<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOnly
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if (!$user || $user->user_type !== 'admin') {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Only admin users can login.']);
        }
        return $next($request);
    }
}
