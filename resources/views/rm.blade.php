@extends('layout/main')

@section('title', 'Rekam Medis')

@section('container')
<div class="card shadow mb-4">
    
  <!-- Card Header - Accordion -->
  <div class="card-header d-sm-flex align-items-center justify-content-between py-3"> 
    @if (Auth::user()->profesi == "Dokter")              
    <a href="{{ route('rm.tambah') }}" class=" btn btn-info btn-sm shadow-sm">
    <i class="fas fa-plus fa-sm"></i> Tambah RM</a> 
    @else
@endif
</div>
  <!-- Card Content - Collapse -->
  <div class="collapse show" id="ListRM" style="">
    <div class="card-body">
    
      <table id="example1" class="table table-bordered table-striped">
    <thead>
      <tr>
        <th>No</th>
        <th>Id RM</th>
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
        <td>{{ $loop->iteration }}</td>
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
          @if (Auth::user()->profesi == "Dokter")
          <a href="{{route('rm.edit', $rm->id)}}" class="btn btn-warning btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-pen"></i>
          </span>
          <span class="text">Edit</span>
          </a>
          @else
          @endif
          <a href="{{route('rm.lihat', $rm->id)}}" class="btn btn-success btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-eye"></i>
          </span>
          <span class="text">Lihat</span>
          </a>
          <a href="{{route('tagihan', $rm->id)}}" class="btn btn-secondary btn-sm btn-icon-split">
          <span class="icon">
          <i style="padding-top:4px"class="fas fa-cart-plus"></i>
          </span>
          <span class="text">Tagihan</span>
          </a>
          @if (Auth::user()->profesi == "Dokter")
          <a href="javascript:;" data-toggle="modal" onclick="deleteData({{$rm->id}})" data-target="#modal-sm" class="btn btn-sm btn-icon-split btn-danger">
            <span class="icon"><i class="fa  fa-trash" style="padding-top: 4px;"></i></span><span class="text"></span>Hapus</a>
            @else
          @endif
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