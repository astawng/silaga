<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="/" class="app-brand-link gap-2">
            <span class="app-brand-logo demo">
                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="silaga logo" style="width: 150px;" class="w-10 p-0 m-0">
            </span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('dashboard') ? 'active' : '' }}">
            <a href="{{ route('dashboard.home') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Pages</span></li>
        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 2)
        <!-- Users -->
        <li class="menu-item {{ request()->is('dashboard/users') ? 'active' : '' }}">
            <a href="{{ route('dashboard.users.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Users</div>
            </a>
        </li>
        @elseif(Auth::user()->role_id == 1)
        <!-- Contact -->
        <li class="menu-item {{ request()->is('dashboard/contacts') ? 'active' : '' }}">
            <a href="{{ route('dashboard.contact') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-envelope"></i>
                <div data-i18n="Basic">Contacts</div>
            </a>
        </li>
        @endif
        @if (Auth::user()->role_id != 1)
        <!-- Reports -->
        <li class="menu-item {{ request()->is('dashboard/reports*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.reports.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-file"></i>
                <div data-i18n="Basic">Reports</div>
            </a>
        </li>
        @endif

        @if(Auth::user()->role_id == 1)
        <!-- Cetak Laporan -->
        <li class="menu-item {{ request()->is('dashboard/print-reports*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.print-reports.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-printer"></i>
                <div data-i18n="Basic">Cetak Laporan</div>
            </a>
        </li>
        @endif

        @if(Auth::user()->role_id == 1 || Auth::user()->role_id == 3)
        <!-- Feedbacks -->
        <li class="menu-item {{ request()->is('dashboard/feedbacks*') ? 'active' : '' }}">
            <a href="{{ route('dashboard.feedbacks.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-message-dots"></i>
                <div data-i18n="Basic">Feedbacks</div>
            </a>
        </li>
        @endif
    </ul>
</aside>
<!-- / Menu -->
