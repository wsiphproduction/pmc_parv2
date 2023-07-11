<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>PMC - PAR v2</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo e(asset('assets/img/icons/Download-Tools-PNG-Image.png')); ?>">

    <!-- vendor css -->
    <link href="<?php echo e(asset('assets/lib/@fortawesome/fontawesome-free/css/all.min.css')); ?>" rel="stylesheet">
    <link href="<?php echo e(asset('assets/lib/ionicons/css/ionicons.min.css')); ?>" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.dashboard.css')); ?>">

    <link rel="stylesheet" id="dfMode" href="<?php echo e(asset('assets/css/skin.light.css')); ?>">
    <link rel="stylesheet" id="dfSkin" href="<?php echo e(asset('assets/css/skin.deepblue.css')); ?>">

    <?php echo $__env->yieldContent('pagecss'); ?>
</head>
<body>
    <?php echo $__env->make('layouts.sidebar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <div class="content ht-100v pd-0">
        <div class="content-header">
            <div class="content-search content-company wd-400">
                <h3 class="tx-15 mg-b-0 dept_header" style="color:#fbeaeb;"><?php echo e(Auth::user()->dept != '' ? Auth::user()->dept : 'Material Control Department'); ?> </h3>
            </div>
        </div>
        <div class="content-body">
            <div class="container pd-x-0">
                <?php echo $__env->yieldContent('content'); ?>

                <footer class="content-footer">
                    <div>
                        <span><a href="javascript:;">Property Accountability Records System v2</a></span>
                    </div>
                    <div>
                        <nav class="nav">
                            <a href="javascript:;" class="nav-link"><span>&copy; 2019 </span> Philsaga Mining Corporation</a>
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
                <h6 class="mg-b-0 tx-white"><?php echo e(Session::get('success')); ?></h6>
            </div>
        </div>    
    </div>

    <div class="pos-fixed b-10 r-10">
        <div id="toast_failed" class="toast bg-danger bd-0 wd-300" data-delay="5000" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-transparent bd-white-1">
                <h6 class="tx-white mg-b-0 mg-r-auto">Failed</h6>
            </div>
            <div class="toast-body pd-10 tx-white">
                <h6 class="mg-b-0 tx-white"><?php echo e(Session::get('failed')); ?></h6>
            </div>
        </div>    
    </div>

    <div class="modal fade effect-flip-horizontal" id="modalEditContact" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="/update/account" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body pd-20 pd-sm-30">
                        <button type="button" class="close pos-absolute t-15 r-20" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>

                        <h5 class="tx-18 tx-sm-20 mg-b-20">Update Account</h5>
                        <div class="alert alert-info d-flex align-items-center" role="alert">
                          <i data-feather="alert-circle" class="mg-r-10"></i> If password was changed, you will be automatically logout!
                        </div>

                        <div class="d-sm-flex">
                            <div class="mg-sm-r-30">
                                <div class="pos-relative d-inline-block mg-b-20">
                                    <div class="avatar avatar-xxl">
                                        <a href="" class="avatar"><img src="<?php echo e(asset('avatars/'.Auth::user()->avatar.'')); ?>" class="rounded-circle" alt=""></a>
                                    </div>
                                </div>
                            </div>
                            <div class="flex-fill">
                                <h6 class="mg-b-10">Personal Information</h6>
                                <div class="form-group mg-b-10">
                                    <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
                                    <input readonly type="text" class="form-control" value="<?php echo e(Auth::user()->fullName); ?>">
                                </div>

                                <h6 class="mg-t-20 mg-b-10">Contact Information</h6>

                                <div class="form-group mg-b-10">
                                    <input readonly type="text" name="domain" class="form-control" value="<?php echo e(Auth::user()->domainAccount); ?>">
                                </div><!-- form-group -->
                                <div class="form-group mg-b-10">
                                    <input type="email" name="email" class="form-control" placeholder="Enter Email Address" value="<?php echo e(Auth::user()->email); ?>">
                                </div><!-- form-group -->
                            
                                <h6 class="mg-t-20 mg-b-10">Change Password</h6>
                                <input type="password" class="form-control" name="password">
                            </div><!-- col -->
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="wd-100p d-flex flex-column flex-sm-row justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary mg-b-5 mg-sm-b-0">Save Changes</button>
                            <button type="button" class="btn btn-sm btn-secondary mg-sm-l-5" data-dismiss="modal">Discard</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="modal effect-flip-horizontal" id="modalAvatar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Change Avatar</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/upload/avatar" method="post" role="form" enctype="multipart/form-data">
                    <?php echo csrf_field(); ?>
                    <div class="modal-body">
                        <input type="hidden" name="id" value="<?php echo e(Auth::user()->id); ?>">
                        <input type="hidden" name="domain" class="form-control" value="<?php echo e(Auth::user()->domainAccount); ?>">
                        <input required type="file" class="form-control" name="avatar" multiple>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Upload Avatar</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo e(asset('assets/lib/jquery/jquery.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/feather-icons/feather.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js')); ?>"></script>

    <script src="<?php echo e(asset('assets/js/dashforge.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashforge.aside.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/js/dashforge.sampledata.js')); ?>"></script>

    <?php if(Session::get('success')): ?>
    <script>
        $('#toast_success').toast('show');
    </script>
    <?php endif; ?>

    <?php if(Session::get('failed')): ?>
    <script>
        $('#toast_failed').toast('show');
    </script>
    <?php endif; ?>

    <?php echo $__env->yieldContent('pagejs'); ?>

</body>
</html>
