<?php $__env->startSection('pagecss'); ?>
<link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">App Maintenance</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Data Maintenance</h4>
    </div>
</div>

<div class="row">
    <!-- Stock Type -->
    <div class="col-md-6 col-xl-4 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Stock Type</h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="#stock-add" data-toggle="modal" class="link-03 lh-0"><i data-feather="plus-square"></i></a>
                </div>
            </div>
            <ul class="list-group list-group-flush tx-13">
                <?php $__currentLoopData = $stock_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex pd-sm-x-20">
                    <div class="pd-sm-l-10">
                        <p class="tx-medium mg-b-0"><?php echo e($stock->code); ?></p>
                        <small class="tx-12 tx-color-03 mg-b-0"><?php echo e($stock->description); ?></small>
                    </div>
                    <div class="mg-l-auto d-flex align-self-center">
                        <nav class="nav nav-icon-only">
                            <a href="#stock-edit" data-toggle="modal" data-stock_id="<?php echo e($stock->id); ?>" data-type="<?php echo e($stock->code); ?>" data-desc="<?php echo e($stock->description); ?>" class="nav-link d-none d-sm-block stock_edit"><i data-feather="edit"></i></a>
                            <a href="#stock-delete" data-toggle="modal" data-stock_id="<?php echo e($stock->id); ?>" class="nav-link d-none d-sm-block stock_delete"><i data-feather="x-square"></i></a>
                        </nav>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
    
    <!-- Close Type -->
    <div class="col-md-6 col-xl-4 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Par Close Type</h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="#close-add" data-toggle="modal" class="link-03 lh-0"><i data-feather="plus-square"></i></a>
                </div>
            </div>
            <ul class="list-group list-group-flush tx-13">
                <?php $__currentLoopData = $close_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $close): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex pd-sm-x-20">
                    <div class="pd-l-10">
                        <p class="tx-medium mg-b-0">ID # <?php echo e($close->id); ?></p>
                        <small class="tx-12 tx-color-03 mg-b-0"><?php echo e($close->description); ?></small>
                    </div>
                    <div class="mg-l-auto d-flex align-self-center">
                        <nav class="nav nav-icon-only">
                            <a href="#close-edit" data-toggle="modal" data-id="<?php echo e($close->id); ?>" data-desc="<?php echo e($close->description); ?>" class="nav-link d-none d-sm-block close_edit"><i data-feather="edit"></i></a>
                            <a href="#close-delete" data-toggle="modal" data-id="<?php echo e($close->id); ?>" class="nav-link d-none d-sm-block close_delete"><i data-feather="x-square"></i></a>
                        </nav>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div><!-- card -->
    </div>

    <!-- Department Code -->
    <div class="col-md-6 col-xl-4 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Department Codes</h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="#dept-add" data-toggle="modal" class="link-03 lh-0"><i data-feather="plus-square"></i></a>
                </div>
            </div>
            <ul class="list-group list-group-flush tx-13">
                <?php $__currentLoopData = $dept_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="list-group-item d-flex pd-sm-x-20">
                    <div class="pd-sm-l-10">
                        <p class="tx-medium mg-b-0"><?php echo e($dept->code); ?></p>
                        <small class="tx-12 tx-color-03 mg-b-0"><?php echo e($dept->description); ?></small>
                    </div>
                    <div class="mg-l-auto d-flex align-self-center">
                        <nav class="nav nav-icon-only">
                            <a href="#dept-edit" data-toggle="modal" data-dept_id="<?php echo e($dept->id); ?>" data-code="<?php echo e($dept->code); ?>" data-desc="<?php echo e($dept->description); ?>" class="nav-link d-none d-sm-block dept_edit"><i data-feather="edit"></i></a>
                            <a href="#dept-delete" data-toggle="modal" data-dept_id="<?php echo e($dept->id); ?>" class="nav-link d-none d-sm-block dept_delete"><i data-feather="x-square"></i></a>
                        </nav>
                    </div>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    </div>
</div>
<?php echo $__env->make('maintenance.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
<script>
    $(document).on("click", ".close_edit", function () {
        $(".modal-body #eclose_id").val($(this).data('id'));
        $(".modal-body #close_desc").val($(this).data('desc'));
    });

    $(document).on("click", ".close_delete", function () {
        $(".modal-body #dclose_id").val($(this).data('id'));
    });

    $(document).on("click", ".stock_edit", function () {
        $(".modal-body #estock_id").val($(this).data('stock_id'));
        $(".modal-body #stype").val($(this).data('type'));
        $(".modal-body #sdesc").val($(this).data('desc'));
    });

    $(document).on("click", ".stock_delete", function () {
        $(".modal-body #dstock_id").val($(this).data('stock_id'));
    });

    $(document).on("click", ".dept_edit", function () {
        $(".modal-body #edeptid").val($(this).data('dept_id'));
        $(".modal-body #deptcode").val($(this).data('code'));
        $(".modal-body #ddesc").val($(this).data('desc'));
    });

    $(document).on("click", ".dept_delete", function () {
        $(".modal-body #ddeptid").val($(this).data('dept_id'));
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>