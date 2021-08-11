@extends('layout/main')

@section('title', 'Tambah Rekam Medis')

@section('container')
<div class="card shadow mb-4">
    <!-- Card Header - Accordion -->
    <a href="#PilihPasien" class="d-block card-header py-3 {{$cont['col']}}" data-toggle="collapse" role="button" aria-expanded="{{$cont['aria']}}" aria-controls="PilihPasien">
      <h6 class="m-0 font-weight-bold text-primary">Pilih pasien</h6>
    </a>
    <!-- Card Content - Collapse -->
    <div class="collapse {{$cont['show']}}" id="PilihPasien" style="">
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>ID</th>
          <th>Nama Pasien</th>
          <th>HP</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($pasiens as $pasien)
          <tr>
            <td>{{ $pasien->id }}</td>
            <td>{{ $pasien->nama }}</td>
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