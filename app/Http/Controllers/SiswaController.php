<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siswa = DB::table('siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
        ->select('siswa.nis', 'siswa.nama', 'siswa.jk', 'kelas.id', 'kelas.nama_kelas', 'siswa.status')
        ->get();

        $kelases = DB::table('kelas')->get();

        return view('siswa', ['siswas' => $siswa, 'kelases' => $kelases]);
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
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'id_kelas' => 'required',
            'status' => 'required'
        ]);
    
        DB::table('siswa')->insert([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'created_at' => now()
        ]);
    
        return redirect('/siswa')->with('success', 'Data Siswa berhasil ditambahkan.');
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
    public function update(Request $request, $nis)
    {
        $request->validate([
            'nis' => 'required',
            'nama' => 'required',
            'jk' => 'required',
            'id_kelas' => 'required',
            'status' => 'required'
        ]);
    
        DB::table('siswa')->where('nis', $nis)->update([
            'nis' => $request->nis,
            'nama' => $request->nama,
            'jk' => $request->jk,
            'id_kelas' => $request->id_kelas,
            'status' => $request->status,
            'updated_at' => now()
        ]);
    
        return redirect('/siswa')->with('success', 'Data Siswa berhasil diubah.');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nis)
    {
        DB::table('siswa')->where('nis', $nis)->delete(); 
        return redirect('/siswa')->with('success', 'Data Siswa berhasil dihapus.');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $siswas = DB::table('siswa')
        ->join('kelas', 'siswa.id_kelas', '=', 'kelas.id')
        ->select('siswa.nis', 'siswa.nama', 'siswa.jk', 'kelas.nama_kelas', 'kelas.id', 'siswa.status')
        ->where('siswa.nis', 'LIKE', "%$keyword%")
        ->orWhere('siswa.nama', 'LIKE', "%$keyword%")
        ->get();

        $kelases = DB::table('kelas')->get();
        
        return view('siswa', compact('siswas', 'kelases'));
    }
}
