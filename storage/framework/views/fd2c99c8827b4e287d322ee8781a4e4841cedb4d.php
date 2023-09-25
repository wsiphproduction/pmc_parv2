<?php $__env->startSection('pagecss'); ?>
    <link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Item Management</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Non-Stock Items</h4>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pd-y-15 pd-x-10">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table mg-b-0 table-striped">
                                <thead>
                                    <form id="filter_saved_nonstock_item">
                                    <?php echo csrf_field(); ?>
                                        <th><input type="text" name="itemid" class="form-control"></th>
                                        <th><input type="text" name="dscptn" class="form-control"></th>
                                        <th><input type="text" name="exptyp" class="form-control"></th>
                                        <th><input type="text" name="serial" class="form-control"></th>
                                        <th></th>
                                        <th><input type="text" name="assetc"   class="form-control"></th>
                                        <th><input type="text" name="po_num" class="form-control"></th>
                                        <th><input type="text" name="dr_num" class="form-control"></th>
                                        <th><button type="submit" class="btn btn-primary"><i data-feather="filter"></i></button></th>
                                    </form>
                                </thead>
                                <thead class="thead-secondary">
                                    <tr>
                                        <th class="wd-10p">ID</th>
                                        <th class="wd-30p">Description</th>
                                        <th class="wd-10p">Expense Type</th>
                                        <th class="wd-10p">Serial #</th>
                                        <th class="wd-5p">Cost</th>
                                        <th class="wd-10p">Asset Code</th>
                                        <th class="wd-10p">PO #</th>
                                        <th class="wd-10p">DR #</th>
                                        <th class="wd-5p">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="items_tbl">
                                    <?php $__empty_1 = true; $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr class="tx-12">
                                            <th scope="row" class="wd-5p"><a href="/item/details/<?php echo e($item->id); ?>" target="_blank"><?php echo e($item->id); ?></a></th>
                                            <td class="wd-390"><?php echo e(strtoupper($item->description)); ?></td>
                                            <td><?php echo e($item->expense_type); ?></td>
                                            <td><?php echo e($item->serial_no); ?></td>
                                            <td><?php echo e(number_format($item->cost,2)); ?></td>
                                            <td><?php echo e($item->asset_code); ?></td>
                                            <td><?php echo e($item->po_no); ?></td>
                                            <td><?php echo e($item->dr_no); ?></td>
                                            <td>
                                                <?php 
                                                    $check = \App\Items::check_item_status($item->id); 
                                                ?>
                                                <?php if($check == 1): ?>
                                                    <a href="/item/edit/<?php echo e($item->id); ?>" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </a>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="11"><center>No items found</center></td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mg-t-5"><?php echo e($items->links()); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php echo $__env->make('Item.modals', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>

    <script>
        $(function(){
            'use strict'
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Search Category'
            });
        });

        $(document).on("click", ".open-item", function () {
            var item        = $(this).data('item');
            var details     = $(this).data('det');
            var tracking    = $(this).data('tracking');
            var tid         = $(this).data('tid');

            $(".modal-body #item").val( item );
            $(".modal-body #det").val( details );
            $(".modal-body #track").val( tracking );
            $(".modal-body #tid").val( tid );
        });
    </script>
    
    <script type="text/javascript">
        $(document).ready(function(){
            $('#filter_saved_nonstock_item').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/filter/saved-nonstock-items",
                    data: $('#filter_saved_nonstock_item').serialize(),
                    success: function( response ) {
                        $('#items_tbl').html(response);  
                    }
                });
            });
        });
    </script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>