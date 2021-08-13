@extends('layout.main')

@section('title', 'Pengaturan User')

@section('container')
<div class="card shadow mb-4">
  <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
    <a href="{{route('register')}}" class="btn btn-info btn-sm shadow-sm">
      <i class="fas fa-plus fa-sm"></i> Tambah Pengguna</a> 
      <a href="{{route('pengaturan')}}" class="btn btn-success btn-sm shadow-sm">
        <i class="fas fa-user fa-sm"></i> Jasa Dokter</a>                
  </div>
  <div class="collapse show" id="user" style="">
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>No</th>
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
      @foreach ($users as $user)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{$user->id }}</td>
          <td>{{$user->name }}</td>
          <td>{{$user->username}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->profesi}}</td>
          <td>{!!($user->admin) === 1 ? '<span class="badge badge-success">' . ucwords(convert_boolean($user->admin)) .'</span>':'<span class="badge badge-danger">'. ucwords(convert_boolean($user->admin)) . '</span>' !!}</td>
          <td>
            <a href ="{{ (Auth::user()->id === $user->id) ? route('profile.edit') : route('profile.edit.admin', $user->id) }}" class="btn btn-sm btn-icon-split btn-warning">
                <span class="icon"><i class="fa fa-pen" style="padding-top: 4px;"></i></span><span class="text">Edit</span>
            </a>
            <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$user->id}})" data-target="#modal-sm" class="btn btn-sm btn-icon-split btn-danger">
              <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text"></span>Hapus</a>
          </td>
        </tr>
      @endforeach
      </tbody>
    </table>
  </div>
</div>
</div>
@endsection
@section('script')
<script type="text/javascript">
  function deleteData(id)
  {
      var id = id;
      var url = '{{ route("user.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
  }

  function formSubmit()
  {
      $("#deleteForm").submit();
  }
</script>
@endsection