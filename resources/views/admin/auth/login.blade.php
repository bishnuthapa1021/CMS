<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login  | Veltrix - Responsive Bootstrap 4 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('public/backend/assets/images/favicon.ico')}}">

    <!-- Bootstrap Css -->
    <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body>

    <div class="home-btn d-none d-sm-block">
        <a href="javascript" class="text-dark"><i class="fas fa-home h2"></i></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card overflow-hidden">
                        <div class="bg-primary">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul style="list-style:none">
                                        @foreach ($errors->all() as $error )
                                        <li> {{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                                @if (Session::has('info-message'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                   {{Session::get('info-message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>

                                @endif
                                @if (Session::has('error-message'))
                                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                   {{Session::get('error-message')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>

                                @endif

                            <div class="text-primary text-center p-4">
                                <h5 class="text-white font-size-20">Welcome Back !</h5>
                                <p class="text-white-50">Sign in to continue to Veltrix.</p>
                                <a href="{{route('adminLogin')}}" class="logo logo-admin">
                                    <img src="{{asset('backend/assets/images/logo-sm.png')}}" height="24" alt="logo">
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-4">
                            <div class="p-3">
                                <form class="form-horizontal mt-4" action="{{route('adminLogin')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Enter your Email">
                                    </div>

                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-6">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="customControlInline">
                                                <label class="custom-control-label" for="customControlInline">Remember me</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-right">
                                            <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Log In</button>
                                        </div>
                                    </div>

                                    <div class="form-group mt-2 mb-0 row">
                                        <div class="col-12 mt-4">
                                            <a href="pages-recoverpw.html"><i class="mdi mdi-lock"></i> Forgot your password?</a>
                                        </div>
                                    </div>

                                </form>

                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- JAVASCRIPT -->
    <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
    <script src="{{asset('backend/assets/libs/node-waves/waves.min.js')}}"></script>

    <script src="{{asset('backend/assets/js/app.js')}}"></script>

</body>

</html>
