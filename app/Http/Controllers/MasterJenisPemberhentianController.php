<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisPemberhentian;
use Illuminate\Http\Request;

class MasterJenisPemberhentianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Data Jenis Pemberhentian',
            'route' => 'jenis_pemberhentian',
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
            'PageTitle' => 'Tambah Data Jenis Pemberhentian',
            'route' => 'jenis_pemberhentian',
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
     * @param  \App\Models\MasterJenisPemberhentian  $masterJenisPemberhentian
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJenisPemberhentian $masterJenisPemberhentian, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Tambah Data Jenis Pemberhentian',
            'route' => 'jenis_pemberhentian',
            'method' => 'show',
            'next' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisPemberhentian  $masterJenisPemberhentian
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJenisPemberhentian $masterJenisPemberhentian, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => 'Tambah Data Jenis Pemberhentian',
            'route' => 'jenis_pemberhentian',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisPemberhentian  $masterJenisPemberhentian
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJenisPemberhentian $masterJenisPemberhentian)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisPemberhentian  $masterJenisPemberhentian
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJenisPemberhentian $masterJenisPemberhentian, Request $request)
    {
        $id = $request->id;

        $del = $masterJenisPemberhentian::find($id);
        $del->delete();

        return redirect('/jenis_pemberhentian')->withSuccess('Berhasil Menghapus Data');
    }
}
