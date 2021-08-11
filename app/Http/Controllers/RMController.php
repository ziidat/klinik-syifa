<?php

namespace App\Http\Controllers;

use App\Models\rm;
use App\Models\obat;
use App\Models\pasien;
use App\Models\lab;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rms = rm::all();

        return view('rm',compact('rms'));
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
        'keluhan' => 'required|max:40',
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
        'keluhan' => $request->keluhan,
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
    public function edit($id)
    {
        if (Auth::User()->admin !== 1) {
            if (Auth::User()->profesi !== "Dokter") {
                abort(403, 'Anda Tidak berhak Mengakses Halaman Ini.');
            }
            $dokters=DB::table('rm')->select('dokter')->where('id',$id)->get();;
            foreach ($dokters as $dokter) {            
                if (Auth::User()->id !== $dokter->dokter) {
                abort(403, 'Anda Tidak berhak Mengakses Halaman Ini.');
                }
            }
        }
        
        $datas= rm::find('rm',$id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             if ($data->idpasien != NULL) {$idpasien = $data->idpasien;  $idens=DB::table('pasien')->where('id',$idpasien)->get();}
             if ($data->lab != NULL) {
                //mengcovert data lab di tabel RM kedalam arry
                $data->labhasil=array_combine(encode($data->lab),encode($data->hasil));
                $num['lab']=sizeof($data->labhasil);
             }
             else {
                $num['lab']=0;
             }
             if ($data->resep != NULL) {
                $data->allresep=array_combine(encode($data->resep),encode($data->aturan));
                $data->jum=encode($data->jumlah);
                $num['resep']=sizeof($data->allresep);
             }
             else {
                $num['resep']=0;
             }
        }
        $dokters = user::where('profesi','Dokter')->get();
        $labs = lab::all();
        $obats = obat::all();
       
      return view('edit-rm',compact('idens','datas','labs','obats','num','dokters'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'idpasien' => 'required|numeric|digits_between:1,4',
            'keluhan' => 'required|max:40',
            'anamnesis' => 'required|max:1000',
            'cekfisik' => 'required|max:1000',
            'diagnosis' => 'required|max:40',
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

        $oldresep=array_combine(encode(get_value('rm',$request->id,'resep')),encode(get_value('rm',$request->id,'jumlah')));
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
   
   
        rm::where('id',$request->id)->update([
            'idpasien' => $request->idpasien,
            'keluhan' => $request->keluhan,
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
           
            switch($request->simpan) {
                case 'simpan_edit': 
                    $buka=route('rm.edit',$request->id);
                    $pesan='Data Rekam Medis berhasil disimpan!';
                break;             
                case 'simpan_baru': 
                    $buka=route('rm.tambah.id',$request->idpasien);
                    $pesan='Data Rekam Medis berhasil disimpan!';
                break;
            }
       
         return redirect($buka)->with('pesan',$pesan);        
        
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
        $idens = pasien::find($idpasien);
        if ($idens->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        $rms = rm::where('idpasien',$idpasien)->get();

        return view('detail-pasien',compact('idens','rms'));   
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

    public function lihat_rm($id)
    {
        $datas= rm::find($id);
        if ($datas->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             $idpasien = $data->idpasien;
             if ($data->lab != NULL) {
                //mengcovert data lab di tabel RM kedalam arry
                $data->labhasil=array_combine(encode($data->lab),encode($data->hasil));
                $num['lab']=sizeof($data->labhasil);
             }
             else {
                $num['lab']=0;
             }
             if ($data->resep != NULL) {
                $data->allresep=array_combine(encode($data->resep),encode($data->aturan));
                $data->jum=encode($data->jumlah);
                $num['resep']=sizeof($data->allresep);
             }
             else {
                $num['resep']=0;
             }
        }
        $labs = lab::all();
        $obats = obat::all();
        $idens= pasien::where('id',$idpasien)->get();
      return view('lihat-rm',[
          'idens' => $idens,
          'datas' => $datas,
          'labs' => $labs,
          'obats' => $obats,
          'num' => $num]);
    }
}
