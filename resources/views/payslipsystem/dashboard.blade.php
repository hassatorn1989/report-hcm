@extends('layouts.layout-payslip')

@push('css')
@endpush

@push('script')
    <script src="{{ url('resources/assets') }}/payslipsystem-app/dashboard.js?q={{ time() }}"></script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0"> &nbsp; </h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">&nbsp;</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('payslip.slip.print2') }}" method="post" id="form">
                                    @csrf
                                    <div class="row">
                                        <div class="col-md-4 offset-md-4" style="text-align: center">
                                            <h1>Welcome</h1>
                                            {{ Auth::guard('payslip')->user()->full_name_en }}
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mt-5">
                                        <div class="col-md-4 offset-md-4">
                                            <div class="form-group">
                                                <label for="pay_date">Pay date</label>
                                                <select class="custom-select" name="pay_date" id="pay_date">
                                                    <option value="">{{ __('msg.select') }}</option>
                                                    @if (count($payslip) > 0)
                                                        @foreach ($payslip as $item)
                                                            <option value="{{ $item->PayDate }}">
                                                                {{ date('d/m/Y', strtotime($item->PayDate)) }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 offset-md-4">
                                            <button type="submit" name="btn_print" id="btn_print"
                                                class="btn btn-primary btn-lg btn-block"> <i class="fas fa-print"></i>
                                                Print</button>
                                        </div>
                                    </div>
                                </form>
                                <br>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
@endsection
