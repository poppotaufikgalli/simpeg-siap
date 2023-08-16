<?php

namespace App\Http\Livewire\Pegawai\DataInduk;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Pegawai;
use App\Models\MasterAgama;
use App\Models\MasterStatusPegawai;
use App\Models\MasterJenisPegawai;
use App\Models\MasterKedudukanPegawai;
use App\Models\MasterJenisKawin;
use App\Models\MasterJenisGolDar;
use App\Models\MasterJenisWilayah;
use App\Models\MasterStatusKPE;
use App\Models\MasterJenisArsip;
use App\Models\MasterInstansi;

class IdentitasPegawai extends Component
{
    use WithFileUploads;

    public $sid;
    public $next;
    public $method;
    public $dataset;
    public $pegawai;

    public $master_kab_kota;
    public $master_kec;
    public $master_kel;

    public $arsip = [];

    protected $listeners = ['updatedArsip'];
    //public $profilePic;
    public function updatedArsip($kdok)
    {
        $this->arsip[] = $kdok;
    }

    public function store(){
        $validator = Validator::make($this->dataset, [
            'nip' => 'required|unique:master_pegawai',
            'nik' => 'required|unique:master_pegawai',

            'kjkel' => 'required',
            'kagama' => 'required',
            'kstatus' => 'required',
            'kjpeg' => 'required',
            'kduduk' => 'required',
            'kskawin' => 'required',
            'kgoldar' => 'required',
            'stat_kpe' => 'required',

            'alkoprop' => 'required',
            'alkokab' => 'required',

            //'npwp' => 'required|unique:master_pegawai',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP Telah terdaftar',

            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK Telah terdaftar',

            'kjkel' => 'Jenis Kelamin Belum dipilih',
            'kagama' => 'Agama Belum dipilih',
            'kstatus' => 'Status Kepegawaian Belum dipilih',
            'kjpeg' => 'Jenis Kepegawaian Belum dipilih',
            'kduduk' => 'Kedudukan Kepegawaian Belum dipilih',
            'kskawin' => 'Status Perkawinan Belum dipilih',
            'kgoldar' => 'Golongan Darah Belum dipilih',
            'stat_kpe' => 'Status KPE Belum dipilih',

            'alkoprop' => 'Alamat Provinsi Belum dipilih',
            'alkokab' => 'Alamat Kabupaten Belum dipilih',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        Pegawai::create($data);

        return redirect()->route('pegawai.edit', [
            'id' => $this->dataset['nip'],
            'method' => 'edit',
            'next' => 'update',
        ])->with([
            'success'=> "Data Identitas Pegawai berhasil ditambahkan."
        ]);
    }

    public function update(){
        $validator = Validator::make($this->dataset, [
            'nik' => ['required', Rule::unique('master_pegawai')->ignore($this->dataset['nik'], 'nik')],

            'kjkel' => 'required',
            'kagama' => 'required',
            'kstatus' => 'required',
            'kjpeg' => 'required',
            'kduduk' => 'required',
            'kskawin' => 'required',
            'kgoldar' => 'required',
            'stat_kpe' => 'required',

            'alkoprop' => 'required',
            'alkokab' => 'required',
        ],[
            'nik.required' => 'NIK tidak boleh kosong',
            'nik.unique' => 'NIK Telah terdaftar',

            'kjkel' => 'Jenis Kelamin Belum dipilih',
            'kagama' => 'Agama Belum dipilih',
            'kstatus' => 'Status Belum dipilih',
            'kjpeg' => 'Jenis Kepegawaian Belum dipilih',
            'kduduk' => 'Kedudukan Kepegawaian Belum dipilih',
            'kskawin' => 'Status Perkawinan Belum dipilih',
            'kgoldar' => 'Golongan Darah Belum dipilih',
            'stat_kpe' => 'Status KPE Belum dipilih',

            'alkoprop' => 'Alamat Provinsi Belum dipilih',
            'alkokab' => 'Alamat Kabupaten Belum dipilih',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        Pegawai::where('nip', '=', $this->sid)->update($data);

        $this->dispatchBrowserEvent('informations', "Data Identitas Pegawai berhasil diubah.");
    }

    public function render()
    {
        $data = [
            'master_agama' => MasterAgama::get(),
            'master_status_pegawai' => MasterStatusPegawai::get(),
            'master_jenis_pegawai' => MasterJenisPegawai::where('status', '=', 1)->get(),
            'master_kedudukan_pegawai' => MasterKedudukanPegawai::get(),
            'master_kawin' => MasterJenisKawin::get(),
            'master_goldar' => MasterJenisGolDar::get(),
            'master_provinsi' => MasterJenisWilayah::where('twil', '=', 1)->get(),
            'master_kpe' => MasterStatusKPE::get(),
            'master_jenis_arsip' => MasterJenisArsip::where('group_arsip_id', '=', 1)->get(),
        ];

        return view('livewire.pegawai.data-induk.identitas-pegawai', $data);
    }

    public function mount(){
        
        if($this->dataset){
            $this->dataset['nip'] = (string)$this->sid;
            $this->changeProv($this->dataset['alkoprop']);    
            $this->changeKab($this->dataset['alkokab']);
            $this->changeKec($this->dataset['alkokec']);
        }
    }

    public function updatedDataset()
    {
        //$nip = $this->dataset['nip'];
        //dd($this->dataset);
    }

    public function changeProv($selId)
    {
        $this->master_kab_kota = MasterJenisWilayah::where('twil','=', 2)->where('kprov', '=', $selId)->get();
    }

    public function changeKab($selId)
    {
        $this->master_kec = MasterJenisWilayah::where('twil','=', 3)->where('kprov', '=', $this->dataset['alkoprop'])->where('kkab', '=', $selId)->get();
    }

    public function changeKec($selId)
    {
        //dd($this->dataset);
        $this->master_kel = MasterJenisWilayah::where('twil','=', 4)->where('kprov', '=', $this->dataset['alkoprop'])->where('kkab', '=', $this->dataset['alkokab'])->where('kkec', '=', $selId)->get();
    }
}
