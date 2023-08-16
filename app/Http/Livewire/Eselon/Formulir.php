<?php

namespace App\Http\Livewire\Eselon;

use Livewire\Component;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\MasterEselon;
use App\Models\MasterJenisJabatan;

class Formulir extends Component
{
    public $next;
    public $method;
    public $lblStts = "Tidak Aktif";
    public $lblAk = "Tidak";

    public $sid;
    public $dataset;

    public $disabled = 'disabled';

    public function store()
    {
        $retData = [
            'id' => $this->dataset['_id'],
            'jabatan_asn' => $this->dataset['jabatan_asn'],
            'nama' => $this->dataset['nama'],
            'id_jenis_jabatan' => $this->dataset['id_jenis_jabatan'] ?? '',
            'status' => isset($this->dataset['status']) && $this->dataset['status'] == 'on' ? 1 : 0, 
        ];

        $validator = Validator::make($retData, [
            'id' => 'required|unique:master_eselon',
            //'jabatan_asn' => 'required|unique:master_eselon',
            'nama' => 'required|unique:master_eselon',
            //'id_jenis_jabatan' => 'required|unique:master_eselon',
        ],[
            'id.required' => 'ID Eselon tidak boleh kosong',
            'id.unique' => 'ID Eselon Telah terdaftar',

            //'jabatan_asn.required' => 'Kode Eselon tidak boleh kosong',
            //'jabatan_asn.unique' => 'Kode Eselon Telah terdaftar',

            'nama.required' => 'Nama Eselon tidak boleh kosong',
            'nama.unique' => 'Nama Eselon Telah terdaftar',

            //'id_jenis_jabatan.required' => 'Id Jenis Jabatan belum dipilih',
            //'id_jenis_jabatan.unique' => 'Id Jenis Jabatan Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterEselon::create($retData);

        return redirect('/eselon')->with([
            'success'=> "Data Master Eselon Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        //dd($this->dataset);
        $retData = [
            'nama' => $this->dataset['nama'],
            'jabatan_asn' => $this->dataset['jabatan_asn'],
            'id_jenis_jabatan' => $this->dataset['id_jenis_jabatan'] ?? '',
            'status' => isset($this->dataset['status']) && ($this->dataset['status'] == 'on' || $this->dataset['status'] == true) ? 1 : 0, 
        ];

        $id = $this->sid;

        $validator = Validator::make($retData, [
            'nama' => [
                'required', 
                //Rule::unique('master_eselon')->ignore($retData['nama'], 'id_eselon'),
                //Rule::unique('master_eselon')->where(function ($query) use ($retData) {
                //    return $query->where('nama', '=', $retData['nama'])->where('id_jenis_jabatan', '=', $retData['id_jenis_jabatan']);
                //})->ignore($id)
            ],
            //'jabatan_asn' => [
                //'required', 
                //Rule::unique('master_eselon')->ignore($retData['nama'], 'id_eselon'),
                //Rule::unique('master_eselon')->where(function ($query) use ($retData) {
                //    return $query->where('jabatan_asn', '=', $retData['jabatan_asn']);
                //})->ignore($this->sid)
            //],
        ],[
            'nama.required' => 'Nama Eselon tidak boleh kosong',
            //'nama.unique' => 'Nama Eselon Telah terdaftar',

            //'jabatan_asn.required' => 'Jabatan ASN Eselon tidak boleh kosong',
            //'jabatan_asn.unique' => 'Jabatan ASN Eselon Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        MasterEselon::find($this->sid)->update($retData);

        return redirect('/eselon')->with([
            'success'=> "Data Master Eselon Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        return view('livewire.eselon.formulir', [
            'master_jenis_jabatan' => MasterJenisJabatan::where('status', '=', 1)->get(),
        ]);
    }

    public function mount()
    {
        if($this->sid != ""){
            $dataset = MasterEselon::find($this->sid);
        
            if($dataset) {
                $this->changeStts($dataset->status);
                $this->changeJnsJab($dataset->id_jenis_jabatan);
                $this->dataset = [
                    '_id' => $dataset->id,
                    'nama' => $dataset->nama,
                    'jabatan_asn' => $dataset->jabatan_asn,
                    'id_jenis_jabatan' => $dataset->id_jenis_jabatan,
                    'status' => $dataset->status == 1 ? true : false,
                ];
            }    
        }
    }

    public function changeStts($selId){
        $this->lblStts = $selId ? "Aktif" : "Tidak Aktif";
    }

    public function changeJnsJab($selId)
    {
        if($selId == 1 || $selId == 3){
            $this->dataset['nama'] = '';
            $this->disabled = '';
        }else{
            $this->dataset['nama'] = '--';
            $this->disabled = 'disabled';
        }
    }
}
