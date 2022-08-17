@extends('layouts.master')
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">E Lapor</h4>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Menu</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>                                                          
        </div>
    </div>
</div>



<div class="row justify-content-center">
    <div class="col-lg-3">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Total Pengguna</p>
                        <h3 class="my-2">{{ $users }}</h3>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="users" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div>
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col--> 
    <div class="col-lg-3">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">                                                
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Total Berita</p>
                        <h3 class="my-2">{{ $news }}</h3>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="clipboard" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div> 
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col--> 
    <div class="col-lg-3">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">                                                
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Total Pekerjaan</p>
                        <h3 class="my-2">{{ $jobtasks }}</h3>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="briefcase" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div> 
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->
    <div class="col-lg-3">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">                                                
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Total Laporan</p>
                        <h3 class="my-2">{{ $reports }}</h3>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="file-text" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div> 
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                               
</div><!--end row-->


</div>



@endsection