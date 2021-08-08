@extends('layout/main')

@section('title', 'Data Pasien')

@section('container')
<div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
            <a href="{{ route('pasien.create') }}" class=" btn btn-info btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Pasien</a> 
        </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
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
            <td>{{ hitung_usia($pasien->tgl_lhr) }}</td>
            <td>{{ $pasien->alamat }}</td>
            <td>{{ $pasien->hp }}</td>
            <td>
              <a href ="#" title="Lihat" class="btn btn-sm btn-icon-split btn-primary">
                  <i class="fas fa-file"></i></a>
              <a href ="{{ route('pasien.edit',$pasien->id) }}" title="Edit" class="btn btn-sm btn-icon-split btn-warning">
                  <i class="fas fa-pen"></i></a>
                  <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$pasien->id}})" data-target="#modal-sm" class="btn btn-sm btn-icon-split btn-danger">
                    <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text"></span></a>
                </td>
              </tr>
            @endforeach
      </tbody>
    </table>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection
@section('script')
<script type="text/javascript">
  function deleteData(id)
  {
      var id = id;
      var url = '{{ route("pasien.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
  }

  function formSubmit()
  {
      $("#deleteForm").submit();
  }
</script>
@endsection