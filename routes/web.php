<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LintorsController;
use App\Http\Controllers\CetakController;
//use App\Models\Lintor;
use App\Http\Controllers\Pemberian_haksController;
//use Carbon\Carbon;
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

Route::resource('lintor', LintorsController::class);
Route::resource('cetak', CetakController::class);

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('print', 'CetakController@st')->name('print');
Route::get('cari', 'CetakController@cari')->name('cari');

Route::get('/print/ST/{id}', [CetakController::class, 'st']);
Route::get('/print/ba/{id}', [CetakController::class, 'ba']);
Route::get('/print/undangan/{id}', [CetakController::class, 'undangan']);
Route::get('/print/risalah/{id}', [CetakController::class, 'risalah']);
Route::get('/print/peng/{id}', [CetakController::class, 'pengumuman']);
Route::get('/print/sk/{id}', [CetakController::class, 'sk']);
Route::post('/print/export', [CetakController::class, 'export']);

Route::resource('pemberian_hak', Pemberian_haksController::class);
Route::get('/print/pemberian_hak/ST/{id}', [Pemberian_haksController::class, 'st']);
Route::get('/print/pemberian_hak/undangan/{id}', [Pemberian_haksController::class, 'undangan']);
Route::get('/print/pemberian_hak/ikhtisar/{id}', [Pemberian_haksController::class, 'ikhtisar']);
Route::get('/print/pemberian_hak/risalah/{id}', [Pemberian_haksController::class, 'risalah']);
Route::get('/print/pemberian_hak/rpd/{id}', [Pemberian_haksController::class, 'rpd']);
Route::get('/print/pemberian_hak/telaahan/{id}', [Pemberian_haksController::class, 'telaahan']);
Route::get('/print/pemberian_hak/sk/{id}', [Pemberian_haksController::class, 'sk']);
Route::get('/cari/pemberian_hak/nama/', [Pemberian_haksController::class, 'cari_nama']);
Route::get('/cari/pemberian_hak/no_berkas/', [Pemberian_haksController::class, 'cari_noberkas']);

Route::get('/cari/berkas/nama/', [Berkas_pemohonController::class, 'cari_nama']);
Route::get('/cari/berkas/no_berkas/', [Berkas_pemohonController::class, 'cari_noberkas']);