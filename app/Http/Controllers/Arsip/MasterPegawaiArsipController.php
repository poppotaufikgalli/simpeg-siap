<?php

namespace App\Http\Controllers\Arsip;

use App\Http\Controllers\Controller;
use App\Models\MasterPegawaiArsip;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class MasterPegawaiArsipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //$filename = $request->filename;
        //dd($filename);

        if($request->isUpload == "true"){
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
        }

        return response()->json([
            "done" => $handler->getPercentageDone(),
            "status" => true,
        ]);
    }

    protected function saveFile(UploadedFile $file, Request $request)
    {
        $extension = $file->extension();

        $filename = $request->filename ?? $request->sid."_".$request->jnsdok."_".$request->page_id.".".$extension;
        $path = 'public/'.$request->sid.'/'.$filename;
        //dd(Storage::exists($path));

        $path = Storage::disk('local')->putFileAs('public/'.$request->sid, $file, $filename);
        $mime = str_replace('/', '-', $file->getMimeType());

        if($request->isArsip == "true"){
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
        }

        return response()->json([
            'path' => $file,
            'name' => $filename,
            'mime_type' => $mime
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MasterPegawaiArsip  $masterPegawaiArsip
     * @return \Illuminate\Http\Response
     */
    public function show(MasterPegawaiArsip $masterPegawaiArsip)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MasterPegawaiArsip  $masterPegawaiArsip
     * @return \Illuminate\Http\Response
     */
    public function edit(MasterPegawaiArsip $masterPegawaiArsip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MasterPegawaiArsip  $masterPegawaiArsip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MasterPegawaiArsip $masterPegawaiArsip)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MasterPegawaiArsip  $masterPegawaiArsip
     * @return \Illuminate\Http\Response
     */
    public function destroy(MasterPegawaiArsip $masterPegawaiArsip, Request $request)
    {
        $id = $request->id;
        $del = $masterPegawaiArsip::find($id);
        $path = storage_path('app/public/'.$del->nip);
        //dd($path);
        @unlink($path.'/'.$del->filename);
        $del->delete();
        
        return redirect()->back()->withSuccess("Berhasil Menghapus Data")->withFragment($request->hash);
    }
}
