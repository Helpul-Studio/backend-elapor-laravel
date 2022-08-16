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
                            <li class="breadcrumb-item active">Sektor</li>
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
                    <h4 class="card-title">Data Sektor</h4>
                    <div class="text-left">
                        <a href="#" class="btn btn-info my-2" id="addStructural">Tambahkan Sektor</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Nama Sektor</th>
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

<div class="modal fade" id="modalAddSector" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form Sektor</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAddSector" method="POST" autocomplete="off">
                    <input type="hidden" name="sector_id" id="sector_id">
                    <div class="form-group">
                        <div class="mb-1">
                            <label for="principal">Nama Sektor</label>
                            <input type="text" class="form-control" id="sector_name" placeholder="Masukkan Nama Sektor" name="sector_name">
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
    ajax : "{{route('getAllSector')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data" : "sector_name"},
        {"data" : "sector_id",
        render: function(data, type, row) {
            return `<a id="editSector" data-id='`+data +`' class="btn btn-md btn-warning my-1"  style="color: white;" > Edit</a>
                    <a id="deleteSector"  data-id='`+data +`' class=" btn btn-md btn-danger my-1" style="color: white;"> Delete</a>`;
        }}
    ]
});

$('#addStructural').click(function(){
        $('#formAddSector').trigger('reset');
        $('#modalAddSector').modal('show');
        $('#sector_id').val('');
    });

    $(document).on('click', '#editSector', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        
        $.get('/manage/sector/get-sector/'+id, function(data){
            $('#modalAddSector').modal('show');
            $('#sector_id').val(data.sector_id);
            $('#sector_name').val(data.sector_name);
        });
    });



    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddSector').trigger("reset");
    });



    $('#submitButton').click(function(e){
        e.preventDefault();
        var formData = {
            data: new FormData(document.getElementById('formAddSector')),
            sector_id: $('#sector_id').val(),
        }

        if(formData.sector_id){
            formData.data.append('_method', 'PUT'),
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/sector/update-sector/"+formData.sector_id,
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddSector').trigger("reset");
                    $('#modalAddSector').trigger("reset");
                    $('#modalAddSector').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddSector').trigger("reset");
                    $('#modalAddSector').modal('hide');
                    $('#modalAddSector').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/sector/add-sector",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddSector').trigger("reset");
                    $('#modalAddSector').trigger("reset");
                    $('#modalAddSector').modal("hide");
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddSector').trigger("reset");
                    $('#modalAddSector').modal('hide');
                    $('#modalAddSector').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteSector', function(e){
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
                    url: '/manage/sector/delete-sector/'+id,
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