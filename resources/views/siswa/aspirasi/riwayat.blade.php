@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/aspirasis.css') }}">

<div class="dashboard-wrapper">
    <header class="db-header" style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <div class="greet-user">
            <h1>Riwayat Aspirasimu</h1>
            <p>Pantau status dan detail laporan yang telah kamu kirimkan.</p>
        </div>
        <a href="{{ route('aspirasi.index') }}" class="btn-submit" style="text-decoration: none; font-size: 14px;">
            <i class="fa-solid fa-plus"></i> Buat Baru
        </a>
    </header>

    <div class="history-card">
        <div class="table-responsive">
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($riwayat as $data)
                    <tr>
                        <td>{{ $data->created_at->format('d/m/Y') }}</td>
                        <td><strong>{{ $data->kategori->nama_kategori ?? 'Umum' }}</strong></td>
                        <td>{{ $data->lokasi }}</td>
                        <td>
                            <span class="badge-status status-{{ strtolower($data->status) }}">
                                {{ ucfirst($data->status) }}
                            </span>
                            {{-- Fitur: Menampilkan sudah berapa menit lalu direspon --}}
                            @if(strtolower($data->status) !== 'menunggu')
                                <small style="display: block; color: #94a3b8; font-size: 10px; margin-top: 5px; font-weight: 600;">
                                    <i class="fa-solid fa-clock-rotate-left"></i> {{ $data->updated_at->diffForHumans() }}
                                </small>
                            @endif
                        </td>
                        <td>
                            <button class="btn-action-detail" onclick="showDetail(
                                '{{ $data->created_at->format('d M Y') }}',
                                '{{ $data->kategori->nama_kategori ?? 'Umum' }}',
                                '{{ $data->lokasi }}',
                                '{{ addslashes($data->ket) }}',
                                '{{ $data->foto ? asset('storage/' . $data->foto) : '' }}',
                                '{{ ucfirst($data->status) }}',
                                {{ $data->aspirasi_all->toJson() }} {{-- Kirim data tanggapan admin --}}
                            )">
                                <i class="fa-solid fa-eye"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; padding: 60px; color: #94a3b8;">
                            <i class="fa-solid fa-folder-open" style="font-size: 48px; display: block; margin-bottom: 15px; color: #e2e8f0;"></i>
                            <span style="font-weight: 600;">Belum ada riwayat aspirasi.</span>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- MODAL DETAIL --}}
<div id="modalDetail" class="custom-modal">
    <div class="modal-content-wrapper" style="max-width: 800px;">
        <div class="modal-header">
            <h3>Detail Aspirasi</h3>
            <span class="close-modal" onclick="closeModal()">&times;</span>
        </div>
        <div class="modal-body">
            <div class="detail-grid">
                <div class="detail-info">
                    <div class="info-group">
                        <label>Tanggal Kejadian</label>
                        <p id="detTanggal"></p>
                    </div>
                    <div class="info-group">
                        <label>Kategori & Lokasi</label>
                        <p><span id="detKategori" class="tag"></span> — <span id="detLokasi"></span></p>
                    </div>
                    <div class="info-group">
                        <label>Isi Aspirasi</label>
                        <div id="detKet" class="ket-box"></div>
                    </div>

                    {{-- SEKSI RIWAYAT TANGGAPAN (SESUAI GAMBAR) --}}
                    <div id="sectionRiwayat" style="display: none; margin-top: 25px;">
                        <h4 style="display: flex; align-items: center; gap: 8px; font-size: 15px; color: #1e293b; margin-bottom: 12px;">
                            <i class="fa-solid fa-history"></i> Riwayat Tanggapan
                        </h4>
                        
                        <div style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 20px; padding: 20px;">
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px;">
                                <strong style="font-size: 16px; color: #000; font-weight: 800;">ADMIN</strong>
                                <span id="detTimeTanggapan" style="font-size: 12px; color: #64748b;"></span>
                            </div>
                            
                            <p id="detTeksTanggapan" style="font-size: 14px; color: #334155; margin-bottom: 20px; line-height: 1.5;"></p>
                            
                            {{-- Pagination Mockup --}}
                            <div style="border-top: 1px solid #e2e8f0; padding-top: 15px; display: flex; align-items: center; justify-content: center; gap: 15px;">
                                <button type="button" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e2e8f0; background: white; color: #cbd5e1; cursor: pointer;">&larr;</button>
                                <span id="detCounter" style="font-size: 13px; font-weight: bold; color: #475569;">1 / 1</span>
                                <button type="button" style="width: 32px; height: 32px; border-radius: 50%; border: 1px solid #e2e8f0; background: white; color: #cbd5e1; cursor: pointer;">&rarr;</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail-image">
                    <label>Lampiran Foto</label>
                    <div id="imgContainer">
                        <img id="detFoto" src="" alt="Foto Bukti" style="max-width: 100%; border-radius: 12px;">
                    </div>
                    <p id="noFotoText" class="text-muted">Tidak ada lampiran foto</p>
                    
                    <div class="info-group" style="margin-top: 20px;">
                        <label>Status Saat Ini</label>
                        <p id="detStatus" style="font-weight: bold;"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showDetail(tgl, kat, lok, ket, foto, status, fbData) {
        document.getElementById('detTanggal').innerText = tgl;
        document.getElementById('detKategori').innerText = kat;
        document.getElementById('detLokasi').innerText = lok;
        document.getElementById('detKet').innerText = ket;
        document.getElementById('detStatus').innerText = status;

        // Logika Menampilkan Riwayat Tanggapan Admin
        const section = document.getElementById('sectionRiwayat');
        if (fbData && fbData.length > 0) {
            section.style.display = 'block';
            
            // Ambil tanggapan terbaru (indeks terakhir)
            const lastFB = fbData[fbData.length - 1];
            
            // Format Waktu: 7 April 2026 • 02.37 WIB
            const dateObj = new Date(lastFB.created_at);
            const options = { day: 'numeric', month: 'long', year: 'numeric' };
            const dateStr = dateObj.toLocaleDateString('id-ID', options);
            const timeStr = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' }).replace(':', '.');
            
            document.getElementById('detTeksTanggapan').innerText = lastFB.feedback || lastFB.tanggapan || "Laporan sedang diproses.";
            document.getElementById('detTimeTanggapan').innerText = `${dateStr} • ${timeStr} WIB`;
            document.getElementById('detCounter').innerText = `1 / ${fbData.length}`;
        } else {
            section.style.display = 'none';
        }

        // Logika Foto
        const img = document.getElementById('detFoto');
        const noFoto = document.getElementById('noFotoText');
        if (foto && foto !== '') {
            img.src = foto;
            img.style.display = 'block';
            noFoto.style.display = 'none';
        } else {
            img.style.display = 'none';
            noFoto.style.display = 'block';
        }

        document.getElementById('modalDetail').classList.add('active');
    }

    function closeModal() {
        document.getElementById('modalDetail').classList.remove('active');
    }

    window.onclick = function(event) {
        let modal = document.getElementById('modalDetail');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
@endsection