<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisKawin;
use Illuminate\Http\Request;

class MasterJenisKawinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Jenis Perkawinan",
            'route' => 'jenis_kawin',
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
            'PageTitle' => "Tambah Data Jenis Perkawinan",
            'route' => 'jenis_kawin',
            'next' => 'store',
            'method' => 'create',
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
     * @param  \App\Models\MasterJenisKawin  $masterJenisKawin
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisKawin $masterJenisKawin, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Detail Data Jenis Perkawinan",
            'route' => 'jenis_kawin',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisKawin  $masterJenisKawin
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisKawin $masterJenisKawin, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Detail Data Jenis Perkawinan",
            'route' => 'jenis_kawin',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisKawin  $masterJenisKawin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisKawin $masterJenisKawin)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisKawin  $masterJenisKawin
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisKawin $masterJenisKawin, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisKawin::find($id);
        $del->delete();
        
        return redirect('/jenis_kawin')->withSuccess("Berhasil Menghapus Data");
    }
}
