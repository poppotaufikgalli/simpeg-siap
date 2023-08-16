<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisJabatan;
use Illuminate\Http\Request;

class MasterJenisJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Jenis Jabatan",
            'route' => 'jenis_jabatan',
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
            "PageTitle" => 'Tambah Data Jenis Jabatan',
            'route' => 'jenis_jabatan',
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
     * @param  \App\Models\MasterJenisJabatan  $masterJenisJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisJabatan $masterJenisJabatan, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Jenis Jabatan',
            'route' => 'jenis_jabatan',
            "next" => 'show',
            "method" => 'show',
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisJabatan  $masterJenisJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisJabatan $masterJenisJabatan, $id)
    {
        return view('referensi/formulir', [
            'route' => 'jenis_jabatan',
            "PageTitle" => 'Edit Data Jenis Jabatan',
            "next" => 'update',
            "method" => 'edit',
            'id' => $id
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisJabatan  $masterJenisJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisJabatan $masterJenisJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisJabatan  $masterJenisJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisJabatan $masterJenisJabatan, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisJabatan::find($id);
        $del->delete();
        
        return redirect('/jenis_jabatan')->withSuccess("Berhasil Menghapus Data");
    }
}
