@extends('layouts.admin')

@section('title')
Danh sách nhà cung cấp
@endsection

@section('content')
<div id="users-box" class="col-lg-12 layout-spacing">
    <div class="statbox widget box box-shadow">
                        <div class="widget-header">
                <div class="row">
                    <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                        <h4>Quản lý người dùng</h4>
                    </div>
                </div>
            </div>
                    <div class="widget-content widget-content-area">
                                <div class="layout-top-spacing ps-3 pe-3 col-12">
                <a href="https://admin.main-site.khgc.dev/user/create" class="btn btn-primary _effect--ripple waves-effect waves-light">
Thêm mới người dùng
</a>
            </div>

            <div id="sUserTable_wrapper" class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer"><div class="dt--top-section"><div class="row"><div class="col-12 col-sm-6 d-flex justify-content-sm-start justify-content-center"></div><div class="col-12 col-sm-6 d-flex justify-content-sm-end justify-content-center mt-sm-0 mt-3"></div></div></div><div class="table-responsive"><table id="sUserTable" class="table style-3 dt-table-hover dataTable no-footer" style="width: 100%;" role="grid" aria-describedby="sUserTable_info">
<thead>
<tr role="row"><th class="text-center sorting_disabled" style="width: 53px;" rowspan="1" colspan="1">ID</th><th style="width: 335px;" class="sorting_disabled" rowspan="1" colspan="1">Tên người dùng</th><th class="text-center sorting_disabled" style="width: 232px;" rowspan="1" colspan="1">Email</th><th style="width: 241px;" class="sorting_disabled block-td" rowspan="1" colspan="1">Vai trò</th><th class="no-content text-center sorting_disabled" style="width: 147px;" rowspan="1" colspan="1">Thao tác</th></tr>
</thead>
    <tbody><tr role="row"><td class=" text-center">9</td><td>Vu Giang</td><td>giang1@gmail.com</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    super admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/9/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">

        <i data-feather="edit-2"></i>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/9" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <i data-feather="trash"></i>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">7</td><td>Nguyen Hieu</td><td>hieunguyen479@gmail.com</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/7/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/7" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">6</td><td>Nguyễn Hân</td><td>han1772000@gmail.com</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/6/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/6" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">5</td><td>ttt vy</td><td>vyttt@gmail.com</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    super admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/5/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/5" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">1</td><td>SuperAdmin SuperAdmin</td><td>superadmin@khgc.vn</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    super admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/1/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/1" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">2</td><td>Admin Admin</td><td>admin@khgc.vn</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    admin
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/2/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/2" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">3</td><td>Staff Staff</td><td>staff@khgc.vn</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    staff
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/3/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/3" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr><tr role="row"><td class=" text-center">4</td><td>Customer Customer</td><td>customer@khgc.vn</td><td class=" block-td"><strong class="d-none">Vai trò: </strong>
                                <span class="badge badge-secondary">
                                    customer
                                </span>
                            </td><td class=" text-center">
                            <ul class="table-controls d-flex justify-content-center">
                                <li>
    <a href="https://admin.main-site.khgc.dev/user/4/edit" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa" data-bs-original-title="Chỉnh sửa" class="bs-tooltip">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1">
            <path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z">
            </path>
        </svg>
    </a>
</li>
                                <li>
    <a class="bs-tooltip delete" data-url="https://admin.main-site.khgc.dev/user/4" data-datatable-id="#sUserTable" data-bs-toggle="tooltip" data-bs-placement="top" title="Xoá" data-bs-original-title="Xoá">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
        </svg>
    </a>
</li>
                            </ul></td></tr></tbody></table><div id="sUserTable_processing" class="dataTables_processing card" style="display: none;">Processing...</div></div><div class="dt--bottom-section d-sm-flex justify-content-sm-between text-center"><div class="dt--pages-count  mb-sm-0 mb-3"><div class="dataTables_info" id="sUserTable_info" role="status" aria-live="polite">Hiển thị trang 1 trong 1</div></div><div class="dt--pagination"><div class="dataTables_paginate paging_simple_numbers" id="sUserTable_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="sUserTable_previous"><a href="#" aria-controls="sUserTable" data-dt-idx="0" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg></a></li><li class="paginate_button page-item active"><a href="#" aria-controls="sUserTable" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item next disabled" id="sUserTable_next"><a href="#" aria-controls="sUserTable" data-dt-idx="2" tabindex="0" class="page-link"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg></a></li></ul></div></div></div></div>
        </div>
    </div>
</div>
@endsection


@section('script')

@endsection
