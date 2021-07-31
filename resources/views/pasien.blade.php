@extends('layout/main')

@section('title', 'Data Pasien')

@section('container')
<div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
            <a href="/tambah-pasien" class=" btn btn-info btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Pasien</a> 
        </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered">
      <thead>
      <tr>
        <th>Id Pasien</th>
        <th>Nama</th>
        <th>Jenis Kelamin</th>
        <th>Umur</th>
        <th>Alamat</th>
        <th>No HP</th>
        <th>Aksi</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($pasien as $pasien)

      <tr>
        <td>{{ $pasien->id }}</td>
        <td>{{ $pasien->nama }}</td>
        <td>{{ $pasien->jk }}</td>
        <td>{{ $pasien->tgl_lhr }}</td>
        <td>{{ $pasien->alamat }}</td>
        <td>{{ $pasien->hp }}</td>
        <td><a href ="#" title="Buka RM" class="btn btn-circle btn-primary">
          <i class="fas fa-file"></i>
        </a>
        <a href ="#" title="Edit" class="btn btn-circle btn-warning">
          <i class="fas fa-pen"></i>
        </a>
        <a href="javascript:;" data-toggle="modal" onclick="#" data-target="#DeleteModal" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></a>
      </td>
      </tr>
      @endforeach
      <tr>
        <td>Trident</td>
        <td>Trident</td>
        <td>Trident</td>
        <td>Internet
          Explorer 5.0
        </td>
        <td>Win 95+</td>
        <td>5</td>
        <td>C</td>
      </tr>
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->


@endsection