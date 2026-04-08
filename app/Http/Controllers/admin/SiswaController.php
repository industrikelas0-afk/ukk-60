<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function register()
    {
        $users = User::all();
        return view('admin.siswa.register', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'nisn' => 'required|numeric|unique:siswa',
            'password' => 'required|string|min:8',
            'kelas' => 'required|string|max:50',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'nisn' => $request->nisn,
            'password' => bcrypt($request->password),
            'kelas' => $request->kelas,
        ]);

        return redirect()->route('admin.siswa.register')->with('success', 'Siswa berhasil ditambahkan.');
    }

}
