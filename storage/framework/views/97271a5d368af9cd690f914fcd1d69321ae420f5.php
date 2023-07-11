<?php $__env->startSection('pagecss'); ?>
    <link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">PAR Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">PPE Issuance Request</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">PPE Issuance Request Management</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pd-y-15 pd-x-10">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table mg-b-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Control #</th>
                                        <th scope="col">Recepient</th>
                                        <th scope="col">Document Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item_list">
                                    <?php $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($req->controlNum); ?></td>
                                            <td><?php echo e($req->rec); ?></td>
                                            <td><?php echo e($req->ddate); ?></td>
                                            <td><?php echo e($req->location); ?></td>
                                            <td><?php echo e($req->total_released); ?> / <?php echo e($req->total_qty); ?> </td>
                                            <td>
                                                <?php if($req->total_released != $req->total_qty): ?>
                                                <a href="/process-irms/<?php echo e($req->controlNum); ?>/<?php echo e(str_replace('/',':',$req->rec)); ?>" class="btn btn-xs btn-primary">Process</a>
                                                <?php else: ?>
                                                <span class="badge badge-success">COMPLETED</span>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mg-t-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')); ?>"></script>

    <script>
      $(function(){
        'use strict'

        $('#example1').DataTable({
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
    <script>
        $(function(){
            'use strict'
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Search Category'
            });
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>