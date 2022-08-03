@extends('layouts.master')
@section('content')
<div class="container-fluid">
<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <div class="row">
                <div class="col">
                    <h4 class="page-title">E Report</h4>
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
    <div class="col-lg-4">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Sessions</p>
                        <h3 class="my-2">24k</h3>
                        <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>8.5%</span> New Sessions Today</p>
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
    <div class="col-lg-4">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">                                                
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Avg.Sessions</p>
                        <h3 class="my-2">00:18</h3>
                        <p class="mb-0 text-truncate text-muted"><span class="text-success"><i class="mdi mdi-trending-up"></i>1.5%</span> Weekly Avg.Sessions</p>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="clock" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div> 
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col--> 
    <div class="col-lg-4">
        <div class="card report-card">
            <div class="card-body">
                <div class="row d-flex justify-content-center">                                                
                    <div class="col">
                        <p class="text-dark mb-1 font-weight-semibold">Bounce Rate</p>
                        <h3 class="my-2">$2400</h3>
                        <p class="mb-0 text-truncate text-muted"><span class="text-danger"><i class="mdi mdi-trending-down"></i>35%</span> Bounce Rate Weekly</p>
                    </div>
                    <div class="col-auto align-self-center">
                        <div class="report-main-icon bg-light-alt">
                            <i data-feather="activity" class="align-self-center text-muted icon-md"></i>  
                        </div>
                    </div> 
                </div>
            </div><!--end card-body--> 
        </div><!--end card--> 
    </div> <!--end col-->                             
</div><!--end row-->


</div>



@endsection