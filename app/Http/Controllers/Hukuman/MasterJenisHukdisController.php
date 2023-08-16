<?php

namespace App\Http\Controllers\Hukuman;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisHukdis;
use Illuminate\Http\Request;

class MasterJenisHukdisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Jenis Hukuman Disiplin",
            'route' => 'jenis_hukdis',
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
            'PageTitle' => "Tambah Data Jenis Hukuman Disiplin",
            'route' => 'jenis_hukdis',
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
     * @param  \App\Models\MasterJenisHukdis  $masterJenisHukdis
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisHukdis $masterJenisHukdis, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Jenis Hukuman Disiplin",
            'route' => 'jenis_hukdis',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisHukdis  $masterJenisHukdis
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisHukdis $masterJenisHukdis, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Jenis Hukuman Disiplin",
            'route' => 'jenis_hukdis',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisHukdis  $masterJenisHukdis
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisHukdis $masterJenisHukdis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisHukdis  $masterJenisHukdis
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisHukdis $masterJenisHukdis, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisHukdis::find($id);
        $del->delete();

        return redirect('/jenis_hukdis')->withSuccess("Berhasil Menghapus Data");
    }
}
