@extends('layouts.admin')

@section('title')
    Thống kê kinh doanh
@endsection

@section('style-plugins')
    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/apex/custom-apexcharts.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/apex/custom-apexcharts.js') }}"></script>

    <script src="{{ asset('src/plugins/src/flatpickr/flatpickr.js') }}"></script>
    <script src="{{ asset('src/plugins/src/flatpickr/custom-flatpickr.js') }}"></script>
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div id="users-box" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Thống kê kinh doanh</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <div class="layout-top-spacing ps-3 pe-3 col-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="filter">Thống kê theo</label>
                                    <select name="" id="filter" class="form-select">
                                        <option value="month">Theo tháng</option>
                                        <option value="quarter">Theo quý</option>
                                        <option value="year">Theo năm</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start-time">Thời gian bắt đầu</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="start-time"
                                        placeholder="Y-m-d"
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end-time">Thời gian kết thúc</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="end-time"
                                        placeholder="Y-m-d"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="line-chart" class="mt-5"></div>

                    <div id="column-chart" class="mt-5"></div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    let getFilteredTimeRange = (filterType, startDate, endDate) => {
        if (!startDate) {
            let currentYear = new Date().getFullYear();
            startDate = new Date(currentYear, 0, 1);
        } else {
            startDate = new Date(startDate);
        }

        if (!endDate) {
            endDate = new Date();
        } else {
            endDate = new Date(endDate);
        }

        let timeRange = [];

        switch (filterType) {
            case 'month':
                let currentMonth = startDate;
                while (currentMonth <= endDate) {
                    timeRange.push(`Tháng ${currentMonth.getMonth() + 1}/${currentMonth.getFullYear()}`);
                    currentMonth.setMonth(currentMonth.getMonth() + 1);
                }
                break;
            case 'quarter':
                let currentQuarter = startDate;
                while (currentQuarter <= endDate) {
                    let quarter = Math.floor(currentQuarter.getMonth() / 3) + 1;
                    timeRange.push(`Quý ${quarter}/${currentQuarter.getFullYear()}`);
                    currentQuarter.setMonth(currentQuarter.getMonth() + 3);
                }
                break;
            case 'year':
                let currentYear = startDate;
                while (currentYear <= endDate) {
                    timeRange.push(`${currentYear.getFullYear()}`);
                    currentYear.setFullYear(currentYear.getFullYear() + 1);
                }
                break;
            default:
                break;
        }

        return timeRange;
    }

    let lineOptions = {
          series: [{
            name: "Đã bán",
            data: [10, 41, 35, 51, 49, 62, 69, 91, 148]
        }],
          chart: {
          height: 350,
          type: 'line',
          zoom: {
            enabled: false
          }
        },
        dataLabels: {
          enabled: false
        },
        stroke: {
          curve: 'straight'
        },
        title: {
          text: 'Số lượng sản phẩm đã xuất',
          align: 'center'
        },
        grid: {
          row: {
            colors: ['#f3f3f3', 'transparent'],
            opacity: 0.5
          },
        },
        xaxis: {
          categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep'],
        }
    };

    let lineChart = new ApexCharts(document.querySelector("#line-chart"), lineOptions);
    lineChart.render();

    let columnOptions = {
          series: [{
          name: 'Lợi nhuận',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Doanh thu',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
          chart: {
          type: 'bar',
          height: 350
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
        title: {
          text: 'Doanh thu và lợi nhuận',
          align: 'center'
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return val.toLocaleString('en', { maximumFractionDigits: 2 });
            }
          }
        }
    };

    let columnChart = new ApexCharts(document.querySelector("#column-chart"), columnOptions);
    columnChart.render();

    let startTime = document.getElementById('start-time');
    let endTime = document.getElementById('end-time');
    let filter = document.getElementById('filter');

    let dt1 = flatpickr(startTime, {
        dateFormat: "Y-m-d",
        maxDate: "{{ getNow() }}",
    });

    let dt2 = flatpickr(endTime, {
        dateFormat: "Y-m-d",
        maxDate: "{{ getNow() }}",
    });

    startTime.onchange = () => {
        processChange();
    }

    endTime.onchange = () => {
        processChange();
    }

    filter.onchange = () => {
        processChange();
    }

    function debounce(func, timeout = 500) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }

    const processChange = debounce(() => updateLineChart());

    let updateLineChart = () => {
        let range = getFilteredTimeRange(filter.value, startTime.value, endTime.value);

        if(!range.length){
            lineChart.updateOptions({
                series: [{
                    data: range,
                }],
                xaxis: {
                    categories: range,
                },
            });

            columnChart.updateOptions({
                series: [{
                    data: range,
                }],
                xaxis: {
                    categories: range,
                },
            });
            return;
        }

        $.ajax({
            url: "{{ route('admin.dashboard.order_statistic') }}",
            data: {
                _token: @json(@csrf_token()),
                'filter': filter.value,
                'range': range,
                'start': startTime.value,
                'end': endTime.value,
            },
            success: function(response) {
                if (response) {
                    console.log(response);
                    lineChart.updateOptions({
                        series: [{
                            data: response.map(item => item.totalQuantity),
                        }],
                        xaxis: {
                            categories: range,
                        },
                    });

                    columnChart.updateOptions({
                        series: [{
                            name: 'Lợi nhuận',
                            data: response.map(item => Math.round(item.profit))
                        }, {
                            name: 'Doanh thu',
                            data: response.map(item => Math.round(item.revenue))
                        }],
                        xaxis: {
                            categories: range,
                        },
                    });
                }
            },
            error: function(response) {

            }
        });
    }

    updateLineChart();
</script>
@endsection
