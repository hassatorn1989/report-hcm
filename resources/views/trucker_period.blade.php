@extends('layouts.layout')
@section('title', __('msg.menu_trucker_period'))
@push('css')
@endpush

@push('script')
    <!-- bs-custom-file-input -->
    <script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script src="{{ url('resources/assets') }}/app/trucker_period.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_trucker_period') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('msg.menu_trucker_period') }}
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
                    <h3 class="card-title">{{ __('msg.menu_trucker_period') }}</h3>
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
                    <form action="{{ route('trucker.trucker-period.store') }}" method="post" id="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="file_import" class="col-sm-2 col-form-label">TRUCKER_PERIOD.XLS</label>
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
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="custom-select select_filter_period" name="filter_year" id="filter_year">
                                        <option value="">{{ __('msg.year_all') }}</option>
                                        @if (!empty($year))
                                            @foreach ($year as $item)
                                                <option value="{{ $item->year }}">{{ $item->year }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="custom-select select_filter_period" name="filter_period"
                                        id="filter_period">
                                        <option value="">{{ __('msg.period_all') }}</option>
                                        @if (!empty($period))
                                            @foreach ($period as $item)
                                                <option value="{{ $item->period }}">{{ $item->period }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="custom-select select_filter_period" name="filter_round"
                                        id="filter_round">
                                        <option value="">{{ __('msg.round_all') }}</option>
                                        @if (!empty($round))
                                            @foreach ($round as $item)
                                                <option value="{{ $item->round }}">{{ $item->round }}</option>
                                            @endforeach
                                        @endif
                                    </select>
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
                                        <th>year</th>
                                        <th>period</th>
                                        <th>round</th>
                                        <th>routing</th>
                                        <th>trucker</th>
                                        <th>drivingStart</th>
                                        <th>drivingEnd</th>
                                        <th>drivingDay</th>
                                        <th>truckerPayDate</th>
                                        <th>truckerPayAmt</th>
                                        <th>truckerAccount</th>
                                        <th>vendorNo</th>
                                        <th>invoiceNo</th>
                                        <th>isActive</th>
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
