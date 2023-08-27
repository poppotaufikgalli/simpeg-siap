<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\AksesController;

//simpeg
use App\Http\Controllers\MainController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\MasterPersonelController;
use App\Http\Controllers\MasterJenisPersonelController;
use App\Http\Controllers\MasterJenisPegawaiController;
use App\Http\Controllers\MasterKedudukanPegawaiController;

use App\Http\Controllers\MasterOPDController;

use App\Http\Controllers\Pangkat\MasterPangkatController;
use App\Http\Controllers\Pangkat\MasterJenisKPController;

use App\Http\Controllers\MasterEselonController;
use App\Http\Controllers\MasterJenisGolDarController;
use App\Http\Controllers\MasterJenisKawinController;
use App\Http\Controllers\MasterAgamaController;

use App\Http\Controllers\MasterJenisPenghargaanController;
use App\Http\Controllers\MasterJenisPemberhentianController;
use App\Http\Controllers\MasterJenisPengadaanController;
use App\Http\Controllers\MasterJenisPensiunController;
use App\Http\Controllers\MasterJenisKompetensiController;
use App\Http\Controllers\MasterJenisOrganisasiController;

use App\Http\Controllers\Hukuman\MasterJenisHukdisController;

use App\Http\Controllers\Arsip\MasterGroupArsipController;
use App\Http\Controllers\Arsip\MasterJenisArsipController;
use App\Http\Controllers\Arsip\MasterPegawaiArsipController;

use App\Http\Controllers\Jabatan\MasterJabatanController;
use App\Http\Controllers\Jabatan\MasterJabStrController;
use App\Http\Controllers\Jabatan\MasterKelJabController;
use App\Http\Controllers\Jabatan\MasterJFUController;
use App\Http\Controllers\Jabatan\MasterJFTController;
use App\Http\Controllers\Jabatan\MasterJenisJabatanController;
use App\Http\Controllers\Jabatan\MasterReferensiJabatanController;

use App\Http\Controllers\Pendidikan\MasterPendidikanController;
use App\Http\Controllers\Pendidikan\MasterTingkatPendidikanController;
use App\Http\Controllers\Pendidikan\MasterJenisProfesiController;
use App\Http\Controllers\Pendidikan\MasterJenisKursusController;
use App\Http\Controllers\Pendidikan\MasterDiklatController;

use App\Http\Controllers\Instansi\MasterInstansiController;
use App\Http\Controllers\Instansi\MasterJenisInstansiController;

use App\Http\Middleware\SiapSSO;
//use Shetabit\Visitor\Middlewares\LogVisits;
//use App\Http\Middleware\LogVisits;
use App\Models\RefTipeDokHukum;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/


Route::group(['middleware' => ['guest']], function() {
    /**
     * Login Routes
     */
    Route::get('/login', [LoginController::class, 'show'])->name('login.show');
    Route::post('/login', [LoginController::class, 'login'])->name('login.perform');

    //Route::post('/survey', [JdihController::class, 'survey'])->name('survey');
    //Route::get('/issurvey', [JdihController::class, 'issurvey'])->name('issurvey');

    Route::group(['middleware' => ['auth']], function() {
        Route::get('/', [MainController::class, 'main'])->name('beranda');
        //Route::get('/statdokhukum/{id}', [JdihController::class, 'statdokhukum'])->name('statdokhukum');
        //Route::get('/statjnsdokhukum/{id}', [JdihController::class, 'statjnsdokhukum'])->name('statjnsdokhukum');
        //Route::get('/cariprodukhukum/{id}', [JdihController::class, 'cariprodukhukum'])->name('cariprodukhukum');
        //Route::post('/cariprodukhukum/', [JdihController::class, 'cariprodukhukumpost'])->name('cariprodukhukumpost');

        //Route::match(['post', 'get'], '/bukutamu', [JdihController::class, 'bukutamu'])->name('bukutamu');    
        /*Route::prefix('bukutamu')->group(function () {
            Route::get('/{judul}', [JdihController::class, 'bukutamu'])->name('bukutamu');
            Route::post('/bukutamu', [JdihController::class, 'bukutamu'])->name('bukutamu.create');    
        });

        Route::get('/page/{id}', [JdihController::class, 'page'])->name('page');    
        Route::get('/lspage/{id}', [JdihController::class, 'lspage'])->name('lspage');    
        Route::post('/carikonten/{id}', [JdihController::class, 'carikonten'])->name('carikonten');    */
    });
    //Route::get('/flipbook/{id}', [JdihController::class, 'flipbook'])->name('flipbook');
    //Route::get('/flipbook2/{path}/{filename}', [JdihController::class, 'flipbook2'])->name('flipbook2');
});

