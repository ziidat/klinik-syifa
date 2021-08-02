<?php

namespace App\Http\Controllers;

use App\Models\obat;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data obat
        $obat = obat::all();

        return view('obat',['obat'=> $obat]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah-obat');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        obat::create([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => $request->harga,       
        ]);
        session()->flash('success', 'Data obat Berhasil di simpan');
        return view('tambah-obat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function show(obat $obat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function edit(obat $obat)
    {
        return view('edit-obat',compact('obat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, obat $obat)
    {
        obat::where('id',$request->id)->update([
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'dosis' => $request->dosis,
            'satuan' => $request->satuan,
            'stok' => $request->stok,
            'harga' => $request->harga,       
        ]);

        session()->flash('warning', 'Data obat Berhasil di Ubah');
        return redirect('obat');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\obat  $obat
     * @return \Illuminate\Http\Response
     */
    public function destroy(obat $obat)
    {
        $deleteobat = obat::find($obat->id);
        $deleteobat->delete();

        session()->flash('destroy', 'Data obat Berhasil di hapus');
        return redirect('obat');
    }

}
