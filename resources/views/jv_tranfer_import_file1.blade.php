@extends('layouts.layout')
@section('title',__('msg.menu_jv_tranfer_import_file1'))
@push('css')
<style>
 div.dt-top-container {
  display: grid;
  grid-template-columns: auto auto auto;
  right: 0;
}

div.dt-center-in-div {
  margin: 0 auto;
}

div.dt-filter-spacer {
  margin: 10px 0;
}
</style>
@endpush

@push('script')
<!-- bs-custom-file-input -->
<script src="{{ url('resources/assets') }}/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.2.2/jquery.form.js"></script>
<script src="{{ url('resources/assets') }}/app/jv_tranfer_import_file1.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('msg.menu_jv_tranfer_import_file1') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">{{ __('msg.menu_jv_tranfer_import_file1')}}
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
                <h3 class="card-title">{{ __('msg.menu_jv_tranfer_import_file1') }}</h3>
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
                <form action="{{ route('jv-tranfer.import-file1.store') }}" method="post" id="form"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="form-group row">
                        <label for="file_import" class="col-sm-2 col-form-label">AS400_EM.XLS</label>
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

                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill"
                                    href="#custom-content-below-home" role="tab"
                                    aria-controls="custom-content-below-home" aria-selected="true">Employee</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill"
                                    href="#custom-content-below-profile" role="tab"
                                    aria-controls="custom-content-below-profile" aria-selected="false">EmpRate</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="custom-content-below-tabContent">
                            <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel"
                                aria-labelledby="custom-content-below-home-tab">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table id="datatable1"
                                            class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th>orgCopCode</th>
                                                    <th>empCode</th>
                                                    <th>titleNameEN</th>
                                                    <th>firstNameEN</th>
                                                    <th>lastNameEN</th>
                                                    <th>titleNameTH</th>
                                                    <th>firstNameTH</th>
                                                    <th>lastNameTH</th>
                                                    <th>orgDivCode</th>
                                                    <th>orgDepCode</th>
                                                    <th>orgJobCode</th>
                                                    <th>orgLineCode</th>
                                                    <th>addressLine1</th>
                                                    <th>addressLine2</th>
                                                    <th>addressLine3</th>
                                                    <th>postCode</th>
                                                    <th>SSNO</th>
                                                    <th>IDCard</th>
                                                    <th>mobile</th>
                                                    <th>birthDate</th>
                                                    <th>dateFr</th>
                                                    <th>dateSt</th>
                                                    <th>dateEx</th>
                                                    <th>sex</th>
                                                    <th>empStatus</th>
                                                    <th>levelCode</th>
                                                    <th>positinCode</th>
                                                    <th>paymentBank</th>
                                                    <th>busRate</th>
                                                    <th>pregnantFlag</th>
                                                    <th>religion</th>
                                                    <th>nationality</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel"
                                aria-labelledby="custom-content-below-profile-tab">
                                <div class="row mt-3">
                                    <div class="col-md-12">
                                        <table id="datatable2"
                                            class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed"
                                            width="100%">
                                            <thead>
                                                <tr>
                                                    <th width="35%">orgCopCode</th>
                                                    <th width="35%">empCode</th>
                                                    <th width="35%">empRate</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
