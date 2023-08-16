<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/getPegawai/{nip}', [ApiController::class, 'getPegawai'])->name('api.getPegawai');

Route::get('/getKonten/{page}/{searchText?}', [ApiController::class, 'getKonten'])->name('api.getKonten');
Route::get('/getMenu', [ApiController::class, 'getMenu'])->name('api.getMenu');
Route::get('/getDataRekap/{id}', [ApiController::class, 'getDataRekap'])->name('api.getDataRekap');
Route::get('/getRekapJnsHukum', [ApiController::class, 'getRekapJnsHukum'])->name('api.getRekapJnsHukum');

Route::get('/getDataSurvey', [ApiController::class, 'getDataSurvey'])->name('api.getDataSurvey');

Route::post('/uploadCK/{folder}', [ApiController::class, 'uploadCK'])->name('api.uploadCK');

Route::get('/getListDokHukum/{id_tipe_dok_hukum}/{searchText?}/{id?}', [ApiController::class, 'getListDokHukum'])->name('api.getListDokHukum');

Route::post('/createToken', [ApiController::class, 'createToken'])->name('api.createToken');
Route::post('/changePwd', [ApiController::class, 'changePwd'])->name('api.changePwd');

Route::middleware('auth:sanctum')->post('/dataJDIHN', [ApiController::class, 'dataJDIHN'])->name('api.dataJDIHN');
Route::middleware('auth:sanctum')->match(['POST', 'GET'],'/dataJDIHNonly', [ApiController::class, 'dataJDIHNonly'])->name('api.dataJDIHNonly');
Route::middleware('auth:sanctum')->post('/dataJDIHNbyIdData', [ApiController::class, 'dataJDIHNbyIdData'])->name('api.dataJDIHNbyIdData');

//noauth - mobile
Route::get('/jdihmobile', [ApiController::class, 'dataJDIHNonly'])->name('api.jdihmobile');
Route::get('/getJnsHukum', [ApiController::class, 'getJnsHukum'])->name('api.getJnsHukum');
Route::post('/carijdihmobile', [ApiController::class, 'carijdihmobile'])->name('api.carijdihmobile');
Route::post('/getkontenmobile/{page}', [ApiController::class, 'getKontenmobile'])->name('api.getkontenmobile');
Route::post('/getTypeKonten', [ApiController::class, 'getTypeKonten'])->name('api.getTypeKonten');
