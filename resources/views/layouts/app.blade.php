<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGAP - Sistem Informasi Pengaduan</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        body { 
            margin: 0; 
            padding: 0; 
            font-family: 'sans-serif'; 
            background-color: #f8f9fa;
        }
        .main-layout { 
            display: flex; 
            min-height: 100vh; 
        }
        main { 
            flex: 1; 
            min-width: 0; 
        }
    </style>
</head>
<body>

    <div class="main-layout">
        {{-- 1. PEMILIHAN SIDEBAR BERDASARKAN GUARD --}}
        
        @auth('admin')
            {{-- Muncul jika login sebagai Admin atau Petugas --}}
            @include('layouts.sidebarAdm')
        @endauth

        @auth('web')
            {{-- Muncul jika login sebagai Siswa --}}
            @include('layouts.sidebar')
        @endauth

        {{-- 2. AREA KONTEN UTAMA --}}
        <main>
            @yield('content')
        </main>
    </div>

    <script>
        function toggleDropdown(element) {
            element.classList.toggle('open');
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- Notifikasi Sukses --}}
    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

    {{-- Notifikasi Error (Termasuk Kredensial Salah) --}}
    @if($errors->any())
    <script>
        Swal.fire({
            icon: 'error',
            title: 'Terjadi Kesalahan',
            text: "{{ $errors->first() }}",
            confirmButtonColor: '#d33'
        });
    </script>
    @endif

</body>
</html>