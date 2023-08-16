<?php

namespace App\Http\Controllers\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MasterPendidikan;
use Illuminate\Http\Request;

class MasterPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/masterpendidikan/index', [
            'PageTitle' => "Data Jurusan Pendidikan",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/masterpendidikan/formulir', [
            'PageTitle' => "Tambah Data Jurusan Pendidikan",
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
     * @param  \App\Models\MasterPendidikan  $masterPendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPendidikan $masterPendidikan, $kjur)
    {
        return view('admin/masterpendidikan/formulir', [
            'PageTitle' => "Lihat Data Jurusan Pendidikan",
            'next' => 'show',
            'method' => 'show',
            'kjur' => $kjur,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPendidikan  $masterPendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPendidikan $masterPendidikan, $kjur)
    {
        return view('admin/masterpendidikan/formulir', [
            'PageTitle' => "Edit Data Jurusan Pendidikan",
            'next' => 'update',
            'method' => 'edit',
            'kjur' => $kjur,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPendidikan  $masterPendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPendidikan $masterPendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPendidikan  $masterPendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPendidikan $masterPendidikan, Request $request)
    {
        $id = $request->id;
        $del = $masterPendidikan::find($id);
        $del->delete();
        
        return redirect('/pendidikan')->withSuccess("Berhasil Menghapus Data");
    }
}
