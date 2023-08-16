<?php

namespace App\Http\Controllers;

use App\Models\RefUnkerja;
use Illuminate\Http\Request;

class RefUnkerjaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {  
        $data['PageTitle'] = "Unit Kerja";
        $data['data'] = RefUnkerja::Paginate(20);
        return view('admin/unkerja/index', $data);
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
     * @param  \App\Models\RefUnkerja  $refUnkerja
     * @return \Illuminate\Http\Response
     */
    public function show(RefUnkerja $refUnkerja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\RefUnkerja  $refUnkerja
     * @return \Illuminate\Http\Response
     */
    public function edit(RefUnkerja $refUnkerja)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\RefUnkerja  $refUnkerja
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RefUnkerja $refUnkerja)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\RefUnkerja  $refUnkerja
     * @return \Illuminate\Http\Response
     */
    public function destroy(RefUnkerja $refUnkerja)
    {
        //
    }
}
