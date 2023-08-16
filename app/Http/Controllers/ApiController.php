<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VDokHukum;
use App\Models\Konten;
use App\Models\VRekapDokHukum;
use App\Models\VJDIHN;
use App\Models\User;
use App\Models\survey;
use App\Models\VDokHukumVerify;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use DB;

class ApiController extends Controller
{
    public function getPegawai($nip)
    {
        $retval = $this->SIAPUser(['nip' => $nip]);
        return response()->json($retval, 200);
    }

    public function getKonten($page, $searchText=null)
    {
        if($searchText == null){
            $retval = Konten::select('id','judul')
                ->where('jns', '=', $page)
                ->get();
            return response()->json($retval, 200);
        }else{
            $retval = Konten::select('id','judul')
                ->where('jns', '=', $page)
                ->orWhere('judul', 'like', $searchText)
                ->get();
            //dd($retval);
            return response()->json($retval, 200);
        }
    }

    public function getListDokHukum($id_tipe_dok_hukum, $searchText=null, $id=0)
    {
        //$retval = $this->SIAPUser(['nip' => $nip]);
        $op_sid = $id_tipe_dok_hukum != 0 ? '=' : '!=';
        if($searchText == null){
            $retval = VDokHukum::select('id', 'judul', 'judul_peraturan', 'nomor_peraturan', 'jns_hukum', 'tipe_dok_hukum')
                ->where('id','!=', $id)
                ->where('id_tipe_dok_hukum',$op_sid, $id_tipe_dok_hukum)
                ->get();
            return response()->json($retval, 200);    
        }else{
            $searchText = '%'.$searchText.'%';
            $retval = VDokHukum::select('id', 'judul', 'judul_peraturan', 'nomor_peraturan', 'jns_hukum', 'tipe_dok_hukum')
                ->where('id','!=', $id)
                ->where('id_tipe_dok_hukum',$op_sid, $id_tipe_dok_hukum)
                ->where(function ($q) use ($searchText) {
                    return $q->where('judul', 'like', $searchText)->orWhere('nomor_peraturan', 'like', $searchText);
                })->get();
            return response()->json($retval, 200);
        }
    }

    public function getDataRekap($id_jns_hukum)
    {
        $ret = [];
        $retval = [];
        $max=0;
        $min=0;
        $data = VRekapDokHukum::where('id', $id_jns_hukum)->orderBy('tahun_peraturan')->get();

        if(isset($data)){
            foreach ($data as $key => $value) {
                $stts_dok = $value->stts_dok;
                $tahun_peraturan = $value->tahun_peraturan;
                
                $ret[$stts_dok][$tahun_peraturan] = $value->jml;
            }

            $max = $data->max('tahun_peraturan');
            $min = $data->min('tahun_peraturan');
            
            for ($i=$min; $i <=$max ; $i++) { 
                $retval['labels'][] = $i;
            }

            $retval['labels'] = array_merge([''], $retval['labels'], ['']);

            foreach ($ret as $key => $value) {
                $nval = [];
                $sum = 0;
                for ($i=$min; $i <=$max ; $i++) { 
                    $nval[] = $value[$i] ?? 0;
                    $sum += $value[$i] ?? 0;
                }  
                $nval = array_merge([null], $nval, [null]);

                $retval['datasets'][] = [
                    "label" => $key,
                    "data" => $nval,
                ];

                $retval['pie']['labels'][] = $key;   
                $retval['pie']['datasets']['data'][] = $sum;   
            }
        }

        //dd($retval);

        return response()->json($retval, 200);
    }

    public function getMenu()
    {
        $menu = $this->getStrukturMenu();
        return response()->json($menu, 200);
    }

    public function uploadCK(Request $request, $folder)
    {
        $reqData['guid'] = $request->upload;
        $validator = Validator::make($reqData, [
            'guid' => 'required|mimes:png,jpg,jpeg|max:2048',
        ],[
            'guid.required' => 'File tidak boleh kosong',
            'guid.mimes' => 'File tidak Valid',
            'guid.max' => 'File melebihi 2 mb',
        ]);

        if($validator->fails())
        {
            return response()->json([
                'uploaded' => false,
                'fileName' => '',
                'url' => '',
            ], 200);
        }

        $fileName = time().'.'.$reqData['guid']->extension();

        // Public Folder
        $reqData['guid']->move(public_path('ckeditor/images/'.$folder), $fileName);

        //$fileName = $this->uploadGbr($path, 'upload');    
        //return $data;
        if($fileName){
            $retval = [
                'uploaded' => true,
                'fileName' => $fileName,
                'url' => '/ckeditor/images/'.$folder."/".$fileName,
            ];
        }else{
            $retval = [
                'uploaded' => false,
                'fileName' => '',
                'url' => '',
            ];
        }

        return response()->json($retval, 200);
    }

    public function getRekapJnsHukum($value='')
    {
        $jnshukum = $this->GetJnsDokHukum();
        $retval = [];
        if(isset($jnshukum)){
            foreach ($jnshukum as $key => $value) {
                if(count($value->ndokhukum) > 0){
                    if($value->kategori_dok == 'P'){
                        $retval['pusat']['labels'][] = $value->singkatan;
                        $retval['pusat']['datasets'][0]['data'][] = count($value->ndokhukum);
                    }

                    if($value->kategori_dok == 'D'){
                        $retval['daerah']['labels'][] = $value->singkatan;
                        $retval['daerah']['datasets'][0]['data'][] = count($value->ndokhukum);
                    }
                }
            }

            $retval['pusat']['datasets'][0]['label'] = "Pusat";
            $retval['daerah']['datasets'][0]['label'] = "Daerah";
            //$retval['pusat']['datasets'][0]['data'] = $retval['pusat']['ndata'];
        }

        return response()->json($retval, 200);
    }

