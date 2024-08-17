@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        var weeklySalesOptions = {
            series: [{
                name: 'Grip',
                data: @json($gripSales)
            }, {
                name: 'Shaft',
                data: @json($shaftSales)
            }],
            chart: {
                type: 'bar',
                height: 350,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            },
            yaxis: {
                title: {
                    text: 'Sales'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    }
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#weeklySalesChart"), weeklySalesOptions);
        chart.render();

        var purchasesPieOptions = {
            series: @json($purchases),
            chart: {
                height: 350,
                type: 'pie',
            },
            labels: [
                'Grip Purchases',
                'Shaft Purchases',
            ],
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    }
                }
            },
        };

        var chart = new ApexCharts(document.querySelector("#purchasesPie"), purchasesPieOptions);
        chart.render();
    </script>
@endpush

<x-layout>
    <h4 class="fw-bold py-3 mb-4">Dashboard</h4>
    <div class="row mb-lg-4">
        <div class="col-md-3">
            <div class="card my-2 my-md-0">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Total Users</span>
                    <h3 class="card-title mb-2">{{ number_format($users) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card my-2 my-md-0">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Grip Stocks</span>
                    <h3 class="card-title mb-2">{{ number_format($grips) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card my-2 my-md-0">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Shaft Stocks</span>
                    <h3 class="card-title mb-2">{{ number_format($shafts) }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card my-2 my-md-0">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Club Head Stocks</span>
                    <h3 class="card-title mb-2">{{ number_format(0) }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card my-2 my-lg-0">
                <h5 class="card-header m-0 pb-3">Weekly Sales</h5>
                <div id="weeklySalesChart" class="px-2"></div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card mb-2">
                <div class="card-body">
                    <span class="fw-semibold d-block mb-1">Sales Today</span>
                    <h3 class="card-title mb-2">Rp. {{ number_format($todaySales) }}</h3>
                </div>
            </div>
            <div class="card mt-3">
                <h5 class="card-header m-0 pb-3">Purchases</h5>
                <div id="purchasesPie" class="px-2"></div>
            </div>
        </div>
    </div>
</x-layout>
