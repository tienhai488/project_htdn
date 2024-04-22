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
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/light/table/datatable/custom_dt_custom.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('src/plugins/css/dark/table/datatable/custom_dt_custom.css') }}">
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">

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
                            <div class="col-md-3">
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
                            <div class="col-md-3">
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
                            <div class="col-md-2">
                                <a
                                    href="{{ route('admin.department.create') }}"
                                    class="btn btn-primary btn-block w-100"
                                >
                                    In báo cáo
                                </a>
                            </div>
                        </div>
                    </div>

                    <table id="datatable" class="table style-3 dt-table-hover" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th rowspan="2">#</th>
                                <th rowspan="2">Tên sản phẩm</th>
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
@endsection

@section('script')
    <script>
        let drawDT = 0;

        const c1 = $('#datatable').DataTable({
            "dom": "<'dt--top-section'<'row'<'col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center'><'col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3'>>>" +
                "<'table-responsive'tr>" +
                "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
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
            "pageLength": 10,
            "processing": true,
            "serverSide": true,
            "ordering": false,
            "ajax": {
                "url": "{{ route('admin.dashboard.purchase_order_statistic') }}",
                "data": function(d) {
                    let searchParams = new URLSearchParams(window.location.search);
                    drawDT = d.draw;
                    d.limit = d.length;
                    d.page = d.start / d.length + 1;
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

        multiCheck(c1);

        $(document).on('keyup', '.search-bar .search-form-control', function() {
            processChange();
        });

        function debounce(func, timeout = 500) {
            let timer;
            return (...args) => {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    func.apply(this, args);
                }, timeout);
            };
        }

        function searchDT() {
            c1.search($('.search-bar .search-form-control').val()).draw();
        }

        const processChange = debounce(() => searchDT());

        $('.search-bar .search-close').on('click', function(e) {
            c1.search('').draw();
        });

        let startDate = document.getElementById('start-date');
        let endDate = document.getElementById('end-date');
        let productCategoryId = document.getElementById('product_category_id');

        let dt1 = flatpickr(startDate, {
            dateFormat: "Y-m-d",
            maxDate: "{{ getNow() }}",
        });

        let dt2 = flatpickr(endDate, {
            dateFormat: "Y-m-d",
            maxDate: "{{ getNow() }}",
        });
    </script>
@endsection
