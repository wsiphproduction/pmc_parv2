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

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.dashboard.css') }}">

    <link rel="stylesheet" id="dfMode" href="{{ asset('assets/css/skin.cool.css') }}">
    <link rel="stylesheet" id="dfSkin" href="{{ asset('assets/css/skin.charcoal.css') }}">

    <style>
        .content-header {
            background-color: #2f3c7e;
        }
    </style>  

    @yield('pagecss')
  </head>
  <body>

    @include('accounting.layouts.sidebar')

    <div class="content ht-100v pd-0">

        <div class="content-header">
            <div class="content-search content-company wd-400">
                <h3 class="tx-15 mg-b-0" style="color:#fbeaeb;">{{ Auth::user()->dept }}</h3>
            </div>
        </div>
        <div class="content-body">
            <div class="container pd-x-0">
                @yield('content')

                <footer class="content-footer">
                    <div>
                        <span>&copy; 2019 </span>
                        <span><a href="/dashboard">Property Accountability Records System v2</a></span>
                    </div>
                    <div>
                        <nav class="nav">
                          <a href="javascript:;" class="nav-link">Philsaga Mining Corporation</a>
                        </nav>
                    </div>
                </footer>
            </div>
        </div>
    </div>

    <div class="pos-fixed b-10 r-10">
        <div id="toast_success" class="toast bg-success bd-0 wd-300" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-transparent bd-white-1">
                <h6 class="tx-white mg-b-0 mg-r-auto">Success</h6>
            </div>
            <div class="toast-body pd-10 tx-white">
                <h6 class="mg-b-0 tx-white">{{ Session::get('success') }}</h6>
            </div>
        </div>    
    </div>

    <div class="pos-fixed b-10 r-10">
        <div id="toast_failed" class="toast bg-danger bd-0 wd-300" data-delay="3000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-transparent bd-white-1">
                <h6 class="tx-white mg-b-0 mg-r-auto">Failed</h6>
            </div>
            <div class="toast-body pd-10 tx-white">
                <h6 class="mg-b-0 tx-white">{{ Session::get('failed') }}</h6>
            </div>
        </div>    
    </div>

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.sampledata.js') }}"></script>

    @if(Session::get('success'))
        <script>
            $('#toast_success').toast('show');
        </script>
    @endif

    @if(Session::get('failed'))
        <script>
            $('#toast_failed').toast('show');
        </script>
    @endif

    @yield('pagejs')

  </body>
</html>
