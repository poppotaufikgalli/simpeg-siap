<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Route;

use App\Models\Group;
use App\Models\RefTipeDokHukum;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected function getControllerList($searchText='index')
    {
        $routelist = Route::getRoutes();
        $ret = [];
        foreach ($routelist as $key => $value) {
            if($value->getActionMethod() == $searchText){
                $ret[] = $value->getName();
            }
        }

        return $ret;
    }

    protected function getDokAkses()
    {
        return RefTipeDokHukum::select('id', 'nama')->where('stts',1)->get();
    }

    public function index()
    {
        $data['data'] = Group::get();
        return view('admin/group/index', $data);
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
            'next' => 'group.store',
            'routelist' => $this->getControllerList(),
            'dokakses' => $this->getControllerList('DokAkses'),
            'kontenakses' => $this->getHal(),
            //'dokakses' => $this->getDokAkses(),
        ];
        
        return view('admin/group/formulir', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reqData = $request->only('nama');
        $validator = Validator::make($reqData, [
            'nama' => 'required|min:3|unique:group,nama',
        ],[
            'nama.required' => 'Nama Group tidak boleh kosong',
            'nama.min' => 'Nama Group minimal 3 Karakter',
            'nama.unique' => 'Nama Group telah terdaftar',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        if($request->input('lsakses')){
            $reqData['lsakses']['menu'] = json_encode($request->lsakses);
        }

        if($request->input('dokakses')){
            $reqData['lsakses']['dokakses'] =  json_encode($request->dokakses);    
        }

        if($request->input('kontenakses')){
            $reqData['lsakses']['kontenakses'] =  json_encode($request->dokakses);    
        }
        
        $reqData['crid'] = $request->session()->get('nip');
        $reqData['lsakses'] = json_encode($reqData['lsakses']);
        //dd($reqData);
        Group::create($reqData);
        return redirect('/group')->with('success', "Data Group berhasil ditambahkan.");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group, $id)
    {
        $data = [
            'data' => $group::find($id),
            'method' => 'show',
            'next' => 'group',
            'routelist' => $this->getControllerList(),
            'dokakses' => $this->getControllerList('DokAkses'),
            'kontenakses' => $this->getHal(),
        ];
        //dd($data);
        return view('admin/group/formulir', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group, $id)
    {
        $data = [
            'data' => $group::find($id),
            'method' => 'edit',
            'next' => 'group.update',
            'routelist' => $this->getControllerList(),
            'dokakses' => $this->getControllerList('DokAkses'),
            'kontenakses' => $this->getHal(),
        ];
        return view('admin/group/formulir', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        $reqData = $request->only('nama');
        $id = $request->id;
        $validator = Validator::make($reqData, [
            'nama' => ['required', 'min:3', Rule::unique('group')->ignore($id)],
        ],[
            'nama.required' => 'Nama Group tidak boleh kosong',
            'nama.min' => 'Nama Group minimal 3 Karakter',
            'name.unique' => 'Nama Group telah terdaftar',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        
        $reqData['lsakses'] = [
            'menu' => json_encode($request->lsakses),
            'dokakses' => json_encode($request->dokakses),
            'kontenakses' => json_encode($request->kontenakses),
        ];
        $reqData['upid'] = $request->session()->get('nip');
        //dd($reqData);
        $group::find($id)->update($reqData);
        return redirect('/group')->with('success', "Data Group berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Akses  $akses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Group $group)
    {
        $id = $request->id;
        $group::find($id)->delete();
        return redirect('/group')->with('success', "Data Group berhasil dihapus.");
    }
}
