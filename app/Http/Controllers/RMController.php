<?php

namespace App\Http\Controllers;

use App\Models\rm;
use Illuminate\Http\Request;

class RMController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('rm');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function tambah_rm()
    {
        return view('tambah-rm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rm  $rm
     * @return \Illuminate\Http\Response
     */
    public function destroy(rm $rm)
    {
        //
    }
    public function PilihPasien()
    {
        return view('tambah-rm-pilih');
    }
}
