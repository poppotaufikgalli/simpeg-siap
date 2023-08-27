<?php

namespace App\Http\Controllers;

use App\Models\MasterPersonel;
use App\Models\MasterJenisPersonel;
use App\Models\MasterRiwayatPendum;
use App\Models\MasterRiwayatPangkat;
use App\Models\MasterRiwayatJabatan;
use App\Models\MasterRiwayatDiklat;
use App\Models\MasterRiwayatKeluarga;
use App\Models\MasterRiwayatDp3;
use App\Models\MasterRiwayatPenghargaan;
//use App\Models\MasterRiwayatPenca;

use App\Models\MasterJenisDiklat;
use App\Models\MasterJenisKeluarga;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

use Barryvdh\DomPDF\Facade\Pdf;
use DB;

class MasterPersonelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function getPersonelInfo($id)
    {
        return MasterJenisPersonel::where('id_jenis_personel', '=', $id)->first()->nama;
    }

    public function index($id_jenis_personel)
    {
        return view('admin/personel/index', [
            'PageTitle'         => $this->getPersonelInfo($id_jenis_personel),
            'id_jenis_personel' => $id_jenis_personel,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id_jenis_personel)
    {
        return view('admin/personel/data-utama', [
            'PageTitle' => 'Data '.$this->getPersonelInfo($id_jenis_personel),
            'method' => 'create',
            'next' => 'store',
            'displayPhoto' => '',
            'id_jenis_personel' => $id_jenis_personel,
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
     * @param  \App\Models\MasterPersonel  $masterPersonel
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPersonel $masterPersonel, $id_jenis_personel, $id)
    {
        $id = str_replace('-','/',$id);
        $data['id_jenis_personel'] = $id_jenis_personel;
        $data['profil'] = $masterPersonel::where('nip','=', $id)->first()->toArray();
        $data['pangkat'] = DB::table('vriwayatpangkat')->where('nip', '=', $id)->orderBy('kgolru', 'desc')->get()->toArray();
        $data['pendum'] = DB::table('vriwayatpendum')->where('nip','=', $id)->get()->toArray();
        $data['jabatan'] = DB::table('vriwayatjabatan')->where('nip','=', $id)->get()->toArray();
        $data['diklat'] = MasterRiwayatDiklat::where('jdiklat','=',1)->where('nip','=', $id)->get()->toArray();
        $data['diklat_a'] = DB::table('vriwayatdiklat')->whereIn('jdiklat', [2,3,4,5,6,7])->where('nip','=', $id)->get()->toArray();
        $data['keluarga'] = DB::table('vriwayatkeluarga')->where('nip','=', $id)->get()->toArray();
        $data['dp3'] = MasterRiwayatDp3::where('nip','=', $id)->get()->toArray();
        $data['pengargaan'] = DB::table('vriwayatpenghargaan')->where('nip','=', $id)->get()->toArray();
        $data['tumlar'] = DB::table('vriwayattumlar')->where('nip','=', $id)->get()->toArray();
        //return view('admin/personel/drh', $data);
        //dd($data);
        $pdf = Pdf::loadView('admin/personel/drh', $data);
        return $pdf->stream('drh-'.$id.'.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPersonel  $masterPersonel
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPersonel $masterPersonel, $id_jenis_personel, $page, $id)
    {
        /*$dataset = $masterPersonel->where('nip', '=', $id)->first();

        if(!$dataset){
            return redirect()->route('personel.create')->withErrors('Pegawai dengan NIP '.$id.' Tidak Ditemukan')->withInput();
        }*/
        $id = str_replace('-', '/', $id);
        return view('admin/personel/formulir', [
            'PageTitle' => 'Edit Data '.$this->getPersonelInfo($id_jenis_personel),
            'method' => 'edit',
            'next' => 'update',
            'id' => $id,
            'displayPhoto' => '',
            'id_jenis_personel' => $id_jenis_personel,
            'jenis_diklat' => MasterJenisDiklat::where('status', '=', 1)->get(),
            'jenis_keluarga' => MasterJenisKeluarga::where('status', '=', 1)->get(),
            //'dataset' => $dataset->toArray(),
            //'displayPhoto' => $dataset->file_bmp,
            'page' => $page,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPersonel  $masterPersonel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPersonel $masterPersonel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPersonel  $masterPersonel
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPersonel $masterPersonel)
    {
        //
    }

    public function uploadArsip(Request $request)
    {
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        $save = $receiver->receive();
        if ($save->isFinished()) {
            return $this->saveFile($save->getFile(), $request);
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            "status" => true,
        ]);
    }

    protected function saveFile(UploadedFile $file, Request $request)
    {
        $extension = $file->extension();

        $filename = $request->filename;
        $path = 'public/'.$request->sid.'/'.$filename;
        //dd(Storage::exists($path));

        $path = Storage::disk('local')->putFileAs('public/'.$request->sid, $file, $filename);
        $mime = str_replace('/', '-', $file->getMimeType());

        /*if($request->isArsip == "true"){
            $insertData = [
                'nip' => $request->sid,
                'jnsdok' => $request->jnsdok,
                'filename' => $filename,
                'tgl_upload' => date('dmY'),
                'caption' => $request->ndok,
                'userid' => $request->session()->get('nama'),
                'page_id' => $request->page_id,
            ];

            MasterPegawaiArsip::updateOrCreate([
                'nip' => $request->sid,
                'jnsdok' => $request->jnsdok,
            ],$insertData);
        }*/

        return response()->json([
            'path' => $file,
            'name' => $filename,
            'mime_type' => $mime
        ]);
    }
}
