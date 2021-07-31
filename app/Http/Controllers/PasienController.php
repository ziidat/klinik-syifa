<?php

namespace App\Http\Controllers;

use App\Models\pasien;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PasienController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data pasien
        $pasien = pasien::all();

        return view('pasien',['pasien'=> $pasien]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_pasien()
    {
        return view('tambah-pasien');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function simpan_pasien(Request $request)
    {
        $this->validate($request, [
            'Nama_Lengkap' => 'required|min:5|max:35',
            'Tanggal_Lahir' => 'required|before:today',
            'Alamat' => 'required',
            'Pekerjaan' => 'required',
            'no_handphone' => 'required|numeric',
            'Jenis_Kelamin' => 'required',
            'no_bpjs' => 'nullable|numeric|digits_between:1,15'
        ]);
        DB::table('pasien')->insert([
            'nama' => $request->Nama_Lengkap,
            'tgl_lhr' => $request->Tanggal_Lahir,
            'alamat' => $request->Alamat,
            'pekerjaan' => $request->Pekerjaan,
            'hp' => $request->no_handphone,
            'jk' => $request->Jenis_Kelamin,
            'pendidikan' => $request->Pendidikan_terakhir,
            'no_bpjs' => $request->no_bpjs,
            'alergi' => $request ->alergi,
            'created_time' => Carbon::now(),
            'updated_time' => Carbon::now(),
        ]);
           $ids= DB::table('pasien')->latest('created_time')->first();         
            switch($request->simpan) {
                case 'simpan': 
                    $buka=route('pasien.edit', $ids->id);
                    $pesan='Data pasien berhasil disimpan!';
                break;
                case 'simpan_rm': 
                    $buka=route('rm.list',$ids->id);
                    $pesan='Data pasien berhasil disimpan!';
                break;              
                case 'simpan_baru': 
                    $buka=route('pasien.tambah');
                    $pesan='Data pasien berhasil disimpan!';
                break;
            }
        return redirect($buka)->with('pesan',$pesan);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(pasien $pasien)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit(pasien $pasien)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, pasien $pasien)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(pasien $pasien)
    {
        //
    }

}
