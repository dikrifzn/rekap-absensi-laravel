<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class RekapController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($namaKelas)
    {
        $rekapSiswas = DB::table('siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
        ->select('siswa.nis', 'siswa.nama')
        ->where('kelas.nama_kelas', $namaKelas)
        ->get();
        $pelajarans = DB::table('pelajaran')->get();

        return view('absenkelas', ['rekapSiswas' => $rekapSiswas, 'pelajarans' => $pelajarans]);
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
        // Validasi input jika diperlukan
        $request->validate([
            'nis' => 'required|array',
            'nis.*' => 'required|string',
        ]);

        // Ambil data dari request
        $nisArray = $request->input('nis');
        $matapelajaran = $request->input('matapelajaran'); // Asumsikan id_pelajaran dikirim dari form atau diatur di controller
        $tanggal = $request->input('tanggal');

        foreach ($nisArray as $nis) {
            $statusPresensi = $request->input($nis . '_status');

            // Gunakan DB Facade untuk memasukkan data ke tabel kehadiran
            DB::table('kehadiran')->insert([
                'tanggal' => $tanggal,
                'nis' => $nis,
                'id_pelajaran' => $matapelajaran,
                'status_presensi' => $statusPresensi,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Redirect atau kembalikan respon sesuai kebutuhan
        return redirect()->back()->with('success', 'Data kehadiran berhasil disimpan.');
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