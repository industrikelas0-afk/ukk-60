@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
{{-- Memastikan tabel tetap modern --}}
<link rel="stylesheet" href="{{ asset('css/aspirasis.css') }}">

<div class="dashboard-wrapper">
    <header class="db-header">
        <div class="greet-user">
            <h1>Halo, {{ Auth::user()->nama_lengkap }}!</h1>
            <p>Selamat datang kembali di sistem layanan aspirasi sekolah.</p>
        </div>
        <div class="date-display">
            <i class="fa-regular fa-calendar"></i> 
            <span>{{ now()->translatedFormat('d F Y') }}</span>
        </div>
    </header>

    <section class="hero-banner">
        <h2>Sampaikan Aspirasimu!</h2>
        <p>Setiap laporan yang kamu berikan sangat berarti untuk kemajuan fasilitas sekolah kita.</p>
        <a href="{{ route('aspirasi.index') }}" class="btn-hero">
            Buat Laporan Sekarang
        </a>
    </section>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-top: 40px;">
        <h2 class="section-title" style="margin: 0; font-size: 1.25rem; font-weight: 800; color: var(--text-dark);">
            Laporan Terbaru Anda
        </h2>
        <a href="{{ route('aspirasi.history') }}" style="color: var(--brand-red); font-weight: 700; text-decoration: none; font-size: 14px;">
            Lihat Semua <i class="fa-solid fa-arrow-right" style="font-size: 12px; margin-left: 5px;"></i>
        </a>
    </div>

    <div class="history-card" style="margin-top: 20px;">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($laporanTerbaru as $data)
                    <tr>
                        <td>{{ $data->created_at->format('d/m/Y') }}</td>
                        <td><strong>{{ $data->kategori->nama_kategori ?? 'Umum' }}</strong></td>
                        <td>{{ $data->lokasi }}</td>
                        <td>
                            <span class="badge-status status-{{ strtolower($data->status) }}">
                                {{ ucfirst($data->status) }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" style="padding: 50px; text-align: center; color: var(--text-muted);">
                            <i class="fa-solid fa-inbox" style="font-size: 2rem; display: block; margin-bottom: 10px; opacity: 0.3;"></i>
                            Belum ada laporan yang dikirimkan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection