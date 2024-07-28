@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        const topGripModelsChartEl = document.querySelector('#topGripModelsChart');
        const cumulativeStockChartEl = document.querySelector('#cumulativeStockChart');

        topGripModelsChartOptions = {
            series: [{
                name: 'Total',
                data: {!! json_encode($topGripModels->pluck('total_stock')) !!}
            }, ],
            chart: {
                height: 300,
                stacked: true,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    borderRadius: 12,
                    startingShape: 'rounded',
                    endingShape: 'rounded'
                }
            },
            colors: [config.colors.primary],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 6,
                lineCap: 'round',
                colors: [config.colors.white]
            },
            legend: {
                show: true,
                horizontalAlign: 'left',
                position: 'top',
                markers: {
                    height: 8,
                    width: 8,
                    radius: 12,
                    offsetX: -3
                },
                labels: {
                    colors: config.colors.axisColor
                },
                itemMargin: {
                    horizontal: 10
                }
            },
            grid: {
                borderColor: config.colors.borderColor,
                padding: {
                    top: 0,
                    bottom: -8,
                    left: 20,
                    right: 20
                }
            },
            xaxis: {
                categories: {!! json_encode($topGripModels->pluck('name')) !!},
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: config.colors.axisColor
                    }
                },
                axisTicks: {
                    show: false
                },
                axisBorder: {
                    show: false
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '13px',
                        colors: config.colors.axisColor
                    }
                }
            },
            states: {
                hover: {
                    filter: {
                        type: 'none'
                    }
                },
                active: {
                    filter: {
                        type: 'none'
                    }
                }
            }
        };

        const topGripModelsChart = new ApexCharts(topGripModelsChartEl, topGripModelsChartOptions);
        topGripModelsChart.render();


        cumulativeStockChartConfig = {
            series: [{
                name: 'Stock',
                data: {!! json_encode($cumulativeStock['data']) !!}
            }],
            chart: {
                height: 298,
                parentHeightOffset: 0,
                parentWidthOffset: 0,
                toolbar: {
                    show: false
                },
                type: 'area'
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            legend: {
                show: false
            },
            markers: {
                size: 6,
                colors: 'transparent',
                strokeColors: 'transparent',
                strokeWidth: 4,
                discrete: [{
                    fillColor: config.colors.white,
                    seriesIndex: 0,
                    dataPointIndex: {{ count($cumulativeStock['data']) - 1 }},
                    strokeColor: config.colors.primary,
                    strokeWidth: 2,
                    size: 6,
                    radius: 8
                }],
                hover: {
                    size: 7
                }
            },
            colors: [config.colors.primary],
            fill: {
                type: 'gradient',
                gradient: {
                    shade: config.colors.shadeColor,
                    shadeIntensity: 0.6,
                    opacityFrom: 0.5,
                    opacityTo: 0.25,
                    stops: [0, 95, 100]
                }
            },
            grid: {
                borderColor: config.colors.borderColor,
                strokeDashArray: 3,
                padding: {
                    top: -20,
                    bottom: -8,
                    left: -10,
                    right: 8
                }
            },
            xaxis: {
                categories: {!! json_encode($cumulativeStock['labels']) !!},
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                },
                labels: {
                    show: true,
                    style: {
                        fontSize: '13px',
                        colors: config.colors.axisColor
                    }
                }
            },
            yaxis: {
                labels: {
                    show: false
                },
                tickAmount: 4
            }
        };

        const cumulativeStockChart = new ApexCharts(cumulativeStockChartEl, cumulativeStockChartConfig);
        cumulativeStockChart.render();
    </script>
@endpush

<x-layout>
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>
    <div class="row mb-3">
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Total Users</span>
                    <h3 class="card-title mb-2">{{ number_format($users) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Grip Types</span>
                    <h3 class="card-title mb-2">{{ number_format($totalGripTypes) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Grip Models</span>
                    <h3 class="card-title mb-2">{{ number_format($totalGripModels) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Grips</span>
                    <h3 class="card-title mb-2">{{ number_format($totalGrips) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <h5 class="card-header m-0 pb-3">Top 5 Grip Models Stock</h5>
                <div id="topGripModelsChart" class="px-2"></div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card pb-3">
                <h5 class="card-header m-0 pb-3">6-Month Cumulative Grip Stock</h5>
                <div id="cumulativeStockChart"></div>
            </div>
        </div>
    </div>
</x-layout>
