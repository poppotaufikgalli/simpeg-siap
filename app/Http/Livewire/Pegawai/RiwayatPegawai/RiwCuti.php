<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatCuti;
use App\Models\MasterJenisCuti;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class RiwCuti extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblAkhir = "Ya";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $tmulai;
    public $nsk;
    public $master_jenis_arsip = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($njns, $tmulai, $nsk){
        //$type, $name, $hash, $table, $key
        $name = preg_replace("![^a-z0-9]+!i", "-", strtolower($nsk)).'_'. date('d-m-Y',strtotime($tmulai));
        //$name = $nsk .'_'. date('d-m-Y',strtotime($tmtjab));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $njns, $name, 'riw-cuti', 'master_riwayat_cuti', [
            'nip' => $this->sid,
            'tmulai' => $tmulai,
            'nsk' => $nsk,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'tmulai' => [
                'required',
                Rule::unique('master_riwayat_cuti')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('nsk', '=', $data['nsk']);
                }),
            ],
            'nsk' => [
                'required',
                Rule::unique('master_riwayat_cuti')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('nsk', '=', $data['nsk']);
                }),
            ],
        ],[
            'tmulai.required' => 'Tanggal Mulai Cuti tidak boleh kosong',
            'tmulai.unique' => 'Tanggal Mulai Cuti Telah terdaftar',

            'nsk.required' => 'Nomor SK Cuti tidak boleh kosong',
            'nsk.unique' => 'Nomor SK Cuti Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatCuti::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Cuti berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
             'tmulai' => [
                'required',
                Rule::unique('master_riwayat_cuti')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('nsk', '=', $data['nsk']);
                })->ignore($this->sid,'nip')->ignore($this->tmulai,'tmulai')->ignore($this->nsk, 'nsk'),
            ],
            'nsk' => [
                'required',
                Rule::unique('master_riwayat_cuti')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('tmulai', '=', $data['tmulai'])
                        ->where('nsk', '=', $data['nsk']);
                })->ignore($this->sid,'nip')->ignore($this->tmulai,'tmulai')->ignore($this->nsk, 'nsk'),
            ],
        ],[
            'tmulai.required' => 'Tanggal Mulai Cuti tidak boleh kosong',
            'tmulai.unique' => 'Tanggal Mulai Cuti Telah terdaftar',

            'nsk.required' => 'Nomor SK Cuti tidak boleh kosong',
            'nsk.unique' => 'Nomor SK Cuti Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatCuti::where('nip', '=', $this->sid)->where('tmulai', '=', $this->tmulai)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Cuti berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatCuti::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-cuti', [
            'master_riwayat_cuti' => $retData,
            'master_jenis_cuti' => MasterJenisCuti::all(),
            'master_pejabat' => MasterPejabat::all()
            //'master_pangkat' => MasterPangkat::all(),
        ]);
    }

    public function mount(){
        $this->dataset['nip'] = $this->sid;
    }

    public function tambah()
    {
        $this->dispatchBrowserEvent('tomSelectActive');
        $this->subPage = 'formulir';
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
        $this->dispatchBrowserEvent('tomSelectActive');

        $this->subPage = 'formulir';
        $this->next = "update";

        $dataset = MasterRiwayatCuti::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->first();

        if($dataset){
            $this->tmulai = $value['tmulai'];
            $this->nsk = $value['nsk'];
            $this->getMasterArsip('cuti_'.$dataset['tmulai']->format('Ymd').'.'.$dataset['jmlhari'], "Cuti : ".$dataset['tmulai']->format('d-m-Y'));
            $this->dataset = $dataset->toArray();
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'cuti')->get();
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
        $del = MasterRiwayatCuti::where('nip', '=', $this->sid)->where('tmulai', '=', $value['tmulai'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Cuti berhasil dihapus");  
    }
}
