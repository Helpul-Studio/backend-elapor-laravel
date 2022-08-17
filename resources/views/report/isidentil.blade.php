@extends('layouts.master')
@section('style')
<link href="{{url('admin/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('admin/plugins/select2/select2.min.css')}}" rel="stylesheet" type="text/css">
@endsection       
@section('content')
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">E Lapor</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu</a></li>
                            <li class="breadcrumb-item active">Pekerjaan</li>
                        </ol>
                    </div><!--end col--> 
                </div><!--end row-->                                                              
            </div><!--end page-title-box-->
        </div><!--end col-->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Pekerjaan</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nama Laporan</th>
                            <th>Pemberi Laporan</th>
                            <th>Tanggal Laporan</th>
                            <th>Tempat Laporan</th>
                            <th>Rangkaian Kegiatan</th>
                            <th>Analisa Pemberi Laporan</th>
                            <th>Prediksi Pemberi Laporan</th>
                            <th>Langkah Yang Diambil Pemberi Laporan</th>
                            <th>Rekomendasi Pemberi Laporan</th>
                        </tr>
                        </thead>


                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>
</div> <!--end col-->   



<div class="modal fade" id="modalViewJobtask" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form Laporan Pekerjaan</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formViewJobtask" action="#">
                <div class="card-body" id="imageJobTask"> 
                </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->

</div>
@endsection
@section('script')
<script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{url('admin/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>
<script src="{{url('admin/plugins/select2/select2.min.js')}}"></script>

<script> 
$(document).ready(function() {
    $.ajaxSetup({
        headers : {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
});
$('#datatable').DataTable({
    processing: true,
    lengthMenu : [10,50,100],
    ajax : "{{route('getAllIsidentil')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data": "report_about"},
        {"data": "subordinate.name"},
        {"data": "report_date"},
        {"data": "report_place"},
        {"data": "report_activities"},
        {"data": "report_analysis"},
        {"data": "report_prediction"},
        {"data": "report_steps_taken"},
        {"data": "report_recommendation"},
    ]
});


      // Modal hidden event fired


    
});
</script>
@endsection