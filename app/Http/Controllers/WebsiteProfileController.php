<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class WebsiteProfileController extends Controller
{
    public function show()
    {
        return view('website.profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'name' => 'required|string|max:255',
            'current_password' => 'nullable|string',
            'password' => 'nullable|string|min:6|confirmed',
        ]);
        $user->name = $request->name;
        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password is incorrect.']);
            }
            $user->password = Hash::make($request->password);
        }
        $user->save();
        return back()->with('success', 'Profile updated successfully.');
    }
}
