<?php

namespace App\Http\Controllers;
use App\Models\pasien;
use App\Models\lab;
use App\Models\obat;
use App\Models\rm;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $jumlah['pasien']=pasien::count();
        $jumlah['kunjungan']=rm::count();
        $jumlah['lab']=lab::count();
        $jumlah['obat']=obat::count();
        $pasiens = pasien::all();
        $labs= lab::all();
        $rms = rm::all();
        $obats= obat::all();
        $warning=cek_stok_warning (10); 

        return view('index',compact('jumlah','pasiens','labs','rms','obats','warning'));
    }

}
