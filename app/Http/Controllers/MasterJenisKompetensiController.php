<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisKompetensi;
use Illuminate\Http\Request;

class MasterJenisKompetensiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Kompetensi',
            'route' => 'jenis_kompetensi',
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
            "PageTitle" => 'Tambah Data Master Jenis Kompetensi',
            'route' => 'jenis_kompetensi',
            "next" => 'store',
            "method" => 'create',
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
     * @param  \App\Models\MasterJenisKompetensi  $masterJenisKompetensi
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisKompetensi $masterJenisKompetensi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Jenis Kompetensi',
            'route' => 'jenis_kompetensi',
            "next" => 'show',
            "method" => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisKompetensi  $masterJenisKompetensi
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisKompetensi $masterJenisKompetensi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Jenis Kompetensi',
            'route' => 'jenis_kompetensi',
            "next" => 'update',
            "method" => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisKompetensi  $masterJenisKompetensi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisKompetensi $masterJenisKompetensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisKompetensi  $masterJenisKompetensi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisKompetensi $masterJenisKompetensi, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisKompetensi::find($id);
        $del->delete();

        return redirect('/jenis_kompetensi')->withSuccess('Berhasil Menghapus Data');
    }
}
