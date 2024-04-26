<div class="sidebar-wrapper sidebar-theme">
    <nav id="sidebar">
        <div class="navbar-nav theme-brand flex-row  text-center">
            <div class="nav-logo">
                <div class="nav-item theme-logo">
                    <a href="">
                        <img src="{{ asset('src/assets/img/logo2.svg') }}" class="" alt="logo">
                    </a>
                </div>
                <div class="nav-item theme-text">
                    <a href="" class="nav-link">HTTTDN</a>
                </div>
            </div>
            <div class="nav-item sidebar-toggle">
                <div class="btn-toggle sidebarCollapse">
                    <i data-feather="chevrons-left"></i>
                </div>
            </div>
        </div>

        <div class="profile-info">
            <div class="user-info">
                <div class="avatar avatar-sm me-2">
                    <img src="{{ auth()->user()->thumbnail }}" alt="avatar" class="rounded-circle">
                </div>
                <div class="profile-content">
                    <h6 class="text-dark">{{ auth()->user()->name }} </h6>
                    <p class="">{{
                    auth()->user()->approved_salary ?
                    auth()->user()->approved_salary->position->name :
                    ''
                    }}</p>
                </div>
            </div>
        </div>

        <ul class="list-unstyled menu-categories">
            <li
                class="menu
                @if (request()->routeIs('admin.dashboard.*')
                || request()->routeIs('admin.profile.*'))
                active
                @endif"
            >
                <a
                    href="#dashboard"
                    data-bs-toggle="collapse"
                    aria-expanded="false"
                    class="dropdown-toggle collapsed"
                >
                    <div>
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.dashboard.*'))
                    show
                    @endif"
                    id="dashboard"
                    data-bs-parent="#dashboard"
                >
                    <li class="@if (request()->routeIs('admin.dashboard.index')) active @endif">
                        <a href="{{ route('admin.dashboard.index') }}">
                            Tổng quan
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('admin.dashboard.purchase_order_statistic')) active @endif">
                        <a href="{{ route('admin.dashboard.purchase_order_statistic') }}">
                            Thống kê kho
                        </a>
                    </li>
                    <li class="@if (request()->routeIs('admin.dashboard.order_statistic')) active @endif">
                        <a href="{{ route('admin.dashboard.order_statistic') }}">
                            Thống kê kinh doanh
                        </a>
                    </li>
                </ul>
            </li>

            <li
                class="menu
                @if (request()->routeIs('admin.product.*')
                || request()->routeIs('admin.product_category.*'))
                active
                @endif"
            >
                <a
                    href="#product"
                    data-bs-toggle="collapse"
                    aria-expanded="false"
                    class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="layers"></i>
                        <span>Sản phẩm</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.product.*')
                    || request()->routeIs('admin.product_category.*'))
                    show
                    @endif"
                    id="product"
                    data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.product_category.*')) active @endif">
                        <a href="{{ route('admin.product_category.index') }}">Danh mục sản phẩm</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.product.*')) active @endif">
                        <a href="{{ route('admin.product.index') }}">Danh sách sản phẩm</a>
                    </li>
                </ul>
            </li>

            <li
                class="menu
                @if (request()->routeIs('admin.supplier.*')
                || request()->routeIs('admin.purchase_order.*'))
                active
                @endif"
            >
                <a
                    href="#supplier"
                    data-bs-toggle="collapse"
                    aria-expanded="false"
                    class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="database"></i>
                        <span>Quản lý kho</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.supplier.*')
                    || request()->routeIs('admin.purchase_order.*'))
                    show
                    @endif" id="supplier"
                    data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.purchase_order.*')) active @endif">
                        <a href="{{ route('admin.purchase_order.index') }}">Hóa đơn nhập</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.supplier.*')) active @endif">
                        <a href="{{ route('admin.supplier.index') }}">Nhà cung cấp</a>
                    </li>
                </ul>
            </li>

            <li class="menu @if (request()->routeIs('admin.customer.*')) active @endif">
                <a href="{{ route('admin.customer.index') }}" aria-expanded="false" class="dropdown-toggle">
                    <div class="">
                        <i data-feather="users"></i>
                        <span>Khách hàng</span>
                    </div>
                </a>
            </li>

            <li
                class="menu
                @if (request()->routeIs('admin.shipping_unit.*')
                || request()->routeIs('admin.order.*'))
                active
                @endif"
            >
                <a
                    href="#orders"
                    data-bs-toggle="collapse"
                    aria-expanded="false" class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="truck"></i>
                        <span>Quản lý kinh doanh</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.shipping_unit.*')
                    || request()->routeIs('admin.order.*'))
                    show
                    @endif"
                    id="orders" data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.order.*')) active @endif">
                        <a href="{{ route('admin.order.index') }}">Hoá đơn bán</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.shipping_unit.*')) active @endif">
                        <a href="{{ route('admin.shipping_unit.index') }}">Đơn vị vận chuyển</a>
                    </li>
                </ul>
            </li>

            <li
            class="menu
                @if (request()->routeIs('admin.position.*')
                || request()->routeIs('admin.department.*')
                || request()->routeIs('admin.user.*'))
                active
                @endif"
            >
                <a
                    href="#users"
                    data-bs-toggle="collapse"
                    aria-expanded="false" class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="user"></i>
                        <span>Nguời dùng</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.position.*')
                    || request()->routeIs('admin.department.*')
                    || request()->routeIs('admin.user.*'))
                    show
                    @endif"
                    id="users" data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.user.*')) active @endif">
                        <a href="{{ route('admin.user.index') }}">Danh sách người dùng</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.position.*')) active @endif">
                        <a href="{{ route('admin.position.index') }}">Danh sách vị trí</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.department.*')) active @endif">
                        <a href="{{ route('admin.department.index') }}">Danh sách phòng ban</a>
                    </li>
                </ul>
            </li>

            <li
            class="menu
                @if (request()->routeIs('admin.salary.*'))
                active
                @endif"
            >
                <a
                    href="#salaries"
                    data-bs-toggle="collapse"
                    aria-expanded="false" class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="dollar-sign"></i>
                        <span>Lương</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.salary.*'))
                    show
                    @endif"
                    id="salaries" data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.salary.*')) active @endif">
                        <a href="{{ route('admin.salary.index') }}">Danh sách lương</a>
                    </li>
                </ul>
            </li>

            <li
            class="menu
                @if (request()->routeIs('admin.recruitment.*'))
                active
                @endif"
            >
                <a
                    href="#recruitment"
                    data-bs-toggle="collapse"
                    aria-expanded="false" class="dropdown-toggle collapsed"
                >
                    <div class="">
                        <i data-feather="user-plus"></i>
                        <span>Tuyển dụng</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul
                    class="collapse submenu list-unstyled
                    @if (request()->routeIs('admin.recruitment.*'))
                    show
                    @endif"
                    id="recruitment" data-bs-parent="#accordionExample"
                >
                    <li class="@if (request()->routeIs('admin.recruitment.*')) active @endif">
                        <a href="{{ route('admin.recruitment.index') }}">Danh sách tuyển dụng</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
