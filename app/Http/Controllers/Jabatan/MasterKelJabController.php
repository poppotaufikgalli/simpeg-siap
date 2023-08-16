<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterKelJab;
use Illuminate\Http\Request;

class MasterKelJabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Master Kelompok Jabatan Fungsional",
            'route'     => "kel_jab",
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
            'PageTitle' => "Tambah Kelompok Jabatan Fungsional",
            'route'     => "kel_jab",
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
     * @param  \App\Models\MasterKelJab  $masterKelJab
     * @return \Illuminate\Http\Response
     */
    public function show(MasterKelJab $masterKelJab, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Kelompok Jabatan Fungsional",
            'route'     => "kel_jab",
            'next'      => 'show',
            'method'    => 'show',
            'id'        => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterKelJab  $masterKelJab
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterKelJab $masterKelJab, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Kelompok Jabatan Fungsional",
            'route'     => "kel_jab",
            'next'      => 'update',
            'method'    => 'edit',
            'id'        => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterKelJab  $masterKelJab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterKelJab $masterKelJab)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterKelJab  $masterKelJab
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterKelJab $masterKelJab, Request $request)
    {
        $id = $request->id;
        $del = $masterKelJab::find($id);
        $del->delete();

        return redirect('/kel_jab')->withSuccess('Berhasil Menghapus Data');
    }
}
