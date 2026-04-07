<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    public function handle(Request $request, Closure $next, $role): Response
    {
        // Cek apakah ada yang login di guard web (Siswa) ATAU guard admin
        $authWeb = Auth::guard('web')->check();
        $authAdmin = Auth::guard('admin')->check();

        if (!$authWeb && !$authAdmin) {
            return redirect()->route('login');
        }


        $userRole = session('user_role');

        if ($userRole !== $role) {
            // Redirect ke dashboard masing-masing jika salah kamar
            return ($userRole === 'admin') 
                ? redirect()->route('dashboard-admin') 
                : redirect()->route('dashboard.siswa');
        }

        return $next($request);
    }
}