{{-- @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>E Lapor</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{url('logo-polri.png')}}">

        <!-- App css -->
        <link href="{{url('admin/dashstyle/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/dashstyle/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{url('admin/dashstyle/assets/css/app.min.css')}}" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body accountbg">

        <!-- Log In page -->
        <div class="container">
            <div class="row vh-100 d-flex justify-content-center">
                <div class="col-12 align-self-center">
                    <div class="row">
                        <div class="col-lg-5 mx-auto">
                            <div class="card">
                                <div class="card-body p-0 auth-header-box">
                                    <div class="text-center p-3">
                                        <a href="index.html" class="logo logo-admin">
                                            <img src="{{url('logo-polri.png')}}" height="50" alt="logo" class="auth-logo">
                                        </a>
                                        <h4 class="mt-3 mb-1 font-weight-semibold text-white font-18">Masuk Aplikasi ereport</h4>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <ul class="nav-border nav nav-pills" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active font-weight-semibold" data-toggle="tab" href="#LogIn_Tab" role="tab">Masuk</a>
                                        </li>
                                    </ul>
                                     <!-- Tab panes -->
                                    <div class="tab-content">
                                        <div class="tab-pane active p-3 pt-3" id="LogIn_Tab" role="tabpanel">                                        
                                            <form class="form-horizontal  my-4" action="{{route('login')}}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="username">NRP</label>
                                                    <div class="input-group mb-3">                                                                                         
                                                        <input type="number" class="form-control @error('nrp') is-invalid @enderror" name="nrp" id="nrp" placeholder="Masukkan NRP" required>
                                                        @error('email')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                                    
                                                </div><!--end form-group--> 
                    
                                                <div class="form-group">
                                                    <label for="userpassword">Password</label>                                            
                                                    <div class="input-group mb-3">                                  
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" placeholder="Isi" required>
                                                        @error('password')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>                               
                                                </div><!--end form-group--> 
                    
                                                <div class="form-group row mt-4">
                                                    <div class="col-sm-6">
                                                        <div class="custom-control custom-switch switch-success">
                                                            <input type="checkbox" class="custom-control-input" id="customSwitchSuccess">
                                                            <label class="custom-control-label text-muted" for="customSwitchSuccess">Ingat saya</label>
                                                        </div>
                                                    </div><!--end col--> 
                                                    <div class="col-sm-6 text-right">
                                                        <p class="text-muted mb-0">Lupa Password ?  <a target="_blank" href="https://api.whatsapp.com/send?phone=6282255883559" class="text-primary ml-2">Silahkan hubungi admin</a></p>
                                                    </div><!--end col--> 
                                                </div><!--end form-group--> 
                    
                                                <div class="form-group mb-0 row">
                                                    <div class="col-12 mt-2">
                                                        <button class="btn btn-primary btn-block waves-effect waves-light" type="submit">Masuk <i class="fas fa-sign-in-alt ml-1"></i></button>
                                                    </div><!--end col--> 
                                                </div> <!--end form-group-->                           
                                            </form><!--end form-->
                                        </div>
                                    </div>
                                </div><!--end card-body-->
                                <div class="card-body bg-light-alt text-center">
                                    <span class="text-muted d-none d-sm-inline-block">Developer © 2020</span>                                            
                                </div>
                            </div><!--end card-->
                        </div><!--end col-->
                    </div><!--end row-->
                </div><!--end col-->
            </div><!--end row-->
        </div><!--end container-->
        <!-- End Log In page -->

        


        <!-- jQuery  -->
        <script src="{{url('admin/dashstyle/assets/js/jquery.min.js')}}"></script>
        <script src="{{url('admin/dashstyle/assets/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{url('admin/dashstyle/assets/js/waves.js')}}"></script>
        <script src="{{url('admin/dashstyle/assets/js/feather.min.js')}}"></script>
        <script src="{{url('admin/dashstyle/assets/js/simplebar.min.js')}}"></script>

        
    </body>

</html>