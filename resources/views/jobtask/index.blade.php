@extends('layouts.master')
@section('style')
<link href="{{url('admin/plugins/sweet-alert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{url('admin/plugins/timepicker/bootstrap-material-datetimepicker.css')}}" rel="stylesheet" type="text/css">
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
                    <div class="text-left">
                        <a href="#" class="btn btn-info my-2" id="addJobtask">Tambahkan Pekerjaan</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nama Pekerjaan</th>
                            <th>Pelaksana Pekerjaan</th>
                            <th>Tanggal Pekerjaan</th>
                            <th>Status Pekerjaan</th>
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
</div> <!--end col-->   

<div class="modal fade" id="modalAddJobtask" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form Struktural</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAddStructural" method="POST" autocomplete="off">
                    <input type="hidden" name="job_task_id" id="job_task_id">
                    <div class="form-group">

                        <div class="mb-1">
                        <label for="subordinate">Nama Pekerjaan</label>
                        <input type="text" class="form-control" id="job_task_name" placeholder="Masukkan Pekerjaan" name="job_task_name">
                        </div>

                        <div class="mb-1">
                        <label for="subordinate">Tanggal Pekerjaan</label>
                        <input type="text" class="form-control" id="mdate" placeholder="2017-06-04" name="job_task_date">
                        </div>

                        <div class="mb-1">
                            <label for="subordinate">Pelaksana Pekerjaan</label>
                            <select name="subordinate" id="subordinate" class="form-control">
                                @foreach ($subordinates as $subordinate)
                                <option value="{{ $subordinate->user_id }}"> {{ $subordinate->name }} </option>
                                @endforeach
                            </select> 
                        </div>

                    </div>
                    <div class="text-right">
                        <button type="submit" id="submitButton" class="btn btn-success waves-effect waves-light mr-2">Submit</button>
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

<script src="{{url('admin/plugins/timepicker/bootstrap-material-datetimepicker.js')}}"></script>


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
    ajax : "{{route('getAllJobtask')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data": "job_task_name"},
        {"data" : null, 
        render: function(data,type,row){
        return data.subordinate[0].name
    }},
        {"data": "job_task_date"},
        {"data": "job_task_status"},
        {"data" : "job_task_id",
        render: function(data, type, row) {
            return `
            <a id="viewStructural" data-id='`+data +`' class="btn btn-md btn-primary my-1"  style="color: white;" > Laporan</a>
            <a id="editStructural" data-id='`+data +`' class="btn btn-md btn-warning my-1"  style="color: white;" > Edit</a>
            <a id="deleteStructural"  data-id='`+data +`' class=" btn btn-md btn-danger my-1" style="color: white;"> Delete</a>`;
        }}
    ]
});

$('#addJobtask').click(function(){
        $('#formJobtask').trigger('reset');
        $('#modalAddJobtask').modal('show');
        $('#job_task_id').val('');
    });

    $(document).on('click', '#editStructural', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        
        $.get('/manage/structural/get-structural/'+id, function(data){
            $('#modalAddJobtask').modal('show');
            $('#job_task_id').val(data.job_task_id);
            $('#principal').val(data.principal); 
            $('#subordinate').val(data.subordinate);            
        });
    });



    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formJobtask').trigger("reset");
    });



    $('#submitButton').click(function(e){
        e.preventDefault();
        var formData = {
            data: new FormData(document.getElementById('formAddStructural')),
            job_task_id: $('#job_task_id').val(),
        }

        if(formData.job_task_id){
            formData.data.append('_method', 'PUT'),
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/structural/update-structural/"+formData.job_task_id,
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formJobtask').trigger("reset");
                    $('#modalAddJobtask').trigger("reset");
                    $('#modalAddJobtask').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formJobtask').trigger("reset");
                    $('#modalAddJobtask').modal('hide');
                    $('#modalAddJobtask').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/structural/add-structural",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formJobtask').trigger("reset");
                    $('#modalAddJobtask').trigger("reset");
                    $('#modalAddJobtask').modal("hide");
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formJobtask').trigger("reset");
                    $('#modalAddJobtask').modal('hide');
                    $('#modalAddJobtask').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteStructural', function(e){
        e.preventDefault();
        var id = $(this).attr('data-id');
        Swal.fire({
            title: "You want to delete this data?",
            type: "warning",
            confirmButtonText: "Yes!",
            showCancelButton: true,
            cancelButtonText: "No"
        }).then((result)=> {
            if(result.value){
                $.ajax({
                    url: '/manage/structural/delete-structural/'+id,
                    type: "DELETE",
                    success : function(data){
                        if(data.status === true){
                            $('#datatable').DataTable().ajax.reload();
                            Swal.fire("Successfull", data.message, "success");
                        } else {
                            Swal.fire("Wrong request", data.message, "error");
                        }
                    }
                });
            } else if(result.dismiss){
                Swal.fire("Canceled", "Your data is safe", "error");
            }
        });
    });

    

});
</script>
@endsection