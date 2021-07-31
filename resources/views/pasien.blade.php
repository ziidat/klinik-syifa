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
        <td><a href ="#" title="Lihat" class="btn btn-circle btn-primary">
          <i class="fas fa-file"></i>
        </a>
        <a href ="pasien/{{ $pasien->id }}" title="Edit" class="btn btn-circle btn-warning">
          <i class="fas fa-pen"></i>
        </a>
        <form action="{{route('pasien.delete',$pasien->id)}}" method="post" class="d-inline">
          @method('delete')
          @csrf
          <button type="submit" class="btn btn-danger btn-sm btn-icon " data-toggle="modal" data-target="#modal-danger" value="Delete"><i class="fa fa-trash"></i></button>
      </form>
        </a>
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
<script>
$(function() {
    var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });
$('.toastsDefaultDanger').click(function() {
  $(document).Toasts('create', {
    class: 'bg-danger',
    title: 'Toast Title',
    subtitle: 'Subtitle',
    body: 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr.'
  })
});
})
</script>
@endsection