Route::group(['middleware' => ['auth']], function() {
    /**
     * Logout Routes
     */
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/dashboard',[MainController::class, 'dashboard'])->name('dashboard');
    Route::get('/notfound',[JdihController::class, 'notfound'])->name('notfound');
    Route::get('/unauthorized',[JdihController::class, 'unauthorized'])->name('unauthorized');

    //Route::group(['middleware' => ['role_check']], function() { <-rolecheck
    Route::group(['middleware' => ['auth']], function() {
        Route::prefix('user')->group(function () {
            Route::match(['get','post'],'/', [UserController::class, 'index'])->name('user');
            Route::get('/create', [UserController::class, 'create'])->name('user.create');
            Route::post('/store', [UserController::class, 'store'])->name('user.store');
            Route::get('/show/{id}', [UserController::class, 'show'])->name('user.show');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
            Route::post('/update', [UserController::class, 'update'])->name('user.update');
            Route::post('/destroy', [UserController::class, 'destroy'])->name('user.destroy');
        });

        Route::prefix('group')->group(function () {
            Route::get('/', [GroupController::class, 'index'])->name('group');
            Route::get('/create', [GroupController::class, 'create'])->name('group.create');
            Route::post('/store', [GroupController::class, 'store'])->name('group.store');
            Route::get('/show/{id}', [GroupController::class, 'show'])->name('group.show');
            Route::get('/edit/{id}', [GroupController::class, 'edit'])->name('group.edit');
            Route::post('/update', [GroupController::class, 'update'])->name('group.update');
            Route::post('/destroy', [GroupController::class, 'destroy'])->name('group.destroy');
        });

        Route::prefix('config')->group(function () {
            Route::get('/', [ConfigController::class, 'index'])->name('config');
            Route::get('/{page}/create/{ref}', [ConfigController::class, 'create'])->name('config.create');
            Route::post('/{page}/store/', [ConfigController::class, 'store'])->name('config.store');
            Route::get('/show/{id}', [ConfigController::class, 'show'])->name('config.show');
            Route::get('/edit/{id}', [ConfigController::class, 'edit'])->name('config.edit');
            Route::post('/{page}/update', [ConfigController::class, 'update'])->name('config.update');
            Route::post('/{page}/destroy', [ConfigController::class, 'destroy'])->name('config.destroy');
        });
        //data master

        /*Route::prefix('pegawai')->group(function () {
            //Route::prefix('{kjpeg}')->group(function () {
                Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
                Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');
                Route::post('/store', [PegawaiController::class, 'store'])->name('pegawai.store');
                Route::get('/show/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
                Route::get('/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
                Route::post('/update', [PegawaiController::class, 'update'])->name('pegawai.update');
                Route::post('/destroy', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
            //});
        });*/

        Route::prefix('pegawai')->group(function () {
            Route::get('/', [PegawaiController::class, 'index'])->name('pegawai');
            Route::get('/create', [PegawaiController::class, 'create'])->name('pegawai.create');
            Route::post('/{page}/store', [PegawaiController::class, 'store'])->name('pegawai.store');
            Route::get('/show/{id}', [PegawaiController::class, 'show'])->name('pegawai.show');
            Route::get('/{page}/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
            Route::post('/{page}/update', [PegawaiController::class, 'update'])->name('pegawai.update');
            //Route::post('/destroy', [PegawaiController::class, 'destroy'])->name('pegawai.destroy');
        });

        Route::prefix('personel')->group(function () {
            Route::prefix('{id_jenis_personel}')->group(function () {
                Route::get('/', [MasterPersonelController::class, 'index'])->name('personel');
                Route::get('/create', [MasterPersonelController::class, 'create'])->name('personel.create');
                //Route::post('/store', [MasterPersonelController::class, 'store'])->name('personel.store');
                Route::get('/show/{id}', [MasterPersonelController::class, 'show'])->name('personel.show');
                Route::get('/{page}/edit/{id}', [MasterPersonelController::class, 'edit'])->name('personel.edit');
                //Route::post('/update', [MasterPersonelController::class, 'update'])->name('personel.update');
                Route::post('/destroy', [MasterPersonelController::class, 'destroy'])->name('personel.destroy');
                Route::post('/uploadArsip', [MasterPersonelController::class, 'uploadArsip'])->name('personel.uploadArsip');
            });
        });

        Route::prefix('jenis_personel')->group(function () {
            Route::get('/', [MasterJenisPersonelController::class, 'index'])->name('jenis_personel');
            Route::get('/create', [MasterJenisPersonelController::class, 'create'])->name('jenis_personel.create');
            //Route::post('/store', [MasterJenisPersonelController::class, 'store'])->name('jenis_personel.store');
            Route::get('/show/{id}', [MasterJenisPersonelController::class, 'show'])->name('jenis_personel.show');
            Route::get('/edit/{id}', [MasterJenisPersonelController::class, 'edit'])->name('jenis_personel.edit');
            //Route::post('/update', [MasterJenisPersonelController::class, 'update'])->name('jenis_personel.update');
            Route::post('/destroy', [MasterJenisPersonelController::class, 'destroy'])->name('jenis_personel.destroy');
        });

        Route::prefix('jenis_pegawai')->group(function () {
            Route::get('/', [MasterJenisPegawaiController::class, 'index'])->name('jenis_pegawai');
            Route::get('/create', [MasterJenisPegawaiController::class, 'create'])->name('jenis_pegawai.create');
            //Route::post('/store', [MasterJenisPegawaiController::class, 'store'])->name('jenis_pegawai.store');
            Route::get('/show/{id}', [MasterJenisPegawaiController::class, 'show'])->name('jenis_pegawai.show');
            Route::get('/edit/{id}', [MasterJenisPegawaiController::class, 'edit'])->name('jenis_pegawai.edit');
            //Route::post('/update', [MasterJenisPegawaiController::class, 'update'])->name('jenis_pegawai.update');
            Route::post('/destroy', [MasterJenisPegawaiController::class, 'destroy'])->name('jenis_pegawai.destroy');
        });

        Route::prefix('kedudukan_pegawai')->group(function () {
            Route::get('/', [MasterKedudukanPegawaiController::class, 'index'])->name('kedudukan_pegawai');
            Route::get('/create', [MasterKedudukanPegawaiController::class, 'create'])->name('kedudukan_pegawai.create');
            //Route::post('/store', [MasterKedudukanPegawaiController::class, 'store'])->name('kedudukan_pegawai.store');
            Route::get('/show/{id}', [MasterKedudukanPegawaiController::class, 'show'])->name('kedudukan_pegawai.show');
            Route::get('/edit/{id}', [MasterKedudukanPegawaiController::class, 'edit'])->name('kedudukan_pegawai.edit');
            //Route::post('/update', [MasterKedudukanPegawaiController::class, 'update'])->name('kedudukan_pegawai.update');
            Route::post('/destroy', [MasterKedudukanPegawaiController::class, 'destroy'])->name('kedudukan_pegawai.destroy');
        });

        Route::prefix('unit_kerja')->group(function () {
            Route::match(['get','post'],'/', [MasterOPDController::class, 'index'])->name('unit_kerja');
            Route::get('/create', [MasterOPDController::class, 'create'])->name('unit_kerja.create');
            //Route::post('/store', [MasterOPDController::class, 'store'])->name('unkerja.store');
            Route::get('/show/{id}', [MasterOPDController::class, 'show'])->name('unit_kerja.show');
            Route::get('/edit/{id}', [MasterOPDController::class, 'edit'])->name('unit_kerja.edit');
            //Route::post('/update', [MasterOPDController::class, 'update'])->name('unkerja.update');
            Route::post('/destroy', [MasterOPDController::class, 'destroy'])->name('unit_kerja.destroy');
        });

        Route::prefix('instansi')->group(function () {
            Route::get('/', [MasterInstansiController::class, 'index'])->name('instansi');
            Route::get('/create', [MasterInstansiController::class, 'create'])->name('instansi.create');
            Route::get('/show/{id}', [MasterInstansiController::class, 'show'])->name('instansi.show');
            Route::get('/edit/{id}', [MasterInstansiController::class, 'edit'])->name('instansi.edit');
            Route::post('/destroy', [MasterInstansiController::class, 'destroy'])->name('instansi.destroy');
        });

        Route::prefix('jenis_jabatan')->group(function () {
            Route::get('/', [MasterJenisJabatanController::class, 'index'])->name('jenis_jabatan');
            Route::get('/create', [MasterJenisJabatanController::class, 'create'])->name('jenis_jabatan.create');
            //Route::post('/store', [MasterJenisJabatanController::class, 'store'])->name('jenis_jabatan.store');
            Route::get('/show/{id}', [MasterJenisJabatanController::class, 'show'])->name('jenis_jabatan.show');
            Route::get('/edit/{id}', [MasterJenisJabatanController::class, 'edit'])->name('jenis_jabatan.edit');
            //Route::post('/update', [MasterJenisJabatanController::class, 'update'])->name('jenis_jabatan.update');
            Route::post('/destroy', [MasterJenisJabatanController::class, 'destroy'])->name('jenis_jabatan.destroy');
        });

        Route::prefix('ref_jabatan')->group(function () {
            Route::prefix('{jenis_jabatan_id}')->group(function () {
                Route::get('/', [MasterReferensiJabatanController::class, 'index'])->name('ref_jabatan');
                Route::get('/create', [MasterReferensiJabatanController::class, 'create'])->name('ref_jabatan.create');
                Route::get('/show/{id}', [MasterReferensiJabatanController::class, 'show'])->name('ref_jabatan.show');
                Route::get('/edit/{id}', [MasterReferensiJabatanController::class, 'edit'])->name('ref_jabatan.edit');
            });
            Route::post('/destroy', [MasterReferensiJabatanController::class, 'destroy'])->name('ref_jabatan.destroy');
        });

        Route::prefix('master_jabatan')->group(function () {
            Route::get('/', [MasterJabatanController::class, 'index'])->name('master_jabatan');
            Route::get('/create', [MasterJabatanController::class, 'create'])->name('master_jabatan.create');
            Route::get('/show/{id}', [MasterJabatanController::class, 'show'])->name('master_jabatan.show');
            Route::get('/edit/{id}', [MasterJabatanController::class, 'edit'])->name('master_jabatan.edit');
            Route::post('/destroy', [MasterJabatanController::class, 'destroy'])->name('master_jabatan.destroy');
        });

        Route::prefix('master_jab_str')->group(function () {
            Route::get('/', [MasterJabStrController::class, 'index'])->name('master_jab_str');
            Route::get('/create', [MasterJabStrController::class, 'create'])->name('master_jab_str.create');
            Route::get('/show/{id}', [MasterJabStrController::class, 'show'])->name('master_jab_str.show');
            Route::get('/edit/{id}', [MasterJabStrController::class, 'edit'])->name('master_jab_str.edit');
            Route::post('/destroy', [MasterJabStrController::class, 'destroy'])->name('master_jab_str.destroy');
        });

        Route::prefix('kel_jab')->group(function () {
            Route::get('/', [MasterKelJabController::class, 'index'])->name('kel_jab');
            Route::get('/create', [MasterKelJabController::class, 'create'])->name('kel_jab.create');
            Route::get('/show/{id}', [MasterKelJabController::class, 'show'])->name('kel_jab.show');
            Route::get('/edit/{id}', [MasterKelJabController::class, 'edit'])->name('kel_jab.edit');
            Route::post('/destroy', [MasterKelJabController::class, 'destroy'])->name('kel_jab.destroy');
        });

        Route::prefix('master_jfu')->group(function () {
            Route::get('/', [MasterJFUController::class, 'index'])->name('master_jfu');
            Route::get('/create', [MasterJFUController::class, 'create'])->name('master_jfu.create');
            Route::get('/show/{id}', [MasterJFUController::class, 'show'])->name('master_jfu.show');
            Route::get('/edit/{id}', [MasterJFUController::class, 'edit'])->name('master_jfu.edit');
            Route::post('/destroy', [MasterJFUController::class, 'destroy'])->name('master_jfu.destroy');
        });

        Route::prefix('master_jft')->group(function () {
            Route::get('/', [MasterJFTController::class, 'index'])->name('master_jft');
            Route::get('/create', [MasterJFTController::class, 'create'])->name('master_jft.create');
            Route::get('/show/{id}', [MasterJFTController::class, 'show'])->name('master_jft.show');
            Route::get('/edit/{id}', [MasterJFTController::class, 'edit'])->name('master_jft.edit');
            Route::post('/destroy', [MasterJFTController::class, 'destroy'])->name('master_jft.destroy');
        });

        Route::prefix('jenis_kawin')->group(function () {
            Route::get('/', [MasterJenisKawinController::class, 'index'])->name('jenis_kawin');
            Route::get('/create', [MasterJenisKawinController::class, 'create'])->name('jenis_kawin.create');
            //Route::post('/store', [MasterJenisKawinController::class, 'store'])->name('jenis_kawin.store');
            Route::get('/show/{id}', [MasterJenisKawinController::class, 'show'])->name('jenis_kawin.show');
            Route::get('/edit/{id}', [MasterJenisKawinController::class, 'edit'])->name('jenis_kawin.edit');
            //Route::post('/update', [MasterJenisKawinController::class, 'update'])->name('jenis_kawin.update');
            Route::post('/destroy', [MasterJenisKawinController::class, 'destroy'])->name('jenis_kawin.destroy');
        });

        Route::prefix('jenis_goldar')->group(function () {
            Route::get('/', [MasterJenisGolDarController::class, 'index'])->name('jenis_goldar');
            Route::get('/create', [MasterJenisGolDarController::class, 'create'])->name('jenis_goldar.create');
            //Route::post('/store', [MasterJenisGolDarController::class, 'store'])->name('jenis_goldar.store');
            Route::get('/show/{id}', [MasterJenisGolDarController::class, 'show'])->name('jenis_goldar.show');
            Route::get('/edit/{id}', [MasterJenisGolDarController::class, 'edit'])->name('jenis_goldar.edit');
            //Route::post('/update', [MasterJenisGolDarController::class, 'update'])->name('jenis_goldar.update');
            Route::post('/destroy', [MasterJenisGolDarController::class, 'destroy'])->name('jenis_goldar.destroy');
        });

        Route::prefix('pangkat')->group(function () {
            Route::get('/', [MasterPangkatController::class, 'index'])->name('pangkat');
            Route::get('/create', [MasterPangkatController::class, 'create'])->name('pangkat.create');
            Route::get('/show/{id}', [MasterPangkatController::class, 'show'])->name('pangkat.show');
            Route::get('/edit/{id}', [MasterPangkatController::class, 'edit'])->name('pangkat.edit');
            Route::post('/destroy', [MasterPangkatController::class, 'destroy'])->name('pangkat.destroy');
        });

        Route::prefix('jenis_kp')->group(function () {
            Route::get('/', [MasterJenisKPController::class, 'index'])->name('jenis_kp');
            Route::get('/create', [MasterJenisKPController::class, 'create'])->name('jenis_kp.create');
            Route::get('/show/{id}', [MasterJenisKPController::class, 'show'])->name('jenis_kp.show');
            Route::get('/edit/{id}', [MasterJenisKPController::class, 'edit'])->name('jenis_kp.edit');
            Route::post('/destroy', [MasterJenisKPController::class, 'destroy'])->name('jenis_kp.destroy');
        });

        Route::prefix('eselon')->group(function () {
            Route::get('/', [MasterEselonController::class, 'index'])->name('eselon');
            Route::get('/create', [MasterEselonController::class, 'create'])->name('eselon.create');
            Route::get('/show/{id}', [MasterEselonController::class, 'show'])->name('eselon.show');
            Route::get('/edit/{id}', [MasterEselonController::class, 'edit'])->name('eselon.edit');
            Route::post('/destroy', [MasterEselonController::class, 'destroy'])->name('eselon.destroy');
        });

        Route::prefix('agama')->group(function () {
            Route::get('/', [MasterAgamaController::class, 'index'])->name('agama');
            Route::get('/create', [MasterAgamaController::class, 'create'])->name('agama.create');
            Route::get('/show/{id}', [MasterAgamaController::class, 'show'])->name('agama.show');
            Route::get('/edit/{id}', [MasterAgamaController::class, 'edit'])->name('agama.edit');
            Route::post('/destroy', [MasterAgamaController::class, 'destroy'])->name('agama.destroy');
        });

        Route::prefix('jenis_arsip')->group(function () {
            Route::get('/', [MasterJenisArsipController::class, 'index'])->name('jenis_arsip');
            Route::get('/create', [MasterJenisArsipController::class, 'create'])->name('jenis_arsip.create');
            Route::get('/show/{id}', [MasterJenisArsipController::class, 'show'])->name('jenis_arsip.show');
            Route::get('/edit/{id}', [MasterJenisArsipController::class, 'edit'])->name('jenis_arsip.edit');
            Route::post('/destroy', [MasterJenisArsipController::class, 'destroy'])->name('jenis_arsip.destroy');
        });

        Route::prefix('jenis_hukdis')->group(function () {
            Route::get('/', [MasterJenisHukDisController::class, 'index'])->name('jenis_hukdis');
            Route::get('/create', [MasterJenisHukDisController::class, 'create'])->name('jenis_hukdis.create');
            Route::get('/show/{id}', [MasterJenisHukDisController::class, 'show'])->name('jenis_hukdis.show');
            Route::get('/edit/{id}', [MasterJenisHukDisController::class, 'edit'])->name('jenis_hukdis.edit');
            Route::post('/destroy', [MasterJenisHukDisController::class, 'destroy'])->name('jenis_hukdis.destroy');
        });

        Route::prefix('jenis_penghargaan')->group(function () {
            Route::get('/', [MasterJenisPenghargaanController::class, 'index'])->name('jenis_penghargaan');
            Route::get('/create', [MasterJenisPenghargaanController::class, 'create'])->name('jenis_penghargaan.create');
            Route::get('/show/{id}', [MasterJenisPenghargaanController::class, 'show'])->name('jenis_penghargaan.show');
            Route::get('/edit/{id}', [MasterJenisPenghargaanController::class, 'edit'])->name('jenis_penghargaan.edit');
            Route::post('/destroy', [MasterJenisPenghargaanController::class, 'destroy'])->name('jenis_penghargaan.destroy');
        });

        Route::prefix('jenis_pemberhentian')->group(function () {
            Route::get('/', [MasterJenisPemberhentianController::class, 'index'])->name('jenis_pemberhentian');
            Route::get('/create', [MasterJenisPemberhentianController::class, 'create'])->name('jenis_pemberhentian.create');
            Route::get('/show/{id}', [MasterJenisPemberhentianController::class, 'show'])->name('jenis_pemberhentian.show');
            Route::get('/edit/{id}', [MasterJenisPemberhentianController::class, 'edit'])->name('jenis_pemberhentian.edit');
            Route::post('/destroy', [MasterJenisPemberhentianController::class, 'destroy'])->name('jenis_pemberhentian.destroy');
        });

        Route::prefix('jenis_pengadaan')->group(function () {
            Route::get('/', [MasterJenisPengadaanController::class, 'index'])->name('jenis_pengadaan');
            Route::get('/create', [MasterJenisPengadaanController::class, 'create'])->name('jenis_pengadaan.create');
            Route::get('/show/{id}', [MasterJenisPengadaanController::class, 'show'])->name('jenis_pengadaan.show');
            Route::get('/edit/{id}', [MasterJenisPengadaanController::class, 'edit'])->name('jenis_pengadaan.edit');
            Route::post('/destroy', [MasterJenisPengadaanController::class, 'destroy'])->name('jenis_pengadaan.destroy');
        });

        Route::prefix('jenis_pensiun')->group(function () {
            Route::get('/', [MasterJenisPensiunController::class, 'index'])->name('jenis_pensiun');
            Route::get('/create', [MasterJenisPensiunController::class, 'create'])->name('jenis_pensiun.create');
            Route::get('/show/{id}', [MasterJenisPensiunController::class, 'show'])->name('jenis_pensiun.show');
            Route::get('/edit/{id}', [MasterJenisPensiunController::class, 'edit'])->name('jenis_pensiun.edit');
            Route::post('/destroy', [MasterJenisPensiunController::class, 'destroy'])->name('jenis_pensiun.destroy');
        });

        Route::prefix('jenis_kompetensi')->group(function () {
            Route::get('/', [MasterJenisKompetensiController::class, 'index'])->name('jenis_kompetensi');
            Route::get('/create', [MasterJenisKompetensiController::class, 'create'])->name('jenis_kompetensi.create');
            Route::get('/show/{id}', [MasterJenisKompetensiController::class, 'show'])->name('jenis_kompetensi.show');
            Route::get('/edit/{id}', [MasterJenisKompetensiController::class, 'edit'])->name('jenis_kompetensi.edit');
            Route::post('/destroy', [MasterJenisKompetensiController::class, 'destroy'])->name('jenis_kompetensi.destroy');
        });

        Route::prefix('pendidikan')->group(function () {
            Route::get('/', [MasterPendidikanController::class, 'index'])->name('pendidikan');
            Route::get('/create', [MasterPendidikanController::class, 'create'])->name('pendidikan.create');
            Route::get('/show/{id}', [MasterPendidikanController::class, 'show'])->name('pendidikan.show');
            Route::get('/edit/{id}', [MasterPendidikanController::class, 'edit'])->name('pendidikan.edit');
            Route::post('/destroy', [MasterPendidikanController::class, 'destroy'])->name('pendidikan.destroy');
        });

        Route::prefix('tingkat_pendidikan')->group(function () {
            Route::get('/', [MasterTingkatPendidikanController::class, 'index'])->name('tingkat_pendidikan');
            Route::get('/create', [MasterTingkatPendidikanController::class, 'create'])->name('tingkat_pendidikan.create');
            Route::get('/show/{id}', [MasterTingkatPendidikanController::class, 'show'])->name('tingkat_pendidikan.show');
            Route::get('/edit/{id}', [MasterTingkatPendidikanController::class, 'edit'])->name('tingkat_pendidikan.edit');
            Route::post('/destroy', [MasterTingkatPendidikanController::class, 'destroy'])->name('tingkat_pendidikan.destroy');
        });

        Route::prefix('jenis_profesi')->group(function () {
            Route::get('/', [MasterJenisProfesiController::class, 'index'])->name('jenis_profesi');
            Route::get('/create', [MasterJenisProfesiController::class, 'create'])->name('jenis_profesi.create');
            Route::get('/show/{id}', [MasterJenisProfesiController::class, 'show'])->name('jenis_profesi.show');
            Route::get('/edit/{id}', [MasterJenisProfesiController::class, 'edit'])->name('jenis_profesi.edit');
            Route::post('/destroy', [MasterJenisProfesiController::class, 'destroy'])->name('jenis_profesi.destroy');
        });

        Route::prefix('jenis_kursus')->group(function () {
            Route::get('/', [MasterJenisKursusController::class, 'index'])->name('jenis_kursus');
            Route::get('/create', [MasterJenisKursusController::class, 'create'])->name('jenis_kursus.create');
            Route::get('/show/{id}', [MasterJenisKursusController::class, 'show'])->name('jenis_kursus.show');
            Route::get('/edit/{id}', [MasterJenisKursusController::class, 'edit'])->name('jenis_kursus.edit');
            Route::post('/destroy', [MasterJenisKursusController::class, 'destroy'])->name('jenis_kursus.destroy');
        });

        Route::prefix('jenis_organisasi')->group(function () {
            Route::get('/', [MasterJenisOrganisasiController::class, 'index'])->name('jenis_organisasi');
            Route::get('/create', [MasterJenisOrganisasiController::class, 'create'])->name('jenis_organisasi.create');
            Route::get('/show/{id}', [MasterJenisOrganisasiController::class, 'show'])->name('jenis_organisasi.show');
            Route::get('/edit/{id}', [MasterJenisOrganisasiController::class, 'edit'])->name('jenis_organisasi.edit');
            Route::post('/destroy', [MasterJenisOrganisasiController::class, 'destroy'])->name('jenis_organisasi.destroy');
        });

        Route::prefix('diklat_str')->group(function () {
            Route::get('/', [MasterDiklatController::class, 'index'])->name('diklat');
            Route::get('/create', [MasterDiklatController::class, 'create'])->name('diklat.create');
            Route::get('/show/{id}', [MasterDiklatController::class, 'show'])->name('diklat.show');
            Route::get('/edit/{id}', [MasterDiklatController::class, 'edit'])->name('diklat.edit');
            Route::post('/destroy', [MasterDiklatController::class, 'destroy'])->name('diklat.destroy');
        });

        Route::prefix('group_arsip')->group(function () {
            Route::get('/', [MasterGroupArsipController::class, 'index'])->name('group_arsip');
            Route::get('/create', [MasterGroupArsipController::class, 'create'])->name('group_arsip.create');
            Route::get('/show/{id}', [MasterGroupArsipController::class, 'show'])->name('group_arsip.show');
            Route::get('/edit/{id}', [MasterGroupArsipController::class, 'edit'])->name('group_arsip.edit');
            Route::post('/destroy', [MasterGroupArsipController::class, 'destroy'])->name('group_arsip.destroy');
        });

        Route::prefix('arsip_elektronik')->group(function () {
            Route::get('/', [MasterPegawaiArsipController::class, 'index'])->name('arsip_elektronik');
            Route::get('/create', [MasterPegawaiArsipController::class, 'create'])->name('arsip_elektronik.create');
            Route::post('/store', [MasterPegawaiArsipController::class, 'store'])->name('arsip_elektronik.store');
            Route::get('/show/{id}', [MasterPegawaiArsipController::class, 'show'])->name('arsip_elektronik.show');
            Route::get('/edit/{id}', [MasterPegawaiArsipController::class, 'edit'])->name('arsip_elektronik.edit');
            Route::post('/destroy', [MasterPegawaiArsipController::class, 'destroy'])->name('arsip_elektronik.destroy');
        });

        /*Route::prefix('tipedokhukum')->group(function () {
            Route::get('/', [TipeDokHukumController::class, 'index'])->name('tipedokhukum');
            Route::get('/create', [TipeDokHukumController::class, 'create'])->name('tipedokhukum.create');
            Route::post('/store', [TipeDokHukumController::class, 'store'])->name('tipedokhukum.store');
            Route::get('/show/{id}', [TipeDokHukumController::class, 'show'])->name('tipedokhukum.show');
            Route::get('/edit/{id}', [TipeDokHukumController::class, 'edit'])->name('tipedokhukum.edit');
            Route::post('/update', [TipeDokHukumController::class, 'update'])->name('tipedokhukum.update');
            Route::post('/destroy', [TipeDokHukumController::class, 'destroy'])->name('tipedokhukum.destroy');
        });

        Route::prefix('bidanghukum')->group(function () {
            Route::get('/', [BidangHukumController::class, 'index'])->name('bidanghukum');
            Route::get('/create', [BidangHukumController::class, 'create'])->name('bidanghukum.create');
            Route::post('/store', [BidangHukumController::class, 'store'])->name('bidanghukum.store');
            Route::get('/show/{id}', [BidangHukumController::class, 'show'])->name('bidanghukum.show');
            Route::get('/edit/{id}', [BidangHukumController::class, 'edit'])->name('bidanghukum.edit');
            Route::post('/update', [BidangHukumController::class, 'update'])->name('bidanghukum.update');
            Route::post('/destroy', [BidangHukumController::class, 'destroy'])->name('bidanghukum.destroy');
        });

        Route::prefix('jnshukum')->group(function () {
            Route::get('/', [JnsHukumController::class, 'index'])->name('jnshukum');
            Route::get('/create', [JnsHukumController::class, 'create'])->name('jnshukum.create');
            Route::post('/store', [JnsHukumController::class, 'store'])->name('jnshukum.store');
            Route::get('/show/{id}', [JnsHukumController::class, 'show'])->name('jnshukum.show');
            Route::get('/edit/{id}', [JnsHukumController::class, 'edit'])->name('jnshukum.edit');
            Route::post('/update', [JnsHukumController::class, 'update'])->name('jnshukum.update');
            Route::post('/destroy', [JnsHukumController::class, 'destroy'])->name('jnshukum.destroy');
        });

        Route::prefix('wilayah')->group(function () {
            Route::get('/', [WilayahController::class, 'index'])->name('wilayah');
            Route::get('/create', [WilayahController::class, 'create'])->name('wilayah.create');
            Route::post('/store', [WilayahController::class, 'store'])->name('wilayah.store');
            Route::get('/show/{id}', [WilayahController::class, 'show'])->name('wilayah.show');
            Route::get('/edit/{id}', [WilayahController::class, 'edit'])->name('wilayah.edit');
            Route::post('/update', [WilayahController::class, 'update'])->name('wilayah.update');
            Route::post('/destroy', [WilayahController::class, 'destroy'])->name('wilayah.destroy');
        });

        //end data master
        /*Route::prefix('dokhukum')->group(function () {
            //Route::match(['get', 'post'],'/', [DokHukumController::class, 'index'])->name('dokhukum');
            Route::get('{id_tipe_dok_hukum}/', [DokHukumController::class, 'index'])->name('dokhukum');
            Route::get('/create/{id_tipe_dok_hukum?}', [DokHukumController::class, 'create'])->name('dokhukum.create');
            Route::post('/store', [DokHukumController::class, 'store'])->name('dokhukum.store');
            Route::get('/show/{id}', [DokHukumController::class, 'show'])->name('dokhukum.show');
            Route::get('/edit/{id}', [DokHukumController::class, 'edit'])->name('dokhukum.edit');
            Route::post('/update', [DokHukumController::class, 'update'])->name('dokhukum.update');
            Route::post('/destroy', [DokHukumController::class, 'destroy'])->name('dokhukum.destroy');
        });*/

        //konten

        /*Route::prefix('konten')->group(function () {
            Route::get('/', [KontenController::class, 'index'])->name('konten');
            Route::get('/index/{page}', [KontenController::class, 'page'])->name('konten.index');
            Route::get('/{page}/create', [KontenController::class, 'create'])->name('konten.create');
            Route::post('/store/', [KontenController::class, 'store'])->name('konten.store');
            Route::get('/show/{id}', [KontenController::class, 'show'])->name('konten.show');
            Route::get('/edit/{id}', [KontenController::class, 'edit'])->name('konten.edit');
            Route::post('/update', [KontenController::class, 'update'])->name('konten.update');
            Route::post('/{page}/destroy', [KontenController::class, 'destroy'])->name('konten.destroy');
        });*/

        /*Route::prefix('konten')->group(function () {
            $tipe_hal = (new Controller)->getHal();
            //Route::get('/', [DokHukumController::class, 'index'])->name('dokhukum');
            // Then iterate the router "get" method.
            foreach($tipe_hal as $key => $value){
                $id = $key;
                $nama = $value;
                Route::get($id, [KontenController::class, 'HalAkses'])->name($id);
                Route::get($id.'/create', [KontenController::class, 'create'])->name($id.'.konten.create');
                Route::post($id.'/store', [KontenController::class, 'store'])->name($id.'.konten.store');
                Route::get($id.'/show/{id}', [KontenController::class, 'show'])->name($id.'.konten.show');
                Route::get($id.'/edit/{id}', [KontenController::class, 'edit'])->name($id.'.konten.edit');
                Route::post($id.'/update', [KontenController::class, 'update'])->name($id.'.konten.update');
                Route::post($id.'/destroy', [KontenController::class, 'destroy'])->name($id.'.konten.destroy');
                Route::post($id.'/verif', [KontenController::class, 'verif'])->name($id.'.konten.verif');

                //upload gambar
                Route::post($id.'/upload/{method}', [KontenController::class, 'upload'])->name($id.'.konten.upload');                
            }
        });*/
        
        //end konten

        //Dokumen Hukum
        /*Route::prefix('dokhukum')->group(function () {
            $tipe_dok = RefTipeDokHukum::where('stts', 1)->get();

            //Route::get('/', [DokHukumController::class, 'index'])->name('dokhukum');
            // Then iterate the router "get" method.
            foreach($tipe_dok as $path){
                $id = $path->id;
                $nama = $path->nama;
                Route::match(['post', 'get'],$id, [DokHukumController::class, 'DokAkses'])->name($nama);
                Route::get($id.'/create', [DokHukumController::class, 'create'])->name($nama.'.dokhukum.create');
                Route::post($id.'/store', [DokHukumController::class, 'store'])->name($nama.'.dokhukum.store');
                Route::get($id.'/show/{id}', [DokHukumController::class, 'show'])->name($nama.'.dokhukum.show');
                Route::get($id.'/edit/{id}', [DokHukumController::class, 'edit'])->name($nama.'.dokhukum.edit');
                Route::post($id.'/update', [DokHukumController::class, 'update'])->name($nama.'.dokhukum.update');
                Route::post($id.'/destroy', [DokHukumController::class, 'destroy'])->name($nama.'.dokhukum.destroy');
            }
        });*/

        /*Route::prefix('verifikasi')->group(function () {
            Route::match(['post', 'get'],'/', [VerifikasiController::class, 'index'])->name('verifikasi');
            Route::get('/create', [VerifikasiController::class, 'create'])->name('verifikasi.create');
            Route::post('/store', [VerifikasiController::class, 'store'])->name('verifikasi.store');
            Route::get('/show/{id}', [VerifikasiController::class, 'show'])->name('verifikasi.show');
            Route::get('/edit/{id}', [VerifikasiController::class, 'edit'])->name('verifikasi.edit');
            Route::post('/update', [VerifikasiController::class, 'update'])->name('verifikasi.update');
            Route::post('/destroy', [VerifikasiController::class, 'destroy'])->name('verifikasi.destroy');
        });*/

        /* end */

        /*Route::prefix('menumodule')->group(function () {
            Route::get('/', [MenuModuleController::class, 'show'])->name('menumodule.show');
            Route::get('/tambah', [MenuModuleController::class, 'tambah'])->name('menumodule.tambah');
            Route::get('/ubah/{id}', [MenuModuleController::class, 'ubah'])->name('menumodule.ubah');
            Route::get('/hapus', [MenuModuleController::class, 'hapus'])->name('menumodule.hapus');
            Route::post('/perform/{method}', [MenuModuleController::class, 'perform'])->name('menumodule.perform');
        });


        Route::prefix('jdih')->group(function () {
            Route::get('/', [JdihController::class, 'show'])->name('jdih.show');
            Route::get('/tambah', [JdihController::class, 'tambah'])->name('jdih.tambah');
            Route::get('/ubah/{id}', [JdihController::class, 'ubah'])->name('jdih.ubah');
            Route::get('/hapus', [JdihController::class, 'hapus'])->name('jdih.hapus');
            Route::post('/perform/{method}', [JdihController::class, 'perform'])->name('jdih.perform');
        });*/
    });
});
