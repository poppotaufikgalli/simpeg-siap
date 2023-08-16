<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisArsip;
use Illuminate\Http\Request;

class MasterJenisArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Arsip',
            'route' => 'jenis_arsip',
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
            'PageTitle' => 'Tambah Data Master Jenis Arsip',
            'route' => 'jenis_arsip',
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
     * @param  \App\Models\MasterJenisArsip  $masterJenisArsip
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisArsip $masterJenisArsip, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Lihat Data Master Jenis Arsip',
            'route' => 'jenis_arsip',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisArsip  $masterJenisArsip
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisArsip $masterJenisArsip, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Edit Data Master Jenis Arsip',
            'route' => 'jenis_arsip',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisArsip  $masterJenisArsip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisArsip $masterJenisArsip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisArsip  $masterJenisArsip
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisArsip $masterJenisArsip, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisArsip::find($id);
        $del->delete();
        
        return redirect('/jenis_arsip')->withSuccess("Berhasil Menghapus Data");
    }
}
