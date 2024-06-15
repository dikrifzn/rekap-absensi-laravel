<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelajaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pelajarans = DB::table('pelajaran')->get();
        return view('pelajaran', ['pelajarans' => $pelajarans]);
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
            'nama_pelajaran' => 'required',
        ]);
    
        DB::table('pelajaran')->insert([
            'nama_pelajaran' => $request->nama_pelajaran,
            'created_at' => now()
        ]);
    
        return redirect('/pelajaran')->with('success', 'Data Pelajaran berhasil ditambahkan.');
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
        $request->validate([
            'nama_pelajaran' => 'required'
        ]);
    
        DB::table('pelajaran')->where('id', $id)->update([
            'pelajaran' => $request->pelajaran,
            'updated_at' => now()
        ]);
    
        return redirect('/pelajaran')->with('success', 'Data Pelajaran berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::table('pelajaran')->where('id', $id)->delete(); 
        return redirect('/pelajaran')->with('success', 'Data Pelajaran berhasil dihapus.');
    }
}
