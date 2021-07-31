@extends('layout/main')

@section('title', 'Lab')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <a href="/tambah-lab" class=" btn btn-info btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah Data Lab</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nama Lab</th>
          <th>Nilai Normal</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <tr>
          <td>Trident</td>
          <td>Internet
            Explorer 4.0
          </td>
          <td> 4</td>
          <td><a href ="#" title="Buka RM" class="btn btn-circle btn-primary">
            <i class="fas fa-file"></i>
          </a>
          <a href ="#" title="Edit" class="btn btn-circle btn-warning">
            <i class="fas fa-pen"></i>
          </a>
          <a href="javascript:;" data-toggle="modal" onclick="#" data-target="#DeleteModal" class="btn btn-circle btn-danger"><i class="fa fa-trash"></i></a>
        </td>
        </tr>
      </table>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
@endsection