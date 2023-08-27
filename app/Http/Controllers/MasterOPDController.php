<?php

namespace App\Http\Controllers;

use App\Models\MasterOPD;
use App\Models\MasterJabatan;
use App\Models\MasterEselon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class MasterOPDController extends Controller
{
    /**
     * Display a listing of the resource.
     *å
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('referensi/index', [
            'PageTitle' => 'Data Unit Kerja',
            'route' => 'unit_kerja',
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
            'PageTitle' => "Tambah Data Unit Kerja",
            'route' => 'unit_kerja',
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
     * @param  \App\Models\MasterOPD  $masterOPD
     * @return \Illuminate\Http\Response
     */
    public function show(MasterOPD $masterOPD, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Lihat Data Unit Kerja",
            'route' => 'unit_kerja',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterOPD  $masterOPD
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterOPD $masterOPD, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Edit Data Unit Kerja",
            'route' => 'unit_kerja',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterOPD  $masterOPD
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterOPD $masterOPD)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterOPD  $masterOPD
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterOPD $masterOPD, Request $request)
    {
        $id = $request->id;
        $del = $masterOPD::find($id);
        $del->delete();

        $del = MasterJabatan::find($id);
        if($del != null){
            $del->delete();    
        }
        
        return redirect('/unit_kerja')->withSuccess("Berhasil Menghapus Data");
    }
}
