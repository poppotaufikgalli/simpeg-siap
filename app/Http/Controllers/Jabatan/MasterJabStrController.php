<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterJabStr;
use Illuminate\Http\Request;

class MasterJabStrController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('referensi/index', [
            'PageTitle' => "Master Jabatan Struktural",
            'route'     => "master_jab_str",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\MasterJabStr  $masterJabStr
     * @return \Illuminate\Http\Response
     */
    public function show(MasterJabStr $masterJabStr)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterJabStr  $masterJabStr
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterJabStr $masterJabStr)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterJabStr  $masterJabStr
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterJabStr $masterJabStr)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterJabStr  $masterJabStr
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterJabStr $masterJabStr)
    {
        //
    }
}
