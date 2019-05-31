<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="user-wrapper">
                    <div class="profile-image">
                        <img src="{{ Auth::check() ? url('').'/'.@Auth::user()->avatar : ''}}" alt="profile image">
                    </div>
                    <div class="text-wrapper">
                        <p class="profile-name">{{ Auth::check() ? @Auth::user()->name : '' }}</p>
                        <div>
                            <small class="designation text-muted">Manager</small>
                            <span class="status-indicator online"></span>
                        </div>
                    </div>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{ route('home.index') }}" >
                <i class="menu-icon ti-desktop"></i>
                <span class="menu-title">Trang chủ</span>
            </a>
        </li>
         @if (Auth::user()->is_customer == 0) 
            @if (Auth::user()->can('setting.contact.read'))
            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.index') }}" >
                    <i class="menu-icon ti-dashboard"></i>
                    <span class="menu-title">Thống kê</span>
                </a>
            </li>

             <li class="nav-item {{ request()->is('admin/contacts') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('contacts.index') }}" >
                    <i class="menu-icon ti-comments"></i>
                    <span class="menu-title">Đánh giá phản hồi</span>
                </a>
            </li>
            @endif
         @endif

        <li class="nav-item {{ request()->is('admin/orders/create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('orders.create') }}" >
                <i class="menu-icon ti-shopping-cart"></i>
                <span class="menu-title">Tạo đơn hàng</span>
            </a>
        </li>
       
        <li class="nav-item {{ request()->is('admin/orders') || request()->is('admin/orders/*') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('orders.index') }}" >
                <i class="menu-icon ti-notepad"></i>
                <span class="menu-title">Đơn hàng</span>
            </a>
        </li>
        @if (Auth::user()->is_customer == 1 || Auth::user()->can('units.read') )
            <li class="nav-item {{ request()->is('admin/units') || request()->is('admin/units/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('units.index') }}" >
                    <i class="menu-icon ti-money"></i>
                    <span class="menu-title">Giá vận đơn</span>
                </a>
            </li>
        @endif  
        @if (Auth::user()->is_customer == 0)
        
            @if (Auth::user()->can('customer.read'))
                <li class="nav-item {{ request()->is('admin/customers') || request()->is('admin/customers/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{ route('customers.index') }}" >
                        <i class="menu-icon ti-id-badge"></i>
                        <span class="menu-title">Khách hàng</span>
                    </a>
                </li>
            @endif
            @if (Auth::user()->can('user.read'))
                <li class="nav-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('users.index') }}" >
                    <i class="menu-icon ti-user"></i>
                    <span class="menu-title">Nhân viên hệ thống </span>
                </a>
            </li>
            @endif
            @if (Auth::user()->can('setting.contact.read'))
            <li class="nav-item {{ request()->is('admin/settings/*') ? 'active' : '' }}">
                <a class="nav-link" data-toggle="collapse" href="#settings" aria-expanded="{{ request()->is('admin/transfers/*') ? 'true': 'false' }}" aria-controls="dashboard-dropdown">
                    <i class="menu-icon mdi mdi-television"></i>
                    <span class="menu-title">Cấu hình</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="collapse {{ request()->is('admin/settings/*') ? 'show': '' }}" id="settings">
                    <ul class="nav flex-column sub-menu">
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('admin/settings/contact') || request()->is('admin/settings/contact/*') ) ? 'active': '' }}" href="{{ route('settings.contact') }}">Liên hệ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ (request()->is('admin/settings/seo-default') || request()->is('admin/settings/seo-default/*') ) ? 'active': '' }}" href="{{ route('settings.seo_default') }}">Mặc định seo</a>
                        </li>
                    </ul>
                </div>
            </li>
            @endif
        @endif
    </ul>
</nav>

