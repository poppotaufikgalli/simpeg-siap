<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Konten;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
//use Illuminate\Support\Facades\Storage;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File; 
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

class ConfigController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $path = public_path('images/banner');
        $data['data'] = $this->getStrukturMenu();
        $data['menuGrid'] = $this->getStrukturMenu(2);
        $data['menuSidebar'] = $this->getStrukturMenu(3);
        $lsbanner = \File::allFiles($path);
        //dd($data);
        foreach ($lsbanner as $key => $value) {
            $data['lsbanner'][] = pathinfo($value);
            //echo $['basename'];
        }

        $introPath = public_path('images/intro');
        $lsintro = \File::allFiles($introPath);
        //dd($data);
        $data['active'] = "";
        foreach ($lsintro as $key => $value) {
            if(pathinfo($value)['basename'] != 'active_intro.text'){
                $data['lsintro'][] = pathinfo($value);    
            }else{
                $data['active'] = \File::get($value);
            }
        }

        $data['link'] = Konten::select('id', 'judul', 'isi')
                ->where('jns', 'l')
                ->get();
        //dd($data);
        return view('admin/config/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($page, $ref)
    {
        $data = [
            'method' => 'create',
            'page' => $page,
            'ref_menu' => Menu::find($ref),
            'next' => 'config.store',
            //'data' => Menu::where('kategori',1)->get(),
            //'menuGrid' => Menu::where('kategori',2)->get(),
            //'lsmenu' => $this->getStrukturMenu(),
            'halaman' => Konten::select('id', 'judul')
                ->where('jns', 'h')
                ->get(),
        ];
        //dd($data);
        return view('admin/config/formulir', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $page)
    {
        //$reqData = $request->only('nama');
        if($page == 'banner'){
            $reqData['guid'] = $request->guid;
            $validator = Validator::make($reqData, [
                'guid' => 'required|mimes:png,jpg,jpeg|max:2048',
            ],[
                'guid.required' => 'File tidak boleh kosong',
                'guid.mimes' => 'File tidak Valid',
                'guid.max' => 'File melebihi 2 mb',
            ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator);
            }

            $fname = time().'.'.$reqData['guid']->extension();

            // Public Folder
            $reqData['guid']->move(public_path('images/banner'), $fname);
            //$reqData['guid'] = $fname;
            return redirect('/config#banner')->with([
                'page' => $page,
                'success'=> "Data Benner berhasil ditambahkan."
            ]);
        }elseif($page == 'link'){
            $reqData = $request->only('judul', 'alamat', 'guid');
            $validator = Validator::make($reqData, [
                'judul' => 'required|min:3|unique:konten,judul,jns:l',
                'alamat' => 'required|url|unique:konten,isi,jns:l',
                'guid' => 'sometimes|mimes:png,jpg,jpeg|max:2048',
            ],[
                'judul.required' => 'Judul tidak boleh kosong',
                'judul.min' => 'Judul minimal 3 Karakter',
                'judul.unique' => 'Judul Telah terdaftar',

                'alamat.required' => 'Alamat tidak boleh kosong',
                'alamat.url' => 'Alamat tidak Valid',
                'alamat.unique' => 'Alamat Telah terdaftar',
                
                'guid.mimes' => 'File tidak Valid',
                'guid.max' => 'File melebihi 2 mb',
            ]);

            if($validator->fails())
            {
                return redirect()->back()->with(['page' => $page])->withErrors($validator);
            }

            $reqData['jns'] = 'l';
            $reqData['isi'] = $reqData['alamat'];
            $reqData['crid'] = $request->session()->get('nip');

            $link = Konten::create($reqData);

            return redirect('/config#link')->with([
                'page' => $page,
                'success'=> "Data Link Terkait berhasil ditambahkan."
            ]);
        }elseif($page == 'menu' || $page == 'menuGrid' || $page == 'menuSidebar'){
            $reqData = $request->all();
            //dd($reqData);
            $reqData['jns'] = $reqData['jns'][0];
            $reqData['kategori'] = $page == 'menuGrid' ? 2 : ($page == 'menuSidebar' ? 3 : 1);
            $guidValidator = $page == 'menuGrid' ? 'sometimes|max:20000|mimetypes:image/png|dimensions:max_width=100,max_height=100' : 'sometimes|max:20000|mimetypes:image/png';
            $validator = Validator::make($reqData, [
                'judul' => 'required|min:3|unique:menu,judul',
                'jns' => 'required',
                'guid' => $guidValidator,
                'target' => 'required'
            ],[
                'judul.required' => 'Judul tidak boleh kosong',
                'judul.min' => 'Judul minimal 3 Karakter',
                'judul.unique' => 'Judul telah terdaftar',

                'guid.max' => 'Ukuran Gambar melebihi 2Mb',
                'guid.mimetypes' => 'Tipe Gambar Tidak Valid',
                'guid.dimensions' => 'Dimensi Gambar Tidak Valid',                

                'jns.required' => 'Jenis tidak Valid',
                'target.required' => 'Target tidak boleh kosong',
            ]);

            if($validator->fails())
            {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if(isset($reqData['guid'])){
                $fname = time().'.'.$reqData['guid']->extension();

                // Public Folder
                $reqData['guid']->move(public_path('images/menuIcon'), $fname);
                $reqData['guid'] = $fname;
            }

            $rethash = 'menu';
            if($page == 'menuGrid'){
                $rethash = 'menu-grid';
            }elseif($page == 'menuSidebar'){
                $rethash = 'menu-sidebar';
            }
            
            $reqData['crid'] = $request->session()->get('nip');
            //dd($reqData);
            Menu::create($reqData);
            return redirect('/config#'.$rethash)->with([
                'page' => $page,
                'success'=> "Data ".ucwords($page)." berhasil ditambahkan."
            ]);
        }elseif($page == 'intro'){
            $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

            // check if the upload is success, throw exception or return response you need
            if ($receiver->isUploaded() === false) {
                throw new UploadMissingFileException();
            }

            // receive the file
            $save = $receiver->receive();

            // check if the upload has finished (in chunk mode it will send smaller files)
            if ($save->isFinished()) {
                // save the file and return any response you need, current example uses `move` function. If you are
                // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
                return $this->saveFile($save->getFile(), $request);
            }

            // we are in chunk mode, lets send the current progress
            /** @var AbstractHandler $handler */
            $handler = $save->handler();

            return response()->json([
                "done" => $handler->getPercentageDone(),
                "status" => true,
            ]);
        }elseif($page == 'active_intro'){
            $filename = $request->stts == 1 ? "" : $request->filename;
            
            
            $introPath = public_path('images/intro/');
            $ok = \File::put($introPath.'active_intro.text', $filename);
            
            return redirect('/config#intro')->with([
                'page' => 'intro',
                'success'=> "Data Website intro berhasil di ". ($filename == "" ? "Non" : "") . " Aktifkan." ,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu, $id)
    {
        $dmenu = $menu::find($id);
        $ref = $dmenu->ref;
        $data = [
            'data' => $dmenu,
            'method' => 'show',
            'next' => 'config',
            'page' => 'menu',
            'ref_menu' => $menu::find($ref),
            'halaman' => Konten::select('id', 'judul')
                ->where('jns', 'h')
                ->get(),
        ];

        //dd($data);
        return view('admin/config/formulir', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu, $id, Request $request)
    {
        $dmenu = $menu::find($id);
        $ref = $dmenu->ref;

        //dd($request->page);

        $data = [
            'data' => $dmenu,
            'lsmenu' => $this->getStrukturMenu(),
            'method' => 'edit',
            'next' => 'config.update',
            'page' => $request->page,
            'ref_menu' => $menu::find($ref),
            'halaman' => Konten::select('id', 'judul')
                ->where('jns', 'h')
                ->get(),
        ];

        //dd($data);
        return view('admin/config/formulir', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Menu $menu)
    {
        $reqData = $request->only('ref', 'judul', 'keterangan', 'jns', 'target', 'guid');
        $page = $request->page;
        $reqData['jns'] = $reqData['jns'][0];
        $id = $request->id;
        $guidValidator = $page == 'menuGrid' ? 'sometimes|max:20000|mimetypes:image/png|dimensions:max_width=100,max_height=100' : 'sometimes|max:20000|mimetypes:image/png';
        $validator = Validator::make($reqData, [
            'judul' => ['required', 'min:3', Rule::unique('menu')->ignore($id)],
            'guid' => $guidValidator,
            'target' => 'required'
        ],[
            'judul.required' => 'Judul tidak boleh kosong',
            'judul.min' => 'Judul minimal 3 Karakter',
            'judul.unique' => 'Judul telah terdaftar',

            'guid.max' => 'Ukuran Gambar melebihi 2Mb',
            'guid.mimetypes' => 'Tipe Gambar Tidak Valid',
            'guid.dimensions' => 'Dimensi Gambar melebihi 100x100',      

            'target.required' => 'Target tidak boleh kosong',
        ]);

        if($validator->fails())
        {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if(isset($reqData['guid'])){
            $fname = time().'.'.$reqData['guid']->extension();

            // Public Folder
            $reqData['guid']->move(public_path('images/menuIcon'), $fname);
            $reqData['guid'] = $fname;
        }

        $rethash = 'menu';
        if($page == 'menuGrid'){
            $rethash = 'menu-grid';
        }elseif($page == 'menuSidebar'){
            $rethash = 'menu-sidebar';
        }else{
            $rethash = $page;
        }

        $reqData['upid'] = $request->session()->get('nip');
        //dd($reqData);
        $menu::find($id)->update($reqData);
        return redirect('/config#'.$rethash)->with('success', "Data ".ucwords($rethash)." berhasil diubah.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Menu $menu)
    {
        $id = $request->id;
        if($request->page == 'menu' || $request->page == 'menuGrid' || $request->page == 'menuSidebar' ){
            $menu::find($id)->delete();    
        }elseif($request->page == 'Banner'){
            $path = public_path('images/banner');
            @unlink($path.'/'.$id);
        }elseif($request->page == 'intro'){
            $path = public_path('images/intro');
            @unlink($path.'/'.$id);
        }

        $rethash = 'menu';
        if($request->page == 'menuGrid'){
            $rethash = 'menu-grid';
        }elseif($request->page == 'menuSidebar'){
            $rethash = 'menu-sidebar';
        }else{
            $rethash = $request->page;
        }
        
        return redirect('/config#'.$rethash)->with([
            'page' => strtolower($request->page),
            'success' => "Data ".$request->page." berhasil dihapus."
        ]);
    }

    protected function saveFile(UploadedFile $file, Request $request)
    {
        $fileName = "-".$file->getClientOriginalName();

        $mime = str_replace('/', '-', $file->getMimeType());
        $finalPath = "images/intro";

        // move the file name
        $file->move($finalPath, $fileName);

        return response()->json([
            'path' => $file,
            'name' => $fileName,
            'mime_type' => $mime
        ]);
    }
}
