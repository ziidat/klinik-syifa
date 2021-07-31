@extends('layout/main')

@section('title', 'Rekam Medis')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <a href="/tambah-rm-pilih" class=" btn btn-info btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah RM</a> 
    </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No RM</th>
        <th>Id Pasien</th>
        <th>Nama</th>
        <th>Keluhan Utama</th>
        <th>Diagnosis</th>
        <th>Terapi</th>
      </tr>
      </thead>
      <tbody>
      <tr>
        <td>RM001</td>
        <td>P0001</td>
        <td>Achmad Fauzi</td>
        <td>Mual
        </td>
        <td>Sehat</td>
        <td> Bodrex</td>
        <td width="120px">
          <a href="tambahrm" class="btn btn-warning btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-pen"></i>
          </span>
          <span class="text">Edit</span>
          </a>
          <a href="/lihatrm" class="btn btn-success btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-eye"></i>
          </span>
          <span class="text">Lihat</span>
          </a>
          <a href="liattagihan" class="btn btn-secondary btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-cart-plus"></i>
          </span>
          <span class="text">Tagihan</span>
          </a>
          <a href="#" data-toggle="modal" onclick="#" data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger">
          <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>
        </td>
      <tr>
        <td>Trident</td>
        <td>Internet
          Explorer 5.0
        </td>
        <td>Win 95+</td>
        <td>5</td>
        <td>C</td>
      </tr>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
