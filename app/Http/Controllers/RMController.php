<?php

namespace App\Http\Controllers;

use App\Models\rm;
use App\Models\obat;
use App\Models\pasien;
use App\Models\lab;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\MessageBag;

class RMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rm = rm::all();

        return view('rm',['rm'=> $rm]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pasiens = pasien::all();
        $cont=[
          'aria'=>'true',
          'show'=>'show',
          'col'=>''  
        ];
        return view('tambah-rm-pilih',compact('pasiens','cont'));  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    $this->validate($request, [
        'idpasien' => 'required|numeric|digits_between:1,4',
        'keluhan_utama' => 'required|max:40',
        'anamnesis' => 'required|max:1000',
        'cekfisik' => 'max:1000',
        'diagnosis' => 'max:40',
        'dokter' => 'required',
    ]);
   // Decoding array input pemeriksaan lab
   if (isset($request->lab))
   {
        if (has_dupes(array_column($request->lab,'id'))){
            $errors = new MessageBag(['lab'=>['Lab yang sama tidak boleh dimasukan berulang']]);
            return back()->withErrors($errors);
        }
        $this->validate($request, [
            'lab.*.hasil' => 'required|numeric|digits_between:1,4',          
        ]);
        $lab_id = decode('lab','id',$request->lab);
        $lab_hasil = decode('lab','hasil',$request->lab);
   }
   else {
    $lab_id ="";
    $lab_hasil ="";
   }

   // Decoding array input resep
   if (isset($request->resep))
    {
        if (has_dupes(array_column($request->resep,'id'))){
            $errors = new MessageBag(['resep'=>['resep yang sama tidak boleh dimasukan berulang']]);
            return back()->withErrors($errors);
        }
        $this->validate($request, [
            'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
            'resep.*.aturan' => 'required',
        ]);
        $resep_id = decode('resep','id',$request->resep);
        $resep_jumlah = decode('resep','jumlah',$request->resep);
        $resep_dosis = decode('resep','aturan',$request->resep); 
    }
    else {
        $resep_id = "";
        $resep_jumlah = "";
        $resep_dosis = "";
    }
    $newresep = array();
    $oldresep=array();
    foreach ($request->resep as $resep){
        $newresep[$resep['id']] = $resep['jumlah'];
        
    }
    if (empty($oldresep)) {
        $resultanresep = resultan_resep($oldresep,$newresep);
    }
    else {$resultanresep=$newresep;}
    $errors = validasi_stok($resultanresep);
    if ($errors !== NULL) {
      return  back()->withErrors($errors);
    }

    foreach ($resultanresep as $key => $value) {
        $perintah=kurangi_stok($key,$value);
        if ($perintah === false) { $habis = array_push($habis,$key); }
    }

    rm::insert([
        'idpasien' => $request->idpasien,
        'ku' => $request->keluhan_utama,
        'anamnesis' => $request->anamnesis,
        'cekfisik' => $request->cekfisik,
        'lab' => $lab_id,
        'hasil' => $lab_hasil,
        'diagnosis' => $request->diagnosis,
        'resep' => $resep_id,
        'jumlah' => $resep_jumlah,
        'aturan' => $resep_dosis,
        'dokter' => $request->dokter,
    ]);

       $ids= rm::latest('created_time')->first();         
        switch($request->simpan) {
            case 'simpan_edit': 
                $buka=route('rm.edit',$ids->id);
                $pesan='Data Rekam Medis berhasil disimpan!';
            break;             
            case 'simpan_baru': 
                $buka=route('rm.tambah.id',$request->idpasien);;
                $pesan='Data Rekam Medis berhasil disimpan!';
            break;
        }
   
     return redirect($buka)->with('pesan',$pesan);
     
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function show(rm $rm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function edit(rm $rm)
    {
        return view('edit-rm',compact('rm'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rm $rm)
    {
        rm::where('id',$request->id)->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => $request->harga,       
        ]);

        session()->flash('warning', 'Data Rekam Medis Berhasil di Ubah');
        return redirect('rm');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function destroy(rm $rm)
    {
        $deleterm = rm::find($rm->id);
        $deleterm->delete();

        session()->flash('destroy', 'Data rekam Medis Berhasil di Hapus');
        return redirect('rm');
    }
    public function pilihrm(rm $rm)
    {
        $pasien = pasien::all();
        return view('tambah-rm',compact('pasien'));
    }

    public function list_rm(rm $idpasien)
    {
    $rm = rm::where('idpasien',$idpasien)->get();

    return view('list-rm',compact('rm'));   
    }

    public function tambah_rmid(pasien $id)
    {
        $pasiens = pasien::all();
        $idens = pasien::find($id);
        $labs = lab::all();
        $obats = obat::all();
        $dokters = user::where('profesi','Dokter')->get();
        $cont=[
          'aria'=>'false',
          'show'=>'',
          'col'=>'collapsed'  
        ];
        return view('tambah-rm',compact('idens','pasiens','cont','labs','obats','dokters'));
    }
}
