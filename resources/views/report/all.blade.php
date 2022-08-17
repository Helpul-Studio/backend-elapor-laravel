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
                            <th>Nama Pekerjaan</th>
                            <th>Bidang Pekerjaan</th>
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
    ajax : "{{route('getAllJobtasks')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data": "job_task_name"},
        {"data": null,
        render: function(data){
            return data.sector.sector_name
        }    
    },
        {"data": "jobtask_subordinate",
        render: function(data){
            var arr = [];
            data.forEach(function (item){
                arr.push(item.subordinate.name)
            })
            return arr;
        }
        },
        {"data": "job_task_date"},
        {"data": "job_task_status"},
        {"data" : "job_task_id",
        render: function(data, type, row) {
            return `
            <a id="viewJobtask" data-id='`+data +`' class="btn btn-md btn-primary my-1"  style="color: white;" > Laporan</a>`;
        }}
    ]
});



    $(document).on('click', '#viewJobtask', function(e){
        e.preventDefault();
        $('#modalViewJobtask').modal('show'); 
        var id = $(this).attr("data-id");
        
        $.get('/manage/jobtask-result/'+id, function(data){
            console.log(data)
            $('#formViewJobtask').trigger('reset');
            if(data.data.length == 0){
                $("<p id='noReport'> Belum Ada Laporan Yang Diberikan </p>").appendTo( "#imageJobTask" )
            }else{
                for (let index = 0; index < data.data.length; index++) {
                $(`#noReport`).remove();  
                $(`<img src="" id="imgReport`+index+`" class="img-fluid mb-2"/>`).appendTo( "#imageJobTask" )
                $(`#imgReport`+index+``).attr("src", `{{Storage::url('${data.data[index].jobtask_documentation}')}}`);

                $('#modalViewJobtask').on('hidden.bs.modal', function () {
                    $(`#imgReport`+index+``).remove();  
                    $(`#noReport`).remove();  
                });
            }
            }
        });
        
    });

      // Modal hidden event fired


    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formJobtask').trigger("reset");
    });



    $('#submitButton').click(function(e){
        e.preventDefault();
        var formData = {
            data: new FormData(document.getElementById('formJobtask')),
            job_task_id: $('#job_task_id').val(),
        }

        if(formData.job_task_id){
            formData.data.append('_method', 'PUT'),
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/jobtask/update-jobtask/"+formData.job_task_id,
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
                url: "/manage/jobtask/add-jobtask",
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

    $(document).on('click', '#deleteJobtask', function(e){
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
                    url: '/manage/jobtask/delete-jobtask/'+id,
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