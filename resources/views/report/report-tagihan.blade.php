<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->     
     <div class="form-group row">
          <div class="col-sm-0 mb-0 mb-sm-0">
              <img src="{{ asset('img') }}/logo.png" width="100" height="100" alt="logo" class="img-circle img-fluid">
          </div>
          <div class="row">
            <div class="ml-3 mb-1 col-12">
              <h2 class="page-header">KLINIK UMUM SYIFA MEDIKANA
              </h2>
              <ul class="ml-3 mb-1 fa-ul text-muted">
                <li class="small mb-1"><span class="fa-li">
                    <i class="fas fa-clinic-medical"></i>
                  </span> <b>No Izin: </b> 503/1096/Dinkes/BP/94</li>
                <li class="small mb-1"><span class="fa-li">
                    <i class="fas fa-lg fa-building"></i>
                  </span> Jl. Mekarsari Raya No 5 Tambun - Bekasi</li>
                <li class="small mb-1"><span class="fa-li">
                    <i class="fas fa-lg fa-phone"></i>
                  </span> Phone : (021) 88391265 / 081380426000</li>
              </ul>
            </div>
          </div>
        <!-- /.col -->
      </div>
      <hr/>
      <h3 class="text-center">TAGIHAN BEROBAT PASIEN</h3>
      <hr/>
      <!-- info row -->
      <div class="row invoice-info">
        <div class="col-sm-4 ml-3 invoice-col">
            <strong>Kepada :</strong>
          <address>
            @if (isset($idens))
            @foreach ($idens as $iden)
            <div class="col-md-12 kertas-biodata">
              <div class="biodata">
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
                            
                          <tr>
                            <td class="textt">Umur</td>
                              <td>:</td>
                              <td>{{hitung_usia($iden->tgl_lhr)}}</td>
                          </tr>
                          <tr>
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
                        </tbody>
                      </table>
                    </td>
                  </tr></tbody>
                </table>
              </div>
            </div> 
          </address>
          @endforeach
            @endif
          </div>
        </div>
        
        <
          <h6 class="m-0 ml-3 font-weight-bold text-dark">Tagihan Kunjungan Pasien</h6></a>
        <div class="collapse show" id="tambahrm">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="table-responsive-sm">
                    <table class="table table-striped">
                    <thead>
                    
                    <tr>
                    <th class="center">#</th>
                    <th>Item</th>
                    <th class="right">Harga Satuan</th>
                      <th class="center">Kuantitas</th>
                    <th class="right">Sub Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @for ($n=0;$n<sizeof($items);$n++)
                    <tr>
                    <td class="center">{{$n + 1}}</td>
                    <td class="left strong">{{$item=array_keys($items)[$n]}}</td>
                        @for ($i=0;$i<3;$i++)
                            @if ($i != 1)
                                <td class="center">{{formatrupiah($items[$item][$i])}}</td>
                            @else
                                <td class="center">{{$items[$item][$i]}}</td>
                            @endif
                        @endfor
                    </tr>
                    @endfor
                    <tr>
                    <th class="center"></th>
                    <th>Jumlah Harga</th>
                    <th class="right"></th>
                      <th class="center"></th>
                    <th class="right">{{formatrupiah(jumlah_harga($items))}}
                  </th>
                </tr>
              </tbody>
             </table>
           </div>                  
        </div>   
      </div>
    </div>
        


           
