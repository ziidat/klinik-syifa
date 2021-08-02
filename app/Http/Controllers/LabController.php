<?php

namespace App\Http\Controllers;

use App\Models\lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // mengambil data obat
        $lab = lab::all();

        return view('lab',['lab'=> $lab]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tambah-lab');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        lab::create([
            'nama' => $request->nama,
            'satuan' => $request->satuan,
            'nn' => $request->nn,
            'harga' => $request->harga,       
        ]);
        session()->flash('success', 'Data lab Berhasil di simpan');
        return view('tambah-lab');
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(lab $lab)
    {
        return view('edit-lab',compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, lab $lab)
    {
        lab::where('id',$request->id)
       ->update([
        'nama' => $request->nama,
        'satuan' => $request->satuan,
        'nn' => $request->nn,
        'harga' => $request->harga,
       ]);

       
       session()->flash('warning', 'Data lab Berhasil di Ubah');
        return redirect('lab');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy(lab $lab)
    {
        $deletelab = lab::find($lab->id);
        $deletelab->delete();

        session()->flash('destroy', 'Data lab Berhasil di hapus');
        return redirect('lab');
    }
}
