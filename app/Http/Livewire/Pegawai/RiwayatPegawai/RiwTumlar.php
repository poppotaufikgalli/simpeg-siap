<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatTumlar;
use App\Models\MasterPejabat;
use App\Models\MasterTingkatPendidikan;
use App\Models\MasterPendidikan;

class RiwTumlar extends Component
{
    public $sid;
    public $method;
    public $next;
    public $subPage = 'list';
    public $dataset;

    public $tsk;
    public $master_pendidikan = [];

    protected $listeners = ['tambah', 'edit', 'tutup', 'delete', "callModal"];

    public function callModal($thn, $tsk, $ktpu){
        //$type, $name, $hash, $table, $key
        //$hash = preg_replace("![^a-z0-9]+!i", "-", strtolower($nama_jkeluarga));
        $name = $ktpu .'_'. date('d-m-Y',strtotime($tsk));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $thn, $name, 'riw-tumlar', 'master_riwayat_tumlar', [
            'nip' => $this->sid,
            'tsk' => $tsk,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'ptetap' => 'required',
            'tsk' => [
                'required',
                Rule::unique('master_riwayat_tumlar')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tsk', '=', $data['tsk']);
                }),
            ],
        ],[
            'ptetap.required' => 'Pejabat Penetap tidak boleh kosong',
            'tsk.required' => 'Tanggal SK Pencantuman Gelar tidak boleh kosong',
            'tsk.unique' => 'Tanggal SK Pencantuman Gelar Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatTumlar::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Pencantuman Gelar berhasil ditambahkan");

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'ptetap' => 'required',
            'tsk' => [
                'required',
                Rule::unique('master_riwayat_tumlar')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tsk', '=', $data['tsk']);
                })->ignore($this->sid, 'nip')->ignore($this->tsk, 'tsk'),
            ],
        ],[
            'ptetap.required' => 'Pejabat Penetap tidak boleh kosong',
            'tsk.required' => 'Tanggal SK Pencantuman Gelar tidak boleh kosong',
            'tsk.unique' => 'Tanggal SK Pencantuman Gelar Telah Terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatTumlar::where('nip', '=', $this->sid)->where('tsk', '=', $this->tsk)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Pencantuman Gelar berhasil diubah");

        $this->tutup();
    }
    
    public function render()
    {
        //$this->master_riwayat_pangkat =  Maste::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-tumlar', [
            'master_riwayat_tumlar' => MasterRiwayatTumlar::where('nip', '=', $this->sid)->get(),
            'master_pejabat' => MasterPejabat::all(),
            'master_tingkat_pendidikan' => MasterTingkatPendidikan::all(),
        ]);
    }

    public function changeJur($selId)
    {
        $dt = MasterTingkatPendidikan::find($selId);
        $sel = explode(',', $dt->ref_simpeg);
        $this->master_pendidikan = MasterPendidikan::where('status', '=', 1)->where(function($query) use($sel){
            foreach ($sel as $key => $value) {
                $query->orWhere('tk_pendidikan_id', '=', $value);
            }
        })->get();
    }

    public function tambah(){
        $this->next = 'store';
        $this->subPage = 'formulir';
        $this->dataset['nip'] = $this->sid;
    }

    public function edit($value){
        $this->next = 'update';
        $this->subPage = 'formulir';

        $dataset = MasterRiwayatTumlar::where('nip', '=', $this->sid)->where('tsk', '=', $value['tsk'])->first();

        if($dataset){
            $this->tsk = $dataset['tsk'];
            $this->changeJur($dataset['ktpu']);
            $this->dataset = $dataset->toArray();
            //$this->getMasterArsip('pendum_'.$dataset['ktpu'], "Pendidikan Umum : ".$dataset['ntpu']->nama);
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function delete($value){
        $this->master_riwayat_pangkat = MasterRiwayatTumlar::where('nip', '=', $this->sid)->where('tsk', '=', $value['tsk'])->delete();
    }

    public function tutup(){
        $this->tsk = '';
        $this->subPage = 'list';   
        $this->dataset = [];
    }
}
