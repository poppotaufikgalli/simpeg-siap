<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPengadaan;
use Illuminate\Http\Request;

class MasterJenisPengadaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Data Jenis Pengadaan',
            'route' => 'jenis_pengadaan',
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
            'PageTitle' => 'Tambah Data Jenis Pengadaan',
            'route' => 'jenis_pengadaan',
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
     * @param  \App\Models\MasterJenisPengadaan  $masterJenisPengadaan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPengadaan $masterJenisPengadaan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Tambah Data Jenis Pengadaan',
            'route' => 'jenis_pengadaan',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPengadaan  $masterJenisPengadaan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPengadaan $masterJenisPengadaan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Tambah Data Jenis Pengadaan',
            'route' => 'jenis_pengadaan',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPengadaan  $masterJenisPengadaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPengadaan $masterJenisPengadaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPengadaan  $masterJenisPengadaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPengadaan $masterJenisPengadaan, Request $request)
    {
        $id = $request->id;

        $del = $masterJenisPengadaan::find($id);
        $del->delete();

        return redirect('/jenis_pengadaan')->withSuccess('Berhasil Menghapus Data');
    }
}
