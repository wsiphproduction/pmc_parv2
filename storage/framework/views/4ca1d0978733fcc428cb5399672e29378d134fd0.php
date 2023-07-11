<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.profile.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="row">
    <div class="col-sm-6">
        <h6 class="tx-20 mg-b-10 mg-t-10"><a href="/par/details/<?php echo e($hid); ?>"><?php echo e($item->stock_code); ?></a></h6>
        <p class="mg-b-0"><?php echo e($item->description); ?></p>
    </div>
    <div class="col-sm-6 tx-right d-none d-md-block"></div>
    <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Item Details</label>
        <p class="mg-b-0">Expense Type: <?php echo e($item->expense_type); ?></p>
        <p class="mg-b-0">Stock Type: <?php echo e($item->stock_type); ?></p>
        <p class="mg-b-0">Inv Code: <?php echo e($item->inv_code); ?></p>
        <p class="mg-b-0">Cost: <?php echo e(number_format($item->cost,2)); ?></p>
    </div>
    <div class="col-sm-6 col-lg-4 mg-t-40">
        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Reference Information</label>
        <ul class="list-unstyled lh-7">
            <li class="d-flex justify-content-between">
                <span>Serial #</span>
                <span><?php echo e($item->serial_no); ?></span>
            </li>
            <li class="d-flex justify-content-between">
                <span>Issuance Doc Ref #</span>
                <span>32334300</span>
            </li>
            <li class="d-flex justify-content-between">
                <span>Asset Code</span>
                <span><?php echo e($item->asset_code); ?></span>
            </li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>