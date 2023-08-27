<?php

namespace App\Http\Livewire\Personel;

use Livewire\Component;
use Livewire\WithFileUploads;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Models\Pegawai;
use Storage;

class Foto extends Component
{
    use WithFileUploads;

    public $photo;
    public $displayPhoto;
    public $profile_image = 'assets/img/undraw_profile.svg';
    public $sid;
    public $uploaded = false;

    public function render()
    {
        return view('livewire.personel.foto');
    }

    public function mount()
    {
        $data = Pegawai::where('nip', '=', $this->sid)->first();
        if($data != null && $data->file_bmp != ''){
            $this->profile_image = 'storage/photo/'.$data->file_bmp;
        }
    }

    public function updatedPhoto()
    {
        $retData = [
            'photo' => $this->photo,
        ];

        $validator = Validator::make($retData, [
            'photo' => 'image|max:1024',
        ],[
            'photo.image' => 'File yang diupload bukan berupa gambar',
            'photo.max' => 'File yang diupload melebihi batas 1MB',
        ]);

        if($validator->fails())
        {
            $this->dispatchBrowserEvent('errors', $validator->errors());
        }

        $validator->validate();

        $filename = $this->sid.'.'. $this->photo->getClientOriginalExtension();
        $this->photo->storeAs('public/photo/', $filename); 

        $this->displayPhoto = $filename;
        $this->profile_image = null;
        //$uploaded = true;

        Pegawai::where('nip', '=', $this->sid)->update([
            'file_bmp' => $filename,
        ]);
    }
}
