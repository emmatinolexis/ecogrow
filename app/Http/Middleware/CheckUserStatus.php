<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
{
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();
        if ($user && $user->status !== 'active') {
            Auth::logout();
            return redirect()->route('login')->withErrors(['email' => 'Your account is inactive.']);
        }
        return $next($request);
    }
}
