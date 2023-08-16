<?php

namespace App\Http\Controllers\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisProfesi;
use Illuminate\Http\Request;

class MasterJenisProfesiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Profesi',
            'route' => 'jenis_profesi',
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
            "PageTitle" => 'Tambah Data Master Jenis Profesi',
            'route' => 'jenis_profesi',
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
     * @param  \App\Models\MasterJenisProfesi  $masterJenisProfesi
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisProfesi $masterJenisProfesi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Jenis Profesi',
            'route' => 'jenis_profesi',
            "next" => 'show',
            "method" => 'show',
            "id" => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisProfesi  $masterJenisProfesi
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisProfesi $masterJenisProfesi, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Jenis Profesi',
            'route' => 'jenis_profesi',
            "next" => 'update',
            "method" => 'edit',
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisProfesi  $masterJenisProfesi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisProfesi $masterJenisProfesi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisProfesi  $masterJenisProfesi
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisProfesi $masterJenisProfesi, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisProfesi::find($id);
        $del->delete();

        return redirect('/jenis_profesi')->withSuccess("Berhasil Menghapus Data");
    }
}
