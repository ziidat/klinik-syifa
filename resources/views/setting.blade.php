@extends('layout.main')

@section('title', 'Pengaturan User')

@section('container')
    @foreach ($datas as $data)
    <div class="card shadow mb-4">
                <div class="card-header d-sm-flex align-items-center justify-content-between py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Formulir Pengaturan</h6>
                </div>
                <div class="card-body">
                <div class="card-body">
              
                    <form class="user" action="{{route('pengaturan.simpan')}}" method="post" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PATCH') }}
                        
                        <div class="form-group row">
                            <h7 class="m-10 font-weight-bold font-italic text-secondary">Pengaturan Khusus</h7>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4 mb-3 mb-sm-0">
                                <label for="nama_klinik">Jasa Dokter</label>
                            </div>
                            <div class="col-sm-8 mb-3 mb-sm-0">
                                <div class="input-group mb-2">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">Rp. </div>
                                    </div>
                                <input type="text" class="form-control " name="jasa" value="{{ $data->jasa }}" placeholder="Jasa Dokter">
                                </div>
                            </div>
                         </div>
                        <div class="form-group row">
                            <div class="col-sm-8 mb-3 mb-sm-0">
                            </div>
                            <a href="{{ route('user') }}" class="btn btn-danger btn-block btn">
                                <i class="fas fa-arrow-left fa-fw"></i> Kembali
                            </a>
                            <div class="col-sm-1 mb-3 mb-sm-0">
                                <button type="submit" class="form-control btn-primary"><i class="fas fa-save"></i>  Simpan</i></button>
                            </div>
                         </div>
                    </form>
                    @endforeach
                </div>
              </div>
                
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
     

$( document ).ready(function() {
    $('.icp-auto').iconpicker();
});
  </script>

@endsection