<?php
use app\Http\Controllers;
use App\Http\Controllers\LabController;
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
Route::get('/',['as' => 'index', 'uses' => 'DashboardController@index']);

// Pasien
Route::resource('pasien','PasienController');
// Route::get('pasien','PasienController@index');
// Route::get('/tambah-pasien', 'PasienController@tambah_pasien');
// Route::put('/pasien-db',['as' => 'pasien.simpan', 'uses' => 'PasienController@store']);
// Route::delete('/pasien-delete/{pasien}',['as' => 'pasien.delete', 'uses' => 'PasienController@destroy']);
// Route::get('edit-pasien/{pasien}',['as' => 'pasien.edit', 'uses' => 'PasienController@edit']);
// Route::put('update-pasien',['as' => 'pasien.update', 'uses' => 'PasienController@update']);
// Route::get('detail-pasien/{pasien}','PasienController@show');

// Lab
Route::resource('lab','LabController'); 
// Route::get('/lab', 'LabController@index');
// Route::get('/tambah-lab', 'LabController@create'); 
// Route::get('/simpan-lab', 'LabController@store'); 
// Route::get('/edit-lab', 'LabController@edit'); 
// Route::get('/update-lab', 'LabController@update');

//Obat
Route::resource('obat','ObatController'); 
// Route::get('/obat', 'ObatController@index');
// Route::get('/tambah-obat', 'ObatController@tambah_obat');

//RM
Route::resource('rm','RMController');
Route::get('rm/pilih-pasien',['as' => 'pilih.rm', 'uses' => 'RMController@pilihrm']);
Route::get('tambah-rm/{id}', ['as' => 'tambah.rm', 'uses' => 'RMController@tambah_rmid']);
// Route::get('/rm', 'RMController@index');
// Route::get('/tambah-rm-pilih', 'RMController@PilihPasien');
// Route::get('/tambah-rm', 'RMController@tambah_rm');

// auth

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('/user', ['as' => 'user.index', 'uses' => 'UserController@index']);
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