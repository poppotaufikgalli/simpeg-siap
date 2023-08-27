<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatDp3;
use App\Models\MasterJenisArsip;

class RiwDp3 extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblAkhir = "Ya";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $mulai;
    public $selesai;
    public $master_jenis_arsip = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete"];

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        //$data['mulai'] = date_format( date_create($data['mulai']), 'Y-m-d');
        //$data['selesai'] = date_format( date_create($data['selesai']), 'Y-m-d');

        //dd($data);

        $validator = Validator::make($data, [
            'mulai' => [
                'required',
                Rule::unique('master_riwayat_p2kp')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('mulai', '=', $data['mulai'])
                        ->where('selesai', '=', $data['selesai']);
                }),
            ],
            'selesai' => [
                'required',
                Rule::unique('master_riwayat_p2kp')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('mulai', '=', $data['mulai'])
                        ->where('selesai', '=', $data['selesai']);
                }),
            ],
        ],[
            'mulai.required' => 'Priode Mulai tidak boleh kosong',
            'mulai.unique' => 'Priode Mulai Telah terdaftar',

            'selesai.required' => 'Priode Selesai tidak boleh kosong',
            'selesai.unique' => 'Priode Selesai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatDp3::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat DP3 berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'mulai' => [
                'required',
                Rule::unique('master_riwayat_p2kp')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('mulai', '=', $data['mulai'])
                        ->where('selesai', '=', $data['selesai']);
                })->ignore($this->sid,'nip')->ignore($this->mulai,'mulai')->ignore($this->selesai,'selesai'),
            ],
            'selesai' => [
                'required',
                Rule::unique('master_riwayat_p2kp')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('mulai', '=', $data['mulai'])
                        ->where('selesai', '=', $data['selesai']);
                })->ignore($this->sid,'nip')->ignore($this->mulai,'mulai')->ignore($this->selesai,'selesai'),
            ],
        ],[
            'mulai.required' => 'Priode Mulai tidak boleh kosong',
            'mulai.unique' => 'Priode Mulai Telah terdaftar',

            'selesai.required' => 'Priode Selesai tidak boleh kosong',
            'selesai.unique' => 'Priode Selesai Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatDp3::where('nip', '=', $this->sid)->where('mulai', '=', $this->mulai)->where('selesai', '=', $this->selesai)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat DP3 berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatDp3::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-dp3', [
            'master_riwayat_dp3' => $retData,
            //'master_jenis_penghargaan' => MasterJenisPenghargaan::all(),
            //'master_pejabat' => MasterPejabat::all()
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function mount(){
        $this->dataset['nip'] = $this->sid;
    }

    public function tambah()
    {
        $this->subPage = 'formulir';
        $this->method = "create";
        $this->next = "store";
    }

    public function tutup()
    {
        $this->subPage = 'list';
        $this->dataset = [];
        $this->dataset['nip'] = $this->sid;
    }

    public function edit($value)
    {
        //dd($value);

        $this->subPage = 'formulir';
        $this->method = "edit";
        $this->next = "update";

        $dataset = MasterRiwayatDp3::where('nip', '=', $this->sid)->where('mulai', '=', $value['mulai'])->where('selesai', '=', $value['selesai'])->first();

        if($dataset){
            $this->mulai = $value['mulai'];
            $this->selesai = $value['selesai'];
            $this->getMasterArsip('dp3_'.$dataset['mulai']->format('Ymd'), "DP3 : ".$dataset['mulai']->format('d-m-Y'));
            $this->dataset = $dataset->toArray();
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'dp3')->get();
        if($master_jenis_arsip){
            foreach ($master_jenis_arsip as $key => $value) {
                $value->jnsdok = $jns;
                $value->nama = $nama;
            }
            $this->master_jenis_arsip = $master_jenis_arsip;
        }
    }

    public function delete($value)
    {
        $del = MasterRiwayatDp3::where('nip', '=', $this->sid)->where('mulai', '=', $value['mulai'])->where('selesai', '=', $value['selesai'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat DP3 berhasil dihapus");  
    }
}
