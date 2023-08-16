<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\MasterGroupArsip;
use Illuminate\Http\Request;

class MasterGroupArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Group Arsip',
            'route' => 'group_arsip',
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
            'PageTitle' => 'Tambah Data Master Group Arsip',
            'route' => 'group_arsip',
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
     * @param  \App\Models\MasterGroupArsip  $masterGroupArsip
     * @return \Illuminate\Http\Response
     */
    public function show(MasterGroupArsip $masterGroupArsip, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Detail Data Master Group Arsip',
            'route' => 'group_arsip',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterGroupArsip  $masterGroupArsip
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterGroupArsip $masterGroupArsip, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Edit Data Master Group Arsip',
            'route' => 'group_arsip',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterGroupArsip  $masterGroupArsip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterGroupArsip $masterGroupArsip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterGroupArsip  $masterGroupArsip
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterGroupArsip $masterGroupArsip, Request $request)
    {
        $id = $request->id;
        $del = $masterGroupArsip::find($id);
        $del->delete();
        
        return redirect('/group_arsip')->withSuccess("Berhasil Menghapus Data");
    }
}
