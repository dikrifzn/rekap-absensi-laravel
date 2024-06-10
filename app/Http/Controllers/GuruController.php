<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GuruController extends Controller
{
    public function index(){
        $gurus = DB::table('guru')->get();
        return view('guru', ['gurus' => $gurus]);
    }

    public function store(Request $request)
    {
        // Validasi data yang diterima
        $request->validate([
            'nuptk' => 'required',
            'nama_guru' => 'required'
        ]);
    
        // Gunakan DB Facade untuk menyimpan data
        DB::table('guru')->insert([
            'nuptk' => $request->nuptk,
            'nama_guru' => $request->nama_guru,
            'created_at' => now(), // Jika tabel memiliki kolom timestamps
            'updated_at' => now()  // Jika tabel memiliki kolom timestamps
        ]);
    
        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect('/guru')->with('success', 'Data Guru berhasil ditambahkan.');
    }

    public function update(Request $request, string $nuptk)
    {
        // Validasi data yang diterima
        $request->validate([
            'nuptk' => 'required',
            'nama_guru' => 'required'
        ]);
    
        // Gunakan DB Facade untuk menyimpan data
        DB::table('guru')->where('nuptk', $nuptk)->update([
            'nuptk' => $request->nuptk,
            'nama_guru' => $request->nama_guru,
        ]);
    
        // Redirect ke halaman tertentu dengan pesan sukses
        return redirect('/guru')->with('success', 'Data Guru berhasil diubah.');
    }

    public function destroy(string $nuptk)
    {
        DB::table('guru')->where('nuptk', $nuptk)->delete(); 
        return redirect('/guru')->with('success', 'Data Guru berhasil dihapus.');
    }
}
