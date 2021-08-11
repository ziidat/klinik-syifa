@extends('layout.main')
@section('title','Detail Pasien')
@section('container')

<div class="card shadow mb-4">
  <a href="#Identitas" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Identitas">
    <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6></a>
  <div class="collapse show" id="Identitas">
  <div class="card-body">
    @if (isset($idens))
     @foreach ($idens as $iden)
      <form class="user" action="">
        <address>
          <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
            <table width="100%" border="0">
        <tbody><tr>
            <td valign="top">
            <table border="0" width="100%" style="padding-left: 2px; padding-right: 13px;">
              <tbody>
                <tr>
                  <td width="50%" valign="top" class="textt">Nama</td>
                    <td width="5%">:</td>
                    <td>{{$iden->nama}}</td>
                </tr>
              <tr>
                  <td class="textt">Jenis Kelamin</td>
                    <td>:</td>
                    <td>{{$iden->jk}}</td>
                </tr>
              <tr>
                  <td class="textt">Umur</td>
                    <td>:</td>
                    <td>{{hitung_usia($iden->tgl_lhr)}}</td>
                </tr>
              <tr>
                  <td class="textt">Pekerjaan</td>
                    <td>:</td>
                    <td>{{$iden->pekerjaan}}</td>
                </tr>
              <tr>
                  <td valign="top" class="textt">Alamat</td>
                    <td valign="top">:</td>
                    <td>{{$iden->alamat}}</td>
                </tr>
              <tr>
                  <td class="textt">No HP</td>
                    <td>:</td>
                    <td>{{$iden->hp}}</td>
                </tr>
            </tbody></table>
            </td>
        </tr>
        </tbody></table>
        </address>
        @endforeach
      </div>
    </div>
  </div>

  <div class="card shadow mb-4">
    <div class="card-header d-sm-flex align-items-center justify-content-between py-3">               
        <a href="{{ route('rm.create') }}" class=" btn btn-info btn-sm shadow-sm">
        <i class="fas fa-plus fa-sm"></i> Tambah RM</a> 
    </div>
  <!-- /.card-header -->
  <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th>No RM</th>
        <th>Id Pasien</th>
        <th>Tanggal Periksa</th>
        <th>Keluhan Utama</th>
        <th>Lab</th>
        <th>Diagnosis</th>
        <th>Terapi</th>
        <th>Tindakan</th>
      </tr>
      </thead>
      <tbody>
        @foreach ($rms as $rm)
                    <tr>
                      <td>RM{{str_pad($rm->id, 4, '0', STR_PAD_LEFT)  }}</td>
                      <td>P{{str_pad($rm->idpasien, 4, '0', STR_PAD_LEFT)  }}</td>
                      <td>{{ format_date($rm->created_time) }}</td>
                      <td>{{ $rm->keluhan }}</td>
                      <td>
                      @if ($rm->lab != NULL)
                        @for ($i=0;$i<sizeof($lab=encode($rm->lab));$i++)
                            @if ($has=encode($rm->hasil))
                                <li>{{get_value('lab',$lab[$i],'nama')}} : {{$has[$i]}} {{get_value('lab',$lab[$i],'satuan')}}</li>
                            @endif
                        @endfor
                      @endif
                      </td>
                      <td>{{ $rm->diagnosis}}</td>
                      <td>
                      @if ($rm->resep != NULL)
                        @for ($i=0;$i<sizeof($resep=encode($rm->resep));$i++)
                            @if ($aturan=encode($rm->aturan))
                                <li>{{ get_value('obat',$resep[$i],'nama')}} {{ get_value('obat',$resep[$i],'jenis')}} {{ get_value('obat',$resep[$i],'dosis')}} {{ get_value('obat',$resep[$i],'satuan')}} : {{$aturan[$i]}}</li>
                            @endif
                        @endfor
                      @endif
                      </td>
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
          <a href="lihattagihan" class="btn btn-secondary btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-cart-plus"></i>
          </span>
          <span class="text">Tagihan</span>
          </a>
          <a href="#" data-toggle="modal" onclick="#" data-target="#DeleteModal" class="btn btn-sm btn-icon-split btn-danger">
          <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text">Hapus</span></a>
        </td>
      </tr>
      </tbody>
    @endforeach
    </table>
  </div>
  <!-- /.card-body -->
</div>
<script>
$(document).ready( function () {
var table = $('#pasien').DataTable( {
pageLength : 10,
lengthMenu: [[5, 10, 20, -1], [5, 10, 20, 'Todos']]
} )
} );
</script>
<script type="text/javascript">

var i = 0;
var a = 0;

function addpenunjang() {

++i;
var pen= $("#penunjang option:selected").html();
var penid= $("#penunjang").val();
if (penid !== null) {
//code
$("#dynamicTable").append('<tr><td><input type="hidden" name="lab['+i+'][id]" value="'+penid+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][nama]" value="'+pen+'" class="form-control" readonly></td><td><input type="text" name="lab['+i+'][hasil]" placeholder="Hasil" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>');
}    
};

function addresep() {

++a;
var res= $("#reseplist option:selected").html();
var resid= $("#reseplist").val();
if (resid !== null) {
//code
$("#reseps").append('<tr><td><input type="hidden" name="resep['+a+'][id]" value="'+resid+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][nama]" value="'+res+'" class="form-control" readonly></td><td><input type="text" name="resep['+a+'][jumlah]" placeholder="Jumlah" class="form-control" required><td><input type="text" name="resep['+a+'][aturan]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
}    
};

$(document).on('click', '.remove-pen', function(){  
$(this).parents('tr').remove();
});

$(document).on('click', '.remove-res', function(){  
$(this).parents('tr').remove();
});  

</script>
<script>
function deleteData(id)
{
var id = id;
var url = '{{ route("rm.destroy", ":id") }}';
url = url.replace(':id', id);
$("#deleteForm").attr('action', url);
}

function formSubmit()
{
$("#deleteForm").submit();
}
</script>
@endsection
