<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function index() {
        $datas=DB::table('pengaturan')->where('id',1)->get();
        
        return view('setting',['datas'=>$datas]);
    }
    public function simpan(Request $request){
            $this->validate($request, [

                // 'jasa' => 'required|numeric|digits_between:1,7',

            ]);

            DB::table('pengaturan')->where('id',1)->update([

                'jasa' => $request->jasa,
            ]);
            session()->flash('warning', 'Jasa Dokter Berhasil di ubah');
        return redirect(route('pengaturan'))->with('pesan',"Pengaturan Berhasil Disimpan!");
    }
}
