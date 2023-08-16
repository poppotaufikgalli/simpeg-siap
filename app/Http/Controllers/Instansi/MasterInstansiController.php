<?php

namespace App\Http\Controllers\Instansi;

use App\Http\Controllers\Controller;
use App\Models\MasterInstansi;
use Illuminate\Http\Request;

class MasterInstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Master Instansi",
            'route' => 'instansi',
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
            'PageTitle' => "Tambah Data Master Instansi",
            'route' => 'instansi',
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
     * @param  \App\Models\MasterInstansi  $masterInstansi
     * @return \Illuminate\Http\Response
     */
    public function show(MasterInstansi $masterInstansi, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Master Instansi",
            'route' => 'instansi',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterInstansi  $masterInstansi
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterInstansi $masterInstansi, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Data Master Instansi",
            'route' => 'instansi',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterInstansi  $masterInstansi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterInstansi $masterInstansi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterInstansi  $masterInstansi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterInstansi $masterInstansi, Request $request)
    {
        $id = $request->id;
        $del = $masterInstansi::find($id);
        $del->delete();

        return redirect('/instansi')->withSuccess('Berhasil Menghapus Data');
    }
}
