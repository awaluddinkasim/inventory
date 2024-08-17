@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endpush

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        var monthlySalesOptions = {
            series: [{
                name: 'Grip',
                data: @json($gripSales)
            }, {
                name: 'Shaft',
                data: @json($shaftSales)
            }],
            chart: {
                type: 'bar',
                height: 300,
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
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
            },
            yaxis: {
                title: {
                    text: 'Sales'
                },
                labels: {
                    formatter: (val) => {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    },
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
        var chart = new ApexCharts(document.querySelector("#monthlySalesChart"), monthlySalesOptions);
        chart.render();

        var monthlyPurchasesOptions = {
            series: [{
                name: 'Grip',
                data: @json($gripPurchases)
            }, {
                name: 'Shaft',
                data: @json($shaftPurchases)
            }],
            chart: {
                type: 'bar',
                height: 300,
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
                categories: [
                    'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'
                ],
            },
            yaxis: {
                title: {
                    text: 'Purchases'
                },
                labels: {
                    formatter: (val) => {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    },
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
        var chart = new ApexCharts(document.querySelector("#monthlyPurchasesChart"), monthlyPurchasesOptions);
        chart.render();

        var cumulativeSalesOptions = {
            series: [{
                    name: 'Grip',
                    data: @json(array_values($cumulativeGripSales))
                },
                {
                    name: 'Shaft',
                    data: @json(array_values($cumulativeShaftSales))
                }
            ],
            chart: {
                height: 300,
                type: 'area',
                toolbar: {
                    show: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth'
            },
            xaxis: {
                categories: @json(array_keys($cumulativeGripSales))
            },
            yaxis: {
                labels: {
                    formatter: (val) => {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    },
                }
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp. " + val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")
                    }
                }
            },
        };

        var cumulativeSales = new ApexCharts(document.querySelector("#cumulativeSales"), cumulativeSalesOptions);
        cumulativeSales.render();

        var gripStocksOptions = {
            series: [{
                name: 'Stock',
                data: @json(array_values($gripStocks))
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
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json(array_keys($gripStocks)),
            }
        };

        var gripStocksChart = new ApexCharts(document.querySelector("#gripStocksChart"), gripStocksOptions);
        gripStocksChart.render();

        var shaftStocksOptions = {
            series: [{
                name: 'Stock',
                data: @json(array_values($shaftStocks))
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
                    borderRadius: 4,
                    borderRadiusApplication: 'end',
                    horizontal: true,
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                categories: @json(array_keys($shaftStocks)),
            }
        };

        var shaftStocksChart = new ApexCharts(document.querySelector("#shaftStocksChart"), shaftStocksOptions);
        shaftStocksChart.render();
    </script>
@endpush

<x-layout title="Reports">
    <div class="row">
        <div class="col-lg-7">
            <div class="card my-2">
                <h5 class="card-header m-0 pb-3">Monthly Sales</h5>
                <div id="monthlySalesChart" class="px-2"></div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card my-2">
                <h5 class="card-header m-0 pb-3">Cumulative Sales</h5>
                <div id="cumulativeSales" class="px-2"></div>
            </div>
        </div>
    </div>
    <div class="card my-2">
        <h5 class="card-header m-0 pb-3">Monthly Purchases</h5>
        <div id="monthlyPurchasesChart" class="px-2"></div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card my-2">
                <h5 class="card-header m-0 pb-3">Lowest Grip Stocks</h5>
                <div id="gripStocksChart" class="px-2"></div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card my-2">
                <h5 class="card-header m-0 pb-3">Lowest Shaft Stocks</h5>
                <div id="shaftStocksChart" class="px-2"></div>
            </div>
        </div>
    </div>
</x-layout>
