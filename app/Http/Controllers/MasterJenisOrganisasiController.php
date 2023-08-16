<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisOrganisasi;
use Illuminate\Http\Request;

class MasterJenisOrganisasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Organisasi',
            'route' => 'jenis_organisasi',
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
            "PageTitle" => 'Tambah Data Master Jenis Organisasi',
            'route' => 'jenis_organisasi',
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
     * @param  \App\Models\MasterJenisOrganisasi  $masterJenisOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisOrganisasi $masterJenisOrganisasi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Jenis Organisasi',
            'route' => 'jenis_organisasi',
            "next" => 'show',
            "method" => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisOrganisasi  $masterJenisOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisOrganisasi $masterJenisOrganisasi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Jenis Organisasi',
            'route' => 'jenis_organisasi',
            "next" => 'update',
            "method" => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisOrganisasi  $masterJenisOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisOrganisasi $masterJenisOrganisasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisOrganisasi  $masterJenisOrganisasi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisOrganisasi $masterJenisOrganisasi, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisOrganisasi::find($id);
        $del->delete();

        return redirect('/jenis_organisasi')->withSuccess('Berhasil Menghapus Data');
    }
}
