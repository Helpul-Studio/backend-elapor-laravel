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
                            <li class="breadcrumb-item active">User</li>
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
                    <h4 class="card-title">Data User</h4>
                    <div class="text-left">
                        <a href="#" class="btn btn-info my-2" id="addUser">Tambahkan User</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Nama</th>
                            <th>NRP</th>
                            <th>Foto</th>
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

<div class="modal fade" id="modalAddUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form User</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAddUser" method="POST" autocomplete="off">
                    <input type="hidden" name="user_id" id="user_id">
                    <div class="form-group">
                        <input type="text" class="form-control mb-1" id="name" placeholder="Masukkan Nama" name="name">
                        <input type="email" class="form-control mb-1" id="email" placeholder="Masukkan Email" name="email"> 
                        <input type="password" class="form-control mb-1" id="password" placeholder="Masukkan Password" name="password">
                        <input type="text" class="form-control mb-1" id="occupation" placeholder="Masukkan Jabatan" name="occupation"> 
                        <select name="user_role" id="user_role" class="form-control mb-1">
                            <option value="subordinate">Bawahan</option>
                            <option value="principal">Kepala</option>
                            <option value="admin">Administrator</option>
                        </select> 
                        <input type="file" class="form-control mb-1" id="user_photo" placeholder="Masukkan Foto Profile" name="user_photo" required>
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
    ajax : "{{route('getAllUser')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data" : "user_id"},
        {"data" : "name"},
        {"data" : "nrp"},
        {"data" : "user_photo",
        render: function(data){
        const url = `http://localhost:8000/storage/${data}` 
            return `<img src ="`+url+`" height="70" width="70"/>`
        }
        },
        {"data" : "user_id",
        render: function(data, type, row) {
            return `<a id="editUser" data-id='`+data +`' class="btn btn-md btn-warning my-1"  style="color: white;" > Edit</a>
                    <a id="deleteUser"  data-id='`+data +`' class=" btn btn-md btn-danger my-1" style="color: white;"> Delete</a>`;
        }}
    ]
});

$('#addUser').click(function(){
        $('#formAddUser').trigger('reset');
        $('#modalAddUser').modal('show');
        $('#user_id').val('');
    });

    $(document).on('click', '#editUser', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        
        $.get('/manage/user/get-user/'+id, function(data){
            $('#modalAddUser').modal('show');
            $('#user_id').val(data.user_id);
            $('#name').val(data.name); 
            $('#email').val(data.email); 
            $('#password').attr('placeholder', 'Masukkan Password (Opsional)').val(''); 
            $('#occupation').val(data.occupation);
            $('#user_role').val(data.user_role);    
           
        });
    });



    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddUser').trigger("reset");
    });



    $('#submitButton').click(function(e){
        e.preventDefault();
        var formData = {
            data: new FormData(document.getElementById('formAddUser')),
            user_id: $('#user_id').val(),
            // name: $('#name').val(),
            // name: $('#email').val(),
            // name: $('#password').val(),
            // name: $('#occupation').val(), 
            // name: $('#user_role').val(), 
            // name: $('#user_photo').val(), 
        }

        if(formData.user_id){
            formData.data.append('_method', 'PUT'),
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/user/update-user/"+formData.user_id,
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddUser').trigger("reset");
                    $('#modalAddUser').trigger("reset");
                    $('#modalAddUser').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddUser').trigger("reset");
                    $('#modalAddUser').modal('hide');
                    $('#modalAddUser').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/user/add-user",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddUser').trigger("reset");
                    $('#modalAddUser').trigger("reset");
                    $('#modalAddUser').modal("hide");
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddUser').trigger("reset");
                    $('#modalAddUser').modal('hide');
                    $('#modalAddUser').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteUser', function(e){
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
                    url: '/manage/user/delete-user/'+id,
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