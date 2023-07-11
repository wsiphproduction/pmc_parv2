<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>PMC - PAR v2</title>

    <!-- vendor css -->
    <link href="{{ asset('assets/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/quill/quill.core.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/quill/quill.snow.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.mail.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/modals.css') }}">

</head>
<body class="app-mail">

    <header class="navbar navbar-header navbar-header-fixed">
        <a href="" id="mainMenuOpen" class="burger-menu d-none d-md-flex d-lg-none"><i data-feather="menu"></i></a>
        <a href="" id="mailSidebar" class="burger-menu d-md-none"><i data-feather="arrow-left"></i></a>
        <div class="navbar-brand">
            <a href="/dashboard" target="_blank" class="df-logo">PAR<span>&nbsp;v2</span></a>
        </div>
        <div class="navbar-right">
            <div class="dropdown dropdown-profile">
                <a href="" class="dropdown-link" data-toggle="dropdown" data-display="static">
                    <div class="avatar avatar-sm"><img src="{{ asset('assets/img/logo/user.jpg') }}" class="rounded-circle" alt=""></div>
                </a>
                <div class="dropdown-menu dropdown-menu-right tx-13">
                    <div class="avatar avatar-lg mg-b-15"><img src="https://via.placeholder.com/500" class="rounded-circle" alt=""></div>
                    <h6 class="tx-semibold mg-b-5">{{ Auth::user()->fullName }}</h6>
                    <p class="mg-b-25 tx-12 tx-color-03 tx-uppercase">{{ Auth::user()->role }}</p>
                    <a href="/par/logout" class="dropdown-item"><i data-feather="log-out"></i>Sign Out</a>
                </div>
            </div>
        </div>
    </header>

    <div class="mail-wrapper">
        <div class="mail-sidebar">
            <div class="mail-sidebar-body">
                <div class="pd-20">
                    <a href="/dashboard" class="btn btn-primary btn-block tx-uppercase tx-10 tx-medium tx-sans tx-spacing-4 text-white">Back to Home</a>
                </div>
            </div><!-- mail-sidebar-body -->
        </div>

        <div class="mail-group">
            <div class="mail-group-header">
                <i data-feather="search"></i>
                <div class="search-form">
                    <input type="search" class="form-control" placeholder="Search PAR or Tracking #">
                </div>
            </div>

            <div class="mail-group-body">
                <div class="pd-y-15 pd-x-20 d-flex justify-content-between align-items-center">
                    <h6 class="tx-uppercase tx-semibold mg-b-0">Inbox</h6>
                </div>
                <ul class="list-unstyled media-list mg-b-0">
                    @foreach($requests as $pending)
                        @if($pending->type == 'PAR')
                            <a href="#" data-rid="{{ $pending->id }}" style="color:blue;" class="request_par">
                                <li class="media @if($pending->status == 'waiting') unread @endif">
                                        <div class="avatar"><span class="avatar-initial rounded-circle bg-indigo">P</span></div>
                                    <div class="media-body mg-l-15">
                                        <div class="tx-color-03 d-flex align-items-center justify-content-between mg-b-2">
                                            <span class="tx-12">{{ $pending->requested_by }}</span>
                                            <span class="tx-11">{{ $pending->requested_date }}</span>
                                        </div>
                                        <h6 class="tx-13">{{ $pending->e_subject }}</h6>
                                        <p class="tx-12 tx-color-03 mg-b-0">{{ str_limit($pending->reason, 50, '...') }}</p>
                                    </div>
                                </li>
                            </a>
                        @else
                            <a href="#" data-iid="{{ $pending->par_id }}" style="color:blue;" class="request_item">
                                <li class="media @if($pending->status == 'waiting') unread @endif">
                                        <div class="avatar"><span class="avatar-initial rounded-circle bg-teal">I</span></div>
                                    <div class="media-body mg-l-15">
                                        <div class="tx-color-03 d-flex align-items-center justify-content-between mg-b-2">
                                            <span class="tx-12">{{ $pending->requested_by }}</span>
                                            <span class="tx-11">{{ $pending->requested_date }}</span>
                                        </div>
                                        <h6 class="tx-13">{{ $pending->e_subject }}</h6>
                                        <p class="tx-12 tx-color-03 mg-b-0">{{ str_limit($pending->reason, 50, '...') }}</p>
                                    </div>
                                </li>
                            </a>
                        @endif
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="mail-content bg-white">
            <div id="request_details"></div>
        </div>
    </div>
    @include('approver.modals')

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/lib/quill/quill.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('scripts/approver.js') }}"></script>
</body>
</html>
