@if(session()->has('warning'))
  <div class="col-sm-2 ml-1 alert alert-default-warning row justify-content-center" role='alert'>
    {{ session()->get('warning') }}
  </div>
  @elseif (session()->has('destroy'))
  <div class="col-sm-2 ml-1 alert alert-default-danger row justify-content-center" role='alert'>
    {{ session()->get('destroy') }}
  </div>
  @elseif (session()->has('success'))
  <div class="col-sm-2 ml-1 alert alert-default-success row justify-content-center" role='alert'>
    {{ session()->get('success') }}
  </div>
  @endif

  <!-- .modal-content -->
<div class="modal fade" id="modal-sm">
    <div class="modal-dialog modal-sm">
      <form action="" id="deleteForm" method="post">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Hapus @yield('title')</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          {{ csrf_field() }}
               {{ method_field('DELETE') }}
          <p>Apakah Anda Yakin untuk menghapus @yield('title')?</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
          <button type="button" name="" class="btn btn-danger" data-dismiss="modal" onclick="formSubmit()">Hapus</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </form>
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
