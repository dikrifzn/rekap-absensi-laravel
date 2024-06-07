<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\KehadiranController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JadwalController;

Route::get('/', function () {
    return view('login');
});

Route::get('/absen', [KelasController::class, 'absen']);
Route::get('/absen/{namaKelas}', [RekapController::class, 'index']);
Route::post('/absenAdd', [RekapController::class, 'store']);

Route::resource('/rekap', KehadiranController::class);
Route::resource('/siswa', SiswaController::class);
Route::resource('/kelas', KelasController::class);
Route::resource('/guru', GuruController::class);
Route::resource('/jadwal', JadwalController::class);