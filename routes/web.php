
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AspirasiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\admin\DashboardAdmController;
use App\Http\Controllers\admin\aspirasi\DataController;
use App\Http\Controllers\admin\aspirasi\KategoriController;
use App\Http\Controllers\admin\SiswaController;

Route::get('/', function () {
    return view('landing');
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('siswa')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.siswa');
        Route::get('/tambah', [AspirasiController::class, 'index'])->name('aspirasi.index');
        Route::post('/tambah', [AspirasiController::class, 'store'])->name('aspirasi.store');
        Route::get('/riwayat-aspirasi', [AspirasiController::class, 'history'])->name('aspirasi.history');
    });
});

Route::middleware(['auth:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdmController::class, 'index'])->name('dashboard.admin');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/aspirasi', [DataController::class, 'index'])->name('admin.aspirasi.index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('admin.kategori.store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('admin.kategori.destroy');
    Route::patch('/aspirasi/{id}/status', [DataController::class, 'updateStatus'])->name('admin.aspirasi.updateStatus');
    Route::get('/siswa/register', [SiswaController::class, 'register'])->name('admin.siswa.register');
    Route::post('/siswa/register', [SiswaController::class, 'store'])->name('admin.siswa.store');

    Route::middleware(['can:access-admin'])->group(function () {
    });
});

require __DIR__.'/auth.php';
