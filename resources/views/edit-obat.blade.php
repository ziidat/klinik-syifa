@extends('layout/main')

@section('title', 'Tambah Obat')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="card-tittle">Formulir Edit obat</h6>
    </div>
    <div class="card-body">
        <form class="user" action="{{route('obat.update',$obat->id) }}" method="post">
        @csrf
        @method('put')
        <input type="hidden" name="id" value="{{ $obat->id }}">
            <div class="form-group row">
                <div class="col-sm-12 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="nama" placeholder="Nama Obat" value="{{ $obat->nama }}" required>
                </div>
             </div>
            <div class="form-group row">
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control " name="jenis" placeholder="Jenis Obat" value="{{ $obat->jenis }}"required>
                          <option value="{{ $obat->jenis }}" selected disabled>{{ $obat->jenis }}</option>
                          <option value="Tablet"{{ $obat->jenis == 'Tablet' ? 'selected' :''}} >Tablet</option>
                          <option value="Kapsul"{{ $obat->jenis == 'kapsul' ? 'selected' :''}} >Kapsul</option>
                          <option value="Syrup"{{ $obat->jenis == 'Syrup' ? 'selected' :''}} >Syrup</option>
                          <option value="Ampul"{{ $obat->jenis == 'Ampul' ? 'selected' :''}} >Ampul</option>
                          <option value="Flask"{{ $obat->jenis == 'Flask' ? 'selected' :''}} >Flask</option>
                      </select>
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                     <input type="text" class="form-control " name="dosis" placeholder="Dosis Obat" value="{{ $obat->dosis }}" required> 
                </div>
                <div class="col-sm-4 mb-3 mb-sm-0">
                    <select class="form-control " name="satuan" placeholder="satuan">
                          <option value="{{ $obat->satuan }}" selected disabled>{{ $obat->satuan }}</option>
                          <option value="g"{{ $obat->satuan == 'g' ? 'selected' :''}} >g</option>
                          <option value="mg"{{ $obat->satuan == 'mg' ? 'selected' :''}} >mg</option>
                          <option value="mcg"{{ $obat->satuan == 'mcg' ? 'selected' :''}} >mcg</option>
                          <option value="IU"{{ $obat->satuan == 'IU' ? 'selected' :''}} >IU</option>
                          <option value="mg/5ml"{{ $obat->satuan == 'mg/5ml' ? 'selected' :''}} >mg/5ml</option>
                      </select>                                
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6">
                <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-hashtag fa-fw"></i></div>
                        </div>
                    <input type="text" class="form-control " name="stok"  placeholder="Jumlah Stok Obat" value="{{ $obat->stok }}" required>
                </div></div>
                <div class="col-sm-6">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-money-bill-wave fa-fw"></i></div>
                        </div>
                    <input type="text" class="form-control " name="harga"  placeholder="Harga Obat" value="{{ $obat->harga }}"required>
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