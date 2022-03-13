@extends('layouts.layout')
@section('title', __('msg.menu_print_slip'))
@push('css')
@endpush

@push('script')
    <!-- bs-custom-file-input -->
    <script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{ url('resources/assets') }}/app/printslip.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_print_slip') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('msg.menu_print_slip') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">

            <!-- Default box -->
            <div class="card card-navy">
                <div class="card-header">
                    <h3 class="card-title">{{ __('msg.menu_print_slip') }}</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                            <i class="fas fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('print-slip.print') }}" method="post" id="form">
                        @csrf
                        {{-- <div class="row">
                            <div class="col-md-4 offset-md-4" style="text-align: center">
                                <h1>Welcome</h1>
                            </div>
                        </div> --}}
                        {{-- <hr> --}}
                        <div class="row mt-5">
                            <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                  <label for="emp_code">Emp Code</label>
                                  <input type="text"
                                    class="form-control" name="emp_code" id="emp_code"  placeholder="Enter Emp Code" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <div class="form-group">
                                    <label for="pay_date">Pay date</label>
                                    <select class="custom-select" name="pay_date" id="pay_date">
                                        <option value="">{{ __('msg.select') }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 offset-md-4">
                                <button type="submit" name="btn_print" id="btn_print"
                                    class="btn btn-primary btn-lg btn-block"> <i class="fas fa-print"></i>
                                    Print</button>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
