@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/adminSiswa.css') }}">

<div class="siswa-page-wrapper">
    <div class="register-card">
        <div class="card-header-gradient">
            <div class="header-text">
                <h2>Registrasi Siswa Baru </h2>
                <p>Silakan isi data lengkap di bawah untuk mendaftarkan akun</p>
            </div>
            <div class="header-icon"><i class="fa-solid fa-user-plus"></i></div>
        </div>

        <form action="{{ route('admin.siswa.store') }}" method="POST" class="form-register">
            @csrf
            <div class="form-body">
                <div class="form-section">
                    <div class="input-group-modern">
                        <label><i class="fa-solid fa-id-card"></i> NISN</label>
                        <input type="text" name="nisn" class="@error('nisn') is-invalid @enderror" value="{{ old('nisn') }}" required>
                        @error('nisn') <span class="error-text" style="color: var(--primary-red); font-size: 12px;">{{ $message }}</span> @enderror
                    </div>
                    <div class="input-group-modern">
                        <label><i class="fa-solid fa-user"></i> Nama Lengkap</label>
                        <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                    </div>
                    <div class="input-group-modern">
                        <label><i class="fa-solid fa-lock"></i> Password</label>
                        <input type="password" name="password" required>
                    </div>
                </div>

                <div class="divider-vertical"></div>

                <div class="form-section">
                    <div class="input-group-modern">
                        <label><i class="fa-solid fa-graduation-cap"></i> Kelas</label>
                        <select name="kelas" required>
                            <option value="" disabled selected>Pilih Kelas</option>
                            <option value="X">X</option>
                            <option value="XI">XI</option>
                            <option value="XII">XII</option>
                        </select>
                    </div>
                    <div class="input-group-modern">
                        <label><i class="fa-solid fa-book"></i> Jurusan</label>
                        <input type="text" name="jurusan"  required>
                    </div>
                    <div class="info-box-red">
                        <i class="fa-solid fa-circle-info"></i>
                        <p>Pastikan NISN dan data diri sesuai </p>
                    </div>
                </div>
            </div>
            <div class="form-footer-actions">
                <button type="submit" class="btn-primary-gradient">Simpan <i class="fa-solid fa-save"></i></button>
            </div>
        </form>

        <hr class="section-divider">

        <div class="table-container">
            <h3 class="table-title">Akun Terdaftar Terbaru</h3>
            <table class="modern-table">
                <thead>
                    <tr>
                        <th>NISN</th>
                        <th>Nama Lengkap</th>
                        <th>Kelas & Jurusan</th>
                        <th>Role</th>
                        <th>Tgl Terdaftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td><strong>{{ $user->nisn }}</strong></td>
                        <td>{{ $user->nama_lengkap }}</td>
                        <td>{{ $user->kelas }}</td>
                        <td><span class="badge-red">{{ strtoupper($user->role) }}</span></td>
                        <td>{{ $user->created_at->format('d/m/Y') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: var(--text-gray); padding: 30px;">Belum ada siswa yang didaftarkan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection