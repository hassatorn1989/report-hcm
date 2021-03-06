@extends('layouts.layout')
@section('title', __('msg.menu_mapaccount_import'))
@push('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/select2/css/select2.min.css">
    <link rel="stylesheet"
        href="{{ url('resources/assets') }}/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
@endpush

@push('script')
    <!-- bs-custom-file-input -->
    <script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- Select2 -->
    <script src="{{ url('resources/assets') }}/plugins/select2/js/select2.full.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
    <script>
        var lang = {
            title_add: '{{ __('msg.title_add_mapaccount') }}',
            title_edit: '{{ __('msg.title_edit_mapaccount') }}',
        }
    </script>
    <script src="{{ url('resources/assets') }}/app/jv_mapaccount_import.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_mapaccount_import') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a
                                    href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard') }}</a>
                            </li>
                            <li class="breadcrumb-item active">{{ __('msg.menu_mapaccount_import') }}
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
                    <h3 class="card-title">{{ __('msg.menu_mapaccount_import') }}</h3>
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
                    <div class="row mb-3">
                        <div class="form-group col-md-3">
                            {{-- <label for="OrgUnit">Dep Name</label> --}}
                            <select class="custom-select select2bs4" name="filter_OrgUnit" id="filter_OrgUnit">
                                <option value=""> --Department All--</option>
                                @if (!empty($OrgUnit))
                                    @foreach ($OrgUnit as $item)
                                        <option value="{{ $item->orgDivCode }}-{{ $item->orgDepCode }}">
                                            {{ $item->orgDivCode }}-{{ $item->orgDepCode }}
                                            {{ $item->orgUnitNameEN }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        {{-- <div class="form-group col-md-3">
                                <select class="custom-select select2bs4" name="filter_orgDivCode" id="filter_orgDivCode">
                                    <option value="">{{ __('msg.select') }}</option>
                                    @if (!empty($orgdiv))
                                        @foreach ($orgdiv as $item)
                                            <option value="{{ $item->orgDivCode }}">
                                                {{ $item->orgDivCode }}-{{ $item->orgUnitNameEN }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            {{-- <div class="form-group col-md-3">
                                <select class="custom-select select2bs4" name="filter_orgDepCode" id="filter_orgDepCode">
                                    <option value="">{{ __('msg.select') }}</option>
                                    @if (!empty($orgdep))
                                        @foreach ($orgdep as $item)
                                            <option value="{{ $item->orgDepCode }}">
                                                {{ $item->orgDepCode }}-{{ $item->orgUnitNameEN }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="col-md-1">
                                <button type="submit" name="" id="" class="btn btn-info btn-block">
                                    <i class="fas fa-search" aria-hidden="true"></i>
                                </button>
                            </div>
                        <div class="col-md-2 offset-md-6">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#modal-default" onclick="add_data()">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('msg.btn_add') }}
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
                                        {{-- <th>orgCopCode</th> --}}
                                        <th>orgDivCode</th>
                                        <th>orgDepCode</th>
                                        <th>orgJobCode</th>
                                        {{-- <th>orgLineCode</th> --}}
                                        <th>accountType</th>
                                        <th>accountTypeName</th>
                                        <th>company</th>
                                        <th>costCenter</th>
                                        <th>accountCode</th>
                                        {{-- <th>JDEcostCenter</th>
                                        <th>JDEaccountCode</th> --}}
                                        <th>ioNumber</th>
                                        <th>Action</th>
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

@section('modal')
    <!-- Modal -->
    <div class="modal fade" id="modal-default" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="" method="post" id="form">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="OrgUnit">Department</label>
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
                            {{-- <div class="form-group col-md-6">
                                <label for="orgDivCode">orgDivCode</label>
                                <select class="custom-select select2bs4" name="orgDivCode" id="orgDivCode">
                                    <option value="">{{ __('msg.select') }}</option>
                                    @if (!empty($orgdiv))
                                        @foreach ($orgdiv as $item)
                                            <option value="{{ $item->orgDivCode }}">
                                                {{ $item->orgDivCode }}-{{ $item->orgUnitNameEN }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="orgDepCode">orgDepCode</label>
                                <select class="custom-select select2bs4" name="orgDepCode" id="orgDepCode">
                                    <option value="">{{ __('msg.select') }}</option>
                                    @if (!empty($orgdep))
                                        @foreach ($orgdep as $item)
                                            <option value="{{ $item->orgDepCode }}">
                                                {{ $item->orgDepCode }}-{{ $item->orgUnitNameEN }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="orgJobCode">orgJobCode</label>
                                <input type="text" name="orgJobCode" id="orgJobCode" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="6">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="orgLineCode">orgLineCode</label>
                                <input type="text" name="orgLineCode" id="orgLineCode" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="6">
                            </div> --}}
                            {{-- <div class="form-group col-md-6">
                                <label for="accountType">accountType</label>
                                <input type="text" name="accountType" id="accountType" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="6">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="accountTypeName">accountTypeName</label>
                                <select class="form-control" name="accountTypeName" id="accountTypeName">
                                    <option value="">{{ __('msg.select') }}</option>
                                    <option value="R-Regular">R-Regular</option>
                                    <option value="O-Overtime">O-Overtime</option>
                                    <option value="RT-Transfer">RT-Transfer</option>
                                    <option value="OT-Transfer">OT-Transfer</option>
                                    <option value="I-Incentive">I-Incentive</option>
                                    <option value="HVAC-Vacation">HVAC-Vacation</option>
                                    <option value="HHOL-Holiday">HHOL-Holiday</option>
                                    <option value="HHOL-Holiday">HHOL-Holiday</option>
                                    <option value="HGPN-Business leave">HGPN-Business leave</option>
                                    <option value="HOTH-Other leave">HOTH-Other leave</option>
                                </select>
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="company">company</label>
                                <input type="text" name="company" id="company" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="4">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="costCenter">costCenter</label>
                                <input type="text" name="costCenter" id="costCenter" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="10">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="accountCode">accountCode</label>
                                <input type="text" name="accountCode" id="accountCode" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="13">
                            </div>
                            {{-- <div class="form-group col-md-6">
                                <label for="JDEcostCenter">JDEcostCenter</label>
                                <input type="text" name="JDEcostCenter" id="JDEcostCenter" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="10">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="JDEaccountCode">JDEaccountCode</label>
                                <input type="text" name="JDEaccountCode" id="JDEaccountCode" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="13">
                            </div> --}}
                            <div class="form-group col-md-6">
                                <label for="ioNumber">ioNumber</label>
                                <input type="text" name="ioNumber" id="ioNumber" class="form-control"
                                    placeholder="{{ __('msg.placeholder') }}" autocomplete="off" maxlength="12">
                            </div>
                        </div>
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
