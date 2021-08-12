@extends('layout.main')
@section('title','Lihat Tagihan')
@section('container')
<div id="print-area-1" class="print-area">
  <div style="text-align:right;"><a class="no-print" href="javascript:printDiv('print-area-1');">Print</a></div>
@include('report.report-tagihan')
<iframe id="printing-frame" name="print_frame" src="about:blank" style="display:none;"></iframe>
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
@section('script')
<script type="text/javascript">
     
  function printDiv(elementId) {
 var a = document.getElementById('print-area-1').value;
 var b = document.getElementById(elementId).innerHTML;
 window.frames["print_frame"].document.title = document.title;
 window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
 window.frames["print_frame"].window.focus();
 window.frames["print_frame"].window.print();
}
</script>
@endsection