@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/dashboardAdm.css') }}">

<div class="dashboard-wrapper">
    <header class="db-header">
        <div class="greet-user">
            <h1>Halo, {{ auth()->user()->nama }}! </h1>
            <p>Ini ringkasan laporan dan data masuk yang perlu dicek hari ini.</p>
        </div>
        <div class="date-display">
            <i class="fa-regular fa-calendar"></i> 
            {{-- Carbon sudah diset ke ID melalui config/app.php atau locale --}}
            <span>{{ now()->translatedFormat('d F Y') }}</span>
        </div>
    </header>

    <section class="hero-banner">
        <h2>Pusat Kendali SIGAP</h2>
        <p>Semua aspirasi siswa soal fasilitas sekolah kumpul di sini. Yuk, respon laporan mereka biar sekolah kita makin oke!</p>
    </section>

    <h2 class="section-title">Update Data Hari Ini</h2>
    <div class="grid-container">
        <div class="info-card">
            <div class="icon-box bg-blue"><i class="fa-solid fa-users"></i></div>
            <div class="card-label">
                <span>Siswa Terdaftar</span>
                <h3>{{ $totalSiswa }}</h3>
            </div>
        </div>
        
        <div class="info-card">
            <div class="icon-box bg-red"><i class="fa-solid fa-clock"></i></div>
            <div class="card-label">
                <span>Menunggu</span>
                <h3>{{ $statusMenunggu }}</h3>
            </div>
        </div>

        <div class="info-card">
            <div class="icon-box bg-yellow"><i class="fa-solid fa-spinner"></i></div>
            <div class="card-label">
                <span>Proses</span>
                <h3>{{ $statusProses }}</h3>
            </div>
        </div>

        <div class="info-card">
            <div class="icon-box bg-green"><i class="fa-solid fa-circle-check"></i></div>
            <div class="card-label">
                <span>Selesai</span>
                <h3>{{ $statusSelesai }}</h3>
            </div>
        </div>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin: 40px 0 20px;">
        <h2 class="section-title" style="margin: 0;">Aspirasi Terbaru</h2>
        <a href="{{ route('admin.aspirasi.index') }}" style="color: var(--brand-red); font-weight: 700; text-decoration: none; font-size: 14px;">
            Lihat Semua <i class="fa-solid fa-chevron-right" style="font-size: 12px; margin-left: 5px;"></i>
        </a>
    </div>

    <div class="modern-card-container">
        <div class="table-responsive">
            <table class="modern-table" style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="background: #fafbfc; text-align: left;">
                        <th style="padding: 15px 20px; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Identitas Siswa</th>
                        <th style="padding: 15px 20px; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Kelas</th>
                        <th style="padding: 15px 20px; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Kategori</th>
                        <th style="padding: 15px 20px; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Status</th>
                        <th style="padding: 15px 20px; font-size: 13px; color: var(--text-muted); text-transform: uppercase;">Waktu</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($aspirasiTerbaru as $item)
                    <tr style="border-bottom: 1px solid #f8fafc;">
                        <td style="padding: 20px;">
                            <div style="display: flex; align-items: center; gap: 12px;">
                                <div style="width: 40px; height: 40px; background: var(--soft-red); color: var(--brand-red); border-radius: 12px; display: flex; align-items: center; justify-content: center; font-weight: 800;">
                                    {{ strtoupper(substr($item->siswa->nama_lengkap ?? 'S', 0, 1)) }}
                                </div>
                                <div>
                                    <span style="display: block; font-weight: 700; color: var(--text-dark); font-size: 14px;">
                                        {{ $item->siswa->nama_lengkap ?? 'Siswa' }}
                                    </span>
                                    <span style="display: block; color: var(--text-muted); font-size: 12px;">
                                        {{ $item->siswa->nisn ?? '-' }}
                                    </span>
                                </div>
                            </div>
                        </td>
                        <td style="padding: 20px;">
                            <span style="background: #f1f5f9; color: var(--text-dark); padding: 6px 12px; border-radius: 8px; font-size: 12px; font-weight: 700;">
                                {{ $item->siswa->kelas ?? '-' }}
                            </span>
                        </td>
                        <td style="padding: 20px;">
                            <span style="font-weight: 700; color: var(--text-dark); font-size: 14px;">
                                {{ $item->kategori->nama_kategori ?? 'Umum' }}
                            </span>
                        </td>
                        <td style="padding: 20px;">
                            <span class="status-pill {{ strtolower($item->status) }}">
                                {{ ucfirst($item->status) }}
                            </span>
                        </td>
                        <td style="padding: 20px; font-size: 12px; color: var(--text-muted); font-style: italic;">
                            {{-- Memaksa bahasa Indonesia untuk selisih waktu --}}
                            @php \Carbon\Carbon::setLocale('id'); @endphp
                            {{ $item->created_at->diffForHumans() }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 50px; color: var(--text-muted);">
                            Belum ada aspirasi baru yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection