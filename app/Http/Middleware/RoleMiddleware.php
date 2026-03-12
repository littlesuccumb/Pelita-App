<?php
// File: app/Http/Middleware/RoleMiddleware.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  ...$roles
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // Jika user belum login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika tidak ada role yang diberikan, lanjutkan
        if (empty($roles)) {
            return $next($request);
        }

        // Cek apakah user memiliki salah satu role yang dibutuhkan
        $userRole = Auth::user()->role;
        
        if (in_array($userRole, $roles)) {
            return $next($request);
        }

        // Jika tidak memiliki akses
        abort(403, 'Anda tidak memiliki akses untuk halaman ini.');
    }
}