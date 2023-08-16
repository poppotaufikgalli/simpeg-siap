<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MasterJenisPegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('referensi/index', [
            'PageTitle' => 'Data Jenis Pegawai',
            'route' => 'jenis_pegawai',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'next' => 'store',
            'method' => 'create',
            'PageTitle' => 'Tambah Data Jenis Pegawai',
            'route' => 'jenis_pegawai',
        ];
        //dd($data);
        return view('referensi/formulir', $data);
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
     * @param  \App\Models\MasterJenisPegawai  $masterJenisPegawai
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPegawai $masterJenisPegawai, $id)
    {
        $data = [
            'next' => 'jenis_pegawai',
            'method' => 'show',
            'route' => 'jenis_pegawai',
            'PageTitle' => 'Lihat Data Jenis Pegawai',
            'id' => $id,
        ];
        return view('referensi/formulir', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPegawai  $masterJenisPegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPegawai $masterJenisPegawai, $id)
    {
        return view('referensi/formulir', [
            'method' => 'edit',
            'route' => 'jenis_pegawai',
            'PageTitle' => 'Edit Data Jenis Pegawai',
            'id' => $id,
            'next' => 'update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPegawai  $masterJenisPegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPegawai $masterJenisPegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPegawai  $masterJenisPegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPegawai $masterJenisPegawai, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisPegawai::find($id);
        $del->delete();
        
        return redirect('/jenis_pegawai')->withSuccess("Berhasil Menghapus Data");
    }
}
