<?php

namespace App\Http\Controllers\Pangkat;

use App\Http\Controllers\Controller;
use App\Models\MasterPangkat;
use Illuminate\Http\Request;

class MasterPangkatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Pangkat",
            'route' => 'pangkat',
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
            'PageTitle' => "Tambah Data Pangkat",
            'route' => 'pangkat',
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
     * @param  \App\Models\MasterPangkat  $masterPangkat
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPangkat $masterPangkat, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Tambah Data Pangkat",
            'route' => 'pangkat',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPangkat  $masterPangkat
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPangkat $masterPangkat, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Tambah Data Pangkat",
            'route' => 'pangkat',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPangkat  $masterPangkat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPangkat $masterPangkat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPangkat  $masterPangkat
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPangkat $masterPangkat, Request $request)
    {
        $id = $request->id;
        $del = $masterPangkat::where('id', '=', $id);
        $del->delete();
        
        return redirect('/pangkat')->withSuccess("Berhasil Menghapus Data");
    }
}
