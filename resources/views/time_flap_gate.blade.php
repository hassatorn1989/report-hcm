@extends('layouts.layout')
@section('title', __('msg.menu_time_flap_gate'))
@push('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="{{ url('resources/assets') }}/app/time_flap_gate.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_time_flap_gate') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('msg.menu_time_flap_gate') }}
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
                    <h3 class="card-title">{{ __('msg.menu_time_flap_gate') }} {{ __('msg.menu_report') }}</h3>

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
                            Calculate Success!!
                        </div>
                    @endif
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
                                            name="date_filter" value="{{ date('d/m/Y') }}">
                                    </div>
                                    <!-- /.input group -->
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" name="" id="" class="btn btn-info btn-block">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-md-2 offset-md-6">
                                {{-- <button type="button" class="btn btn-info btn-block" id="btn_process" data-toggle="modal"
                                data-target="#modal-default"> <i class="fas fa-calculator"></i> Calculate</button> --}}
                            </div>
                        </div>
                    </form>
                    <table class="table table-sm" id="datatable">
                        <thead>
                            <tr>
                            <tr>
                                <th>EmpID</th>
                                <th>DateTime</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>MachineNo</th>
                                <th>MachineType</th>
                                <th>InOut</th>
                                <th>IsError</th>
                                <th>IsInterface</th>
                            </tr>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-footer-->
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('jv-tranfer.report-accrue-daily-process') }}" method="POST" id="form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Calculate</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="date_cal">Date</label>
                            <input type="text" class="form-control" name="date_calculate" id="date_calculate"
                                placeholder="dd/mm/yyyy" autocomplete="off">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" id="btn_save"> <i class="fas fa-save"></i>
                            {{                             __('msg.btn_save') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
