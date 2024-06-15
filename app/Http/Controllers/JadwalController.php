<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JadwalController extends Controller
{
    public function index(){
        $jadwalMengajars = DB::table('jadwal_mengajar')
        ->join('kelas', 'jadwal_mengajar.id_kelas', '=', 'kelas.id')
        ->select('jadwal_mengajar.id', 'jadwal_mengajar.waktu', 'jadwal_mengajar.deskripsi', 'jadwal_mengajar.id_kelas', 'kelas.nama_kelas')
        ->get();

        $kelases = DB::table('kelas')->get();

        return view('jadwal', ['jadwalMengajars' => $jadwalMengajars, 'kelases' => $kelases]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'waktu' => 'required',
            'deskripsi' => 'required',
            'id_kelas' => 'required'
        ]);
    
        DB::table('jadwal_mengajar')->insert([
            'waktu' => $request->waktu,
            'deskripsi' => $request->deskripsi,
            'id_kelas' => $request->id_kelas,
            'created_at' => now()
        ]);
    
        return redirect('/jadwal')->with('success', 'Data Jadwal berhasil ditambahkan.');
    }
    public function update(Request $request, string $id)
    {
        $request->validate([
            'waktu' => 'required',
            'deskripsi' => 'required',
            'id_kelas' => 'required'
        ]);
    
        DB::table('jadwal_mengajar')->where('id', $id)->update([
            'waktu' => $request->waktu,
            'deskripsi' => $request->deskripsi,
            'id_kelas' => $request->id_kelas,
            'updated_at' => now()
        ]);
    

        return redirect('/jadwal')->with('success', 'Data Jadwal berhasil diubah.');
    }
    public function destroy(string $id)
    {
        DB::table('jadwal_mengajar')->where('id', $id)->delete(); 
        return redirect('/jadwal')->with('success', 'Data Jadwal berhasil dihapus.');
    }
}
