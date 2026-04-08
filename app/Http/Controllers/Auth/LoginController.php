<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Admin;

class LoginController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'login'    => 'required|string',
            'password' => 'required|string',
            'role'     => 'required|in:siswa,admin',
        ]);

        $credentials = $request->only('password');
        $role = $request->role;

        if ($role === 'admin') {
            $user = Admin::where('username', $request->login)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::guard('admin')->login($user, $request->boolean('remember'));
                $request->session()->regenerate();

                return redirect()->route('dashboard.admin')
                    ->with('success', 'Login Berhasil! ');
            }

            $errorMessage = 'Username atau Password Admin salah!';
        }

        else {
            $user = User::where('nisn', $request->login)->first();

            if ($user && Hash::check($request->password, $user->password)) {
                Auth::guard('web')->login($user, $request->boolean('remember'));
                $request->session()->regenerate();

                return redirect()->route('dashboard.siswa')
                    ->with('success', 'Selamat Datang, ' . $user->nama_lengkap);
            }

            $errorMessage = 'NISN atau Password Siswa salah!';
        }


        return back()
            ->withErrors(['login' => $errorMessage])
            ->withInput($request->only('login', 'role'));
    }

    public function logout(Request $request)
    {
        // Logout dari semua guard
        Auth::guard('admin')->logout();
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Berhasil Logout!');
    }
}
