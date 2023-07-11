<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.profile.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
<div class="row">
    <div class="mg-t-10">
        <?php
            $grouped = $datas->groupBy('employee_id');
            $grouped->toArray();
        ?>

        <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card mg-b-10">
                <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                    <div>
                        <h4 class="mg-b-5"><?php echo e($d[0]['employee_id']); ?> <?php echo e($d[0]['emp_name']); ?></h4>
                        <p><?php echo e($d[0]['dept']); ?></p>
                    </div>
                </div>
              
                <div class="table-responsive">
                    <table class="table table-dashboard mg-b-0">
                  
                        <thead>
                            <tr class="group">
                                <div class="col">
                                <th>Document Date</th>
                                  </div>
                                 <div class="col"> 
                                <th>Par ID</th>
                                  </div>
                                  <div class="col">
                                <th>Description</th>
                                    </div>
                                  <div class="col">  
                                <th class="serial">Serial #</th>
                                 </div>
                                 <div class="col">
                                <th>Item Status</th>
                                 </div>
                                  <div class="col">  
                                <th>Document Status</th>
                                    </div>
                                  <div class="col">  
                                <th>Qty</th>
                                    </div>
                                  <div class="col">  
                                <th>Cost</th>
                                   </div>
                            </tr>
                        </thead>
                        </div>
                        
                        <tbody>
                             <?php
                                $total = 0;
                            ?>
                            <?php $__currentLoopData = $d; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $total += $i->qty*$i->cost ?>
                                <?php if($i->status != 'CLOSED'): ?>
                                <tr>
                                <td class="tx-color-03 tx-normal"><?php echo e($i->document_date); ?></td>
                                <td class="tx-medium"><?php echo e($i->refcode); ?></td>
                                <td class="tx-medium"><?php echo e($i->description); ?></td>
                                <td class="tx-color-03 tx-normal"><?php echo e($i->serial_no); ?></td>
                                <td class="tx-color-03 tx-normal"><?php echo e($i->status); ?></td>
                                <td class="tx-color-03 tx-normal"><?php echo e(strtoupper($i->doc_status)); ?></td>
                                <td class="tx-color-03 tx-normal text-right"><?php echo e($i->qty); ?></td>
                                <td class="tx-color-03 tx-normal text-right"><?php echo e($i->cost); ?></td>
                            </tr>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td colspan="7" class="tx-medium">Grand Total</td>
                                <td class="tx-medium text-right"><?php echo e(number_format($total,2)); ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>
</div>

<?php $__env->stopSection(); ?>



<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>