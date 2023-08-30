<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MasterPegawaiArsip;
use DB;

class ModalUploadArsipPersonel extends Component
{
    public $arsip;
    public $sid;
    public $jnsdok;
    public $dataset = [];
    public $route;
    public $hash;
    public $iframeSrc;
    public $isArsip = false;
    public $isUpload = false;
    public $data;
    public $existing_filename;

    public $selArsipId;

    protected $listeners = ['openModalPersonel', 'openFile', "insertArsip"];

    public function render()
    {
        return view('livewire.modal-upload-arsip-personel');
    }

    public function updatedArsip(){
        $this->emitTo('pegawai.data-induk.identitas-pegawai','updatedArsip', $this->arsip);
    }

    public function insertArsip($filename){
        DB::table($this->table)->where($this->key)->update([
            'filename' => $filename
        ]);

        $this->dispatchBrowserEvent('informations', "File Berhasil diupload");
    }

    public function deleteUploadFile($filename){
        DB::table($this->table)->where($this->key)->where('filename', '=', $filename)->update([
            'filename' => null
        ]);

        $path = storage_path('app/public/'.str_replace('/','_', $this->sid));
        @unlink($path.'/'.$filename);
        
        $this->dispatchBrowserEvent('reloadPage', $this->hash);

    }

    protected function getListArsip(){
        $this->dataset = MasterPegawaiArsip::where('nip', '=', $this->sid)->where('jnsdok', '=', $this->jnsdok)->get();  
        //dd($this->dataset);
    }

    public function openFile($filename){
        $this->existing_filename = $filename;
        $this->dispatchBrowserEvent('open-modal-file', [
            'filename'  => $filename,
        ]);
    }

    public function openModalPersonel($type, $name, $hash, $table, $key){
        $sid = preg_replace( '/[\W]/', '_', $this->sid);
        $filename = preg_replace( '/[\W]/', '_', $sid.'_'.$type.'_'.$name);
        
        $this->table = $table;
        $this->key = $key;
        $this->hash = $hash;
        //$this->existing_filename = $existing_filename;

        $data = DB::table($this->table)->where($this->key)->first();
        $this->existing_filename = $data->filename;


        //dd($item);
        /*$this->jnsdok = $this->data['jnsdok'];
        $this->route = $route;
        $this->isArsip = $isArsip;
        $this->isUpload = $isUpload;
        $this->hash = $hash;*/
        //$this->getListArsip();
        
        $this->dispatchBrowserEvent('open-modal-personel', [
            'type'      => $type,
            'sid'       => $sid,
            'filename'  => $filename,
            'hash'      => $hash,
        ]);
    }
}
