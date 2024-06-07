<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Jadwal;
use Carbon\Carbon;

class KelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $kelases = DB::table('kelas')
        ->join('guru', 'kelas.id_guru', '=', 'guru.nuptk')
        ->select('kelas.id', 'kelas.nama_kelas', 'guru.nuptk', 'guru.nama_guru')
        ->get();
        $gurus = DB::table('guru')->get();
        return view('kelas', ['kelases' => $kelases, 'gurus' => $gurus]);
    }
    public function absen()
    {
        $kelases = DB::table('kelas')
        ->join('guru', 'kelas.id_guru', '=', 'guru.nuptk')
        ->select('kelas.nama_kelas', 'guru.nama_guru')
        ->get();

    
        $jadwalMengajars = DB::table('jadwal_mengajar')
        ->join('kelas', 'jadwal_mengajar.id_kelas', '=', 'kelas.id')
        ->select('jadwal_mengajar.*', 'kelas.nama_kelas')
        ->get();
        
        // Kirim data ke view
        return view('absen', ['kelases' => $kelases, 'jadwalMengajars' => $jadwalMengajars]);
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
        // Validasi data yang diterima
        $request->validate([
            'nama_kelas' => 'required',
            'id_guru' => 'required'
        ]);
    
        // Gunakan DB Facade untuk menyimpan data
        DB::table('kelas')->insert([
            'nama_kelas' => $request->nama_kelas,
            'id_guru' => $request->id_guru,
            'created_at' => now(), // Jika tabel memiliki kolom timestamps
            'updated_at' => now()  // Jika tabel memiliki kolom timestamps
        ]);
    
        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect('/kelas')->with('success', 'Kelas berhasil ditambahkan.');
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
        // Validasi data yang diterima
        $request->validate([
            'nama_kelas' => 'required',
            'id_guru' => 'required'
        ]);
    
        // Gunakan DB Facade untuk menyimpan data
        DB::table('kelas')->where('id', $id)->update([
            'nama_kelas' => $request->nama_kelas,
            'id_guru' => $request->id_guru,
        ]);
    
        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect('/kelas')->with('success', 'Kelas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('kelas')->where('id', $id)->delete(); 
        return redirect('/kelas')->with('success', 'Kelas berhasil Dihapus.');
    }
}
