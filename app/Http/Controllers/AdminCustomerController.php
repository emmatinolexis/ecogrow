<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminCustomerController extends Controller
{
    // List all customers
    public function index()
    {
        $customers = User::where('user_type', 'user')->latest()->paginate(20);
        return view('admin.customers.index', compact('customers'));
    }

    // Show customer details
    public function show($id)
    {
        $customer = User::where('user_type', 'user')->findOrFail($id);
        $shippingAddresses = \App\Models\ShippingAddress::where('user_id', $customer->id)->get();
        return view('admin.customers.show', compact('customer', 'shippingAddresses'));
    }

    // Optionally add edit, update, delete logic here
}
