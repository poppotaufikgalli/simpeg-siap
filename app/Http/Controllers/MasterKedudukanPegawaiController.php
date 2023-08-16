<?php

namespace App\Http\Controllers;

use App\Models\MasterKedudukanPegawai;
use Illuminate\Http\Request;

class MasterKedudukanPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            "PageTitle" => "Data Kedudukan Hukum Pegawai",
            'route' => 'kedudukan_pegawai',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Tambah Data Kedudukan Hukum Pegawai',
            'route' => 'kedudukan_pegawai',
            'method' => 'create',
            'next' => 'store',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterKedudukanPegawai  $masterKedudukanPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(MasterKedudukanPegawai $masterKedudukanPegawai, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Detail Data Kedudukan Hukum Pegawai',
            'route' => 'kedudukan_pegawai',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterKedudukanPegawai  $masterKedudukanPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterKedudukanPegawai $masterKedudukanPegawai, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Edit Data Kedudukan Hukum Pegawai',
            'route' => 'kedudukan_pegawai',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterKedudukanPegawai  $masterKedudukanPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterKedudukanPegawai $masterKedudukanPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterKedudukanPegawai  $masterKedudukanPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterKedudukanPegawai $masterKedudukanPegawai, Request $request)
    {
        $id = $request->id;
        $del = $masterKedudukanPegawai::find($id);
        $del->delete();
        
        return redirect('/kedudukan_pegawai')->withSuccess("Berhasil Menghapus Data");
    }
}
