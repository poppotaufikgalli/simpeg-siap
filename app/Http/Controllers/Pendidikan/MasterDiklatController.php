<?php

namespace App\Http\Controllers\Pendidikan;

use App\Http\Controllers\Controller;
use App\Models\MasterDiklat;
use Illuminate\Http\Request;

class MasterDiklatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => 'Master Diklat Struktural',
            'route' => 'diklat',
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
            "PageTitle" => 'Tambah Data Master Diklat Struktural',
            'route' => 'diklat',
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
     * @param  \App\Models\MasterJenisDiklatStr  $masterJenisDiklatStr
     * @return \Illuminate\Http\Response
     */
    public function show(MasterDiklat $masterDiklat, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Lihat Data Master Diklat Struktural',
            'route' => 'diklat',
            "next" => 'show',
            "method" => 'show',
            "id" => $id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJenisDiklatStr  $masterJenisDiklatStr
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterDiklat $masterDiklat, $id)
    {
        return view('referensi/formulir', [
            "PageTitle" => 'Edit Data Master Diklat Struktural',
            'route' => 'diklat',
            "next" => 'update',
            "method" => 'edit',
            "id" => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJenisDiklatStr  $masterJenisDiklatStr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterDiklat $masterDiklat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJenisDiklatStr  $masterJenisDiklatStr
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterDiklat $masterDiklat, Request $request)
    {
        $id = $request->id;
        $del = $masterDiklatStr::find($id);
        $del->delete();

        return redirect('/diklat_str')->withSuccess("Berhasil Menghapus Data");
    }
}
