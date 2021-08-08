@extends('layout/main')

@section('title', 'Edit Lab')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary">Formulir Edit Lab</h6>
    </div>
    <div class="card-body">
        <form class="user" action="{{ route('lab.update',$lab->id) }}n" method="post">
        @csrf
        @method('put')
          <input type="hidden" name="id" value="{{ $lab->id }}">
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="nama" placeholder="Nama Pemeriksaan Lab" value="{{ $lab->nama }}" required>
                </div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="satuan"  placeholder="Satuan" value="{{ $lab->satuan }}" required>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <div class="input-group mb-2">
                        <div class="input-group-prepend">
                            <div class="input-group-text"><i class="fas fa-money-bill-wave fa-fw"></i></div>
                        </div>
                    <input type="text" class="form-control " name="harga"  placeholder="Harga" value="{{ $lab->harga }}" required>
                </div></div>
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="nn"  placeholder="Nilai Normal" value="{{ $lab->nn }}" required>
                </div>
            </div>
            <div class="form-group row justify-content-center">
                <div class="card-footer">
                    <a href="{{ route('lab.index') }}" class="btn btn-danger btn-block btn">
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