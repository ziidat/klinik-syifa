@extends('layout/main')

@section('title', 'Edit Pasien')

@section('container')
@if (\Session::has('alert'))
<div class="toasts-top-right fixed">
        <ul>
            <li>{!! \Session::get('alert') !!}</li>
        </ul>
    </div>
@endif
<div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="card-tittle">Edit Pasien</h6>
    </div>
    <div class="card-body">
    <div class="card-body">
        <form class="user" action="{{route('edit.pasien')}}" method = "post">
          @csrf
          @method('put')
        
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" class="form-control " name="nama_lengkap" placeholder="Nama Lengkap" value="{{ $pasien->nama }}" required>
                </div>
              <div class="col-sm-2">
                <label align="center" class ="form-text"  required>Tanggal lahir :</label>
              </div>
              <div class="col-sm-4">
                <input type="date" class="form-control " name="tanggal_lahir" placeholder="Tanggal lahir" value="{{ $pasien->tgl_lhr }}" required>
              </div>
            </div>
            <div class="form-group">
              <input type="text" class="form-control " name="alamat" placeholder="Alamat" value="{{ $pasien->alamat }}" required>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" class="form-control " name="pekerjaan" placeholder="Pekerjaan" value="{{ $pasien->pekerjaan }}" required>
              </div>
              <div class="col-sm-6">
                <input type="text" class="form-control " name="no_handphone" placeholder="Nomer Handphone" value="{{ $pasien->hp }}" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
                <select class="form-control " name="pendidikan_terakhir" placeholder="Pendidikan terakhir" value="{{ $pasien->pendidikan }}" required>
                    <option value="" selected disabled>Pendidikan Terakhir</option>
                    <option value="Tidak Ssekolah">Tidak Sekolah</option>
                    <option value="SD">SD</option>
                    <option value="SMP">SMP</option>
                    <option value="SMA">SMA</option>
                    <option value="Perguruan Tinggi">Perguruan Tinggi</option>
                </select>    
              </div>
              <div class="col-sm-6">
                <select class="form-control " name="jenis_kelamin" placeholder="Jenis Kelamin" value="{{ $pasien->jk }}" required>
                    <option value="" selected disabled>Jenis Kelamin</option>
                    <option value="Laki-laki">Laki-laki</option>
                    <option value="perempuan">Perempuan</option>

                </select>
              </div>
            </div>
                <div class="form-group">
                    <input type="text" class="form-control " name="no_bpjs" value="{{ $pasien->no_bpjs }}" placeholder="Nomer BPJS (Tidak Wajib)">
                </div>
                <div class="form-group">
                    <textarea class="form-control " name="alergi" value="{{ $pasien->alergi }}" placeholder="Daftar Alergi (Tidak Wajib)"></textarea>
                </div>                                
            <div class="form-group row justify-content-center">
                <div class="card-footer">
                    <a href="/pasien" class="btn btn-danger btn-block btn">
                        <i class="fas fa-arrow-left fa-fw"></i> Kembali
                    </a>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-block swalDefaultSuccess">
                        <i class="fas fa-save fa-fw"></i> Simpan
                    </button>
                </div>     
            </div>
        </form>
    </div>
  </div> 
@endsection