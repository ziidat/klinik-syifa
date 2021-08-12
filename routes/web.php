<?php
use app\Http\Controllers;
use App\Http\Controllers\LabController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
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

//Route Group
Route::group(['middleware'=> 'auth'],function(){
    Route::get('/',['as' => 'index', 'uses' => 'DashboardController@index']);

    // Pasien
    Route::resource('pasien','PasienController');

    // Lab
    Route::resource('lab','LabController');

    //Obat
    Route::resource('obat','ObatController');

    //RM
    Route::get('/rm', 'RMController@index')->name('rm');

    Route::delete('/rm/hapus/{rm}','RMController@hapus_rm')->name('rm.destroy');

    Route::get('/rm/edit/{id}', 'RMController@edit_rm')->name('rm.edit');

    Route::get('/rm/tambah', 'RMController@tambah_rm')->name('rm.tambah');

    Route::get('/rm/tambah/{idpasien}', 'RMController@tambah_rmid')->name('rm.tambah.id');

    Route::post('/rm/simpan/', 'RMController@simpan_rm')->name('rm.simpan');

    Route::post('/rm/update/', 'RMController@update_rm')->name('rm.update');

    Route::get('/rm/list/{idpasien}', 'RMController@list_rm')->name('rm.list');

    Route::get('/rm/lihat/{id}', 'RMController@lihat_rm')->name('rm.lihat');
  });

// Route::group(['middleware'=> 'auth','admin'],function(){
Route::get('/user', ['as' => 'user.index', 'uses' => 'UserController@index'])->middleware('auth','admin');;
Route::get('/register', ['as' => 'register', 'uses' => 'RegistrationController@create'])->middleware('auth','admin');;
Route::post('/register', ['as' => 'register', 'uses' => 'RegistrationController@register'])->middleware('auth','admin');;
// });
Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@create']);


//Tagihan
Route::get('/tagihan/{id}', 'RMController@tagihan')->name('tagihan')->middleware('auth');
//Endtagihan

//Tagihan
Route::get('/pengaturan', 'PengaturanController@index')->name('pengaturan')->middleware('auth','admin');

Route::patch('/pengaturan/simpan', 'PengaturanController@simpan')->name('pengaturan.simpan')->middleware('auth','admin');
//Endtagihan

//Profile
Auth::routes([
  'register' => true,
  'verify' => false,
  'reset' => false
]);

Route::group(['prefix' => 'users'], function(){
    Route::auth();
    });
//Users
Route::get('/users', 'UserController@index')->name('user')->middleware('auth','admin');
Route::get('users/profile', 'ProfileController@index')->name('profile.edit')->middleware('auth');
Route::get('users/profile/{id}', 'ProfileController@edit')->name('profile.edit.admin')->middleware('auth','admin');
Route::patch('users/profile/simpan', 'ProfileController@simpan')->name('profile.simpan')->middleware('auth');
Route::delete('/users/delete/{id}', 'UserController@destroy')->name('user.destroy')->middleware('auth','admin');
//endProfile





//endUsers

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
