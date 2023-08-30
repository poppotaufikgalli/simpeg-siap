<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;

class ModalGantiPassword extends Component
{
    public $passlama;
    public $passbaru;
    public $cpassbaru;
    public $myid;

    public function render()
    {
        $this->myid = Session::get('id');
        return view('livewire.modal-ganti-password');
    }

    public function update()
    {
        //dd($this->myid);
        $user = User::find($this->myid);
        //dd($user);
        if($this->passlama == "" || $this->passbaru == ""){
            $this->dispatchBrowserEvent('passwordInfo', ["type" => 'error', 'message' => 'Password Tidak Boleh Kosong']);        
        }else{
            if($user->password != md5($this->passlama)){
                $this->dispatchBrowserEvent('passwordInfo', ["type" => 'error', 'message' => 'Password Tidak Sesuai']);        
            }else{
                if($this->passbaru != $this->cpassbaru){
                  $this->dispatchBrowserEvent('passwordInfo', ["type" => 'error', 'message' => 'Password Baru Tidak Sama']);          
                }else{
                    $user->password = md5($this->passbaru);
                    $user->save();
                    $this->dispatchBrowserEvent('passwordInfo', ["type" => 'success', 'message' => 'Password Berhasil diganti. Silahkan Logout']);          
                }
            }    
        }
    }
}
