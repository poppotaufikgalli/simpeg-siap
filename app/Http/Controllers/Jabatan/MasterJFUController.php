<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJFU;
use Illuminate\Http\Request;

class MasterJFUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Master Jabatan Fungsional Umum",
            'route'     => "master_jfu",
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
            'PageTitle' => "Tambah Master Jabatan Fungsional Umum",
            'route'     => "master_jfu",
            'method'    => 'create',
            'next'      => 'store',
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
     * @param  \App\Models\MasterJFU  $masterJFU
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJFU $masterJFU, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Master Jabatan Fungsional Umum",
            'route'     => "master_jfu",
            'method'    => 'show',
            'next'      => 'show',
            'id'        => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJFU  $masterJFU
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJFU $masterJFU, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Tambah Master Jabatan Fungsional Umum",
            'route'     => "master_jfu",
            'method'    => 'edit',
            'next'      => 'update',
            'id'        => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJFU  $masterJFU
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJFU $masterJFU)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJFU  $masterJFU
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJFU $masterJFU, Request $request)
    {
        $id = $request->id;
        $del = $masterJFU::find($id);
        $del->delete();

        return redirect('/master_jfu')->withSuccess('Berhasil Menghapus Data');
    }
}
