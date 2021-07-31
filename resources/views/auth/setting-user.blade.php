@extends('layout.main')

@section('title', 'Pengaturan User')

@section('container')
<div class="card shadow mb-4">
  <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
      <a href="/register" class=" btn btn-info btn-sm shadow-sm">
      <i class="fas fa-plus fa-sm"></i>Tambah Pengguna</a> 
  </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-striped" id="dataTable" width="100%" cellspacing="0">
              <thead>
                <tr>
                  <th>Id</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Email</th>
                  <th>Profesi</th>
                  <th>Admin</th>
                  <th>Tindakan</th> 
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>1</td>
                    <td>Achmad Fauzi </td>
                    <td>Fauzi</td>
                    <td>Achmad Fauzi987@gmail.com</td>
                    <td>Dokter</td>
                    <td>Ya</td>
                    <td>
                    <a href =# class="btn btn-sm btn-icon-split btn-warning">
                        <span class="icon"><i class="fa fa-pen" style="padding-top: 4px;"></i></span><span class="text">Edit</span>
                    </a>
                    <a href="#" class="btn btn-sm btn-icon-split btn-danger">
                        <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>
                    </td>
                    </tr>
              </tbody>
            </table>
          </div>
        </div>
@endsection