<?php

namespace App\Http\Livewire\JenisPersonel;

use Livewire\Component;

use App\Models\MasterJenisPersonel;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class Formulir extends Component
{
    public $method;
    public $next;
    public $lblStts = "Tidak Aktif";

    public $sid;
    public $dataset;

    public function store()
    {
        $retData = [
            'id_jenis_personel' => $this->dataset['id_jenis_personel'],
            'nama' => $this->dataset['nama'],
            'stts' => isset($this->dataset['stts']) && $this->dataset['stts'] == 'on' ? 1 : 0, 
        ];

        $validator = Validator::make($retData, [
            'id_jenis_personel' => 'required|unique:master_jenis_personel',
            'nama' => 'required|unique:master_jenis_personel',
        ],[
            'id_jenis_personel.required' => 'Kode Jenis Personel tidak boleh kosong',
            'id_jenis_personel.unique' => 'Kode Jenis Personel Telah terdaftar',

            'nama.required' => 'Nama Jenis Personel tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Personel Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
   
        MasterJenisPersonel::create($retData);

        return redirect('/jenis_personel')->with([
            'success'=> "Data Master Jenis Personel Terkait berhasil ditambahkan."
        ]);
    }

    public function update()
    {
        $retData = [
            'nama' => $this->dataset['nama'],
            'stts' => ($this->dataset['stts'] == 'on' ||  $this->dataset['stts'] == 1) ? 1 : 0, 
        ];

        $validator = Validator::make($retData, [
            //'id_jenis_personel' => 'required|unique:master_jenis_personel',
            'nama' => ['required', Rule::unique('master_jenis_personel')->ignore($this->dataset['nama'], 'id_jenis_personel')],
        ],[
            //'id_jenis_personel.required' => 'Kode Jenis Personel tidak boleh kosong',
            //'id_jenis_personel.unique' => 'Kode Jenis Personel Telah terdaftar',

            'nama.required' => 'Nama Jenis Personel tidak boleh kosong',
            'nama.unique' => 'Nama Jenis Personel Telah terdaftar',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();
        //dd($retData);
        //$this->dataset->update($retData);
        MasterJenisPersonel::where('id_jenis_personel', '=', $this->dataset['id_jenis_personel'])->update($retData);

        return redirect('/jenis_personel')->with([
            'success'=> "Data Master Jenis Personel Terkait berhasil diubah."
        ]);
    }

    public function render()
    {
        //$this->getData();
        return view('livewire.jenis-personel.formulir');
    }

    public function changeStts($selId){
        $this->lblStts = $selId ? "Aktif" : "Tidak Aktif";
    }

    public function mount()
    {
        //dd($this->sid);
        if($this->sid > 0){
            $dataset = MasterJenisPersonel::where('id_jenis_personel', '=', $this->sid)->first();
        
            if($dataset) {
                $this->dataset = [
                    'ids' => $dataset->id_jenis_personel,
                    'id_jenis_personel' => $dataset->id_jenis_personel,
                    'nama' => $dataset->nama,
                    'stts' => $dataset->stts,
                ];
                $this->changeStts($dataset->stts);
            }    
        }
    }
}
