<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Cek apakah user sudah login dan memiliki peran yang sesuai
        if (Auth::check() && Auth::user()->hasRole($role)) {
            return $next($request);
        }

        // Jika user tidak memiliki akses, arahkan ke halaman 403 atau redirect sesuai kebutuhan
        abort(401, 'Unauthorized action.');
    }
}
