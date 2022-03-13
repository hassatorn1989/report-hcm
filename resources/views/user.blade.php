@extends('layouts.layout')
@section('title',__('msg.menu_setting').' '.__('msg.menu_setting_user'))
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
<script src="{{ url('resources/assets') }}/app/user.js?q={{ time() }}"></script>
@endpush

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ __('msg.menu_setting') }} {{ __('msg.menu_setting_user') }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard.index') }}">{{ __('msg.menu_dashboard')
                                }}</a></li>
                        <li class="breadcrumb-item active">{{ __('msg.menu_setting') }} {{ __('msg.menu_setting_user')
                            }}
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
                <h3 class="card-title">{{ __('msg.menu_setting') }} {{ __('msg.menu_setting_user') }}</h3>

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

                <form action="" id="search-form">
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
                        <div class="col-md-2 offset-md-4">
                            <button type="button" class="btn btn-primary btn-block" data-toggle="modal"
                                data-target="#modal-default" onclick="add_data()">
                                <i class="fa fa-plus-circle" aria-hidden="true"></i> {{ __('msg.btn_add') }}
                            </button>
                        </div>
                    </div>
                </form>
                <table id="datatable"
                    class="table table-striped table-hover table-sm dt-responsive dataTable no-footer dtr-inline collapsed">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="40%">{{ __('msg.full_name') }}</th>
                            <th width="10%">{{ __('msg.user_role') }}</th>
                            <th width="10%">{{ __('msg.hr_role') }}</th>
                            <th width="30%">{{ __('msg.action') }}</th>
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
                    <div class="form-group">
                        <label for="empCode">{{ __('msg.emp_code') }}</label>
                        <input type="hidden" name="id" name="id">
                        <input type="text" name="empCode" id="empCode" class="form-control"
                            placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user_name">{{ __('msg.user_name') }}</label>
                        <input type="text" name="user_name" id="user_name" class="form-control"
                            placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="user_last">{{ __('msg.user_last') }}</label>
                        <input type="text" name="user_last" id="user_last" class="form-control"
                            placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="username">{{ __('msg.username') }}</label>
                        <input type="text" name="username" id="username" class="form-control"
                            placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                    </div>
                    <div class="form-group">
                        <label for="password">{{ __('msg.password') }}</label>
                        <input type="password" name="password" id="password" class="form-control"
                            placeholder="{{ __('msg.placeholder') }}" autocomplete="off">
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="user_role" name="user_role" value="yes">
                            <label for="user_role">
                                Admin Role
                            </label>
                        </div>
                    </div>
                    <div class="form-group clearfix">
                        <div class="icheck-primary d-inline">
                            <input type="checkbox" id="hr_role" name="hr_role" value="yes">
                            <label for="hr_role">
                                HR Role
                            </label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id="btn_save"> <i class="fas fa-save"></i> {{
                        __('msg.btn_save') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> {{ __('msg.btn_close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-user-role" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <form action="{{ route('user.store-role') }}" method="post" id="form-user-role">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">{{ __('msg.btn_manage_role') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="role-list">
                    <input type="hidden" name="user_id" id="user_id">
                    @foreach ($menu as $item)
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label>{!! $item->menu_icon !!} {{ $item->menu_name }}</label>
                                <select class="duallistbox" multiple="multiple" id="menu_{{ $item->id }}" name="menu[]">
                                </select>
                            </div>
                            <!-- /.form-group -->
                        </div>
                        <!-- /.col -->
                    </div>
                    @endforeach

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" id="btn_save_user_role"> <i class="fas fa-save"></i> {{
                        __('msg.btn_save') }}</button>
                    <button type="button" class="btn btn-danger" data-dismiss="modal"><i
                            class="fas fa-times-circle"></i> {{
                        __('msg.btn_close') }}</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
