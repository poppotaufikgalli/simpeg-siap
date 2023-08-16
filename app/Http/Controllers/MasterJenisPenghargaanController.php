<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPenghargaan;
use Illuminate\Http\Request;

class MasterJenisPenghargaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Data Jenis Penghargaan',
            'route' => 'jenis_penghargaan',
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
            'PageTitle' => 'Tambah Data Jenis Penghargaan',
            'route' => 'jenis_penghargaan',
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
     * @param  \App\Models\MasterJenisPenghargaan  $masterJenisPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPenghargaan $masterJenisPenghargaan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Lihat Data Jenis Penghargaan',
            'route' => 'jenis_penghargaan',
            'method' => 'show',
            'next' => 'show',
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPenghargaan  $masterJenisPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPenghargaan $masterJenisPenghargaan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Edit Data Jenis Penghargaan',
            'route' => 'jenis_penghargaan',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPenghargaan  $masterJenisPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPenghargaan $masterJenisPenghargaan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPenghargaan  $masterJenisPenghargaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPenghargaan $masterJenisPenghargaan, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisPenghargaan::find($id);
        $del->delete();

        return redirect('/jenis_penghargaan')->withSuccess('Berhasil Menghapus Data');
    }
}
