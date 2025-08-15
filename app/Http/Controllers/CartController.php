<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ProductOption;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Add to cart

    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'product_options' => 'nullable|array',
            'product_options.*' => 'exists:product_options,id',
        ]);

        $user = Auth::user();
        if (!$user) {
            return response()->json([
                'message' => 'Please login to add to cart.'
            ], 401);
        }

        $cart = Cart::firstOrCreate(['user_id' => $user->id]);

        // Find existing cart item with same product and same options
        $existingItem = null;
        $productOptions = $request->input('product_options', []);
        $existingItem = null;
        foreach ($cart->items as $cartItem) {
            if ($cartItem->product_id == $request->product_id) {
                $optionIds = $cartItem->options->pluck('id')->sort()->values()->toArray();
                $incomingOptionIds = collect($productOptions)->sort()->values()->toArray();
                if ($optionIds == $incomingOptionIds) {
                    $existingItem = $cartItem;
                    break;
                }
            }
        }

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->save();
        } else {
            $item = CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $request->product_id,
                'quantity' => $request->quantity,
            ]);
            if (!empty($productOptions)) {
                $item->options()->sync($productOptions);
            }
        }

        return back()->with('success', 'Product added to cart.');
    }

    // View cart

    public function index()
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('customer.login')->with('error', 'Please login to view your cart.');
        }
        $cart = Cart::with(['items.product', 'items.options'])->where('user_id', $user->id)->first();
        $cartItems = $cart ? $cart->items : collect();
        $cartSubtotal = $cartItems->sum(function ($item) {
            return $item->product->discounted_price * $item->quantity;
        });
        $cartTotal = $cartSubtotal; // Add delivery/discount logic if needed
        return view('website.cart', compact('cart', 'cartItems', 'cartSubtotal', 'cartTotal'));
    }

    // Remove item from cart

    public function remove(Request $request, $itemId)
    {
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('customer.login')->with('error', 'Please login to modify your cart.');
        }
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Cart not found.');
        }
        $item = CartItem::where('cart_id', $cart->id)->where('id', $itemId)->first();
        if (!$item) {
            return redirect()->route('cart.index')->with('error', 'Item not found.');
        }
        $item->delete();
        return redirect()->route('cart.index')->with('success', 'Item removed from cart.');
    }

    // Update item quantity

    public function update(Request $request, $itemId)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);
        $user = Auth::user();
        if (!$user) {
            return redirect()->route('customer.login')->with('error', 'Please login to modify your cart.');
        }
        $cart = Cart::where('user_id', $user->id)->first();
        if (!$cart) {
            return redirect()->route('cart.index')->with('error', 'Cart not found.');
        }
        $item = CartItem::where('cart_id', $cart->id)->where('id', $itemId)->first();
        if (!$item) {
            return redirect()->route('cart.index')->with('error', 'Item not found.');
        }
        $item->quantity = $request->quantity;
        $item->save();
        return redirect()->route('cart.index')->with('success', 'Cart updated.');
    }
}