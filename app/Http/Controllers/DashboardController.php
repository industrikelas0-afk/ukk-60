<?php

namespace App\Http\Controllers;

use App\Models\InputAspirasi;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $nisn = Auth::guard('web')->id();

        $laporanTerbaru = InputAspirasi::where('nisn', $nisn)
            ->with('kategori')
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        return view('siswa.dashboard', compact('laporanTerbaru'));
    }
}
