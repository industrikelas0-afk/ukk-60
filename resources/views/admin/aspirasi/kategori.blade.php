@extends('layouts.app')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<link rel="stylesheet" href="{{ asset('css/kategori.css') }}">

<div class="aspirasi-page-wrapper">
    <header class="page-header">
        <div class="header-left">
            <h1>Kategori </h1>
            <p>Kelola kategori aspirasi</p>
        </div>
        <div class="header-right">
            <a href="{{ route('admin.aspirasi.index') }}" class="btn-back">
                <i class="fa-solid fa-list"></i> Data Aspirasi
            </a>
            <a href="{{ route('dashboard.admin') }}" class="btn-back" style="background: #6c757d;">
                Dashboard
            </a>
        </div>
    </header>

    {{-- Alert Success --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000
            });
        </script>
    @endif

    {{-- Alert Error (Pemberitahuan jika kategori sedang digunakan) --}}
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Gagal Menghapus!',
                text: "{{ session('error') }}",
                confirmButtonColor: '#cc0000',
            });
        </script>
    @endif

    <div class="kategori-container" style="display: flex; gap: 25px; margin-top: 20px;">
        <div class="aspirasi-card" style="flex: 1; height: fit-content;">
            <div class="card-header">
                <h4 style="margin:0; font-size: 1.1rem;">Tambah Kategori</h4>
            </div>
            <form action="{{ route('admin.kategori.store') }}" method="POST" style="padding: 20px;">
                @csrf
                <div class="form-group" style="margin-bottom: 15px;">
                    <label style="display:block; margin-bottom: 8px; font-weight:600; font-size: 0.9rem;">Nama Kategori</label>
                    <input type="text" name="nama_kategori" class="form-control" required style="width:100%; padding:12px; border:1px solid #ddd; border-radius:8px;">
                </div>
                <button type="submit" class="btn-detail" style="width: 100%; justify-content: center; padding: 12px; font-weight: 600;">
                    <i class="fa-solid fa-save"></i> Simpan Kategori
                </button>
            </form>
        </div>

        <div class="aspirasi-card" style="flex: 2; padding: 0; overflow: hidden;">
            <table style="width: 100%; border-collapse: collapse;">
                <thead style="background: #f8f9fa;">
                    <tr>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee; width: 60px;">Nomor</th>
                        <th style="padding: 15px; text-align: left; border-bottom: 2px solid #eee;">Nama Kategori</th>
                        <th style="padding: 15px; text-align: center; border-bottom: 2px solid #eee; width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $kat)
                    <tr style="border-bottom: 1px solid #eee;">
                        <td style="padding: 15px; color: #888;">{{ $loop->iteration }}</td>
                        <td style="padding: 15px;">
                            <span class="category-tag" style="background: #e9ecef; color: #495057;">
                                {{ $kat->nama_kategori }}
                            </span>
                        </td>
                        <td style="padding: 15px; text-align: center;">
                            <form action="{{ route('admin.kategori.destroy', $kat->id_kategori) }}" method="POST" class="form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="button" class="btn-hapus-swal" style="background: #ffeded; color: #dc3545; border: 1px solid #ffc2c2; padding: 8px 10px; border-radius: 6px; cursor: pointer;">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" style="padding: 40px; text-align: center;">
                            <p style="color: #999;">Belum ada kategori.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Logika Konfirmasi SweetAlert2
    document.querySelectorAll('.btn-hapus-swal').forEach(button => {
        button.addEventListener('click', function(e) {
            const form = this.closest('.form-delete');

            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Kategori yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#cc0000',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@endsection
