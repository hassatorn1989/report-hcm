@extends('layouts.layout')
@section('title',__('msg.menu_time_working_record'))

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ url('resources/assets') }}/app/export_time_working_record.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('msg.menu_time_working_record') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">{{ __('msg.menu_time_working_record') }}
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
                <h3 class="card-title">{{ __('msg.menu_time_working_record') }}</h3>

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
                <form action="{{ route('export.export-time-working-record') }}" method="POST" id="form-tranfer-daily"
                    target="_blank">
                    @csrf
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
                                    <input type="text" class="form-control float-right" id="date_filter" name="date_filter"
                                        value="{{ date('d/m/Y') }}">
                                </div>
                                <!-- /.input group -->
                            </div>
                        </div>
                        {{-- <div class="col-md-1">
                            <button type="submit" name="" id="" class="btn btn-info btn-block">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </div> --}}
                        <div class="col-md-2 offset-md-7">
                             <button type="submit" class="btn btn-info btn-block" id="btn_export_accrue_daily"> <i
                                    class="fas fa-file-export"></i> {{
                                __('msg.btn_export') }}</button>
                        </div>
                    </div>
                </form>
                </form>
                <table
                    class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                    width="100%" id="datatable">
                    <thead>
                        <tr>
                            <th>SCO</th>
                            <th>SID</th>
                            <th>SDTE</th>
                            <th>STME</th>
                            <th>SMNO</th>
                            <th>STY</th>
                            <th>SFAG</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection

@section('modal')


<!-- Modal -->
<div class="modal fade" id="modal-accrue-daily" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('export.export-accrue-daily') }}" method="POST" id="form-tranfer-daily"
                target="_blank">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Export Accrue Daily</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date_cal">Date Post</label>
                        <input type="text" class="form-control" name="date_post" id="date_post" placeholder="dd/mm/yyyy"
                            autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="date_cal">Date</label>
                        <input type="text" class="form-control" name="date_export_accrue_daily"
                            id="date_export_accrue_daily" placeholder="dd/mm/yyyy" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id="btn_export_accrue_daily"> <i
                            class="fas fa-file-export"></i> {{
                        __('msg.btn_export') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