    public function dataJDIHN()
    {
        $dlink = url('/data_file');
        $retval = VJDIHN::select(
            '*', 
            DB::raw('concat("'.$dlink.'","/", idData, "/", fileDownload) as urlDownload'),
            DB::raw('"" as urlDetailPeraturan'),
        )->get();
            
        $b = $retval->toArray();
        array_walk_recursive($b, function(&$item){
            $item = strval($item);
        });

        $ret = [
            "status" => true,
            "data" => $b,
        ];
        return response()->json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function dataJDIHNonly()
    {
        $dlink = url('/data_file');
        $retval = VJDIHN::select(
            '*', 
            DB::raw('concat("'.$dlink.'","/", idData, "/", fileDownload) as urlDownload'),
            DB::raw('"" as urlDetailPeraturan'),
        )->get();
            
        $b = $retval->toArray();
        array_walk_recursive($b, function(&$item){
            $item = strval($item);
        });

        $ret = $b;
        return response()->json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function dataJDIHNbyIdData(Request $request)
    {
        $dlink = url('/data_file');

        $validator = Validator::make($request->all(), [
            'idData' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
     
        //$user = User::where('username', $request->username)->first();
        $data = VJDIHN::select(
            '*', 
            DB::raw('concat("'.$dlink.'","/", idData, "/", fileDownload) as urlDownload'),
            DB::raw('"" as urlDetailPeraturan'),
        )->where('idData', '=', $request->idData)->first();
     
        if (! $data || $request->idData != $data->idData) {
            return response()->json([
                "status" => false,
                "message" => "Data Not Found",
            ], 404);
        }

        $b = $data->toArray();
        array_walk_recursive($b, function(&$item){
            $item = strval($item);
        });

        $ret = [
            "status" => true,
            "data" => $b,
        ];
        return response()->json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function createToken(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
     
        $user = User::where('username', $request->username)->first();
     
        if (! $user || $request->password !== $user->nip) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials",
            ], 401);
        }
        $user->tokens()->delete();
        $token = $user->createToken($request->username)->plainTextToken;

        $ret = [
            "status" => true,
            "access_token" => $token,
            'token_type' => 'Bearer'
        ];
        return response()->json($ret, 200);   
    }

    public function changePwd(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
            'newpassword' => [
                'required',
                Password::min(7)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
            ]
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        }
     
        $user = User::where('username', $request->username)->first();
     
        if (! $user || $request->password !== $user->nip) {
            return response()->json([
                "status" => false,
                "message" => "Invalid Credentials",
            ], 401);
        }

        $user->tokens()->delete();
        User::find($user->id)->update(['nip' => $request->newpassword]);
        //$user->nip = $request->newpassword;
        //$user->save();

        $ret = [
            "status" => true,
            "message" => "Please Revoke Token",
        ];
        return response()->json($ret, 200);      
    }

    public function getDataSurvey()
    {
        $data = [];
        $total = 0;
        $survey = survey::select('nilai', DB::raw('count(*) as total'))
                 ->groupBy('nilai')
                 ->get();

        foreach ($survey as $key => $value) {
            $data[$value->nilai] = $value->total;
            $total = $total + $value->total;
        }

        $retval = [
            'data' => $data,
            'total' => $total,
        ];

        return response()->json($retval, 200);
    }

    public function getJnsHukum(){
        $data = $this->GetJnsDokHukum();

        return response()->json($data, 200);
    }

    public function carijdihmobile(Request $request)
    {
        $judul = $request->only('judul');
        $dlink = url('/data_file');

        if($judul['judul'] == ''){
            return response()->json(null, 200);
        }

        $sfield = $request->only('jenis', 'noPeraturan', 'tahun_pengundangan');
        $sfield = array_filter($sfield, function($v, $k) {
            return !is_null($v) && $v !== '';
        }, ARRAY_FILTER_USE_BOTH);

        $sfilter = array_merge($sfield, $judul);

        $retval =  VJDIHN::select(
            '*', 
            DB::raw('concat("'.$dlink.'","/", idData, "/", fileDownload) as urlDownload'),
            DB::raw('"" as urlDetailPeraturan'),
        )->where(function($query) use ($sfilter) {
            foreach($sfilter as $key =>$value){
                if($key == 'judul'){
                    $query->where($key, 'like', '%'.$value.'%'); 
                }else{
                    $query->where($key, '=', $value);       
                }
            }
        })->get();

        $b = $retval->toArray();
        array_walk_recursive($b, function(&$item){
            $item = strval($item);
        });

        $ret = $b;
        
        return response()->json($ret, 200, [], JSON_NUMERIC_CHECK);
    }

    public function getkontenmobile($page)
    {
        $retval = Konten::where('jns', '=', $page)
            ->simplePaginate(5);
        return response()->json($retval, 200);
    }

    public function getTypeKonten()
    {
        $type = $this->getHal();
        return response()->json($type, 200);
    }
}
