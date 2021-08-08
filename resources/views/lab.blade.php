@extends('layout/main')

@section('title', 'Data Lab')

@section('container')
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <a href="lab/create" class=" btn btn-info btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah Data Lab</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nama Lab</th>
          <th>satuan</th>
          <th>Nilai Normal</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($lab as $lab)
        <tr>
          <td>{{ $lab->nama }}</td>
          <td>{{ $lab->satuan }}</td>
          <td>{{ $lab->nn }}</td>
          <td>{{ $lab->harga}}</td>
          <td>
          <a href ="{{ route('lab.edit',$lab->id) }}" title="Edit" class="btn btn-sm btn-circle btn-warning">
            <i class="fas fa-pen"></i>
          </a>
          <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$lab->id}})" data-target="#modal-sm" class="btn btn-sm btn-icon-split btn-danger">
            <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text"></span></a>
        </td>
        </tr>
        @endforeach
        <tbody>
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
      var url = '{{ route("lab.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
  }

  function formSubmit()
  {
      $("#deleteForm").submit();
  }
</script>
  
@endsection
