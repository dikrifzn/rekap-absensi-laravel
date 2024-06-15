<?php

use App\Http\Controllers\KelasController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\PelajaranController;
use App\Http\Controllers\Auth\LoginController;

Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.login');
Route::post('/logout', [LoginController::class, 'logout'])->name('login.logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/absen', [KelasController::class, 'absen']);
    Route::get('/absen/{namaKelas}', [RekapController::class, 'index']);
    Route::post('/absenAdd', [RekapController::class, 'store']);

    Route::resource('/rekap', KehadiranController::class);
    Route::post('/rekap/filter', [KehadiranController::class, 'filter'])->name('rekap.filter');
    Route::post('/download-rekap', [KehadiranController::class, 'downloadRekap'])->name('rekap.download');

    Route::get('/siswa/search', [SiswaController::class, 'search'])->name('siswa.search');
    Route::resource('/siswa', SiswaController::class);
    Route::resource('/kelas', KelasController::class);
    Route::resource('/guru', GuruController::class);
    Route::resource('/jadwal', JadwalController::class);
    Route::resource('/pelajaran', PelajaranController::class);
});
