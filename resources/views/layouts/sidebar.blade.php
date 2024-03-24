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
                    <a href="" class="nav-link">TienHai</a>
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
                <div class="profile-img">
                    <img src="{{ asset('src/assets/img/profile-30.png') }}" alt="avatar">
                </div>
                <div class="profile-content">
                    <h6 class="">Shaun Park</h6>
                    <p class="">Project Leader</p>
                </div>
            </div>
        </div>

        <ul class="list-unstyled menu-categories" id="accordionExample">
            <li class="menu @if (request()->routeIs('admin.dashboard')) active @endif">
                <a href="#dashboard" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                    <div>
                        <i data-feather="home"></i>
                        <span>Dashboard</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if (request()->routeIs('admin.dashboard')) show @endif" id="dashboard"
                    data-bs-parent="#accordionExample">
                    <li class="@if (request()->routeIs('admin.dashboard')) active @endif">
                        <a href=""> Analytics </a>
                    </li>
                    <li>
                        <a href=""> Sales </a>
                    </li>
                </ul>
            </li>

            <li class="menu @if (request()->routeIs('admin.product.*')) active @endif">
                <a href="#product" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                    <div class="">
                        <i data-feather="database"></i>
                        <span>Quản lý sản phẩm</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if (request()->routeIs('admin.product.*')) show @endif" id="product"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href="">Danh mục sản phẩm</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.product.*')) active @endif">
                        <a href="{{ route('admin.product.index') }}">Sản phẩm</a>
                    </li>
                </ul>
            </li>

            <li class="menu @if (request()->routeIs('admin.supplier.*')) active @endif">
                <a href="#supplier" data-bs-toggle="collapse" aria-expanded="false" class="dropdown-toggle collapsed">
                    <div class="">
                        <i data-feather="database"></i>
                        <span>Quản lý kho</span>
                    </div>
                    <div>
                        <i data-feather="chevron-right"></i>
                    </div>
                </a>
                <ul class="collapse submenu list-unstyled @if (request()->routeIs('admin.supplier.*')) show @endif" id="supplier"
                    data-bs-parent="#accordionExample">
                    <li>
                        <a href="">Hóa đơn nhập</a>
                    </li>
                    <li class="@if (request()->routeIs('admin.supplier.*')) active @endif">
                        <a href="{{ route('admin.supplier.index') }}">Nhà cung cấp</a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>
