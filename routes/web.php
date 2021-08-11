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
    Route::resource('rm','RMController');
    Route::get('rm/pilih-pasien',['as' => 'pilih.rm', 'uses' => 'RMController@pilihrm']);
    Route::get('rm/create/{id}', ['as' => 'tambah.rm', 'uses' => 'RMController@tambah_rmid']);
    Route::get('/lihatrm/{id}', ['as' => 'lihat.rm', 'uses' => 'RMController@lihatrm']);
    Route::get('/rm/list/{idpasien}',['as'=> 'rm.list','uses'=>'RMController@list_rm']);
    Route::get('/rm/edit/{id}', ['as'=> 'rm.edit','uses'=>'RMController@edit_rm']);
    Route::get('/rm/lihat/{id}', ['as'=> 'rm.lihat','uses'=>'RMController@lihat_rm']);
  });

// Route::group(['middleware'=> 'auth','admin'],function(){
Route::get('/user', ['as' => 'user.index', 'uses' => 'UserController@index'])->middleware('auth','admin');;
Route::get('/register', ['as' => 'register', 'uses' => 'RegistrationController@create'])->middleware('auth','admin');;
Route::post('/register', ['as' => 'register', 'uses' => 'RegistrationController@register'])->middleware('auth','admin');;
// });
Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@create']);

// report
Route::get('/lihatrm', function () {
  return view('lihat-rm');
  }
);
Route::get('/cetakrm', function () {
  return view('cetak-rm');
  }
);
Route::get('/lihattagihan', function () {
  return view('lihat-tagihan');
  }
);
Route::get('/cetaktagihan', function () {
  return view('cetak-tagihan');
  }
);

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

Route::get('users/profile', 'ProfileController@index')->name('profile.edit')->middleware('auth');

Route::get('users/profile/{id}', 'ProfileController@edit')->name('profile.edit.admin')->middleware('auth','admin');

Route::patch('users/profile/simpan', 'ProfileController@simpan')->name('profile.simpan')->middleware('auth');
//endProfile

//Users
Route::get('/users', 'UserController@index')->name('user')->middleware('auth','admin');

Route::delete('/users/delete/{id}', 'UserController@hapus')->name('user.destroy')->middleware('auth','admin');


//endUsers

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
