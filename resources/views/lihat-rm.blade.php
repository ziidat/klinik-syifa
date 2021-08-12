@extends('layout.main')
@section('title','Lihat RM')
@section('container')
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
@include('report.report-rm')
   <!-- this row will not appear when printing -->
   <div class="form-group row no-print">
     <div class="card mb-1 ml-3">
       <a href="{{ route('rm') }}" rel="noopener" target="_blank" class="btn btn-danger"><i class="fas fa-long-arrow-alt-left"></i></i> Kembali</a>
     </div>
    <div class="card mb-1 ml-3">
      <button onclick="window.print()" class="btn btn-success"><i class="fas fa-print"></i> Print</a></button>
    </div>
  </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- ./wrapper -->
<!-- /.invoice -->
@endsection