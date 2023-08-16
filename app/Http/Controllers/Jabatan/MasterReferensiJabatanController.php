<?php

namespace App\Http\Controllers\Jabatan;

use App\Http\Controllers\Controller;
use App\Models\MasterReferensiJabatan;
use App\Models\MasterJenisJabatan;
use Illuminate\Http\Request;

class MasterReferensiJabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function getJnsJab($jenis_jabatan_id)
    {
        $data = MasterJenisJabatan::find($jenis_jabatan_id);
        if($data){
            return $data->nama;
        }

        return;
    }

    public function index($jenis_jabatan_id)
    {
        return view('referensi_jabatan/index', [
            'PageTitle'         => "Referensi ". $this->getJnsJab($jenis_jabatan_id),
            'route'             => "ref_jabatan",
            'jenis_jabatan_id'  => $jenis_jabatan_id,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($jenis_jabatan_id)
    {
        return view('referensi_jabatan/formulir', [
            'PageTitle' => "Tambah ". $this->getJnsJab($jenis_jabatan_id),
            'route'     => "ref_jabatan",
            'next'      => 'store',
            'method'    => 'create',
            'jenis_jabatan_id'  => $jenis_jabatan_id,
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
     * @param  \App\Models\MasterReferensiJabatan  $masterReferensiJabatan
     * @return \Illuminate\Http\Response
     */
    public function show(MasterReferensiJabatan $masterReferensiJabatan, $jenis_jabatan_id, $id)
    {
        return view('referensi_jabatan/formulir', [
            'PageTitle' => "Lihat". $this->getJnsJab($jenis_jabatan_id),
            'route'     => "ref_jabatan",
            'next'      => 'show',
            'method'    => 'show',
            'id'        => $id,
            'jenis_jabatan_id' => $jenis_jabatan_id,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterReferensiJabatan  $masterReferensiJabatan
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterReferensiJabatan $masterReferensiJabatan, $jenis_jabatan_id, $id)
    {
        return view('referensi_jabatan/formulir', [
            'PageTitle' => "Lihat". $this->getJnsJab($jenis_jabatan_id),
            'route'     => "ref_jabatan",
            'next'      => 'update',
            'method'    => 'edit',
            'id'        => $id,
            'jenis_jabatan_id' => $jenis_jabatan_id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterReferensiJabatan  $masterReferensiJabatan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterReferensiJabatan $masterReferensiJabatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterReferensiJabatan  $masterReferensiJabatan
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterReferensiJabatan $masterReferensiJabatan, Request $request)
    {
        $id = $request->id;
        $del = $masterReferensiJabatan::find($id);

        $jenis_jabatan_id = $del->jenis_jabatan_id;

        $del->delete();

        return redirect('/ref_jabatan/'.$jenis_jabatan_id)->withSuccess('Berhasil Menghapus Data');
    }
}
