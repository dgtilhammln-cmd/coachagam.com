<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    public function handle(Request $request, Closure $next): Response
    {
        // Harus login DAN punya role administrator
        if (!auth()->check() || auth()->user()->role !== 'administrator') {
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized. Administrator access required.'], 403);
            }

            return redirect()->route('admin.login')
                ->with('error', 'Silakan login sebagai administrator terlebih dahulu.');
        }

        // Cek akun aktif
        if (!auth()->user()->is_active) {
            auth()->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect()->route('admin.login')
                ->with('error', 'Akun Anda telah dinonaktifkan. Hubungi super admin.');
        }

        return $next($request);
    }
}
