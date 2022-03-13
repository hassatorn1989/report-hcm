<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ __('msg.sys_name') }} | @yield('title')</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="{{ url('resources') }}/css/minimal.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/sweetalert2/sweetalert2.css">

    {{-- Datatable --}}
    <link rel="stylesheet"
        href="{{ url('resources/assets') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ url('resources/assets') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet"
        href="{{ url('resources/assets') }}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@300&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Kanit', sans-serif;
        }
    </style>
    @stack('css')
</head>

<body class="hold-transition sidebar-mini layout-fixed sidebar-closed">
    <!-- Site wrapper -->
    <div class="wrapper">
        <!-- Navbar -->
        @livewire('navbar')
        <!-- /.navbar -->

        @livewire('sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        @yield('modal')
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; {{ date('Y') }} {{ __('msg.sys_name') }} All rights
                reserved.
        </footer>

    </div>
    <!-- ./wrapper -->

    <!-- jQuery -->
    <script src="{{ url('resources/assets') }}/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ url('resources/assets') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('resources/assets') }}/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->

    <script src="{{ url('resources/assets') }}/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/jquery-validation/additional-methods.min.js">
    </script>
    {{-- <script src="{{ url('resources/assets') }}/plugins/jquery-validation/localization/messages_th.min.js">
        --}}
    </script>
    <script src="{{ url('resources/assets') }}/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pace-js@latest/pace.min.js"></script>

    <script src="{{ url('resources/assets') }}/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/jszip/jszip.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var myurl = '{{ url('') }}';

        var lang_action = {
            destroy_title : '{{ __('msg.destroy_title') }}',
            destroy_yes : '{{ __('msg.destroy_yes') }}',
            destroy_no : '{{ __('msg.destroy_no') }}',
            select : '{{ __('msg.select') }}',
        }
    </script>

    @stack('script')
</body>

</html>
