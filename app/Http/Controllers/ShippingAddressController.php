<?php
namespace App\Http\Controllers;

use App\Models\ShippingAddress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShippingAddressController extends Controller
{
    // List all shipping addresses for the authenticated user
    public function index()
    {
        $addresses = ShippingAddress::where('user_id', Auth::id())->get();
        return view('website.shipping_address', compact('addresses'));
    }

    // Store a new shipping address
    public function store(Request $request)
    {
        $data = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'phone_number' => 'nullable|string|max:30',
            'is_default' => 'boolean',
        ]);
        $data['user_id'] = Auth::id();
        if (!isset($data['is_default']))
            $data['is_default'] = false;
        if ($data['is_default']) {
            ShippingAddress::where('user_id', Auth::id())->update(['is_default' => false]);
        }
        ShippingAddress::create($data);
        return redirect()->route('shipping_addresses.index')->with('success', 'Shipping address added successfully.');
    }

    // Update an existing shipping address
    public function update(Request $request, $id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())->findOrFail($id);
        $data = $request->validate([
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'country' => 'required|string|max:100',
            'postal_code' => 'required|string|max:20',
            'phone_number' => 'nullable|string|max:30',
            'is_default' => 'boolean',
        ]);
        if (isset($data['is_default']) && $data['is_default']) {
            ShippingAddress::where('user_id', Auth::id())->update(['is_default' => false]);
        }
        $address->update($data);
        return redirect()->route('shipping_addresses.index')->with('success', 'Shipping address updated successfully.');
    }

    // Delete a shipping address
    public function destroy($id)
    {
        $address = ShippingAddress::where('user_id', Auth::id())->findOrFail($id);
        $address->delete();
        return redirect()->route('shipping_addresses.index')->with('success', 'Shipping address deleted successfully.');
    }
}