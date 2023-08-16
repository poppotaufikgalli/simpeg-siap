<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPensiun;
use Illuminate\Http\Request;

class MasterJenisPensiunController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Pensiun',
            'route' => 'jenis_pensiun',
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
            "PageTitle" => 'Tambah Data Master Jenis Pensiun',
            'route' => 'jenis_pensiun',
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
     * @param  \App\Models\MasterJenisPensiun  $masterJenisPensiun
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPensiun $masterJenisPensiun, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Jenis Pensiun',
            'route' => 'jenis_pensiun',
            "next" => 'show',
            "method" => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPensiun  $masterJenisPensiun
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPensiun $masterJenisPensiun, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Jenis Pensiun',
            'route' => 'jenis_pensiun',
            "next" => 'update',
            "method" => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPensiun  $masterJenisPensiun
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPensiun $masterJenisPensiun)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPensiun  $masterJenisPensiun
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPensiun $masterJenisPensiun, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisPensiun::find($id);
        $del->delete();

        return redirect('/jenis_pensiun')->withSuccess('Berhasil Menghapus Data');
    }
}
