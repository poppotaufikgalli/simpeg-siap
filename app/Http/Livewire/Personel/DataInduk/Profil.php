<?php

namespace App\Http\Livewire\Personel\DataInduk;

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

class Profil extends Component
{
    use WithFileUploads;

    public $sid;
    public $nama;
    public $next;
    public $method;
    public $dataset;
    public $pegawai;
    public $id_jenis_personel;

    public $master_kab_kota;
    public $master_kec;
    public $master_kel;

    public $file_bmp;
    public $profile_image = 'assets/img/undraw_profile.svg';

    public $arsip = [];

    protected $listeners = ['updatedArsip', "callModal"];

    public function callModal($nama){
        $this->emitTo('modal-upload-arsip-personel', 'openModalPersonel', $this->sid, $nama, 'data-induk', 'master_pegawai', [
            'nip' => $this->sid,
        ]);
    }

    //public $profilePic;
    public function updatedArsip($kdok)
    {
        $this->arsip[] = $kdok;
    }

    public function store(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['id_jenis_personel'] = $this->id_jenis_personel;
        $data['kstatus'] = 1;
        $data['kjpeg'] = 2;

        //dd($data);

        $validator = Validator::make($data, [
            'nip' => 'required|unique:master_pegawai',
            //'nik' => 'required|unique:master_pegawai',

            'kjkel' => 'required',
            'kagama' => 'required',
            'kstatus' => 'required',
            'kjpeg' => 'required',
            'kduduk' => 'required',
            'kskawin' => 'required',
            //'file_bmp' => 'sometimes|image|max:1024',
            //'kgoldar' => 'required',
            //'stat_kpe' => 'required',

            //'alkoprop' => 'required',
            //'alkokab' => 'required',

            //'npwp' => 'required|unique:master_pegawai',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            'nip.unique' => 'NIP Telah terdaftar',

            //'nik.required' => 'NIK tidak boleh kosong',
            //'nik.unique' => 'NIK Telah terdaftar',

            'kjkel.required' => 'Jenis Kelamin Belum dipilih',
            'kagama.required' => 'Agama Belum dipilih',
            'kstatus.required' => 'Status Kepegawaian Belum dipilih',
            'kjpeg.required' => 'Jenis Kepegawaian Belum dipilih',
            'kduduk.required' => 'Kedudukan Kepegawaian Belum dipilih',
            'kskawin.required' => 'Status Perkawinan Belum dipilih',
            'file_bmp.image' => 'File yang diupload bukan berupa gambar',
            'file_bmp.max' => 'File yang diupload melebihi batas 1MB',
            //'kgoldar' => 'Golongan Darah Belum dipilih',
            //'stat_kpe' => 'Status KPE Belum dipilih',

            //'alkoprop' => 'Alamat Provinsi Belum dipilih',
            //'alkokab' => 'Alamat Kabupaten Belum dipilih',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        //$this->dataset['file_bmp']->store('photos');

        if($this->file_bmp){
            $filename = $this->dataset['nip'].'.'. $this->file_bmp->getClientOriginalExtension();
            $this->file_bmp->storeAs('public/photo/', $filename); 

            $data['file_bmp'] = $filename;
        }

        Pegawai::create($data);

        return redirect()->route('personel.edit', [
            'id' => str_replace('/', '-', $this->dataset['nip']),
            'method' => 'edit',
            'next' => 'update',
            'page' => 'data-induk',
            'id_jenis_personel' => $this->id_jenis_personel,
        ])->with([
            'success'=> "Data Identitas Pegawai berhasil ditambahkan."
        ]);
    }

    public function update(){
        $data = array_map(function($value) {
           return $value === "" ? NULL : $value;
        }, $this->dataset);

        $data['id_jenis_personel'] = $this->id_jenis_personel;
        $data['kstatus'] = 1;
        $data['kjpeg'] = 2;

        $validator = Validator::make($data, [
            //'nik' => ['required', Rule::unique('master_pegawai')->ignore($this->dataset['nik'], 'nik')],

            'kjkel' => 'required',
            'kagama' => 'required',
            'kstatus' => 'required',
            'kjpeg' => 'required',
            'kduduk' => 'required',
            'kskawin' => 'required',
            //'file_bmp' => 'nullable|image|max:1024',
            //'kgoldar' => 'required',
            //'stat_kpe' => 'required',

            //'alkoprop' => 'required',
            //'alkokab' => 'required',
        ],[
            //'nik.required' => 'NIK tidak boleh kosong',
            //'nik.unique' => 'NIK Telah terdaftar',

            'kjkel.required' => 'Jenis Kelamin Belum dipilih',
            'kagama.required' => 'Agama Belum dipilih',
            'kstatus.required' => 'Status Belum dipilih',
            'kjpeg.required' => 'Jenis Kepegawaian Belum dipilih',
            'kduduk.required' => 'Kedudukan Kepegawaian Belum dipilih',
            'kskawin.required' => 'Status Perkawinan Belum dipilih',
            'file_bmp.image' => 'File yang diupload bukan berupa gambar',
            'file_bmp.max' => 'File yang diupload melebihi batas 1MB',
            //'kgoldar' => 'Golongan Darah Belum dipilih',
            //'stat_kpe' => 'Status KPE Belum dipilih',

            //'alkoprop' => 'Alamat Provinsi Belum dipilih',
            //'alkokab' => 'Alamat Kabupaten Belum dipilih',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        if($this->file_bmp){
            $filename = $this->dataset['nip'].'.'. $this->file_bmp->getClientOriginalExtension();
            $this->file_bmp->storeAs('public/photo/', $filename); 

            $data['file_bmp'] = $filename;
        }

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

        return view('livewire.personel.data-induk.profil', $data);
    }

    public function mount(){
        
        if($this->sid != ''){
            $dataset = Pegawai::where('nip', '=', $this->sid)->first();

            if($dataset){
                $this->dataset = $dataset->toArray();
                $this->dataset['nip'] = (string)$this->sid;
                $this->profile_image = 'storage/photo/'.$dataset->file_bmp;
                $this->nama = $dataset->nama;
            }
        }
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
