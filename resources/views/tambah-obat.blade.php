@extends('layout/main')

@section('title', 'Tambah Obat')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="card-tittle">Formulir Obat Baru</h6>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('obat.store')}}" method="post">
        @csrf
        <form>
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="nama" placeholder="Nama Obat" required>
                </div>
             </div>
            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control " name="jenis" placeholder="Bentuk Sediaan"required>
                          <option value="" selected disabled>Jenis Obat</option>
                          <option value="Tablet">Tablet</option>
                          <option value="Kapsul">Kapsul</option>
                          <option value="Syrup">Syrup</option>
                          <option value="Ampul">Ampul</option>
                          <option value="Flask">Flask</option>
                      </select>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                     <input type="text" class="form-control " name="dosis" placeholder="Dosis Obat" required> 
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control " name="satuan" placeholder="satuan">
                          <option value="" selected disabled>Satuan</option>
                          <option value="g">g</option>
                          <option value="mg">mg</option>
                          <option value="mcg">mcg</option>
                          <option value="IU">IU</option>
                          <option value="mg/5ml">mg/5ml</option>
                      </select>                                
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-hashtag fa-fw"></i></div>
                        </div>
                    <input type="text" class="form-control " name="stok"  placeholder="Jumlah Stok Obat"required>
                </div></div>
                <div class="col-sm-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-money-bill-wave fa-fw"></i></div>
                        </div>
                    <input type="text" class="form-control " name="harga"  placeholder="Harga Obat"required>
                </div></div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="card-footer">
                    <a href="{{ route('obat.index') }}" class="btn btn-danger btn-block btn">
                        <i class="fas fa-arrow-left fa-fw"></i> Kembali
                    </a>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan" >
                        <i class="fas fa-save fa-fw"></i> Simpan
                    </button>
                </div>  
                </div>                      
        </form>
    </div>
</div>


@endsection