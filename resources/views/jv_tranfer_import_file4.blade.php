@extends('layouts.layout')
@section('title', __('msg.menu_jv_tranfer_import_file4'))
@push('css')
    <!-- daterange picker -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/daterangepicker/daterangepicker.css">
@endpush

@push('script')
    <!-- date-range-picker -->
    <script src="{{ url('resources/assets') }}/plugins/moment/moment.min.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/daterangepicker/daterangepicker.js"></script>
    <!-- bs-custom-file-input -->
    <script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{ url('resources/assets') }}/app/jv_tranfer_import_file4.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_jv_tranfer_import_file4') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard') }}</a></li>
                            <li class="breadcrumb-item active">{{ __('msg.menu_jv_tranfer_import_file4') }}
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
                    <h3 class="card-title">{{ __('msg.menu_jv_tranfer_import_file4') }}</h3>
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
                    @if (!empty(Session::get('status')))
                        <div class="alert alert-success" role="alert">
                            Import Success!!
                        </div>
                    @endif
                    <form action="{{ route('jv-tranfer.import-file4.store') }}" method="post" id="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="file_import" class="col-sm-2 col-form-label">AS400_JV.XLS</label>
                            <div class="col-sm-8">
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="file_import" name="file_import"
                                            accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                                        <label class="custom-file-label" for="file_import">Choose file</label>
                                    </div>
                                    <div class="input-group-append">
                                        <span class="input-group-text">Upload</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <button type="submit" id="btn_import" class="btn btn-info  btn-block"> <i
                                        class="fas fa-file-import"></i>
                                    {{ __('msg.btn_import') }}</button>
                            </div>
                        </div>


                    </form>
                    <form action="" method="post" id="search-form">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control float-right" id="date_filter"
                                            name="date_filter" value="{{ date('d/m/Y') }} - {{ date('d/m/Y') }}">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" name="" id="" class="btn btn-info btn-block">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <table id="datatable"
                                class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>transferDate</th>
                                        <th>orgCopCode</th>
                                        <th>orgDivCode</th>
                                        <th>orgDepCode</th>
                                        <th>costCenter</th>
                                        <th>accountCode</th>
                                        <th>docNumber</th>
                                        <th>amtHour</th>
                                        <th>amtWage</th>
                                        <th>jvReference</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
