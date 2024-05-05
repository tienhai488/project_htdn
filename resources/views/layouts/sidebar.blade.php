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
            <x-menu.vertical.drop-down
                :id="'dashboard'"
                :title="'Dashboard'"
                :active="request()->routeIs('admin.dashboard.*')"
                :drop-down-active="request()->routeIs('admin.profile.*')"
                :icon="'home'"
                :show="true"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Tổng quan'"
                    :active="request()->routeIs('admin.dashboard.index')"
                    :url="route('admin.dashboard.index')"
                    :show="true"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Thống kê kho'"
                    :active="request()->routeIs('admin.dashboard.purchase_order_statistic')"
                    :url="route('admin.dashboard.purchase_order_statistic')"
                    :show="checkPermissions([Acl::PERMISSION_PURCHASER_ORDER_STATISTIC_MANAGE])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Thống kê kinh doanh'"
                    :active="request()->routeIs('admin.dashboard.order_statistic')"
                    :url="route('admin.dashboard.order_statistic')"
                    :show="checkPermissions([Acl::PERMISSION_ORDER_STATISTIC_MANAGE])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.drop-down
                :id="'products'"
                :title="'Sản phẩm'"
                :active="
                request()->routeIs('admin.product.*')
                || request()->routeIs('admin.product_category.*')
                "
                :icon="'layers'"
                :show="checkPermissions([Acl::PERMISSION_PRODUCT_MANAGE_WAREHOUSE, Acl::PERMISSION_PRODUCT_CATEGORY_MANAGE_WAREHOUSE])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý sản phẩm'"
                    :active="request()->routeIs('admin.product.*')"
                    :url="route('admin.product.index')"
                    :show="checkPermissions([Acl::PERMISSION_PRODUCT_MANAGE_WAREHOUSE])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Danh mục sản phẩm'"
                    :active="request()->routeIs('admin.product_category.*')"
                    :url="route('admin.product_category.index')"
                    :show="checkPermissions([Acl::PERMISSION_PRODUCT_CATEGORY_MANAGE_WAREHOUSE])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.drop-down
                :id="'purchaseOrders'"
                :title="'Quản lý kho'"
                :active="
                request()->routeIs('admin.purchase_order.*')
                || request()->routeIs('admin.supplier.*')
                "
                :icon="'database'"
                :show="checkPermissions([Acl::PERMISSION_PURCHASE_ORDER_MANAGE_WAREHOUSE, Acl::PERMISSION_SUPPLIER_MANAGE_WAREHOUSE])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Hóa đơn nhập'"
                    :active="request()->routeIs('admin.purchase_order.*')"
                    :url="route('admin.purchase_order.index')"
                    :show="checkPermissions([Acl::PERMISSION_PURCHASE_ORDER_MANAGE_WAREHOUSE])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Nhà cung cấp'"
                    :active="request()->routeIs('admin.supplier.*')"
                    :url="route('admin.supplier.index')"
                    :show="checkPermissions([Acl::PERMISSION_SUPPLIER_MANAGE_WAREHOUSE])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.single
                :title="'Khách hàng'"
                :url="route('admin.customer.index')"
                :active="request()->routeIs('admin.customer.*')"
                :icon="'users'"
                :show="checkPermissions([Acl::PERMISSION_CUSTOMER_MANAGE_BUSINESS])"
            />

            <x-menu.vertical.drop-down
                :id="'orders'"
                :title="'Quản lý kinh doanh'"
                :active="
                request()->routeIs('admin.order.*')
                || request()->routeIs('admin.shipping_unit.*')
                "
                :icon="'truck'"
                :show="checkPermissions([Acl::PERMISSION_ORDER_MANAGE_BUSINESS, Acl::PERMISSION_SHIPPING_UNIT_MANAGE_BUSINESS])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Hóa đơn bán'"
                    :active="request()->routeIs('admin.order.*')"
                    :url="route('admin.order.index')"
                    :show="checkPermissions([Acl::PERMISSION_ORDER_MANAGE_BUSINESS])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Đơn vị vận chuyển'"
                    :active="request()->routeIs('admin.shipping_unit.*')"
                    :url="route('admin.shipping_unit.index')"
                    :show="checkPermissions([Acl::PERMISSION_SHIPPING_UNIT_MANAGE_BUSINESS])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.single
                :title="'Vai trò'"
                :url="route('admin.role.index')"
                :active="request()->routeIs('admin.role.*')"
                :icon="'shield'"
                :show="checkPermissions([Acl::PERMISSION_ROLE_MANAGE_HR])"
            />

            <x-menu.vertical.drop-down
                :id="'users'"
                :title="'Người dùng'"
                :active="
                request()->routeIs('admin.user.*')
                || request()->routeIs('admin.position.*')
                || request()->routeIs('admin.department.*')
                "
                :icon="'user'"
                :show="checkPermissions([Acl::PERMISSION_USER_MANAGE_HR, Acl::PERMISSION_DEPARTMENT_MANAGE_HR, Acl::PERMISSION_POSITION_MANAGE_HR])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý người dùng'"
                    :active="request()->routeIs('admin.user.*')"
                    :url="route('admin.user.index')"
                    :show="checkPermissions([Acl::PERMISSION_USER_MANAGE_HR])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý phòng ban'"
                    :active="request()->routeIs('admin.department.*')"
                    :url="route('admin.department.index')"
                    :show="checkPermissions([Acl::PERMISSION_DEPARTMENT_MANAGE_HR])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý vị trí'"
                    :active="request()->routeIs('admin.position.*')"
                    :url="route('admin.position.index')"
                    :show="checkPermissions([Acl::PERMISSION_POSITION_MANAGE_HR])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.drop-down
                :id="'salaries'"
                :title="'Lương'"
                :active="
                request()->routeIs('admin.salary.*')
                || request()->routeIs('admin.timekeeping.*')
                "
                :icon="'dollar-sign'"
                :show="checkPermissions([Acl::PERMISSION_SALARY_MANAGE_HR, Acl::PERMISSION_TIMEKEEPING_MANAGE_HR])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý lương'"
                    :active="request()->routeIs('admin.salary.*')"
                    :url="route('admin.salary.index')"
                    :show="checkPermissions([Acl::PERMISSION_SALARY_MANAGE_HR])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý chấm công'"
                    :active="request()->routeIs('admin.timekeeping.*')"
                    :url="route('admin.timekeeping.index')"
                    :show="checkPermissions([Acl::PERMISSION_TIMEKEEPING_MANAGE_HR])"
                />
            </x-menu.vertical.drop-down>

            <x-menu.vertical.drop-down
                :id="'recruitments'"
                :title="'Tuyển dụng'"
                :active="
                request()->routeIs('admin.recruitment.*')
                || request()->routeIs('admin.candidate.*')
                "
                :icon="'user-plus'"
                :show="checkPermissions([Acl::PERMISSION_RECRUITMENT_MANAGE_HR, Acl::PERMISSION_CANDIDATE_MANAGE_HR])"
            >
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý tuyển dụng'"
                    :active="request()->routeIs('admin.recruitment.*')"
                    :url="route('admin.recruitment.index')"
                    :show="checkPermissions([Acl::PERMISSION_RECRUITMENT_MANAGE_HR])"
                />
                <x-menu.vertical.drop-down-item
                    :title="'Quản lý ứng viên'"
                    :active="request()->routeIs('admin.candidate.*')"
                    :url="route('admin.candidate.index')"
                    :show="checkPermissions([Acl::PERMISSION_CANDIDATE_MANAGE_HR])"
                />
            </x-menu.vertical.drop-down>
        </ul>
    </nav>
</div>
