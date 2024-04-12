@extends('layouts.admin')

@section('title')
    Danh sách lương
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
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('src/assets/css/dark/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('script-plugins')
    <script src="https://cdn-script.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- datatable --}}
    <script src="{{ asset('src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    {{-- sweatalert2 --}}
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>

    @include('includes.toast')
@endsection

@section('content')
    <div class="row layout-top-spacing">
        <div id="users-box" class="col-lg-12 layout-spacing">
            <div class="statbox widget box box-shadow">
                <div class="widget-header">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                            <h4>Quản lý lương</h4>
                        </div>
                    </div>
                </div>
                <div class="widget-content widget-content-area">
                    <table id="datatable" class="table style-3 dt-table-hover" style="width:100%">
                        <thead>
                            <tr role="row">
                                <th>#</th>
                                <th>Tên người nhận</th>
                                <th>Tiền lương</th>
                                <th>Vị trí</th>
                                <th>Duyệt bởi</th>
                                <th>Lương chờ duyệt</th>
                                <th>Hành động</th>
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
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let url = this.href;
            Swal.fire({
                title: "Bạn có chắc chắn muốn xóa?",
                text: "Bạn sẽ không thể khôi phục lại dữ liệu đã xóa!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Đồng ý",
                cancelButtonText: "Hủy",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: 'DELETE',
                        url: url,
                        data: {
                            _token: @json(@csrf_token())
                        },
                        success: function(response) {
                            if (response) {
                                $('#datatable').DataTable().ajax.reload();

                                const Toast = Swal.mixin({
                                    toast: true,
                                    position: 'top-end',
                                    showConfirmButton: false,
                                    timer: 3000,
                                    timerProgressBar: true,
                                    didOpen: (toast) => {
                                        toast.addEventListener('mouseenter', Swal
                                            .stopTimer)
                                        toast.addEventListener('mouseleave', Swal
                                            .resumeTimer)
                                    }
                                });

                                Toast.fire({
                                    icon: 'success',
                                    title: 'Xóa dữ liệu thành công!'
                                });
                            }
                        },
                        error: function(response) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal
                                        .stopTimer)
                                    toast.addEventListener('mouseleave', Swal
                                        .resumeTimer)
                                }
                            });

                            Toast.fire({
                                icon: 'error',
                                title: 'Xóa dữ liệu không thành công!'
                            });
                        }
                    });
                }
            });
        });

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
                "url": "{{ route('admin.salary.index') }}",
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
                    "data": "approved_salary",
                    "class": "text-end",
                    "render": function(data, type, full, meta) {
                        return data ? data.amount : 'N/A';
                    },
                },
                {
                    "data": "approved_salary",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ? data.position.name : 'N/A';
                    },
                },
                {
                    "data": "approved_salary",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        return data ?
                            `
                            <div style="display: flex; justify-content: space-between;">
                                <p class="text-start">Người duyệt:</p>
                                <p>${data.approved_by.name}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p class="text-start">Thời gian:</p>
                                <p>${data.approved_at}</p>
                            </div>
                            `
                            :
                            "N/A";
                    },
                },
                {
                    "data": "pending_salary",
                    "class": "text-center",
                    "render": function(data, type, full, meta) {
                        let form = '';
                        let url = data ?
                            `{{ route('admin.salary.update', ':id') }}`.replace(':id', data.id)
                            :
                            ''
                        ;

                        form = `<form
                            action="${url}" method="POST" class="d-flex justify-content-end"
                        >
                            @method('PUT')
                            @csrf
                            <button class="btn btn-sm btn-primary">
                                Duyệt
                            </button>
                        </form>`;

                        return data ?
                            `
                            <div style="display: flex; justify-content: space-between;">
                                <p class="text-start">Tiền lương:</p>
                                <p>${data.amount}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p class="text-start">Vị trí:</p>
                                <p>${data.position.name}</p>
                            </div>
                            <div style="display: flex; justify-content: space-between;">
                                <p class="text-start">Tạo lúc:</p>
                                <p>${data.created_at}</p>
                            </div>
                            ${form}
                            `
                            :
                            'N/A';
                    },
                },
                {
                    "data": "id",
                    "class": "text-center",
                    "render": function(data, type, full) {
                        return `
                            <div class="action-btns">
                                <a href="" class="action-btn btn-view bs-tooltip me-2" data-toggle="tooltip" data-placement="top" title="View" data-bs-original-title="View">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                                </a>
                            </div>
                        `;
                    }
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
    </script>
@endsection
