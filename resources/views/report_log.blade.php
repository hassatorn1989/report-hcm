@extends('layouts.layout')
@section('title','Log Export')
@push('css')
<!-- Bootstrap4 Duallistbox -->
<link rel="stylesheet"
    href="{{ url('resources/assets') }}/plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
<link rel="stylesheet" href="{{ url('resources/assets') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
@endpush

@push('script')
<script>
    var lang = {
        title_add : '{{ __('msg.title_add_user') }}',
        title_edit : '{{ __('msg.title_edit_user') }}',
    }
</script>
<!-- Bootstrap4 Duallistbox -->
<script src="{{ url('resources/assets') }}/plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<script src="{{ url('resources/assets') }}/app/report_log.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Log Export</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">Log Export
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
                <h3 class="card-title">Log Export</h3>

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

                {{-- <form action="" id="search-form">
                    <div class="row mb-2">
                        <div class="col-md-5">
                            <div class="form-group">
                                <input type="text" class="form-control" name="filter_full_name" id="filter_full_name"
                                    placeholder="{{ __('msg.filter_full_name') }}" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="submit" name="" id="" class="btn btn-info btn-block">
                                <i class="fas fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}
                <table id="datatable"
                    class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="20%">Menu</th>
                            <th width="40%">Description</th>
                            <th width="20%">Date Time</th>
                            <th width="20%">User</th>
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

