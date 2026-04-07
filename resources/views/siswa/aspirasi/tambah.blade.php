@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/aspirasis.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="dashboard-wrapper">
    <div class="toast-container">
        @if(session('success'))
            <div class="modern-toast" id="modernToast">
                <div class="toast-icon">
                    <i class="fa-solid fa-check"></i>
                </div>
                <div class="toast-content">
                    <h4>Berhasil!</h4>
                    <p>{{ session('success') }}</p>
                </div>
                <div class="toast-close" onclick="closeToast()">&times;</div>
            </div>
        @endif
    </div>

    <header class="db-header">
        <div class="greet-user">
            <h1>Buat Aspirasi </h1>
            <p>Halo <strong>{{ auth()->user()->nama_lengkap ?? auth()->user()->name }}</strong>, sampaikan aspirasimu.</p>
        </div>
    </header>

    <div class="form-card">
        <form action="{{ route('aspirasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label>Kategori Aspirasi</label>
                <select name="id_kategori" class="form-control" required>
                    <option value="" disabled selected>Pilih Kategori </option>
                    @foreach($kategori as $kat)
                        <option value="{{ $kat->id_kategori }}" @selected(old('id_kategori') == $kat->id_kategori)>
                            {{ $kat->nama_kategori }}
                        </option>
                    @endforeach
                </select>
                @error('id_kategori')
                    <small style="color: red;">{{ $message }}</small>
                @enderror
            </div>

            <div class="form-group">
                <label for="lokasi">Lokasi Kejadian</label>
                <input type="text" id="lokasi" name="lokasi" class="form-control" 
                       value="{{ old('lokasi') }}" required>
            </div>

            <div class="form-group">
                <label>Detail Keterangan</label>
                <textarea name="ket" class="form-control" rows="5" 
                         required>{{ old('ket') }}</textarea>
            </div>

            <div class="form-group">
                <label>Lampiran Foto (Opsional)</label>
                <div class="file-upload-wrapper">
                    <input type="file" name="foto" id="foto" class="file-input" onchange="updateLabel(this)" accept="image/*">
                    <label for="foto" class="file-label">
                        <i class="fa-solid fa-camera"></i>
                        <span id="label-text">Klik untuk ambil foto atau pilih file</span>
                    </label>
                </div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-submit">
                    Kirim Aspirasi
                </button>
                <a href="{{ route('dashboard.siswa') }}" class="btn-cancel">Batal</a>
            </div>
        </form>
    </div>
</div>

<script>
    function updateLabel(input) {
        if (input.files.length > 0) {
            document.getElementById('label-text').innerText = input.files[0].name;
        }
    }

    window.onload = function() {
        const toast = document.getElementById('modernToast');
        if(toast) {
            setTimeout(() => { toast.classList.add('show'); }, 100);
            setTimeout(() => { closeToast(); }, 5000);
        }
    }

    function closeToast() {
        const toast = document.getElementById('modernToast');
        if(toast) {
            toast.classList.remove('show');
            setTimeout(() => { toast.remove(); }, 500);
        }
    }
</script>
@endsection