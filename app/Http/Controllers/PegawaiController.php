<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\VPegawai;
use App\Models\VPeglistall;
use App\Models\VPeglist2;
use App\Models\MasterJenisPegawai;

use Illuminate\Http\Request;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/pegawai/index', [
            'PageTitle' => 'Pegawai',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'PageTitle' => 'Tambah Pegawai Baru',
            'method' => 'create',
            'next' => 'store',
            'displayPhoto' => '',
        ];
        return view('admin/pegawai/data-utama', $data);
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
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai, $id)
    {
        $dataset = $pegawai->where('nip', '=', $id)->first();

        if(!$dataset){
            return redirect()->route('pegawai.create')->withErrors('Pegawai dengan NIP '.$id.' Tidak Ditemukan')->withInput();
        }

        $data = [
            'PageTitle' => 'Pegawai',
            'method' => 'show',
            'next' => 'show',
            //'id_jenis_personel' => $id_jenis_personel,
            'id' => $id,
            'dataset' => $dataset->toArray(),
            'displayPhoto' => $dataset->file_bmp,
        ];

        //dd($data);

        return view('admin/pegawai/formulir', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai, $page, $id)
    {
        $dataset = $pegawai->where('nip', '=', $id)->first();

        if(!$dataset){
            return redirect()->route('pegawai.create')->withErrors('Pegawai dengan NIP '.$id.' Tidak Ditemukan')->withInput();
        }

        $data = [
            'PageTitle' => 'Edit Pegawai',
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
            'dataset' => $dataset->toArray(),
            'displayPhoto' => $dataset->file_bmp,
        ];
        //dd($data);
        return view('admin/pegawai/formulir', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        //
    }
}
