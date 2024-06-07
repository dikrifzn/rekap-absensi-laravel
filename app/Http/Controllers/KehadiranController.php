<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KehadiranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $query = "
        SELECT siswa.nis, siswa.nama, kelas.nama_kelas, 
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Hadir' THEN 1 ELSE 0 END), 0) as hadir,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Sakit' THEN 1 ELSE 0 END), 0) as sakit,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Izin' THEN 1 ELSE 0 END), 0) as izin,
        COALESCE(SUM(CASE WHEN kehadiran.status_presensi = 'Alpha' THEN 1 ELSE 0 END), 0) as alpha
        FROM siswa
        LEFT JOIN kehadiran ON siswa.nis = kehadiran.nis
        LEFT JOIN kelas ON siswa.id_kelas = kelas.id
        GROUP BY siswa.nis
        ";

        $kehadirans = DB::select($query);

        return view('rekap', compact('kehadirans'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
