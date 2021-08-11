@extends('layout.main')
@section('title','Lihat Tagihan')
@section('container')
@include('report.report-tagihan')
   <!-- this row will not appear when printing -->
   <div class="row no-print">
    <div class="col-12 mb-1 ml-1">
      <a href="/cetaktagihan" rel="noopener" target="_blank" class="btn btn-success"><i class="fas fa-print"></i> Print</a>
    </div>
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
<!-- /.invoice -->
@endsection