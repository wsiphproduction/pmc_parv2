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
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/icons/Download-Tools-PNG-Image.png')); ?>">
    <!-- vendor css -->
    <link href="<?php echo e(asset('assets/lib/@fontawesome/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.auth.css')); ?>">

</head>
<body>
    <div class="content content-fixed content-auth">
        <div class="container">
            <div class="media align-items-stretch justify-content-center ht-100p pos-relative">
                <div class="media-body align-items-center d-none d-lg-flex">
                    <div class="mx-wd-800">
                        <img src="<?php echo e(asset('assets/img/logo/warehouse.jpg')); ?>" class="img-fluid" alt="">
                    </div>
                </div>
                <div class="sign-wrapper mg-lg-l-50 mg-xl-l-60">
                    <div class="wd-100p">

                        <h3 class="tx-color-01 mg-b-5">Sign In</h3>
                        <p class="tx-color-03 tx-16 mg-b-40">Welcome back! Please signin to continue.</p>
                        
                        <?php if($message = Session::get('msg')): ?>
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i data-feather="alert-circle" class="mg-r-10"></i> <?php echo e($message); ?>

                            </div>
                        <?php endif; ?>

                        <?php if($message = Session::get('error')): ?>
                            <div class="alert alert-solid alert-danger d-flex align-items-center mg-b-10" role="alert">
                                <?php echo e($message); ?>

                            </div>
                        <?php endif; ?>

                        <form method="POST" action="<?php echo e(url('/par/checklogin')); ?>">
                            <?php echo csrf_field(); ?>
                            <div class="form-group">
                                <label>Username <i class="tx-danger">*</i></label>
                                <input autofocus required type="text" name="domainAccount" class="form-control" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-between mg-b-5">
                                    <label class="mg-b-0-f">Password <i class="tx-danger">*</i></label>
                                </div>
                                <input required type="password" name="password" class="form-control" placeholder="Enter your password">
                            </div>
                            <button type="submit" class="btn btn-brand-02 btn-block">Sign In</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div>
            <span>&copy; 2019 Philsaga Mining Corporation </span>
            <span><a href="#">Property Accountability Records System v2</a></span>
        </div>
    </footer>

    <script src="<?php echo e(asset('assets/lib/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>

</body>
</html>
