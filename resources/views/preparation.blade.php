@extends('layouts.layout')
@section('title', __('msg.menu_print_slip'))
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ url('resources/assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
    <!-- bs-custom-file-input -->
    <script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <!-- Select2 -->
    <script src="{{ url('resources/assets') }}/plugins/select2/js/select2.full.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        var lang = {
            placeholder: '{{ __('msg.placeholder') }}'
        }
    </script>
    <script src="{{ url('resources/assets') }}/app/preparation.js?q={{ time() }}"></script>
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
                                        <input type="text" class="form-control datecal" name="filter_dateCalculate"
                                            id="filter_dateCalculate" placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <select class="custom-select select2bs4" name="filter_OrgUnit" id="filter_OrgUnit">
                                        <option value="">--Dep Name All --</option>
                                        @if (!empty($OrgUnit))
                                            @foreach ($OrgUnit as $item)
                                                <option value="{{ $item->orgDivCode }}-{{ $item->orgDepCode }}">
                                                    {{ $item->orgUnitNameEN }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <button type="submit" class="btn btn-info btn-block">
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                            <div class="col-md-2 offset-md-3">
                                {{-- onclick="add_data();" --}}
                                <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                    data-target="#modal-default" id="btn_add">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('msg.btn_add') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    <table id="datatable"
                        class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                        width="100%">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Div Name</th>
                                <th>Dep Name</th>
                                <th>Dep Code</th>
                                <th>ชั่วโมง (ปกติ)</th>
                                <th>ชั่วโมง (OT)</th>
                                <th>ชั่วโมงย้าย (ปกติ)</th>
                                <th>ชั่วโมงย้าย (OT)</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </section>
        <!-- /.content -->
    </div>
@endsection


@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal-default" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="{{ route('preparation.store') }}" method="post" id="form">
                    @csrf
                    <input type="hidden" name="type" id="type">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateCalculate">Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datecal" name="dateCalculate"
                                            id="dateCalculate" placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="OrgUnit">Dep Name</label>
                                    <select class="custom-select select2bs4" name="OrgUnit" id="OrgUnit">
                                        <option value="">{{ __('msg.select') }}</option>
                                        @if (!empty($OrgUnit))
                                            @foreach ($OrgUnit as $item)
                                                <option value="{{ $item->orgDivCode }}-{{ $item->orgDepCode }}">
                                                    {{ $item->orgDivCode }}-{{ $item->orgDepCode }}
                                                    {{ $item->orgUnitNameEN }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-9">
                                {{-- onclick="add_row()" --}}
                                <button type="button" class="btn btn-primary btn-block" id="btn_add_row"> <i
                                        class="fa fa-plus-circle" aria-hidden="true"></i>
                                    {{ __('msg.btn_add_row') }}</button>
                            </div>
                        </div>

                        <table class="table" id="table_detail">
                            <thead>
                                <tr>
                                    <th>Dep Name</th>
                                    <th>costCenter</th>
                                    <th>accountCode</th>
                                    <th>hoursPrice</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="0">
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control costCenter" name="costCenter[0]"
                                                id="costCenter_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control accountCode" name="accountCode[0]"
                                                id="accountCode_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control hoursPrice" name="hoursPrice[0]"
                                                id="hoursPrice_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" id="btn_save"> <i class="fas fa-save"></i>
                            {{ __('msg.btn_save') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-default-update" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <form action="{{ route('preparation.store') }}" method="post" id="form-update">
                    @csrf
                    <input type="hidden" name="type" id="type">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="dateCalculate">Date</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="text" class="form-control datecal" name="dateCalculate"
                                            id="dateCalculate" placeholder="dd/mm/yyyy" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="OrgUnit">Dep Name</label>
                                    <select class="custom-select select2bs4" name="OrgUnit" id="OrgUnit">
                                        <option value="">{{ __('msg.select') }}</option>
                                        @if (!empty($OrgUnit))
                                            @foreach ($OrgUnit as $item)
                                                <option value="{{ $item->orgDivCode }}-{{ $item->orgDepCode }}">
                                                    {{ $item->orgDivCode }}-{{ $item->orgDepCode }}
                                                    {{ $item->orgUnitNameEN }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-md-3 offset-md-9">
                                {{-- onclick="add_row()" --}}
                                <button type="button" class="btn btn-primary btn-block" id="btn_add_row"> <i
                                        class="fa fa-plus-circle" aria-hidden="true"></i>
                                    {{ __('msg.btn_add_row') }}</button>
                            </div>
                        </div>

                        <table class="table" id="table_detail_update">
                            <thead>
                                <tr>
                                    <th>Dep Name</th>
                                    <th>costCenter</th>
                                    <th>accountCode</th>
                                    <th>hoursPrice</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr id="0">
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control costCenter" name="costCenter[0]"
                                                id="costCenter_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="text" class="form-control accountCode" name="accountCode[0]"
                                                id="accountCode_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <input type="number" class="form-control hoursPrice" name="hoursPrice[0]"
                                                id="hoursPrice_0" placeholder="{{ __('msg.placeholder') }}" value=""
                                                autocomplete="off">
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info" id="btn_save"> <i class="fas fa-save"></i>
                            {{ __('msg.btn_save') }}</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                                class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
