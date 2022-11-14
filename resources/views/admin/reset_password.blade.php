<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Gelera | Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- App favicon -->
        <link rel="shortcut icon" href="{{ asset('public/images/logo.png') }}">

        <!-- App css -->
        <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/metisMenu.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet" type="text/css" />

    </head>

    <body class="account-body">

        <!-- Log In page -->
        <div class="row vh-100 ">
            <div class="col-12 align-self-center">
                <div class="auth-page">
                    <div class="card auth-card shadow-lg">
                        <div class="card-body">
                            <div class="px-3">
                                <div class="auth-logo-box">
                                    <a href="{{ url('/login') }}" class="logo logo-admin"><img src="{{ asset('public/images/logo.png') }}" height="55" alt="logo" class="auth-logo"></a>
                                </div><!--end auth-logo-box-->
                                
                                <div class="text-center auth-logo-text">
                                    <h4 class="mt-0 mb-3 mt-5">Password Reset</h4>
                                    <p class="text-muted mb-0">Please reset your password</p>  
                                </div> <!--end auth-logo-text-->  



                                <form class="form-horizontal auth-form my-4" method="post" action="{{ url('/reset_password_submit') }}">
                                @csrf

                                @if(session('error_msg'))
                                     <p class="alert alert-danger">{{session('error_msg')}}</p> 
                                @endif
                                @if(session('success_msg'))
                                     <p class="alert alert-success">{{session('success_msg')}}</p> 
                                @endif
                                    
                                    <div class="form-group">
                                        <label for="username">New Password</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i> 
                                            </span>
                                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter password" required>
                                        </div>            
                                    </div>

                                    <div class="form-group">
                                        <label for="username">Confirm New Password</label>
                                        <div class="input-group mb-3">
                                            <span class="auth-form-icon">
                                                <i class="dripicons-lock"></i>
                                            </span>
                                            <input type="password" class="form-control" id="confirm_new_password" name="confirm_new_password" placeholder="Enter password again" required>
                                        </div>
                                    </div>
        
                                    <div class="form-group mb-0 row">
                                        <div class="col-12 mt-2">
                                            <button class="btn btn-primary btn-round btn-block waves-effect waves-light" type="submit">Password Reset</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            
                            <div class="m-3 text-center text-muted">
                                <p class=""><a href="{{url('/')}}" class="text-primary ml-2">Signin instead</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Log In page -->

        <!-- jQuery  -->
        <script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/metisMenu.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/waves.min.js') }}"></script>
        <script src="{{ asset('public/assets/js/jquery.slimscroll.min.js') }}"></script>

        <!-- App js -->
        <script src="{{ asset('public/assets/js/app.js') }}"></script>

    </body>
</html>