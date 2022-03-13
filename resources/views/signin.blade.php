<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
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
            <a href="#!">{{ __('msg.sys_name') }}</a>
        </div>
        <!-- /.login-logo -->
        <div class="card">
            <div class="card-body login-card-body">
                <p class="login-box-msg">Sign in to start your session</p>
                @if (!empty(Session::get('msg')))
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    Login false
                </div>
                @endif
                <form action="{{ route('auth.login') }}" method="post" id="form">
                    @csrf
                    <div class="form-group">
                        <input type="text" name="username" id="username" class="form-control" placeholder="Username"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password" class="form-control" placeholder="Password"
                            autocomplete="off">
                    </div>
                    <button type="submit" id="btn_login" class="btn btn-primary btn-block"> <i
                            class="fas fa-sign-in-alt"></i> {{ __('msg.btn_signin') }}</button>
                </form>
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
    <script src="{{ url('resources/assets') }}/plugins/jquery-validation/additional-methods.min.js">
    </script>
    {{-- <script src="{{ url('resources/assets') }}/plugins/jquery-validation/localization/messages_th.min.js">
        --}}
    </script>
    <script src="{{ url('resources/assets') }}/app/signin.js?q={{ time() }}"></script>
</body>

</html>
