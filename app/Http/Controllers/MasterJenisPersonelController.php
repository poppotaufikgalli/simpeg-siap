<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPersonel;
use Illuminate\Http\Request;

class MasterJenisPersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('admin/masterjenispersonel/index', [
            'PageTitle' => 'Data Jenis Personel',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/masterjenispersonel/formulir', [
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
     * @param  \App\Models\MasterJenisPersonel  $masterJenisPersonel
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPersonel $masterJenisPersonel, $id_jenis_personel)
    {
        return view('admin/masterjenispersonel/formulir', [
            'method' => 'show',
            'id_jenis_personel' => $id_jenis_personel,
            'PageTitle' => 'Detail Data Personel',
            'next' => 'show',
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPersonel  $masterJenisPersonel
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPersonel $masterJenisPersonel, $id_jenis_personel)
    {
        return view('admin/masterjenispersonel/formulir', [
            'method' => 'edit',
            'id_jenis_personel' => $id_jenis_personel,
            'PageTitle' => 'Edit Data Personel',
            'next' => 'update',
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPersonel  $masterJenisPersonel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPersonel $masterJenisPersonel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPersonel  $masterJenisPersonel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPersonel $masterJenisPersonel, Request $request)
    {
        $id_jenis_personel = $request->id;
        $del = $masterJenisPersonel::where('id_jenis_personel', '=', $id_jenis_personel);
        $del->delete();
        
        return redirect('/jenis_personel')->withSuccess("Berhasil Menghapus Data Jenis Personel [".$id_jenis_personel."]");
    }
}
