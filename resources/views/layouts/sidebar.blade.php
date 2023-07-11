<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="#" class="aside-logo">PAR<span> v2</span></a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img src="{{ asset('avatars/'.Auth::user()->avatar.'') }}" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    <a href="#modalAvatar" data-toggle="modal" title="Change Avatar"><i data-feather="user"></i></a>
                    <a href="#modalEditContact" data-toggle="modal" title="Change Password"><i data-feather="settings"></i></a>
                    <a href="/par/logout" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
                    <h6 class="tx-semibold mg-b-0 tx-white">{{ Auth::user()->fullName }}</h6>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0 tx-uppercase">{{ Auth::user()->role }}</p>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside">
                <li class="nav-label">Menus</li>
            @if(Auth::user()->role == 'read only' || Auth::user()->is_dept == 1)
                <!-- <li class="nav-item"><a href="/dashboard" class="nav-link"><i data-feather="airplay"></i> <span>Dashboard</span></a></li> -->
                <li class="nav-item"><a href="/par/index" class="nav-link"><i data-feather="list"></i> <span>Par List</span></a></li>
                <li class="nav-item"><a href="/report/par-summary" class="nav-link"><i data-feather="file"></i> <span>Par Summary</span></a></li>
            @else
                <!-- <li class="nav-item"><a href="/dashboard" class="nav-link"><i data-feather="airplay"></i> <span>Dashboard</span></a></li> -->
                <li class="nav-item with-sub">
                    <a href="#" class="nav-link mg-r-10"><i data-feather="users"></i> <span>Par Management</span></a>
                    <ul>
                        <li><a href="/par/index"><span>Par List</span></a></li>
                        <li><a href="/par/add">New Par</a></li>
                        <li><a href="/irms/index">PPE Issuance Request</a></li>
                    </ul>
                </li>
                <li class="nav-item with-sub">
                    <a href="#" class="nav-link mg-r-10"><i data-feather="shopping-bag"></i> <span>Item Management</span></a>
                    <ul>
                        <li><a href="/item/add"><span>Add Item</span></a></li>
                        <li><a href="/item/stocked"><span>Stock Items</span></a></li>
                        <li><a href="/item/non-stock"><span>Non-Stock Items</span></a></li>
                    </ul>
                </li>
                <li class="nav-item with-sub">
                    <a href="#" class="nav-link mg-r-10"><i data-feather="chrome"></i> <span>App Maintenance</span></a>
                    <ul>
                        <li><a href="/maintenance/stock-code"><span>Stock Code Masterfile</span></a></li>
                        <li><a href="/maintenance/contractor"><span>Contractors</span></a></li>
                        @if(Auth::user()->role == 'admin')
                        <li><a href="/maintenance/user"><span>Users</span></a></li>
                        @endif
                        <li><a href="/maintenance/data"><span>Data Maintenance</span></a></li>
                    </ul>
                </li>
                <li class="nav-item with-sub">
                    <a href="#" class="nav-link mg-r-10"><i data-feather="file-text"></i> <span>Reports</span></a>
                    <ul>
                        <li><a href="/report/par-summary"><span>Par Summary</span></a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </div>
</aside>
