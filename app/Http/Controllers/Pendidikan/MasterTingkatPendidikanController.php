<?php

namespace App\Http\Controllers\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MasterTingkatPendidikan;
use Illuminate\Http\Request;

class MasterTingkatPendidikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Tingkat Pendidikan',
            'route' => 'tingkat_pendidikan',
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
            "PageTitle" => 'Tambah Data Master Tingkat Pendidikan',
            'route' => 'tingkat_pendidikan',
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
     * @param  \App\Models\MasterTingkatPendidikan  $masterTingkatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterTingkatPendidikan $masterTingkatPendidikan, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Tingkat Pendidikan',
            'route' => 'tingkat_pendidikan',
            "next" => 'show',
            "method" => 'show',
            "id" => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterTingkatPendidikan  $masterTingkatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterTingkatPendidikan $masterTingkatPendidikan, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Tingkat Pendidikan',
            'route' => 'tingkat_pendidikan',
            "next" => 'update',
            "method" => 'edit',
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterTingkatPendidikan  $masterTingkatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterTingkatPendidikan $masterTingkatPendidikan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterTingkatPendidikan  $masterTingkatPendidikan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterTingkatPendidikan $masterTingkatPendidikan, Request $request)
    {
        $id = $request->id;
        $del = $masterTingkatPendidikan::find($id);
        $del->delete();

        return redirect('/tingkat_pendidikan')->withSuccess("Berhasil Menghapus Data");
    }
}
