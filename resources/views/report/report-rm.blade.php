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
      <h3 class="text-center">REKAM MEDIS PASIEN</h3>
      <hr/>
      <!-- info row -->
    <div class="row invoice-info">
      <div class="col-sm-4 invoice-col">
          <h5><strong>Biodata Pasien</strong></h5>
        @if (isset($idens))
          @foreach ($idens as $iden)
            <form class="user" action="">
              <address>
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
                            </tbody>
                          </table>
                        </td>
                      </tr></tbody>
                    </table>
                  </div>
                </div>
              </address>
            @endforeach
            </form>
            @endif
      </div>
    </div>
    @foreach ($datas as $data)
        <div class="col-sm-4 invoice-col">
        </div>
        <input type="hidden" name="idpasien" value="{{ $data->idpasien }}">
        <input type="hidden" name="id" value="{{ $data->id }}">
        <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Tanggal Periksa</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
              <p class="text-md-left">{{ format_date($data->created_time) }}</p>
          </div>
      </div>
          <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label ><strong>Dokter Pemeriksa</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
             <p class="text-md-left">dr. {{ get_value('users',$data->dokter,'name') }}</p>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Keluhan Utama</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
              <p class="text-md-left">{{ $data->keluhan }}</p>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Anamnesis</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
              <p class="text-md-left">{{ $data->anamnesis}}</p>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Pemeriksaan Fisik</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>    
          <div class="col-sm-8">
              <p class="text-md-left">{{ $data->cekfisik}}</p>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Pemeriksaan Penunjang</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
              @if ($data->lab != NULL)
              @for ($i=0;$i<$num['lab'];$i++) <li> {{get_value('lab',array_keys($data->labhasil)[$i],'nama')}} : {{$data->labhasil[array_keys($data->labhasil)[$i]]}} {{get_value('lab',array_keys($data->labhasil)[$i],'satuan')}} | Nilai Normal : {{get_value('lab',array_keys($data->labhasil)[$i],'nn')}} </li>
              
              @endfor
              @endif
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Diagnosis</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          <div class="col-sm-8">
              <p class="text-md-left">{{ $data->diagnosis }}</p>
          </div>
      </div>
      <div class="form-group row">
          <div class="col-sm-3 text-md-right">
              <label for="keluhan-utama"><strong>Resep</strong></label>
          </div>
          <div class="col-sm-1 text-md-center">
              :
          </div>
          
          <div class="col-sm-8">
          @if ($data->resep != NULL)                          
              @for ($i=0;$i<$num['resep'];$i++)
                  <li class="text-md-left">{{get_value('obat',array_keys($data->allresep)[$i],'nama')}} {{get_value('obat',array_keys($data->allresep)[$i],'jenis')}} {{get_value('obat',array_keys($data->allresep)[$i],'dosis')}}  {{$data->allresep[array_keys($data->allresep)[$i]]}}</li>
              @endfor
             @endif
          </div>
        @endforeach    
      </div>
