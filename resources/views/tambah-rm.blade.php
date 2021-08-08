@extends('layout/main')

@section('title', 'Tambah Rekam Medis')

@section('container')

<div class="card shadow mb-4">
    <a href="#Identitas" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="Identitas">
      <h6 class="m-0 font-weight-bold text-primary">Identitas Pasien</h6></a>
    <div class="collapse show" id="Identitas">
    <div class="card-body">
      @if (isset($idens))
       @foreach ($idens as $iden)
        <form class="user" action="">
          <h5><strong>Biodata Pasien</strong></h5>
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
    <a href="#tambahrm" class="d-block card-header py-3" data-toggle="collapse" role="button" aria-expanded="true" aria-controls="tambahrm">
      <h6 class="m-0 font-weight-bold text-primary">Tambah Rekam Medis</h6></a>
    <div class="collapse show" id="tambahrm">
    <div class="card-body">
      <form class="user" action="{{route('rm.store')}}" method="post">
        @csrf
        @foreach ($idens as $iden)
        <input type="hidden" name="idpasien" value="{{ $iden->id }}">
        @endforeach
            <div class="form-group row">
                <label for="dokter">Dokter Pemeriksa</label>
                <select class="form-control " name="dokter" 
                {{-- {{(Auth::user()->admin !== 1) ? (Auth::user()->profesi !== "Staff") ? 'disabled="true"' : '' : ''}} --}}
                >
                @foreach ($dokters as $dokter)
                <option value ="{{$dokter->id}}" {{$dokter->id === Auth::user()->id ? 'selected' : ''}}>dr. {{get_value('users',$dokter->id,'name') }}</option>
                @endforeach
                </select>
            </div>   
            <div class="form-group row">
                <label for="keluhan-utama">Keluhan Utama</label>
                <input type="text" class="form-control " name="keluhan_utama" required>
            </div>
            <div class="form-group row">
                <label for="anamnesis">Anamnesis</label>
                <textarea type="date" class="form-control " name="anamnesis" required></textarea>
            </div>
            <div class="form-group row">
                <label for="pemeriksaan_fisik">Pemeriksaan Fisik</label>
                <textarea type="date" class="form-control " name="cekfisik" required></textarea>
            </div>
            <div class="form-group row">
              <div class="col-sm-6 mb-3 mb-sm-0">
              <label for="penunjang">Pemeriksaan Penunjang</label>
            </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                
                <select class="form-control "id="penunjang" name="penunjang"
                 {{-- {{Auth::user()->profesi !== "Dokter" ? 'disabled="true"': ''}} --}}
                 >
                    <option value="" selected disabled>Pilih satu</option>
                    @foreach ($labs as $lab)
                    <option satuan="{{$lab->satuan}}" value="{{$lab->id}}">{{$lab->nama}}</option>
                    @endforeach
                </select>  
              </div>
                <div class="col-sm-6">
                    <a href="javascript:;" onclick="addpenunjang()" type="button" name="add" id="add" class="btn btn-success">Tambahkan</a>
                </div>
              </div>
            <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <table id="dynamicTable"></table>
            </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-12 mb-3 mb-sm-0">
                <label for="diagnosis">Diagnosis</label>
                <input type="text" class="form-control " name="diagnosis">
              </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="reseplist">Resep</label>
            `   </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-9 mb-0 mb-sm-0">
                <select class="form-control " name="reseplist" id="reseplist" >
                    <option value="" selected disabled>Pilih satu</option>
                    @foreach ($obats as $obat)
                    <option value="{{$obat->id}}">{{$obat->nama}} {{$obat->jenis}} {{$obat->dosis}}{{$obat->satuan}}</option>
                    @endforeach
                </select>   
              </div>
                <div class="col-sm-3">
                    <a href="javascript:;" onclick="addresep()" type="button" name="addresep" id="addresep" class="btn btn-success">Tambahkan</a>
                </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-12 mb-3 mb-sm-0">
                <table width="100%" id="reseps"></table>
            </div>
            </div>
            <div class="form-group row">
            <div class="col-sm-4 mb-3 mb-sm-0">

        </form>
    </div>
  </div>
  @endif
{{-- Button --}}
<div class="form-group row justify-content-center">
  <div class="card-footer">
    @foreach ($idens as $iden)
      <a href="{{ route('rm.index') }}" class="btn btn-danger btn-block btn">
          <i class="fas fa-arrow-left fa-fw"></i> Kembali
      </a>
      @endforeach
  </div>
  <div class="card-footer">
      <button type="submit" class="btn btn-primary btn-block" name="simpan" value="simpan_edit" >
          <i class="fas fa-save fa-fw"></i> Simpan
      </button>
  </div>     
</div>
<script type="text/javascript">
   
  var i = 0;
  var a = 0;
     
  function addpenunjang() {
        
        
        var pen= $("#penunjang option:selected").html();
        var penid= $("#penunjang").val();
        var satuan =$("#penunjang option:selected").attr('satuan');
        if (penid !== null) {
            //code
            $("#dynamicTable").append('<tr><td><input type="hidden" name="lab['+i+'][id]" value="'+penid+'" class="form-control" readonly></td><td width="30%"><input type="text" name="lab['+i+'][nama]" value="'+pen+'" class="form-control" readonly></td><td width="30%"><input type="text" name="lab['+i+'][hasil]" placeholder="Hasil" class="form-control" required><td width=10%"><input class="form-control" value='+satuan+' readonly></td></td><td><button type="button" class="btn btn-danger remove-pen">Hapus</button></td></tr>');
        }
        ++i;
    };
    
     function addresep() {
        
        
        var res= $("#reseplist option:selected").html();
        var resid= $("#reseplist").val();
        if (resid !== null) {
            //code
            $("#reseps").append('<tr><td><input type="hidden" name="resep['+a+'][id]" value="'+resid+'" class="form-control" readonly></td><td width="30%"><input type="text" name="resep['+a+'][nama]" value="'+res+'" class="form-control" readonly></td><td width ="10%"><input type="text" name="resep['+a+'][jumlah]" placeholder="Jumlah" class="form-control" required><td width="30%"><input type="text" name="resep['+a+'][aturan]" placeholder="Aturan pakai" class="form-control" required></td><td><button type="button" class="btn btn-danger remove-res">Hapus</button></td></tr>');
        }
        ++a;
    };
   
    $(document).on('click', '.remove-pen', function(){  
         $(this).parents('tr').remove();
    });
    
    $(document).on('click', '.remove-res', function(){  
         $(this).parents('tr').remove();
    });   
 
</script>
@endsection