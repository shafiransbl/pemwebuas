<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckIfLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!auth::check()) {
            // Cek apakah URL yang diminta adalah untuk halaman 'home'
            if ($request->is('home') || $request->is('/')) {
                return $next($request);  // Lanjutkan ke halaman home
            }

            // Jika bukan halaman 'home', redirect ke halaman login
            return redirect()->route('login');
        }

        // Jika sudah login, lanjutkan request
        return $next($request);
    }    
}
