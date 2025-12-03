<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class UserAkses
{
    public function handle($request, Closure $next, ...$roles)
    {
        if (
            Auth::check() &&
            Auth::user()->role &&
            in_array(Auth::user()->role->name, $roles)
        ) {
            return $next($request);
        }

        return redirect('/auth_dash')->withErrors(['Anda tidak memiliki akses ke halaman ini.']);
    }
}
