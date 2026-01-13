<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class FiturMiddleware
{
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('auth.login-register')->withErrors(['Silakan login terlebih dahulu untuk mengakses fitur.']);
        }

        return $next($request);
    }
}
