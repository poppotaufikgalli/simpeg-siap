<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Akses;
use App\Models\Group;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\Route;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function getControllerList()
    {
        $routelist = \Illuminate\Support\Facades\Route::getRoutes();
        $ret = [];
        foreach ($routelist as $key => $value) {
            if($value->getActionMethod() == 'index'){
                $ret[] = $value->getName();
            }
        }

        return $ret;
    }

    public function index(Request $request)
    {
        $data['group'] = Group::get();
        if($request->method() == 'POST'){
            $reqAll = $request->only('name', 'nama', 'nip', 'gid');
            //dd($reqAll);
            $filter = array_filter($reqAll, function($value) {
                return $value != "";
            });
            //if($filter)
            if(count($filter) > 0){
                $req = $request->only('name', 'nip');

                $filter = array_filter($req, function($value) {
                    return $value != "";
                });

                $data['data'] = User::Where($filter)->where(function ($query) use ($request) {
                    if($request->gid != null){
                        $query->where('gid', '=', $request->gid);
                    }
                })->Paginate(20);

                /*$data['data'] = User::Where($filter)->whereHas('roleInfo', function ($query) use ($request) {
                    if($request->gid != null){
                        $query->where('gid', '=', $request->gid);
                    }
                })->toSql();
                dd($data['data']);*/
            }else{
                $data['data'] = User::Paginate(20);    
            }
        }else{
            $data['data'] = User::Paginate(20);
        }
        
        //dd($data['data']);
        return view('admin/user/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'method' => 'create',
            'next' => 'user.store',
            'group' => Group::get(),
        ];
        //dd($data);
        return view('admin/user/formulir', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqData = $request->all();
        //dd($reqData);
        $validator = Validator::make($reqData, [
            'nip' => 'required|unique:users,nip',
            'name' => 'required|unique:users,name',
            'gid' => 'required',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            //'nip.size' => 'NIP tidak Valid',
            'nip.unique' => 'NIP telah terdaftar',

            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama telah terdaftar',

            'gid.required' => 'Group tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reqData['crid'] = $request->session()->get('nip');
        $reqData['password'] = md5($request->nip);

        User::create($reqData);
        return redirect('/user')->with('success', "Data User berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function show(Akses $akses, $id)
    {
        $data = [
            'data' => User::find($id),
            'method' => 'show',
            'next' => 'user',
            'group' => Group::get(),
        ];
        return view('admin/user/formulir', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function edit(Akses $akses, $id)
    {
        $data = [
            'data' => User::find($id),
            'method' => 'edit',
            'next' => 'user.update',
            'group' => Group::get(),
        ];
        return view('admin/user/formulir', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Akses $akses)
    {
        $reqData = $request->only('nip', 'name', 'gid');
        $id = $request->id;
        $validator = Validator::make($reqData, [
            'nip' => ['required', Rule::unique('users')->ignore($id)],
            'name' => ['required', Rule::unique('users')->ignore($id)],
            'gid' => 'required',
        ],[
            'nip.required' => 'NIP tidak boleh kosong',
            //'nip.size' => 'NIP tidak Valid',
            'nip.unique' => 'NIP telah terdaftar',

            'name.required' => 'Nama tidak boleh kosong',
            'name.unique' => 'Nama telah terdaftar',

            'gid.required' => 'Group tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $reqData['crid'] = $request->session()->get('nip');
        //dd($reqData);
        User::find($id)->update($reqData);
        return redirect('/user')->with('success', "Data User berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Akses $akses)
    {
        $id = $request->id;
        User::find($id)->delete();
        return redirect('/user')->with('success', "Data User berhasil dihapus.");
    }
}
