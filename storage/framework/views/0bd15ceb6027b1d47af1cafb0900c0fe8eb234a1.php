<?php
    $grouped = $par_details->groupBy('header_id');
    $grouped->toArray();
?>

<?php $__empty_1 = true; $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        if($d[0]['doc_status'] == 'saved'){
            $btn = '#10b759';
        }

        if($d[0]['doc_status'] == 'posted'){
            $btn = '#ffc107';
        }

        if($d[0]['doc_status'] == 'closed'){
            $btn = '#dc3545';
        }

        if($d[0]['doc_status'] == 'adjustment'){
            $btn = '#00b8d4';
        }
    ?>
<div class="trainings-wrapper" style="border-left: 5px solid <?php echo e($btn); ?>;">
    <div class="card-header d-sm-flex align-items-start justify-content-between pd-b-0 pd-l-1">
        <div class="mg-t-10">
            <h6 class="mg-b-5"><a href="javascript:;" onclick="$('#detailsd<?php echo e($d[0]['header_id']); ?>').toggle();"><?php echo e($d[0]['refcode']); ?> :</a>
                
                <?php if($d[0]['is_dept'] == 0): ?>
                    <a href="/<?php echo e($d[0]['employee_id']); ?>/accountability"><?php echo e($d[0]['employee_id']); ?> : <?php echo e($d[0]['emp_name']); ?></a>
                <?php else: ?>
                    <?php echo e($d[0]['accountable']); ?>

                <?php endif; ?>
                    
                &nbsp;<small><?php echo e($d[0]['dept']); ?> </small> - 
                &nbsp;<small><?php echo e($d[0]['document_date']); ?> </small> - 
                &nbsp;<small> [ <strong> doc status </strong> <?php echo e(strtoupper($d[0]['doc_status'])); ?> ] </small> - 
                &nbsp;<small> [ <strong> item status </strong> <?php echo e(strtoupper($d[0]['status'])); ?> ] </small> 
            </h6>
        </div>

        <div class="d-flex mg-t-20 mg-sm-t-0">
            <span class="pull-right mg-b-5">
                <div class="d-none d-md-block">
                    <?php if($d[0]['doc_status'] == 'closed'): ?>
                        <a href="/par/details/<?php echo e($d[0]['header_id']); ?>" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                            <i class="fa fa-eye"></i>
                        </a>
                        <a href="/par/print/<?php echo e($d[0]['header_id']); ?>" title="Print Par Details" target="_blank" title="Print PAR" class="btn btn-info btn-xs">
                            <i class="fa fa-print"></i>
                        </a>
                    <?php else: ?>
                            <?php if($d[0]['doc_status'] == 'posted'): ?>
                                <a href="/par/details/<?php echo e($d[0]['header_id']); ?>" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="/par/print/<?php echo e($d[0]['header_id']); ?>" title="Print Par Details" target="_blank" class="btn btn-info btn-xs">
                                    <i class="fa fa-print"></i>
                                </a>
                                <?php if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write'): ?>
                                    <a href="/par/recreate/<?php echo e($d[0]['header_id']); ?>" title="Recreate Par" class="btn btn-warning btn-xs">
                                        <i class="fa fa-reply"></i>
                                    </a>
                                    <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="<?php echo e($d[0]['refcode']); ?>" data-a="<?php echo e($d[0]['accountable']); ?>" data-dd="<?php echo e($d[0]['document_date']); ?>" data-ab="<?php echo e($d[0]['added_by']); ?>" data-ad="<?php echo e($d[0]['created_at']); ?>" data-eid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-primary btn-xs email-par">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    <?php if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0): ?>
                                    <a href="#" title="Close PAR" data-toggle="modal" data-target="#close-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-danger btn-xs close-par">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php else: ?>
                                <a href="/par/details/<?php echo e($d[0]['header_id']); ?>" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="/par/print/<?php echo e($d[0]['header_id']); ?>" title="Print Par Details" target="_blank" class="btn btn-info btn-xs">
                                    <i class="fa fa-print"></i>
                                </a>
                                 <?php if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write'): ?>
                                    <a href="/par/edit/<?php echo e($d[0]['header_id']); ?>" title="Edit Par Details" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" title="Post Par" data-target="#post-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-warning btn-xs post-par">
                                        <i class="fa fa-stamp"></i>
                                    </a>
                                    <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="<?php echo e($d[0]['refcode']); ?>" data-a="<?php echo e($d[0]['accountable']); ?>" data-dd="<?php echo e($d[0]['document_date']); ?>" data-ab="<?php echo e($d[0]['added_by']); ?>" data-ad="<?php echo e($d[0]['created_at']); ?>" data-eid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-primary btn-xs email-par">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    <?php if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0): ?>
                                        <a href="#" title="Close PAR" data-toggle="modal" data-target="#close-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-danger btn-xs close-par">
                                            <i data-feather="x-square"></i>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                    <?php endif; ?>
                </div>
            </span>
        </div>
    </div>
    
    <div class="table-responsive" style="display: none;" id="detailsd<?php echo e($d[0]['header_id']); ?>">
        <table class="table table-sm">
            <thead class="thead-secondary">
                <tr class="tx-12">
                    <th class="wd-10p">Stock Code</th>
                    <th class="wd-45p">Description</th>
                    <th class="wd-10p">Serial #</th>
                    <th class="wd-10p">Status</th>
                    <th class="wd-5p">Qty</th>
                    <th class="wd-10p">Cost</th>
                    <th class="wd-10p"></th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $d; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr class="tx-12">
                    <td><?php echo e(isset($i->stock_code) ? $i->stock_code : 'N/A'); ?></td>
                    <td><?php echo e($i->description); ?></td>
                    <td><?php echo e($i->serial_no); ?></td>
                    <td>
                        <?php if($i->status == 'OPEN'): ?>
                            <span class="label label-sm label-success ">OPEN</span>
                        <?php endif; ?>

                        <?php if($i->status == 'CLOSED'): ?>
                            <span class="label label-sm label-danger ">CLOSED</span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($i->qty); ?></td>
                    <td><?php echo e($i->cost); ?></td>
                    
                    <td>
                        <?php if($d[0]['doc_status'] == 'saved' || $d[0]['doc_status'] == 'closed' || $d[0]['doc_status'] == 'adjustment'): ?>
                            <a href="/item/details/<?php echo e($i->item_id); ?>" data-placement="bottom" title="View Par Details" target="_blank">
                                <i class="fa fa-eye"></i>
                            </a>
                        <?php else: ?>
                            <?php if($i->status == 'CLOSED'): ?>
                                <a href="/item/details/<?php echo e($i->item_id); ?>" class="mg-l-5" data-placement="bottom" title="View Par Details" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>
                            <?php else: ?>
                                <a href="/item/details/<?php echo e($i->item_id); ?>" class="mg-l-5" data-placement="bottom" title="View Par Details" target="_blank">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <?php if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write'): ?>
                                    <a href="#close-item" class="mg-l-5 close-item" data-hid="<?php echo e($d[0]['header_id']); ?>" data-iid="<?php echo e($i->item_id); ?>" data-qty="<?php echo e($i->qty); ?>" data-cost="<?php echo e($i->cost); ?>" data-toggle="modal" title="Close Item">
                                        <i class="fa fa-times"></i>
                                    </a>

                                    <a href="#transfer-item" class="mg-l-5 transfer-item" data-hid="<?php echo e($d[0]['header_id']); ?>" data-iid="<?php echo e($i->item_id); ?>" data-desc="<?php echo e($i->description); ?>" data-cost="<?php echo e($i->cost); ?>" data-qty="<?php echo e($i->qty); ?>" data-dept="<?php echo e($i->is_dept); ?>" data-toggle="modal" title="Transfer Item">
                                        <i class="fa fa-link"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                    <td>
                        <input class='checkbox' type="checkbox" data-check="checkbox-<?php echo e($d[0]['header_id']); ?>" name="checkboxes[]" value="<?php echo e($i->id); ?>" data-row="<?php echo e(json_encode($i)); ?>" data-header="<?php echo e($d[0]['header_id']); ?>">
                    </td>   
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <center><span class="badge badge-info">No accountability founds . . .</span></center>
<?php endif; ?>
