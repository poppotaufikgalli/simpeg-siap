<?php

namespace App\Http\Controllers;

use App\Models\MasterAgama;
use Illuminate\Http\Request;

class MasterAgamaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Agama',
            'route' => 'agama',
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
            "PageTitle" => 'Tambah Data Master Agama',
            'route' => 'agama',
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
     * @param  \App\Models\MasterAgama  $masterAgama
     * @return \Illuminate\Http\Response
     */
    public function show(MasterAgama $masterAgama, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Detail Data Master Agama',
            'route' => 'agama',
            "next" => 'show',
            "method" => 'show',
            "id" => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterAgama  $masterAgama
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterAgama $masterAgama, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Agama',
            'route' => 'agama',
            "next" => 'update',
            "method" => 'edit',
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterAgama  $masterAgama
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterAgama $masterAgama)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterAgama  $masterAgama
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterAgama $masterAgama, Request $request)
    {
        $id = $request->id;
        $del = $masterAgama::where('id', '=', $id);
        $del->delete();
        
        return redirect('/agama')->withSuccess("Berhasil Menghapus Data");
    }
}
