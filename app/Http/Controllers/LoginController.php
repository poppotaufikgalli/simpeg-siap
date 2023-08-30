<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use App\Models\User;
use App\Models\Group;

class LoginController extends Controller
{
    /**
     * Display login page.
     * 
     * @return Renderable
     */
    public function show()
    {
        return view('admin/loginPage');
    }

    /**
     * Handle account login request
     * 
     * @param LoginRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        //dd(md5($credentials['password']));

        $user = User::where('nip', $credentials['nip'])
                ->where('password', md5($credentials['password']))->first();
        //dd($akses);
        
        if(!$user){
            return redirect()->to('login')
                ->withErrors("Login Invalid")
                ->onlyInput('nip');
        }else{
            Auth::login($user); 
            $akses = Group::find($user->gid);
            return $this->authenticated($request, $user, $akses['lsakses']);
        }
    }

    public function logout()
    {
        //Session::flush();
        Auth::logout();
        return redirect('login');
    }

    /**
     * Handle response after user authenticated
     * 
     * @param Request $request
     * @param Auth $user
     * 
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user, $akses) 
    {
        $request->session()->put('authenticated', time());
        $request->session()->put('id', $user->id);
        $request->session()->put('nama', $user->name);
        $request->session()->put('nip', $user->nip);
        $menu = [];
        $dokakses = [];
        $konakses = [];
        $makses = [];
        $dakses = [];
        $kakses = [];
        /*$nkakses = $this->getHal();
        //dd($akses);*/

        if($akses != ''){
            $adata = json_decode($akses, true);
            //dd($akses);
            $mdata = json_decode($adata['menu'], true);

            if(isset($adata['menu'])){
                foreach ($mdata as $key => $value) {
                    $menu[] = $key;
                    $makses[$key] = $value;  
                }
            }

            if(isset($adata['dokakses'])){
                $ddata = json_decode($adata['dokakses'], true);
                foreach ($ddata as $key => $value) {
                    $dokakses[] = $key;
                    $dakses[$key] = $value;  
                }
            }
            
            if(isset($adata['kontenakses'])){
                $kdata = json_decode($adata['kontenakses'], true);
                foreach ($kdata as $key => $value) {
                    $konakses[] = $key;
                    $kakses[$key] = $value;  
                }    
            }
            
        }

        //dd($akses);
        $request->session()->put('akses', $akses);
        
        $request->session()->put('dokakses', $dokakses);
        $request->session()->put('nakses', $makses);
        $request->session()->put('dakses', $dakses);
        $request->session()->put('konakses', $konakses);
        $request->session()->put('kakses', $kakses);
        //$request->session()->put('nkakses', $nkakses);

        $request->session()->put('menu', $menu);
        return redirect()->intended('dashboard')->withSuccess('Berhasil Login');
    }
}
