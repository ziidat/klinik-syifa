<?php
use app\Http\Controllers;
use Illuminate\Support\Facades\Route;

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
Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/', 'DashboardController@index');

// Pasien
Route::get('pasien','PasienController@index');
Route::get('/tambah-pasien', 'PasienController@tambah_pasien');
Route::put('/pasien-db',['as' => 'pasien.simpan', 'uses' => 'PasienController@store']);
Route::delete('/pasien-delete/{pasien}',['as' => 'pasien.delete', 'uses' => 'PasienController@destroy']);
Route::get('/pasien-edit/{id}', 'PasienController@edit');
Route::put('/pasien-update/{id}', 'PasienController@update')->name('pasien.update');
Route::get('/pasien-detail/{id}', 'PasienController@show');
// Lab
Route::get('/lab', 'LabController@index');
Route::get('/tambah-lab', 'LabController@create'); 

//Obat
Route::get('/obat', 'ObatController@index');
Route::get('/tambah-obat', 'ObatController@tambah_obat');

//RM
Route::get('/rm', 'RMController@index');
Route::get('/tambah-rm-pilih', 'RMController@PilihPasien');
Route::get('/tambah-rm', 'RMController@tambah_rm');

// auth

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/user', function () {
    return view('auth.setting-user');
});
Route::get('/register', function () {
    return view('auth.register');
});


// report

Route::get('/lihattagihan', function () {
    return view('lihat-tagihan');
});

Route::get('/cetaktagihan', function () {
    return view('cetak-tagihan');
});

Route::get('/cetakrm', function () {
    return view('cetak-rm');
});

Route::get('/lihatrm', function () {
    return view('lihat-rm');
});