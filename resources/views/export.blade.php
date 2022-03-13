@extends('layouts.layout')
@section('title',__('msg.menu_export'))

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ url('resources/assets') }}/app/export.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('msg.menu_export') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">{{ __('msg.menu_export') }}
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
                <h3 class="card-title">{{ __('msg.menu_export') }}</h3>

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
                <dl class="row">
                    <dt class="col-sm-4">Export Tranfer Daily</dt>
                    <dd class="col-sm-8"><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-tranfer-daily">
                       <i class="fas fa-file-export"></i> {{ __('msg.btn_export') }}
                    </button></dd>
                    <dt class="col-sm-4">Export Accrue Daily</dt>
                    <dd class="col-sm-8"><!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-accrue-daily">
                       <i class="fas fa-file-export"></i> {{ __('msg.btn_export') }}
                    </button></dd>

                </dl>
            </div>
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@endsection

@section('modal')

<!-- Modal -->
<div class="modal fade" id="modal-tranfer-daily" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('export.tranfer-daily') }}" method="POST" id="form-tranfer-daily" target="_blank">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Export Tranfer Daily</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date_cal">Date</label>
                        <input type="text" class="form-control" name="date_export_tranfer_daily"
                            id="date_export_tranfer_daily" placeholder="dd/mm/yyyy" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id="btn_export_tranfer_daily"> <i
                            class="fas fa-file-export"></i> {{
                        __('msg.btn_export') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-accrue-daily" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="{{ route('export.accrue-daily') }}" method="POST" id="form-tranfer-daily" target="_blank">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Export Accrue Daily</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="date_cal">Date</label>
                        <input type="text" class="form-control" name="date_export_accrue_daily" id="date_export_accrue_daily"
                            placeholder="dd/mm/yyyy" autocomplete="off">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id="btn_export_accrue_daily"> <i class="fas fa-file-export"></i> {{
                        __('msg.btn_export') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
