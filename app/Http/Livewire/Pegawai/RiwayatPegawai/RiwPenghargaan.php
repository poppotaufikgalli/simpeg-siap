<?php

namespace App\Http\Livewire\Pegawai\RiwayatPegawai;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterRiwayatPenghargaan;
use App\Models\MasterJenisPenghargaan;
use App\Models\MasterPejabat;
use App\Models\MasterJenisArsip;

class RiwPenghargaan extends Component
{
    public $sid;
    public $subPage = 'list';
    public $lblAkhir = "Ya";

    public $next;
    public $method;
    public $dataset = [];
    public $arsip = [];

    public $nsk;
    public $nbintang;
    public $master_jenis_arsip = [];

    protected $listeners = ["tambah", "tutup", "edit", "delete", "callModal"];

    public function callModal($nbintang, $njns, $nsk){
        //$type, $name, $hash, $table, $key
        $name = preg_replace("![^a-z0-9]+!i", "-", strtolower($njns.'-'.$nsk));
        //$name = $id_jenis_penghargaan .'_'. date('d-m-Y',strtotime($tmtjab));
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $nbintang, $name, 'riw-penghargaan', 'master_riwayat_penghargaan', [
            'nip' => $this->sid,
            'nbintang' => $nbintang,
            'nsk' => $nsk,
        ]);
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'nbintang' => [
                'required',
                Rule::unique('master_riwayat_penghargaan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('nsk', '=', $data['nsk'])
                        ->where('nbintang', '=', $data['nbintang']);
                }),
            ],
            'nsk' => [
                'required',
                Rule::unique('master_riwayat_penghargaan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('nsk', '=', $data['nsk'])
                        ->where('nbintang', '=', $data['nbintang']);
                }),
            ],
        ],[
            'nbintang.required' => 'Nama Penghargaan tidak boleh kosong',
            'nbintang.unique' => 'Nama Penghargaan Telah terdaftar',

            'nsk.required' => 'Nomor SK Penghargaan tidak boleh kosong',
            'nsk.unique' => 'Nomor SK Penghargaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatPenghargaan::create($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Penghargaan berhasil ditambahkan");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $validator = Validator::make($data, [
            'nbintang' => [
                'required',
                Rule::unique('master_riwayat_penghargaan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('nbintang', '=', $data['nbintang'])
                        ->where('nsk', '=', $data['nsk']);
                })->ignore($this->sid,'nip')->ignore($this->nbintang,'nbintang')->ignore($this->nsk,'nsk'),
            ],
            'nsk' => [
                'required',
                Rule::unique('master_riwayat_penghargaan')->where(function ($query) use($data) {
                    return $query->where('nip', '=', $this->sid)
                        ->where('nbintang', '=', $data['nbintang'])
                        ->where('nsk', '=', $data['nsk']);
                })->ignore($this->sid,'nip')->ignore($this->nbintang,'nbintang')->ignore($this->nsk,'nsk'),
            ],
        ],[
            'nbintang.required' => 'Nama Penghargaan tidak boleh kosong',
            'nbintang.unique' => 'Nama Penghargaan Telah terdaftar',

            'nsk.required' => 'Nomor SK Penghargaan tidak boleh kosong',
            'nsk.unique' => 'Nomor SK Penghargaan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        MasterRiwayatPenghargaan::where('nip', '=', $this->sid)->where('nbintang', '=', $this->nbintang)->where('nsk', '=', $this->nsk)->update($data);
        $this->dispatchBrowserEvent('informations', "Data Riwayat Penghargaan berhasil diubah");

        //$this->getMasterArsip('pangkat'.$result->kgolru, "Pangkat ".$result->npangkat->nama);
        //$this->next = 'update';

        $this->tutup();
    }
    
    public function render()
    {
        $retData = MasterRiwayatPenghargaan::where('nip', '=', $this->sid)->get();

        return view('livewire.pegawai.riwayat-pegawai.riw-penghargaan', [
            'master_riwayat_penghargaan' => $retData,
            'master_jenis_penghargaan' => MasterJenisPenghargaan::all(),
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

        $dataset = MasterRiwayatPenghargaan::where('nip', '=', $this->sid)->where('nbintang', '=', $value['nbintang'])->where('nsk', '=', $value['nsk'])->first();

        if($dataset){
            $this->nsk = $value['nsk'];
            $this->nbintang = $value['nbintang'];
            $this->getMasterArsip('jasa_'.$dataset['tsk']->format('Ymd').'.'.strlen($dataset['nsk']), "Penghargaan : ".$dataset['nbintang']);
            $this->dataset = $dataset->toArray();
        }else{
            $this->dataset['nip'] = $this->sid;
        }
    }

    public function getMasterArsip($jns, $nama)
    {
        $master_jenis_arsip = MasterJenisArsip::select('id', 'nama', 'jnsdok')->where('jnsdok', '=', 'jasa')->get();
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
        $del = MasterRiwayatPenghargaan::where('nip', '=', $this->sid)->where('nbintang', '=', $value['nbintang'])->where('nsk', '=', $value['nsk'])->delete();
        //dd($del);
        //$del->delete();      
        
        $this->dispatchBrowserEvent('informations', "Data Riwayat Penghargaan berhasil dihapus");  
    }
}
