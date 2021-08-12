<?php

namespace App\Http\Controllers;
use App\Models\rm;
use App\Models\obat;
use App\Models\lab;
use App\Models\pasien;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Auth;

class RMController extends Controller
{
    public function index() {
        $rms = rm::all();
        return view('rm', compact('rms'));
    }
    public function hapus_rm(rm $rm)
    {
        $rm = rm::find($rm->id);
        $rm->delete();

        session()->flash('destroy', 'Data Rekam Medis Berhasil di hapus');
        return redirect('rm');
    }
    public function update_rm(Request $request)
    {
        // $test=$request->all();
        // dd($test);
        // $request->validate([
        //     'idpasien' => 'required|numeric',
        //     'anamnesis' => 'required|max:1000',
        //     'cekfisik' => 'required|max:1000',
        //     'diagnosis' => 'required|max:40',
        //     'dokter' => 'required',
        // ]);
       // Decoding array input pemeriksaan lab
       if (isset($request->lab))
       {
            if (has_dupes(array_column($request->lab,'id'))){
                $errors = new MessageBag(['lab'=>['Lab yang sama tidak boleh dimasukan berulang']]);
                return back()->withErrors($errors);
            }


            // $request->validate([
            //     'lab.*.hasil' => 'required|numeric',          
            // ]);
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
            // $request->validate([
            //     'resep.*.jumlah' => 'required|numeric',
            //     'resep.*.aturan' => 'required',
            // ]);
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
   
        DB::table('rm')->where('id',$request->id)->update([
            'idpasien' => $request->idpasien,
            'keluhan' => $request->keluhan_utama,
            'anamnesis' => $request->anamnesis,
            'cekfisik' => $request->px_fisik,
            'lab' => $lab_id,
            'hasil' => $lab_hasil,
            'diagnosis' => $request->diagnosis,
            'resep' => $resep_id,
            'jumlah' => $resep_jumlah,
            'aturan' => $resep_dosis,
            'dokter' => $request->dokter,
        ]);
           
            // switch($request->simpan) {
            //     case 'simpan_edit': 
            //         $buka=route('rm.edit',$request->id);
            //         $pesan='Data Rekam Medis berhasil disimpan!';
            //     break;             
            //     case 'simpan_baru': 
            //         $buka=route('rm.tambah.id',$request->idpasien);
            //         $pesan='Data Rekam Medis berhasil disimpan!';
            //     break;
            // }
        session()->flash('warning', 'Data RM Berhasil di ubah');
         return redirect()->back();        
        
    }
    //Hallaman Edit Pasien
    public function edit_rm($id)
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
        
        $datas= rm::where('id',$id)->get();
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
        $dokters = DB::table('users')->where('profesi','Dokter')->get();
        $labs = lab::all();
        $obats = obat::all();
       
      return view('edit-rm',compact('idens','datas','labs','obats','num','dokters'));
    }
    
    public function list_rm($idpasien)
    {
        $idens = pasien::where('id',$idpasien)->get();
        if ($idens->count() <= 0) {
            return abort(404, 'Halaman Tidak Ditemukan.');
        }
        $rms = DB::table('rm')->where('idpasien',$idpasien)->get();

        return view('detail-pasien',compact('idens','rms'));

    }
    
    public function tambah_rm()
    {
        $pasiens = pasien::all();
        $cont=[
          'aria'=>'true',
          'show'=>'show',
          'col'=>''  
        ];
        return view('tambah-rm',compact('pasiens','cont'));  
    }
    
        public function tambah_rmid($idpasien)
    {
        $pasiens = pasien::all();
        $idens = pasien::where('id',$idpasien)->get();
        $labs = lab::all();
        $obats = obat::all();
        $dokters = DB::table('users')->where('profesi','Dokter')->get();
        $cont=[
          'aria'=>'false',
          'show'=>'',
          'col'=>'collapsed'  
        ];
        return view('tambah-rm',compact('idens','pasiens','cont','labs','obats','dokters'));  
    }
    
           public function simpan_rm(Request $request)
    {  
        // $test=$request->dokter;
        // dd($test);

        $request->validate([
            'idpasien' => 'required|numeric',
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
            $request->validate([
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
            $request->validate([
                'resep.*.jumlah' => 'required|numeric|digits_between:1,3',
                'resep.*.aturan' => 'required',
            ]);
            $resep_id = decode('resep','id',$request->resep);
            $resep_jumlah = decode('resep','jumlah',$request->resep);
            $resep_dosis = decode('resep','aturan',$request->resep); 

            $newresep = array();
            $oldresep=array();
            foreach ($request->resep as $resep){
            $newresep[$resep['id']] = $resep['jumlah'];

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
            
        }
        }
        else {
            $resep_id = "";
            $resep_jumlah = "";
            $resep_dosis = "";
        }
        
        
   
        DB::table('rm')->insert([
            'idpasien' => $request->idpasien,
            'keluhan' => $request->keluhan_utama,
            'anamnesis' => $request->anamnesis,
            'cekfisik' => $request->px_fisik,
            'lab' => $lab_id,
            'hasil' => $lab_hasil,
            'diagnosis' => $request->diagnosis,
            'resep' => $resep_id,
            'jumlah' => $resep_jumlah,
            'aturan' => $resep_dosis,
            'dokter' => $request->dokter
        ]);
    
        //    $ids= DB::table('rm')->latest('created_at')->first();         
        //     switch($request->simpan) {
        //         case 'simpan_edit': 
        //             $buka=route('rm.edit',$ids->id);
        //             $pesan='Data Rekam Medis berhasil disimpan!';
        //         break;             
        //         case 'simpan_baru': 
        //             $buka=route('rm.tambah.id',$request->idpasien);;
        //             $pesan='Data Rekam Medis berhasil disimpan!';
        //         break;
        //     }
        //  return redirect($buka)->with('pesan',$pesan);

        session()->flash('success', 'Data RM Berhasil di simpan');
         return redirect()->back();
        
        // return view('rm');
         
    }
    
    public function tagihan($id)
    {
        $datas= rm::where('id',$id)->get();
        foreach ($datas as $data) {
            //mencari id pasien dari id RM
             $idpasien = $data->idpasien;
             $labs_id= encode($data->lab);
             $obats_id=encode($data->resep);
             $jumlah_obat=encode($data->jumlah);
        }             
        $idens=DB::table('pasien')->where('id',$idpasien)->get();
        
        $items = array();
        $jasa=DB::table('pengaturan')->select('jasa')->first();
        foreach ($jasa as $j) {
            $items['Jasa Dokter'] = [$j,1,$j * 1];
        }
        
        foreach ($labs_id as $lab_id) {
            $entries = lab::where('id',$lab_id)->get();
                foreach ($entries as $entry) {
                    $items[$entry->nama] = [$entry->harga, $n=1, $entry->harga * $n];
                }
                
        }
        
        for ($i=0;$i<sizeof($obats_id);$i++) {
            $entries = obat::where('id',$obats_id[$i])->get();
                foreach ($entries as $entry) {
                    $items[$entry->nama] = [$entry->harga, $n=$jumlah_obat[$i], $entry->harga * $n];
                }
                
        }
        

        return view('lihat-tagihan',compact('idens','items'));      
        
    }
    
        public function lihat_rm($id)
    {
        $datas= rm::where('id',$id)->get();
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
        $idens=DB::table('pasien')->where('id',$idpasien)->get();
      return view('lihat-rm',compact('idens','datas','labs','obats','num'));
    }
}