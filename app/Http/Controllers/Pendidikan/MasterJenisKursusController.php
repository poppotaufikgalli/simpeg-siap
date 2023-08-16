<?php

namespace App\Http\Controllers\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKursus;
use Illuminate\Http\Request;

class MasterJenisKursusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Jenis Kursus',
            'route' => 'jenis_kursus',
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
            "PageTitle" => 'Tambah Data Master Jenis Kursus',
            'route' => 'jenis_kursus',
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
     * @param  \App\Models\MasterJenisKursus  $masterJenisKursus
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisKursus $masterJenisKursus, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Jenis Kursus',
            'route' => 'jenis_kursus',
            "next" => 'show',
            "method" => 'show',
            "id" => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisKursus  $masterJenisKursus
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisKursus $masterJenisKursus, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Jenis Kursus',
            'route' => 'jenis_kursus',
            "next" => 'update',
            "method" => 'edit',
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisKursus  $masterJenisKursus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisKursus $masterJenisKursus)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisKursus  $masterJenisKursus
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisKursus $masterJenisKursus, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisKursus::find($id);
        $del->delete();

        return redirect('/jenis_kursus')->withSuccess("Berhasil Menghapus Data");
    }
}
