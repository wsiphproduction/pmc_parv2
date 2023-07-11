<aside class="aside aside-fixed">
    <div class="aside-header">
        <a href="#" class="aside-logo">PAR <span>v2</span></a>
        <a href="" class="aside-menu-link">
            <i data-feather="menu"></i>
            <i data-feather="x"></i>
        </a>
    </div>
    <div class="aside-body">
        <div class="aside-loggedin">
            <div class="d-flex align-items-center justify-content-start">
                <a href="" class="avatar"><img src="{{ asset('assets/img/logo/user.jpg') }}" class="rounded-circle" alt=""></a>
                <div class="aside-alert-link">
                    <a href="/dept/logout" data-toggle="tooltip" title="Sign out"><i data-feather="log-out"></i></a>
                </div>
            </div>
            <div class="aside-loggedin-user">
                <a href="#loggedinMenu" class="d-flex align-items-center justify-content-between mg-b-2" data-toggle="collapse">
                    <h6 class="tx-semibold mg-b-0 tx-white">{{ Auth::user()->fullName }}</h6>
                </a>
                <p class="tx-color-03 tx-12 mg-b-0 tx-uppercase">{{ Auth::user()->role }}</p>
            </div>
        </div><!-- aside-loggedin -->
        <ul class="nav nav-aside"><!-- 
            <li class="nav-label">Menus</li>
            <li class="nav-item"><a href="/dashboard" class="nav-link"><i data-feather="airplay"></i> <span>Dashboard</span></a></li> -->
            <li class="nav-item"><a href="/dept/par/list" class="nav-link"><i data-feather="list"></i> <span>Par List</span></a></li>
            <!-- <li class="nav-item active"><a href="/accounting/item-verification" class="nav-link"><i data-feather="briefcase"></i> <span>Item Verification <span class="badge badge-danger">{{ \App\Items::count_unverified_items() }}</span></span></a> </li> -->
            <!-- <li class="nav-item with-sub">
                <a href="#" class="nav-link mg-r-10"><i data-feather="file-text"></i> <span>Reports</span></a>
                <ul>
                    <li><a href="#"><span>List of Department</span></a></li>
                    <li><a href="#"><span>List of Employee</span></a></li>
                    <li><a href="#"><span>Contractor's Personnel</span></a></li>
                    <li><a href="#"><span>List of Contractor/Agency</span></a></li>
                </ul>
            </li> -->
        </ul>
    </div>
</aside>
