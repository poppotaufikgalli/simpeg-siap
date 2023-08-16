<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJFT;
use Illuminate\Http\Request;

class MasterJFTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Master Jabatan Fungsional Tertentu",
            'route'     => "master_jft",
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
            'PageTitle' => "Tambah Jabatan Fungsional Tertentu",
            'route'     => "master_jft",
            'next'      => 'store',
            'method'    => 'create',
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
     * @param  \App\Models\MasterJFT  $masterJFT
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJFT $masterJFT, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Jabatan Fungsional Tertentu",
            'route'     => "master_jft",
            'next'      => 'show',
            'method'    => 'show',
            'id'        => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJFT  $masterJFT
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJFT $masterJFT, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Jabatan Fungsional Tertentu",
            'route'     => "master_jft",
            'next'      => 'update',
            'method'    => 'edit',
            'id'        => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJFT  $masterJFT
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJFT $masterJFT)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJFT  $masterJFT
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJFT $masterJFT, Request $request)
    {
        $id = $request->id;
        $del = $masterJFT::find($id);
        $del->delete();

        return redirect('/master_jft')->withSuccess('Berhasil Menghapus Data');

    }
}
