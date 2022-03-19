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
            <div class="row">
                <div class="col-md-8">
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
                            <div class="row">
                                <div class="col-md-2 offset-md-10">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                        data-target="#modal-default">
                                        Launch
                                    </button>
                                </div>
                            </div>
                            <table id="datatable"
                                class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                                width="100%">
                                <thead>
                                    <tr>
                                        <th>Depart Name</th>
                                        <th>Depart Code</th>
                                        <th>Cost Center</th>
                                        <th>Account Code</th>
                                        <th>Hours Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
                <div class="col-md-4">
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
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
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
                <form action="{{ route('preparation.store') }}" method="post" id="form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="dateCalculate">Date</label>
                            <input type="date" class="form-control" name="dateCalculate" id="dateCalculate"
                                placeholder="{{ __('msg.placeholder') }}" value="{{ Request::get('dateCalculate') }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="orgDivCode">orgDivCode</label>
                            <input type="text" class="form-control" name="orgDivCode" id="orgDivCode"
                                placeholder="{{ __('msg.placeholder') }}" value="{{ Request::get('orgDivCode') }}" autocomplete="off" readonly>
                        </div>
                        <div class="form-group">
                            <label for="orgDepCode">orgDepCode</label>
                            <input type="text" class="form-control" name="orgDepCode" id="orgDepCode"
                                placeholder="{{ __('msg.placeholder') }}" value="{{ Request::get('orgDepCode') }}" autocomplete="off" readonly>
                        </div>
                        <div class="form-group">
                            <label for="costCenter">Cost Center</label>
                            <input type="text" class="form-control" name="costCenter" id="costCenter"
                                placeholder="{{ __('msg.placeholder') }}" value="" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="accountCode">Account Code</label>
                            <input type="text" class="form-control" name="accountCode" id="accountCode"
                                placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="hoursPrice">Hours Price</label>
                            <input type="number" class="form-control" name="hoursPrice" id="hoursPrice"
                                placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
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
