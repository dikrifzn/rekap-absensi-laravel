<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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
        ->select('kelas.id', 'kelas.nama_kelas', 'guru.nuptk', 'guru.nama_guru', 'kelas.gambar')
        ->get();
        $gurus = DB::table('guru')->get();
        return view('kelas', ['kelases' => $kelases, 'gurus' => $gurus]);
    }

    public function absen()
    {
        $kelases = DB::table('kelas')
        ->join('guru', 'kelas.id_guru', '=', 'guru.nuptk')
        ->select('kelas.nama_kelas', 'guru.nama_guru', 'kelas.gambar')
        ->get();

    
        $jadwalMengajars = DB::table('jadwal_mengajar')
        ->join('kelas', 'jadwal_mengajar.id_kelas', '=', 'kelas.id')
        ->select('jadwal_mengajar.*', 'kelas.nama_kelas')
        ->get();
        
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
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'id_guru' => 'required|exists:guru,nuptk',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/kelas');
            $gambarPath = Storage::url($gambarPath);
        }
    
        DB::table('kelas')->insert([
            'nama_kelas' => $validated['nama_kelas'],
            'id_guru' => $validated['id_guru'],
            'gambar' => $gambarPath,
            'created_at' => now(),
        ]);    
    
        return redirect('/kelas')->with('success', 'Data Kelas berhasil ditambahkan.');
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
        $validated = $request->validate([
            'nama_kelas' => 'required|string|max:255',
            'nuptk' => 'required|exists:guru,nuptk',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('public/kelas');
            $gambarPath = Storage::url($gambarPath);
        }
    
        $kelas = DB::table('kelas')->where('id', $id)->first();
    
        DB::table('kelas')->where('id', $id)->update([
            'nama_kelas' => $validated['nama_kelas'],
            'id_guru' => $validated['nuptk'],
            'gambar' => $gambarPath ?? $kelas->gambar,
            'updated_at' => now(),
        ]);
    
        return redirect('/kelas')->with('success', 'Data Kelas berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kelas = DB::table('kelas')->where('id', $id)->first();

        if ($kelas) {
            if ($kelas->gambar) {
                Storage::delete($kelas->gambar);
                DB::table('kelas')->where('id', $id)->delete();
            }
        }
        
        return redirect('/kelas')->with('success', 'Data Kelas berhasil dihapus.');
    }
}
