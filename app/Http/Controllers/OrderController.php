<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingAddress;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Customer: view their own orders
    public function index()
    {
        $orders = Order::with('items.product', 'shippingAddress')->where('user_id', Auth::id())->latest()->get();
        return view('website.orders.index', compact('orders'));
    }

    // Admin: view all orders
    public function adminIndex()
    {
        $orders = Order::with('user', 'items.product', 'shippingAddress')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    // Admin: show order details
    public function adminShow($id)
    {
        $order = Order::with('user', 'items.product', 'shippingAddress')->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }

    // Admin: edit order status/payment
    public function adminEdit($id)
    {
        $order = Order::with('user', 'items.product', 'shippingAddress')->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    // Admin: update order status/payment
    public function adminUpdate(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $request->validate([
            'order_status' => 'required|string',
            'payment_status' => 'required|string',
        ]);
        $order->order_status = $request->order_status;
        $order->payment_status = $request->payment_status;
        $order->save();
        return redirect()->route('admin.orders.index')->with('success', 'Order updated successfully.');
    }

    public function create()
    {
        $addresses = ShippingAddress::where('user_id', Auth::id())->get();
        return view('website.orders.create', compact('addresses'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'shipping_address_id' => 'required|exists:shipping_addresses,id',
        ]);
        $user = Auth::user();
        $cart = Cart::with('items.product')->where('user_id', $user->id)->first();

        if (!$cart || $cart->items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }
        DB::beginTransaction();
        try {
            $total = $cart->items->sum(function ($item) {
                return $item->product->discounted_price * $item->quantity;
            });
            $order = Order::create([
                'user_id' => $user->id,
                'order_status' => 'pending',
                'payment_status' => 'unpaid',
                'shipping_address_id' => $request->shipping_address_id,
                'total_amount' => $total,
            ]);
            foreach ($cart->items as $item) {
                $orderItem = OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price_at_purchase' => $item->product->discounted_price,
                ]);
                // Copy selected options from cart item to order item
                if ($item->options && $item->options->count()) {
                    $orderItem->options()->sync($item->options->pluck('id')->toArray());
                }
            }
            $cart->items()->delete();
            DB::commit();
            return redirect()->route('cart.index')->with('success', 'Order placed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to place order: ' . $e->getMessage());
        }
    }
}