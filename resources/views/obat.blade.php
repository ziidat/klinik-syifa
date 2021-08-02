@extends('layout/main')

@section('title', 'Data Obat')

@section('container')
@if(session()->has('warning'))
  <div class="alert alert-warning" role='alert'>
    {{ session()->get('warning') }}
  </div>
  @elseif (session()->has('destroy'))
  <div class="alert alert-danger" role='alert'>
    {{ session()->get('destroy') }}
  </div>
  @endif
<div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <a href="{{ route('obat.create') }}" class=" btn btn-info btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah Stok Obat</a> 
    </div>
    <!-- /.card-header -->
    <div class="card-body">
      <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
          <th>Nama Obat</th>
          <th>Bentuk Obat</th>
          <th>Dosis</th>
          <th>Stok</th>
          <th>Harga</th>
        </tr>
        </thead>
        <tbody>
          @foreach ($obat as $obat)
        <tr> 
          <td>{{ $obat->nama }}</td>
          <td>{{ $obat->jenis }}</td>
          <td>{{ $obat->dosis }}</td>
          <td>{{ $obat->stok}}</td>
          <td>{{ $obat->harga}}</td>
          <td>
          <a href ="{{ route('obat.edit',$obat->id) }}" title="Edit" class="btn btn-circle btn-warning">
            <i class="fas fa-pen"></i>
          </a>
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
  <!-- .modal-content -->
  <div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <form action="" id="deleteForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus Data Obat</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
               {{ method_field('DELETE') }}
          <p>Apakah Anda Yakin untuk menghapus Data Obat?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">tutup</button>
          <button type="button" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Yakin</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

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