<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InputAspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class AspirasiController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('siswa.aspirasi.tambah', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kategori' => 'required|exists:kategori,id_kategori',
            'lokasi'      => 'required|string|max:255',
            'ket'         => 'required',
            'foto'        => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $namaFoto = null;
        if ($request->hasFile('foto')) {
            $namaFoto = $request->file('foto')->store('uploads/aspirasi', 'public');
        }

        InputAspirasi::create([
            'nisn'        => Auth::user()->nisn,
            'id_kategori' => $request->id_kategori,
            'ket'         => $request->ket,
            'lokasi'      => $request->lokasi,
            'foto'        => $namaFoto,
            'status'      => 'menunggu'
        ]);

        return redirect()->route('aspirasi.history')->with('success', 'Aspirasi berhasil terkirim!');
    }

    public function history()
    {
        $riwayat = InputAspirasi::where('nisn', Auth::user()->nisn)
            ->with(['kategori', 'aspirasi_all'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('siswa.aspirasi.riwayat', compact('riwayat'));
    }
}
