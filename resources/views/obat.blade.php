@extends('layout/main')

@section('title', 'Data Obat')

@section('container')
<div class="card shadow mb-4">
        <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
            <a href="{{ route('obat.create') }}" class=" btn btn-info btn-sm shadow-sm">
            <i class="fas fa-plus fa-sm"></i> Tambah Obat</a> 
        </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
          <th>Nama Obat</th>
          <th>Jenis</th>
          <th>Dosis</th>
          <th>Stok</th>
          <th>Harga</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($obat as $obat)
          <tr>
            <td>{{ $obat->nama }}</td>
            <td>{{ $obat->jenis }}</td>
            <td>{{ $obat->dosis }}
            {{ $obat->satuan }} </td>
            <td>{{ $obat->stok }}</td>
            <td>{{ formatrupiah($obat->harga) }}</td>
            <td>
              <a href ="{{ route('obat.edit',$obat->id) }}" title="Edit" class="btn btn-sm btn-circle btn-warning">
                  <i class="fas fa-pen"></i></a>
                  <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$obat->id}})" data-target="#modal-sm" class="btn btn-sm btn-icon-split btn-danger">
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
      var url = '{{ route("obat.destroy", ":id") }}';
      url = url.replace(':id', id);
      $("#deleteForm").attr('action', url);
  }

  function formSubmit()
  {
      $("#deleteForm").submit();
  }
</script>
@endsection