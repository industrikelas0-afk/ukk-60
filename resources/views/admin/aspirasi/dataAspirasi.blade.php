@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/aspirasiAdmin.css') }}">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="aspirasi-page-wrapper">
    <header class="page-header">
        <div class="header-left">
            <h1>Daftar Aspirasi Siswa </h1>
            <p>Kelola laporan </p>
        </div>
        <a href="{{ route('dashboard-admin') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Dashboard
        </a>
    </header>

    {{-- Alert Berhasil --}}
    @if(session('success'))
        <div class="alert-success" id="success-alert">
            <div class="alert-content">
                <i class="fa-solid fa-check-circle"></i>
                <span><strong>Berhasil!</strong> {{ session('success') }}</span>
            </div>
            <div class="alert-progress"></div>
        </div>
    @endif

    <div class="aspirasi-grid">
        @forelse($aspirasi as $item)
        <div class="aspirasi-card">
            <div class="card-header">
                <div class="user-profile">
                    <div class="avatar-box">
                        {{ strtoupper(substr($item->siswa->nama_lengkap ?? 'S', 0, 1)) }}
                    </div>
                    <div>
                        <h4 class="student-name">{{ $item->siswa->nama_lengkap }}</h4>
                        <small class="student-info">NISN: {{ $item->siswa->nisn }}</small>
                    </div>
                </div>
                <span class="badge-status {{ strtolower($item->status) }}">{{ $item->status }}</span>
            </div>

            <div class="card-body">
                <div class="category-tag">{{ $item->kategori->nama_kategori ?? 'Umum' }}</div>
                <p class="complaint-text">{{ $item->ket }}</p>
            </div>

            <div class="card-footer">
                <small class="timestamp">
                    <i class="fa-regular fa-clock"></i> 
                    {{ $item->created_at->diffForHumans() }}
                </small>
                
                <button class="btn-detail" onclick="openModal(
                    '{{ $item->id_pelaporan }}', 
                    '{{ $item->status }}', 
                    '{{ addslashes($item->ket) }}', 
                    {{ $item->aspirasi_all->toJson() }}, 
                    '{{ $item->siswa->nisn }}',
                    '{{ $item->siswa->nama_lengkap }}',
                    '{{ $item->siswa->kelas }}',
                    '{{ addslashes($item->lokasi) }}',
                    '{{ $item->foto ? asset('storage/' . $item->foto) : '' }}',
                    '{{ $item->kategori->nama_kategori ?? 'Umum' }}'
                )">Detail & Balas</button>
            </div>
        </div>
        
        @empty
        {{-- TAMPILAN KETIKA ASPIRASI KOSONG --}}
        <div class="empty-state-container">
            <div class="empty-state-content">
                <div class="illustration-wrapper">
                    <i class="fa-solid fa-inbox"></i>
                    <div class="pulse-ring"></div>
                </div>
                <h3>Belum Ada Aspirasi Masuk</h3>
                <div class="empty-state-footer">
                    <span class="status-indicator">
                        <span class="dot"></span> Sistem Siaga
                    </span>
                </div>
            </div>
        </div>
        @endforelse
    </div>

    <div class="pagination-wrapper">
        {{ $aspirasi->links() }}
    </div>
</div>

