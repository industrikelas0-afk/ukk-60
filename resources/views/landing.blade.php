<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIGAP - Sistem Aspirasi Digital SMKN 4 Tangerang</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800&display=swap" rel="stylesheet" />
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* Animasi tambahan untuk elemen dekoratif */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 5s ease-in-out infinite;
        }
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="antialiased font-sans bg-white text-gray-900">

    <nav class="fixed w-full z-50 top-0 left-0 bg-white/90 backdrop-blur-md border-b border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center">
                    <x-sigap-logo class="h-12 w-auto" />
                    <span class="ml-3 text-2xl font-extrabold tracking-tight ">SIGAP</span>
                </div>

                <div class="flex items-center">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard-siswa') }}" class="text-red-600 font-bold hover:text-red-800 transition">
                                <i class="fa-solid fa-gauge-high mr-1"></i> Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="bg-red-600 text-white px-8 py-2.5 rounded-xl font-bold shadow-lg shadow-red-200 hover:bg-red-700 transition transform hover:scale-105">
                                <i class="fa-solid fa-user-lock mr-2 text-sm"></i> Login
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <section class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="lg:w-1/2 text-left" data-aos="fade-right">
                    <h1 class="text-5xl lg:text-7xl font-extrabold text-gray-900 mb-6 leading-[1.1]">
                        Suaramu Adalah<br/>
                        <span class="text-red-600">Energi Perubahan.</span>
                    </h1>
                    <p class="text-lg text-gray-500 mb-10 max-w-xl leading-relaxed font-medium">
                        Jadilah bagian dari solusi. SIGAP hadir sebagai jembatan resmi untuk menyampaikan ide, laporan fasilitas, dan saran inovatif demi mewujudkan SMKN 4 Tangerang yang lebih unggul.
                    </p>
                    
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ url('/dashboard-siswa') }}" class="px-10 py-4 bg-red-600 text-white font-bold rounded-xl shadow-xl shadow-red-100 hover:bg-red-700 transition-all flex items-center group">
                                Mulai Suarakan <i class="fa-solid fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="px-10 py-4 bg-red-600 text-white font-bold rounded-xl shadow-xl shadow-red-100 hover:bg-red-700 transition-all flex items-center group">
                                Mulai Suarakan <i class="fa-solid fa-arrow-right ml-3 group-hover:translate-x-2 transition-transform"></i>
                            </a>
                            <a href="#flow" class="px-10 py-4 bg-white border border-gray-200 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition shadow-sm">
                                Pelajari Alur
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="lg:w-1/2 relative flex justify-center" data-aos="fade-left">
                    <div class="relative bg-white p-12 rounded-[50px] shadow-2xl shadow-gray-200 border border-gray-50 animate-float">
                        <x-sigap-logo class="w-full h-auto max-w-[320px] mx-auto" />
                    </div>
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-red-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50 animate-pulse"></div>
                    <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-orange-100 rounded-full mix-blend-multiply filter blur-3xl opacity-50"></div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-24 bg-gray-50/50 border-y border-gray-100">
        <div class="max-w-7xl mx-auto px-4">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl lg:text-4xl font-extrabold text-gray-900 mb-3">Pilar Utama Kami</h2>
                <p class="text-gray-500 font-medium">Landasan Sistem Aspirasi Digital</p>
                <div class="w-20 h-1.5 bg-red-600 mx-auto mt-4 rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-red-200 hover:shadow-xl hover:shadow-red-50 transition-all group" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-red-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-red-600 transition-colors duration-300">
                        <i class="fa-solid fa-eye text-red-600 text-xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Visi</h3>
                    <p class="text-gray-500 leading-relaxed text-sm font-medium">
                        Mewujudkan lingkungan sekolah yang modern, nyaman, aman, dan mendukung penuh aktivitas pembelajaran siswa secara inklusif.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-red-200 hover:shadow-xl hover:shadow-red-50 transition-all group" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-14 h-14 bg-orange-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-red-600 transition-colors duration-300">
                        <i class="fa-solid fa-bullseye text-orange-600 text-xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Misi</h3>
                    <p class="text-gray-500 leading-relaxed text-sm font-medium">
                        Memberikan wadah digital bagi seluruh elemen siswa untuk menyampaikan aspirasi secara transparan, mudah, dan terstruktur.
                    </p>
                </div>

                <div class="bg-white p-10 rounded-3xl shadow-sm border border-gray-100 hover:border-red-200 hover:shadow-xl hover:shadow-red-50 transition-all group" data-aos="fade-up" data-aos-delay="300">
                    <div class="w-14 h-14 bg-emerald-50 rounded-2xl flex items-center justify-center mb-8 group-hover:bg-red-600 transition-colors duration-300">
                        <i class="fa-solid fa-handshake text-emerald-600 text-xl group-hover:text-white"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-4">Kolaborasi</h3>
                    <p class="text-gray-500 leading-relaxed text-sm font-medium">
                        Membangun sinergi yang kuat antara admin, guru, dan siswa melalui komunikasi aktif untuk membangun sekolah yang lebih baik.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section id="flow" class="py-24 bg-white overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <span class="text-red-600 font-bold uppercase tracking-widest text-sm italic">Langkah Mudah</span>
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mt-2">Alur Menyuarakan <span class="text-red-600">Aspirasi</span></h2>
                <p class="text-gray-500 mt-4 max-w-2xl mx-auto font-medium">Ikuti 4 langkah sederhana ini untuk membantu kemajuan sekolah.</p>
            </div>

            <div class="relative">
                <div class="hidden lg:block absolute top-1/2 left-0 w-full h-0.5 bg-gray-100 -translate-y-1/2 z-0"></div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 relative z-10">
                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-100 transition-all group text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-16 h-16 bg-red-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-red-200 group-hover:rotate-12 transition-transform">
                            <i class="fa-solid fa-right-to-bracket text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">1. Masuk Akun</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Login menggunakan akun NISN Anda yang terdaftar pada sistem SIGAP.
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-100 transition-all group text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-16 h-16 bg-red-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-red-200 group-hover:rotate-12 transition-transform">
                            <i class="fa-solid fa-file-pen text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">2. Isi Aspirasi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Tuliskan laporan, keluhan, atau saran detail dan lampirkan foto
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-100 transition-all group text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-16 h-16 bg-red-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-red-200 group-hover:rotate-12 transition-transform">
                            <i class="fa-solid fa-spinner text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">3. Verifikasi</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Laporan akan cek oleh Admin untuk segera ditindaklanjuti
                        </p>
                    </div>

                    <div class="bg-white p-8 rounded-3xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-100 transition-all group text-center" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-16 h-16 bg-red-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-6 shadow-lg shadow-red-200 group-hover:rotate-12 transition-transform">
                            <i class="fa-solid fa-check-double text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">4. Selesai</h3>
                        <p class="text-gray-500 text-sm leading-relaxed">
                            Pantau perkembangan penanganan laporan Anda melalui riwayat laporan
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-16 text-center" data-aos="zoom-in">
                <a href="{{ route('login') }}" class="inline-flex items-center px-10 py-4 bg-gray-900 text-white font-bold rounded-2xl hover:bg-red-600 transition-all shadow-xl hover:-translate-y-1">
                    Siap Melapor? Mulai Sekarang <i class="fa-solid fa-arrow-pointer ml-3"></i>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-gray-950 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-8 mb-12">
                <div>
                    <div class="flex items-center mb-4">
                        <span class=" text-2xl font-bold tracking-tight text-white">SIGAP</span>
                    </div>
                    <p class="text-gray-400 text-sm max-w-sm font-medium">
                        Sistem Aspirasi Siswa SMKN 4 Tangerang. Wadah inovatif untuk menampung ide demi kemajuan sekolah.
                    </p>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="w-12 h-12 bg-gray-900 border border-gray-800 rounded-xl flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition shadow-sm">
                         <i class="fa-brands fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-12 h-12 bg-gray-900 border border-gray-800 rounded-xl flex items-center justify-center hover:bg-red-600 hover:border-red-600 transition shadow-sm">
                        <i class="fa-solid fa-envelope text-lg"></i>
                    </a>
                </div>
            </div>
            
            <div class="pt-8 border-t border-gray-900 flex flex-col md:flex-row justify-between gap-4">
                <p class="text-gray-500 text-xs font-semibold">
                    &copy; {{ date('Y') }} SIGAP - SMK Negeri 4 Tangerang. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true,
            offset: 100
        });
    </script>
</body>
</html>