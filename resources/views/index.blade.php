@extends('layout/main')

@section('title', 'Dashboard')

@section('container')
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlah['pasien']}}</h3>

            <h5>Total Pasien Terdaftar</h5>
          </div>
          <div class="icon">
            <i class="fas fa-user-friends"></i>
          </div>
          @if (Auth::user()->profesi == "Petugas") 
          <a href="{{route('pasien.index')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          @else
          @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$jumlah['kunjungan']}}</h3>
            <h5>Total Pengunjung</h5>
          </div>
          <div class="icon">
            <i class="fas fa-head-side-virus"></i>
          </div>
          @if (Auth::user()->profesi == "Petugas") 
          <a href="{{route('rm')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          @else
          @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$jumlah['obat']}}</h3>

            <h5>Total Obat</h5>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-capsules"></i>
          </div>
          @if (Auth::user()->profesi == "Petugas") 
          <a href="{{route('obat.index')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          @else
          @endif
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$jumlah['lab']}}</h3>

            <h5>Total Lab</h5>
          </div>
          <div class="icon">
            <i class="nav-icon fas fa-flask"></i>
          </div>
          @if (Auth::user()->profesi == "Petugas") 
          <a href="{{route('lab.index')}}" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
          @else
            @endif
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- AREA CHART -->
    <div class="card card-olive">
      <div class="card-header">
        <h3 class="card-title">Grafik Pengunjung Klinik</h3>

        <div class="card-tools">
          <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-minus"></i>
          </button>
          <button type="button" class="btn btn-tool" data-card-widget="remove">
            <i class="fas fa-times"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <div class="chart">
          <canvas id="areaChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
@section('chart')
<script>

$(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */

    //--------------
    //- AREA CHART -
    //--------------

    // Get context with jQuery - using jQuery's .get() method.
    var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

    var areaChartData = {
      labels  : ['Januari', 'Februari', 'Maret', 'April', 'May', 'June', 'July'],
      datasets: [
        {
          label               : 'Digital Goods',
          backgroundColor     : 'rgba(60,141,188,0.9)',
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius          : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [28, 48, 40, 19, 86, 27, 90]
        },
        // {
        //   label               : 'Electronics',
        //   backgroundColor     : 'rgba(210, 214, 222, 1)',
        //   borderColor         : 'rgba(210, 214, 222, 1)',
        //   pointRadius         : false,
        //   pointColor          : 'rgba(210, 214, 222, 1)',
        //   pointStrokeColor    : '#c1c7d1',
        //   pointHighlightFill  : '#fff',
        //   pointHighlightStroke: 'rgba(220,220,220,1)',
        //   data                : [65, 59, 80, 81, 56, 55, 40]
        // },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

     // This will get the first returned node in the jQuery collection.
     new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })
  }
)
</script>
@endsection