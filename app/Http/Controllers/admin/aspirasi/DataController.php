<?php

namespace App\Http\Controllers\admin\aspirasi;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Aspirasi;

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
            'status'=> 'required|in:menunggu,proses,selesai',
            'feedback' => 'required|string',
        ]);

        $pelaporan = InputAspirasi::findOrFail($id);
        $pelaporan->update([
            'status' => $request->status,
        ]);

        Aspirasi::create([
            'id_pelaporan' => $id,
            'id_admin' => Auth::guard('admin')->user()->id_admin,
            'feedback' => $request->feedback,
        ]);

        return redirect()->back()->with('success', 'Berhasil memperbarui status aspirasi!');
    }
}
