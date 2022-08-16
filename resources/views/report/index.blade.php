@extends('layouts.master')
@section('style')
<link href="{{url('admin/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
@endsection
@section('content')
<div class="page-content">
    <div class="container-fluid">
    <div class="row">
        <div class="col-sm-12">
            <div class="page-title-box">
                <div class="row">
                    <div class="col">
                        <h4 class="page-title">E Report</h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Menu</a></li>
                            <li class="breadcrumb-item active">Laporan</li>
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
                    <h4 class="card-title">Data Laporan</h4>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nama Laporan</th>
                            <th>Pembuat Laporan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>


                        <tbody>
                        </tbody>
                    </table>

                </div>
            </div>
        </div> <!-- end col -->
    </div>

    <div class="modal fade" id="modalReport" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="formTitle">Form Laporan</h4>
                    <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
                </div>
                <div class="modal-body">
                    <form id="formViewReport" action="#">
                        <div class="card-body" id="imageJobTask" />
    
    
                        <div class="mb-3">
                            <label for="report_subordinate"> <b> Dilaporkan Oleh </b> </label>
                            <p id="report_subordinate"></p>
                        </div>
    
                        <div class="mb-3">
                            <label for="report_sector"> <b> Bidang Laporan </b> </label>
                            <p id="report_sector"></p>
                        </div> 
    
                        <div class="mb-3">
                            <label for="report_about"> <b> Perihal Laporan </b> </label>
                            <p id="report_about"></p>
                        </div> 
    
                        <div class="mb-3">
                            <label for="report_source_information"> <b> Sumber Informasi </b> </label>
                            <p id="report_source_information"></p>
                        </div> 
    
                        <div class="mb-3">
                            <label for="report_place"> <b> Lokasi Kejadian Laporan </b> </label>
                            <p id="report_place"></p>
                        </div>
    
                        <div class="mb-3">
                            <label for="report_date"> <b> Tanggal Kejadian </b> </label>
                            <p id="report_date"></p>
                        </div>
    
                        <div class="mb-3">
                            <label for="report_activities"> <b> Rangkaian Kejadian Laporan </b> </label>
                            <p id="report_activities"></p> 
                        </div>
    
                        <div class="mb-3">
                            <label for="report_analysis"> <b> Analisa </b> </label>
                            <p id="report_analysis"></p> 
                        </div>
                        
                        <div class="mb-3">
                            <label for="report_prediction"> <b> Prediksi </b> </label>
                            <p id="report_prediction"></p>
                        </div> 
    
                        <div class="mb-3">
                            <label for="report_recommendation"> <b> Rekomendasi </b> </label>
                            <p id="report_recommendation"></p>
                        </div> 
    
                        <div class="mb-3">
                            <label for="report_steps_taken"> <b> Langkah-langkah Yang Diambil </b> </label>
                            <p id="report_steps_taken"></p>
                        </div>
                        
    
    
                    </form>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    
    </div>

</div> <!--end col-->   


@endsection
@section('script')
<script src="{{url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('admin/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>

<script src="{{url('admin/plugins/sweet-alert2/sweetalert2.min.js')}}"></script>


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
    ajax : "{{route('getAllReport')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data": "report_about"},
        {"data": "subordinate.name"},
        {"data" : "report_task_id",
        render: function(data, type, row) {
            return `
            <a id="viewReport" data-id='`+data +`' class="btn btn-md btn-primary my-1"  style="color: white;" >Lihat Laporan</a>`;
        }}
    ]
});

    $(document).on('click', '#viewReport', function(e){
        e.preventDefault();
        $('#modalReport').modal('show'); 
        var id = $(this).attr("data-id");
        
        $.get('/manage/report-result/'+id, function(data){
            $('#formViewReport').trigger('reset');

            $('#report_subordinate').text(data.data[0].subordinate.name); 
            $('#report_sector').text(data.data[0].sector.sector_name); 
            $('#report_about').text(data.data[0].report_about); 
            $('#report_source_information').text(data.data[0].report_source_information); 
            $('#report_place').text(data.data[0].report_source_information);  
            $('#report_date').text(data.data[0].report_date); 
            $('#report_activities').text(data.data[0].report_activities); 
            $('#report_analysis').text(data.data[0].report_analysis); 
            $('#report_prediction').text(data.data[0].report_prediction); 
            $('#report_steps_taken').text(data.data[0].report_steps_taken); 
            $('#report_recommendation').text(data.data[0].report_recommendation); 

            for (let index = 0; index < data.data.length; index++) {
                $(`#noReport`).remove();  
                $(`<img src="" id="imgReport`+index+`" class="img-fluid mb-2"/>`).appendTo( "#imageJobTask" )
                $(`#imgReport`+index+``).attr("src", `{{Storage::url('${data.data[index].jobtask_documentation}')}}`);

                $('#modalReport').on('hidden.bs.modal', function () {
                    $(`#imgReport`+index+``).remove();  
                    $(`#noReport`).remove();  
                });
            }
        });
        
    });



    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddNews').trigger("reset");
    });


});
</script>
@endsection