@extends('layout/main')

@section('title', 'Tambah Rekam Medis')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
        <h6 class="m-0 font-weight-bold text-dark">Pilih Pasien</h6>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nama Pasien</th>
          <th>Jenis Kelamin</th>
          <th>HP</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($pasiens as $pasien)
          <tr>
            <td>{{ $pasien->id }}</td>
            <td>{{ $pasien->nama }}</td>
            <td>{{ $pasien->jk }}</td>
            <td>{{ $pasien->hp }}</td>
          <td width="120px">
            <a href="{{ route('tambah.rm',$pasien->id) }}" class="btn btn-circle btn-primary">
            <span class="icon text-white-50">
            <i style="padding-top:4px"class="fas fa-check"></i>
            </span>
            <span class="text"></span></td>
          </a>
        </tr>
        @endforeach
      </tbody>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection