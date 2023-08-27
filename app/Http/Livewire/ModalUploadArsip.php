<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\MasterPegawaiArsip;

class ModalUploadArsip extends Component
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

    public $selArsipId;

    protected $listeners = ['openModal'];

    public function render()
    {
        return view('livewire.modal-upload-arsip');
    }

    public function updatedArsip(){
        $this->emitTo('pegawai.data-induk.identitas-pegawai','updatedArsip', $this->arsip);
    }

    protected function getListArsip(){
        $this->dataset = MasterPegawaiArsip::where('nip', '=', $this->sid)->where('jnsdok', '=', $this->jnsdok)->get();  
        //dd($this->dataset);
    }

    public function openModal($route, $item, $isArsip=false, $isUpload=false, $hash=""){
        $this->data = json_decode($item, TRUE);
        //dd($this->data);
        $this->jnsdok = $this->data['jnsdok'];
        $this->route = $route;
        $this->isArsip = $isArsip;
        $this->isUpload = $isUpload;
        $this->hash = $hash;
        $this->getListArsip();
        
        $this->dispatchBrowserEvent('open-modal', [
            'route' => $this->route,
            'data' => $this->data,
            'sid' => $this->sid,
            'isArsip' => $this->isArsip,
            'isUpload' => $this->isUpload,
            'hash' => $this->hash,
        ]);
    }
}
