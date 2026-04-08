<?php

namespace App\Http\Controllers\admin\aspirasi;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DataController extends Controller
{
    public function index()
    {
        $aspirasi = InputAspirasi::with(['siswa', 'kategori'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('admin.aspirasi.dataAspirasi', compact('aspirasi'));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Menunggu,Proses,Selesai',
            'feedback' => 'required|string|min:5',
        ], [
            'feedback.required' => 'Feedback wajib diisi.',
            'feedback.min' => 'Feedback harus minimal 5 karakter.',
        ]);
        try {
        $aspirasi = InputAspirasi::findOrFail($id);
        $aspirasi->update ([
            'status' => $request->status,
        ]);

        $aspirasi->aspirasi_all()->create([
            'id_pelaporan' => $request->status,
            'feedback' => $request->feedback,
            'id_admin' => Auth::guard('admin')->id(),
            'created_at' => now(),
        ]);
        return redirect()->back()->with('success', 'Status aspirasi berhasil diperbarui!');

        }catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui status: ' . $e->getMessage());
        }

    }
}
