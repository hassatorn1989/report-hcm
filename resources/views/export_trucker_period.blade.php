@extends('layouts.layout')
@section('title',__('msg.menu_export_trucker_period'))

@push('css')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('script')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="{{ url('resources/assets') }}/app/export_trucker_period.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('msg.menu_export_trucker_period') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">{{ __('msg.menu_export_trucker_period') }}
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
                <h3 class="card-title">{{ __('msg.menu_export_trucker_period') }}</h3>

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
                <form action="{{ route('export.export-trucker-period') }}" method="POST" id="form-tranfer-daily"
                    target="_blank">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="date_export"
                                        id="date_export_accrue_daily" placeholder="dd/mm/yyyy" autocomplete="off">
                                </div>

                            </div>
                        </div> --}}
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
                                <select class="custom-select select_filter_period" name="filter_period" id="filter_period">
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
                                <select class="custom-select select_filter_period" name="filter_round" id="filter_round">
                                    <option value="">{{ __('msg.round_all') }}</option>
                                    @if (!empty($round))
                                    @foreach ($round as $item)
                                    <option value="{{ $item->round }}">{{ $item->round }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="date_post" id="date_post"
                                        placeholder="dd/mm/yyyy" autocomplete="off">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 offset-md-2">
                            <button type="submit" class="btn btn-info btn-block" id="btn_export_accrue_daily"> <i
                                    class="fas fa-file-export"></i> {{
                                __('msg.btn_export') }}</button>
                        </div>
                    </div>
                </form>
                <table
                    class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                    width="100%" id="datatable">
                    <thead>
                        <tr>
                            <th>Index</th>
                            <th>Comp. Code</th>
                            <th>Reference No.</th>
                            <th>Doc. Type</th>
                            <th>Header Text</th>
                            <th>Doc. Date</th>
                            <th>PostingDate</th>

                            <th>Posting Key</th>
                            <th>Account No.</th>
                            <th>Vendor</th>

                            <th>Trn Currency</th>
                            <th>Trn. Amt</th>
                            <th>D/C Ind.</th>
                            {{-- <th>Internal Order</th> --}}
                            <th>Cost Ctr.</th>
                            <th>Business Place</th>
                            <th>WHT Type</th>
                            <th>WHT Code</th>
                            <th>W/Tax Base Amt in DC</th>
                            <th>Assignment</th>
                            <th>Line Item Text</th>
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