{{-- MODAL DETAIL & RIWAYAT --}}
<div id="modalDetail" class="modal">
    <div class="modal-content">
        <h3 class="modal-title">Detail Aspirasi & Riwayat Tanggapan</h3>
        
        <div class="modal-body-grid">
            <div class="modal-col">
                <div class="info-box">
                    <p><strong>Nama:</strong> <span id="vNama"></span></p>
                    <p><strong>NISN / Kelas:</strong> <span id="vNisn"></span> / <span id="vKelas"></span></p>
                    <p><strong>Lokasi:</strong> <span id="vLokasi"></span></p>
                    <p><strong>Kategori:</strong> <span id="vKategori" class="category-badge-modal"></span></p>
                </div>

                <label class="form-label">Isi Aspirasi:</label>
                <div id="vKet" class="complaint-display"></div>

                <label class="form-label"><i class="fa-solid fa-history"></i> Riwayat Tanggapan</label>
                <div class="feedback-slider-wrapper">
                    <div id="feedbackContent"></div>
                    <div class="slider-controls" id="sliderNav">
                        <button type="button" class="nav-btn" onclick="changeFB(-1)" id="prevBtn">←</button>
                        <span id="fbCounter">0/0</span>
                        <button type="button" class="nav-btn" onclick="changeFB(1)" id="nextBtn">→</button>
                    </div>
                </div>
            </div>

            <div class="modal-col">
                <label class="form-label">Foto Bukti:</label>
                <div id="photoArea">
                    <img id="vFoto" src="" class="img-fluid-custom" style="display:none;">
                    <div id="vNoFoto" class="no-photo-placeholder">
                        <i class="fa-solid fa-image-slash"></i>
                        <p>Tidak ada foto bukti</p>
                    </div>
                </div>
            </div>
        </div>

        <form id="formUpdate" method="POST" class="form-update-status">
            @csrf
            @method('PATCH')
            <div class="form-row">
                <div class="form-group">
                    <label>Ubah Status:</label>
                    <select name="status" id="iStatus" class="form-control">
                        <option value="menunggu">Menunggu</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Berikan Tanggapan:</label>
                    <textarea name="feedback" class="form-control" rows="3" placeholder="Tuliskan tanggapan untuk siswa..." required></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn-secondary" onclick="closeModal()">Batal</button>
                <button type="submit" class="btn-detail">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

<script>
    // --- LOGIKA AUTO-HIDE ALERT ---
    const alertBox = document.getElementById('success-alert');
    if(alertBox) {
        setTimeout(() => {
            alertBox.style.transition = "all 0.6s ease";
            alertBox.style.opacity = "0";
            alertBox.style.transform = "translateX(20px)";
            setTimeout(() => alertBox.remove(), 600);
        }, 5000);
    }

    let fbData = [];
    let currentIdx = 0;

    function openModal(id, status, ket, feedbacks, nisn, nama, kelas, lokasi, foto, kategori) {
        document.getElementById('vNama').innerText = nama;
        document.getElementById('vNisn').innerText = nisn;
        document.getElementById('vKelas').innerText = kelas;
        document.getElementById('vLokasi').innerText = lokasi;
        document.getElementById('vKategori').innerText = kategori;
        document.getElementById('vKet').innerText = `"${ket}"`;

        fbData = feedbacks;
        currentIdx = fbData.length - 1; 
        renderFB();

        const img = document.getElementById('vFoto');
        const noImg = document.getElementById('vNoFoto');
        if(foto) {
            img.src = foto;
            img.style.display = 'block';
            noImg.style.display = 'none';
        } else {
            img.style.display = 'none';
            noImg.style.display = 'flex';
        }

        document.getElementById('iStatus').value = status.toLowerCase();
        document.getElementById('formUpdate').action = `/admin/aspirasi/${id}/status`;
        document.getElementById('modalDetail').style.display = 'flex';
    }

    function renderFB() {
        const container = document.getElementById('feedbackContent');
        const counter = document.getElementById('fbCounter');
        
        if(fbData.length > 0) {
            const fb = fbData[currentIdx];
            const dateObj = new Date(fb.created_at);
            const dateFormatted = dateObj.toLocaleDateString('id-ID', { day: 'numeric', month: 'long', year: 'numeric' });
            const timeFormatted = dateObj.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });

            container.innerHTML = `
                <div class="feedback-bubble">
                    <div class="feedback-header">
                        <strong>ADMIN</strong>
                        <span class="feedback-time">${dateFormatted} • ${timeFormatted} WIB</span>
                    </div>
                    <div class="feedback-body">${fb.feedback}</div>
                </div>`;
            counter.innerText = `${currentIdx + 1} / ${fbData.length}`;
        } else {
            container.innerHTML = `<div class="empty-fb">Belum ada tanggapan resmi.</div>`;
            counter.innerText = "0/0";
        }

        document.getElementById('prevBtn').disabled = (currentIdx <= 0);
        document.getElementById('nextBtn').disabled = (currentIdx >= fbData.length - 1);
    }

    function changeFB(step) {
        currentIdx += step;
        renderFB();
    }

    function closeModal() { document.getElementById('modalDetail').style.display = 'none'; }
    window.onclick = function(e) { if(e.target == document.getElementById('modalDetail')) closeModal(); }
</script>
@endsection