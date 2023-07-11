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
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/icons/Download-Tools-PNG-Image.png') }}">

    <!-- vendor css -->
    <link href="{{ asset('assets/lib/@fontawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.auth.css') }}">

</head>
<body>

    <div class="content content-fixed content-auth">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p">
                <div class="sign-wrapper mg-lg-r-50 mg-xl-r-60">
                    <div class="pd-t-20 wd-100p">
                        @if($message = Session::get('error'))
                        <div class="alert alert-solid alert-danger d-flex align-items-center mg-b-10" role="alert">
                            {{ $message }}
                        </div>
                        @endif
                        <h4 class="tx-color-01 mg-b-5">Sign In</h4>
                        <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
                        
                        <form method="POST" action="{{ url('/dept/checklogin') }}">
                            @csrf
                            <div class="form-group">
                                <label>Username <i class="text-danger">*</i></label>
                                <input autofocus required type="text" name="domainAccount" class="form-control" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">Password <i class="text-danger">*</i></label>
                                </div>
                                <input required type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>
                            <button class="btn btn-brand-02 btn-block">Sign In</button>
                        </form>
                    </div>
                </div><!-- sign-wrapper -->
                <div class="media-body pd-y-30 pd-lg-x-50 pd-xl-x-60 align-items-center d-none d-lg-flex pos-relative">
                    <div class="mx-lg-wd-500 mx-xl-wd-550">

                        <img src="{{ asset('assets/img/logo/acc/logo8.jpg') }}" class="img-fluid" alt="">
                    </div>
                </div><!-- 1280 x 1255 media-body -->
            </div><!-- media -->
        </div><!-- container -->
    </div><!-- content -->

    <footer class="footer">
        <div>
            <span>&copy; 2019 DashForge v1.0.0. </span>
            <span>Created by <a href="http://themepixels.me">ThemePixels</a></span>
        </div>
        <div>
            <nav class="nav">
                <a href="https://themeforest.net/licenses/standard" class="nav-link">Licenses</a>
                <a href="../../change-log.html" class="nav-link">Change Log</a>
                <a href="https://discordapp.com/invite/RYqkVuw" class="nav-link">Get Help</a>
            </nav>
        </div>
    </footer>

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
</body>
</html>
