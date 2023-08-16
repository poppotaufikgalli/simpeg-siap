<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJabatan;
use Illuminate\Http\Request;

class MasterJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Formasi Jabatan OPD",
            'route'     => "master_jabatan",
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
            'PageTitle' => "Tambah Data Formasi Jabatan OPD",
            'route'     => "master_jabatan",
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
     * @param  \App\Models\MasterJabatan  $masterJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJabatan $masterJabatan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Formasi Jabatan OPD",
            'route'     => "master_jabatan",
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJabatan  $masterJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJabatan $masterJabatan, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Data Formasi Jabatan OPD",
            'route'     => "master_jabatan",
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJabatan  $masterJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJabatan $masterJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJabatan  $masterJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJabatan $masterJabatan, Request $request)
    {
        $id = $request->id;
        $del = $masterJabatan::find($id);
        $del->delete();

        return redirect('/master_jabatan')->withSuccess('Berhasil Menghapus Data');
    }
}
