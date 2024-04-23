@extends('layouts.admin')

@section('title')
    Thống kê tồn kho
@endsection

@section('style-plugins')
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/src/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/dt-global_style.css') }}">

    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}">

    <link href="{{ asset('src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/plugins/src/flatpickr/flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/light/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('src/plugins/css/dark/flatpickr/custom-flatpickr.css') }}" rel="stylesheet" type="text/css">
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>

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
                            <h4>Thống kê tồn kho</h4>
                        </div>
                    </div>
                </div>

                <div class="widget-content widget-content-area">
                    <div class="layout-top-spacing ps-3 pe-3 col-12">
                        <div class="row d-flex align-items-end">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="product_category_id">Thống kê theo danh mục</label>
                                    <select name="" id="product_category_id" class="form-select">
                                        <option value="">Lựa chọn</option>
                                        @foreach ($productCategories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="start-date">Thời gian bắt đầu</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="start-date"
                                        placeholder="Y-m-d"
                                    >
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="end-date">Thời gian kết thúc</label>
                                    <input
                                        type="text"
                                        class="form-control"
                                        id="end-date"
                                        placeholder="Y-m-d"
                                    >
                                </div>
                            </div>
                        </div>
                    </div>

                    <table id="html5-extension" class="table style-3 dt-table-hover" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th rowspan="2">#</th>
                                <th rowspan="2">Tên sản phẩm</th>
                                <th rowspan="2">Danh mục</th>
                                <th colspan="2" class="text-center">Nhập trong kỳ</th>
                                <th colspan="2" class="text-center">Xuất trong kỳ</th>
                                <th colspan="2" class="text-center">Tồn cuối kỳ</th>
                            </tr>
                            <tr role="row">
                                <th>Số lượng</th>
                                <th>Tiền</th>
                                <th>Số lượng</th>
                                <th>Tiền</th>
                                <th>Số lượng</th>
                                <th>Tiền</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="now" value="{{ getNowFormat() }}">
    <input type="hidden" id="start_of_year" value="{{ getStartOfYearFormat() }}">
@endsection

@section('script')
    <script>
        let drawDT = 0;

        let c1 = $('#html5-extension').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
            buttons: {
                buttons: [
                    {
                        extend: 'excel',
                        className: 'btn',
                        title: function () {
                            let startDate = $('#start-date').val() ? $('#start-date').val() : $('#start_of_year').val();
                            let endDate = $('#end-date').val() ?  $('#end-date').val(): $('#now').val();
                            return `Thống kê nhập xuất kho (${startDate} - ${endDate})`;
                        },
                    },
                    {
                        extend: 'print',
                        className: 'btn',
                        title: function () {
                            return ``;
                        },
                        customize: function (win) {
                            let startDate = $('#start-date').val() ? $('#start-date').val() : $('#start_of_year').val();
                            let endDate = $('#end-date').val() ?  $('#end-date').val(): $('#now').val();
                            $(win.document.body).prepend(`<h1 class="text-center pt-3">
                                Thống kê nhập xuất kho (${startDate} - ${endDate})
                            </h1>`);
                        }
                    }
                ]
            },
            "oLanguage": {
                "oPaginate": {
                    "sPrevious": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
                    "sNext": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>'
                },
                "sEmptyTable": "Chưa có dữ liệu",
                "sInfo": "Hiển thị trang _PAGE_ trong _PAGES_",
                "sInfoEmpty": "Hiển thị trang _PAGES_ trong _PAGES_s",
                "sSearch": '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
                "sSearchPlaceholder": "Tìm kiếm...",
                "sLengthMenu": "Số lượng :  _MENU_",
                "sInfoFiltered": "(Lọc từ tổng số _MAX_ bản ghi)",
                "sZeroRecords": "Không có bản ghi nào trùng khớp",
            },
            "stripeClasses": [],
            "lengthMenu": [7, 10, 20, 50],
            "pageLength": 100,
            "searching" : false,
            "ordering" : false,
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{ route('admin.dashboard.purchase_order_statistic') }}",
                "data": function(d) {
                    let searchParams = new URLSearchParams(window.location.search);
                    drawDT = d.draw;
                    d.limit = d.length;
                    d.page = d.start / d.length + 1;
                    d.keyword = $('.search-bar .search-form-control').val();
                    d.product_category_id = $('#product_category_id').val();
                    d.start_date = $('#start-date').val();
                    d.end_date = $('#end-date').val();
                },
                "dataSrc": function(res) {
                    res.draw = drawDT;
                    res.recordsTotal = res.meta ? res.meta.total : res.total;
                    res.recordsFiltered = res.meta ? res.meta.total : res.total;
                    return res.data;
                }
            },
            "columns": [{
                    "data": "id",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return meta.row + 1;
                    },
                },
                {
                    "data": "name",
                    "render": function(data, type, full, meta) {
                        let thumbnail = full.thumbnail;
                        return `
                        <div class="d-flex justify-content-left align-items-center">
                                <div class="avatar  me-3">
                                    <img src="${thumbnail}" alt="Thumbnail" style="border-radius: 18px; width:48px !important; height:48px !important;">
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="fw-bold">
                                        <p style="max-width:200px;" class="text-truncate">${data}</p>
                                    </span>
                                </div>
                            </div>
                        `;
                    },
                },
                {
                    "data": "category.name",
                    "render": function(data, type, full, meta) {
                        let thumbnail = full.thumbnail;
                        return `
                        <p style="max-width:200px;" class="text-truncate">${data}</p>
                        `;
                    },
                },
                {
                    "data": "statistic.start_import_quantity",
                    "class": "text-end",
                },
                {
                    "data": "statistic.start_import_total",
                    "class": "text-end",
                },
                {
                    "data": "statistic.start_export_quantity",
                    "class": "text-end",
                },
                {
                    "data": "statistic.start_export_total",
                    "class": "text-end",
                },
                {
                    "data": "statistic.end_quantity",
                    "class": "text-end",
                },
                {
                    "data": "statistic.end_total",
                    "class": "text-end",
                },
            ]
        });

        let searchBar = document.querySelector('.search-bar .search-form-control');
        let startDate = document.getElementById('start-date');
        let endDate = document.getElementById('end-date');
        let productCategoryId = document.getElementById('product_category_id');
        let sortBy = document.getElementById('sort_by');

        let dt1 = flatpickr(startDate, {
            dateFormat: "d/m/Y",
            maxDate: $('#now').val(),
        });

        let dt2 = flatpickr(endDate, {
            dateFormat: "d/m/Y",
            maxDate: $('#now').val(),
        });

        productCategoryId.onchange = () => {
            processChange();
        }

        startDate.onchange = () => {
            processChange();
        }

        endDate.onchange = () => {
            processChange();
        }

        $(document).on('keyup', '.search-bar .search-form-control', function() {
            processChange();
        });

        $('.search-bar .search-close').on('click', function(e) {
            searchBar.value = '';
            processChange();
        });

        const processChange = debounce(() => searchDT());

        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        const searchDT = () => {
            c1.ajax.reload();
        }
    </script>
@endsection
