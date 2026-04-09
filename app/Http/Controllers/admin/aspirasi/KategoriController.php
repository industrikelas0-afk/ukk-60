<?php

namespace App\Http\Controllers\admin\aspirasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.aspirasi.kategori', compact('kategori'));
    }

    public function store (Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategori,nama_kategori',
        ], [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.max' => 'Nama kategori tidak boleh lebih dari 255 karakter.',
            'nama_kategori.unique' => 'Nama kategori sudah ada, silakan gunakan nama lain.',
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
        ]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $cat = Kategori::findOrFail($id);

        if ($cat->aspirasi()->count() > 0) {
            return redirect()->back()->with('error', 'Kategori tidak bisa di hapus karena sedang di gunakan');
        }

        $cat->delete();
        return redirect()->back()->with('success', 'Kategori berhasil dihapus!');

    }
}

