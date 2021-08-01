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
    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_lengkap' => 'required|min:5|max:35',
        //     'tanggal_lahir' => 'required|before:today',
        //     'alamat' => 'required',
        //     'pekerjaan' => 'required',
        //     'no_handphone' => 'required|numeric',
        //     'jenis_kelamin' => 'required',
        //     'no_bpjs' => 'nullable|numeric|digits_between:1,15'
        // ]);
        pasien::create([
            'nama' => $request->nama_lengkap,
            'tgl_lhr' => $request->tanggal_lahir,
            'pekerjaan' => $request->pekerjaan,
            'jk' => $request->jenis_kelamin,
            'alamat' => $request->alamat,
            'hp' => $request->no_handphone,
            'pendidikan' => $request->pendidikan_terakhir,
            'no_bpjs' => $request->no_bpjs,
            'alergi' => $request ->alergi,
        ]);

        return redirect('tambah-pasien')->with('succes','Data Berhasil di simpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function show(pasien $request)
    {
      return view('detail-pasien');  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pasien = pasien::findOrFail($id);
        return view('edit-pasien', ['pasien' => $pasien]); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function update($id, pasien $request)
    {
        $pasien = pasien::find($id);
        $pasien -> nama ; $request->nama_lengkap;
        $pasien -> tgl_lhr ; $request->tanggal_lahir;
        $pasien -> pekerjaan ; $request->pekerjaan;
        $pasien -> jk ; $request->jenis_kelamin;
        $pasien -> alamat ; $request->alamat;
        $pasien -> hp ; $request->no_handphone;
        $pasien -> pendidikan ; $request->pendidikan_terakhir;
        $pasien -> no_bpjs ; $request->no_bpjs;
        $pasien -> alergi ; $request->alergi;
    $pasien->save();
    
    return redirect('/pasien');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\pasien  $pasien
     * @return \Illuminate\Http\Response
     */
    public function destroy(pasien $pasien)
    {
        $deleteUser = pasien::find($pasien->id);
        $deleteUser->delete();
        return redirect('pasien')->with('alert', 'User Berhasil Dihapus');
    }

}
