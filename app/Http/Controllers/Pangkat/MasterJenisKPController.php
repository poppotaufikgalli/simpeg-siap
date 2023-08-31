<?php

namespace App\Http\Controllers\Pangkat;

use App\Http\Controllers\Controller;
use App\Models\MasterJenisKp;
use Illuminate\Http\Request;

class MasterJenisKPController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Data Jenis Kenaikan Pangkat",
            'route' => 'jenis_kp',
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
            'PageTitle' => "Tambah Data Jenis Kenaikan Pangkat",
            'route' => 'jenis_kp',
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
     * @param  \App\Models\MasterJenisKp  $masterJenisKP
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisKp $masterJenisKP, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Jenis Kenaikan Pangkat",
            'route' => 'jenis_kp',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisKp  $masterJenisKP
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisKp $masterJenisKP, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Data Jenis Kenaikan Pangkat",
            'route' => 'jenis_kp',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisKp  $masterJenisKP
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisKp $masterJenisKP)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisKP  $masterJenisKP
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisKp $masterJenisKP, Request $request)
    {
        $id = $request->id;
        $del = $masterJenisKP::find($id);
        $del->delete();

        return redirect('/jenis_kp')->withSuccess('Berhasil Menghapus Data');
    }
}
