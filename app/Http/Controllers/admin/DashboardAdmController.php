<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\InputAspirasi;
use App\Models\User;


class DashboardAdmController extends Controller
{
    public function index()
    {
    $totalSiswa = User::count();
    $statusMenunggu = InputAspirasi::where('status', 'Menunggu')->count();
    $statusProses = InputAspirasi::where('status', 'Proses')->count();
    $statusSelesai = InputAspirasi::where('status', 'Selesai')->count();

    $aspirasiTerbaru = InputAspirasi::with('kategori')
        ->orderBy('created_at', 'desc')
        ->take(5)
        ->get();

        return view('admin.dashboardAdm', compact('totalSiswa', 'statusMenunggu', 'statusProses', 'statusSelesai', 'aspirasiTerbaru'));
    }
}
