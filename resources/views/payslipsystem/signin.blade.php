<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('msg.sys_name') }} | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/dist/css/adminlte.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="#!">{{ __('msg.sys_name') }} Print Slip</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                            href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home"
                            aria-selected="true">Print Slip</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                            href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile"
                            aria-selected="false">Login to System</a>
                    </li>
                </ul>
                <div class="tab-content" id="custom-content-below-tabContent">
                    <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                        aria-labelledby="custom-content-below-home-tab">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="login-box-msg">Enter empoyee code to print slip</p>
                                {{-- @if (!empty(Session::get('msg')))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        Login false
                                    </div>
                                @endif --}}
                                <form action="{{ route('payslip.slip.print1') }}" method="post" id="form_print">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="emp_code_print" id="emp_code_print" class="form-control"
                                            placeholder="Emp Code" autocomplete="off">
                                    </div>
                                    <button type="submit" id="btn_print" class="btn btn-primary btn-block"> <i class="fas fa-print"></i> Print Slip</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                        aria-labelledby="custom-content-below-profile-tab">
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <p class="login-box-msg">Sign in to start your session</p>
                                @if (!empty(Session::get('msg')))
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        Login false
                                    </div>
                                @endif
                                <form action="{{ route('payslip.auth.login') }}" method="post" id="form">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="emp_code" id="emp_code" class="form-control"
                                            placeholder="Emp Code" autocomplete="off">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="birth_date" id="birth_date" class="form-control"
                                            placeholder="Birth Date (Example : DDMMYYYY)" autocomplete="off" >
                                    </div>
                                    <button type="submit" id="btn_login" class="btn btn-primary btn-block"> <i
                                            class="fas fa-sign-in-alt"></i> {{ __('msg.btn_signin') }}</button>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
            <!-- /.login-card-body -->
        </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ url('resources/assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('resources/assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('resources/assets') }}/dist/js/adminlte.min.js"></script>

    <script src="{{ url('resources/assets') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/jquery-validation/additional-methods.min.js"></script>
    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var myurl = '{{ url('payslip') }}';
    </script>
    <script src="{{ url('resources/assets') }}/payslipsystem-app/signin.js?q={{ time() }}"></script>
</body>

</html>
