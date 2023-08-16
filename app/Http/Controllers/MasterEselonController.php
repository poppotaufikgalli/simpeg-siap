<?php

namespace App\Http\Controllers;

use App\Models\MasterEselon;
use Illuminate\Http\Request;

class MasterEselonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Eselonering',
            'route' => 'eselon',
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
            "PageTitle" => 'Tambah Data Master Eselonering',
            'route' => 'eselon',
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
     * @param  \App\Models\MasterEselon  $masterEselon
     * @return \Illuminate\Http\Response
     */
    public function show(MasterEselon $masterEselon, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Detail Data Master Eselonering",
            'route' => 'eselon',
            'next' => 'show',
            'method' => 'show',
            'id' => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterEselon  $masterEselon
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterEselon $masterEselon, $id)
    {
        return view('referensi/formulir', [
            'PageTitle' => "Detail Data Master Eselonering",
            'route' => 'eselon',
            'next' => 'update',
            'method' => 'edit',
            'id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterEselon  $masterEselon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterEselon $masterEselon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_eselon  $master_eselon
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterEselon $masterEselon, Request $request)
    {
        $id = $request->id;
        $del = $masterEselon::find($id);
        $del->delete();
        
        return redirect('/eselon')->withSuccess("Berhasil Menghapus Data");
    }
}
