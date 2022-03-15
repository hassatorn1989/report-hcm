@extends('layouts.layout')
@section('title', __('msg.menu_dashboard'))

@push('css')
@endpush

@push('script')
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/highcharts.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/highcharts-more.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/modules/solid-gauge.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/modules/accessibility.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/modules/series-label.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/modules/exporting.js"></script>
    <script src="{{ url('resources/assets') }}/plugins/Highcharts-10.0.0/modules/export-data.js"></script>

    <script type="text/javascript">
        var gaugeOptions = {
            chart: {
                type: 'solidgauge',
                style: {
                    fontFamily: 'Kanit'
                }
            },

            title: {
                text: 'Avg. Attendance Rate'
            },
            subtitle: {
                text: 'Target > 90%'
            },

            pane: {
                center: ['50%', '85%'],
                size: '140%',
                startAngle: -90,
                endAngle: 90,
                background: {
                    backgroundColor: Highcharts.defaultOptions.legend.backgroundColor || '#EEE',
                    innerRadius: '60%',
                    outerRadius: '100%',
                    shape: 'arc'
                }
            },

            exporting: {
                enabled: false
            },

            tooltip: {
                enabled: false
            },

            // the value axis
            yAxis: {
                stops: [
                    [0.1, '#55BF3B'], // green
                    [0.5, '#DDDF0D'], // yellow
                    [0.9, '#DF5353'] // red
                ],
                lineWidth: 0,
                tickWidth: 0,
                minorTickInterval: null,
                tickAmount: 2,
                title: {
                    y: -70
                },
                labels: {
                    y: 16
                }
            },

            plotOptions: {
                solidgauge: {
                    dataLabels: {
                        y: 5,
                        borderWidth: 0,
                        useHTML: true
                    }
                }
            }
        };

        // The speed gauge
        var chartSpeed = Highcharts.chart('container-speed', Highcharts.merge(gaugeOptions, {

            yAxis: {
                min: 0,
                max: 90,
                // title: {
                //     text: 'Speed'
                // }
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Speed',
                data: [{{ $q2->qty }}],
                dataLabels: {
                    format: '<div style="text-align:center">' +
                        '<span style="font-size:25px">{y}</span><br/>' +
                        '<span style="font-size:12px;opacity:0.4">%</span>' +
                        '</div>'
                },
                tooltip: {
                    valueSuffix: ' %'
                }
            }]

        }));

        Highcharts.chart('container', {

            title: {
                text: 'OLE The Last 7 Day'
            },
            chart: {
                // type: 'solidgauge',
                style: {
                    fontFamily: 'Kanit'
                }
            },

            yAxis: {
                title: {
                    text: 'Number of Employee'
                }
            },

            xAxis: {
                categories: [
                    @foreach ($q4 as $item)
                        ' {{ date('d/m/Y', strtotime($item->dateIn)) }}',
                    @endforeach
                ],
            },

            credits: {
                enabled: false
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            series: [{
                name: 'Empoyee',
                data: [
                    @foreach ($q4 as $item)
                        {{ $item->empCode }},
                    @endforeach
                ]
            }],

            responsive: {
                rules: [{
                    condition: {
                        maxWidth: 500
                    },
                    chartOptions: {
                        legend: {
                            layout: 'horizontal',
                            align: 'center',
                            verticalAlign: 'bottom'
                        }
                    }
                }]
            }

        });

        Highcharts.chart('container2', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Attendance By Division'
            },
            xAxis: {
                categories: [
                    @foreach ($q3 as $item)
                        '{{ $item->orgUnitNameEN }}',
                    @endforeach
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y : .0f}</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Unit Name',
                data: [
                     @foreach ($q3 as $item)
                        {{ $item->percen }},
                    @endforeach
                ]

            }]
        });


        Highcharts.chart('container3', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'OLE The Last 7 Day By Division'
            },
            xAxis: {
                categories: [
                    'Jan',
                    'Feb',
                    'Mar',
                    'Apr',
                    'May',
                    'Jun',
                    'Jul',
                    'Aug',
                    'Sep',
                    'Oct',
                    'Nov',
                    'Dec'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Tokyo',
                data: [49.9, 71.5, 106.4, 129.2, 144.0, 176.0, 135.6, 148.5, 216.4, 194.1, 95.6, 54.4]

            }]
        });
    </script>
@endpush

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>{{ __('msg.menu_dashboard') }}</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">{{ __('msg.menu_dashboard') }}
                            </li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>


        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Attendance</h3>

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
                                <div class="col-md-4">
                                    <div class="info-box">

                                        <span class="info-box-icon bg-info"><i class="fa fa-user"
                                                aria-hidden="true"></i></span>
                                        <div class="info-box-content">
                                            <span class="info-box-number">{{ $q1->qtyEmp }} people</span>
                                            <span class="info-box-text">Date {{ date('d.m.Y') }}</span>
                                        </div>

                                    </div>
                                    <div id="container-speed" class="chart-container"></div>
                                </div>
                                <div class="col-md-8">
                                    <div id="container2" style="height: 500px"></div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>


            <div class="row">
                <div class="col-md-12">
                    <!-- Default box -->
                    <div class="card card-navy">
                        <div class="card-header">
                            <h3 class="card-title">Overall Labor Effectiveness (OLE)</h3>

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
                                <div class="col-md-6">
                                    <div id="container" style="height: 500px"></div>
                                </div>
                                <div class="col-md-6">
                                    <div id="container3" style="height: 500px"></div>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-footer-->
                    </div>
                </div>
            </div>
            <!-- /.card -->

        </section>
        <!-- /.content -->
    </div>
@endsection
