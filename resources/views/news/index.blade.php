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
                            <li class="breadcrumb-item active">Berita</li>
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
                    <h4 class="card-title">Data Berita</h4>
                    <div class="text-left">
                        <a href="#" class="btn btn-info my-2" id="addNews">Tambahkan Berita</a>
                    </div>
                </div><!--end card-header-->
                <div class="card-body">
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th>Judul Berita</th>
                            <th>Penulis Berita</th>
                            <th>Bidang Berita</th>
                            <th>Foto Berita</th>
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

<div class="modal fade" id="modalAddNews" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="formTitle">Form Berita</h4>
                <button type="button" class="close" data-dismiss="modal" id="closeButton" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="formAddNews" method="POST" autocomplete="off">
                    <input type="hidden" name="news_id" id="news_id">
                    <input type="hidden" name="principal" id="principal" value="{{Auth::user()->user_id}}">
                    <div class="form-group">
                    <div class="mb-1">
                        <label for="subordinate">Judul Berita</label>
                        <input type="text" class="form-control" id="news_title" placeholder="Masukkan Judul Berita" name="news_title">
                    </div>

                    <div class="mb-1">
                        <label for="subordinate">Isi Berita</label>
                        <textarea class="form-control" name="news_field" id="news_field" cols="20" rows="10"></textarea>
                    </div>

                    <div class="mb-1">
                        <label for="sector_id">Bidang Berita</label>
                        <select name="sector_id" id="sector_id" class="form-control">
                            @foreach ($sectors as $sector)
                            <option value="{{ $sector->sector_id }}"> {{ $sector->sector_name }} </option>
                            @endforeach
                        </select> 
                    </div>

                    <input type="file" class="form-control mb-1" id="news_image" placeholder="Masukkan Gambar Berita" name="news_image" required>
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
    ajax : "{{route('getAllNews')}}",
    columnDefs : [
            { responsivePriority: 1, targets: -1 }
    ],
    columns: [
        {"data" : "news_title"},
        {"data": null,
        render: function(data){
            return data.principal[0].name
        }    
    },
        {"data": null,
        render: function(data){
            return data.sector.sector_name
        }    
    },
        {"data" : "news_image",
        render: function(data){
        const url = `{{Storage::url('${data}')}}` 
            return `<img src ="`+url+`" height="140" width="140"/>`
        }
        },
        {"data" : "news_id",
        render: function(data, type, row) {
            return `<a id="editNews" data-id='`+data +`' class="btn btn-md btn-warning my-1"  style="color: white;" > Edit</a>
                    <a id="deleteNews"  data-id='`+data +`' class=" btn btn-md btn-danger my-1" style="color: white;"> Delete</a>`;
        }}
    ]
});

$('#addNews').click(function(){
        $('#formAddNews').trigger('reset');
        $('#modalAddNews').modal('show');
        $('#news_id').val('');
    });

    $(document).on('click', '#editNews', function(e){
        e.preventDefault();
        var id = $(this).attr("data-id");
        
        $.get('/manage/news/get-news/'+id, function(data){
            $('#modalAddNews').modal('show');
            $('#news_id').val(data.news_id);
            $('#news_title').val(data.news_title);
            $('#news_field').val(data.news_field);
            $('#principal').val(data.principal);  
            $('#sector_id').val(data.sector_id);
        });
    });



    
    $(document).on('click', '#closeButton', function(e){
        e.preventDefault();
        $('#formAddNews').trigger("reset");
    });



    $('#submitButton').click(function(e){
        e.preventDefault();
        var formData = {
            data: new FormData(document.getElementById('formAddNews')),
            news_id: $('#news_id').val(),
        }

        if(formData.news_id){
            formData.data.append('_method', 'PUT'),
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/news/update-news/"+formData.news_id,
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddNews').trigger("reset");
                    $('#modalAddNews').trigger("reset");
                    $('#modalAddNews').modal('hide');
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message, "success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddNews').trigger("reset");
                    $('#modalAddNews').modal('hide');
                    $('#modalAddNews').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            });
        } else {
            $.ajax({
                processData: false,
                contentType: false,
                data: formData.data,
                url: "/manage/news/add-news",
                type: "POST",
                dataType: "json",
                success : function(data){
                    $('#formAddNews').trigger("reset");
                    $('#modalAddNews').trigger("reset");
                    $('#modalAddNews').modal("hide");
                    $('#datatable').DataTable().ajax.reload();
                    Swal.fire("Successfull", data.message,"success");
                },
                error : function(data){
                    console.log('Error : ', data);
                    $('#formAddNews').trigger("reset");
                    $('#modalAddNews').modal('hide');
                    $('#modalAddNews').trigger("reset");
                    Swal.fire("Wrong request", data.responseJSON.message, "error");
                }
            })
        }
    });

    $(document).on('click', '#deleteNews', function(e){
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
                    url: '/manage/news/delete-news/'+id,
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