<?php $__env->startSection('pagecss'); ?>
<link rel="stylesheet" href="<?php echo e(asset('assets/css/dashforge.profile.css')); ?>">
<style>
    .content {
        overflow: hidden;
    }
    @media  print{
        .btn_print {
            display: none;
        }

        .btn_upload {
            display: none;
        }
       .content-footer {
            display: none;
        }
        .dept_header {
            display: none;
        }

        .divfiles {
            display: none;
        }
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <?php
        $grouped = $par_details->groupBy('header_id');
        $grouped->toArray();
    ?>

    <?php $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $par): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="bd-b mg-t-20">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mg-b-5">Par #<?php echo e($par[0]['refcode']); ?></h4>
                        <p class="mg-b-0 tx-color-03">Transaction Date : <?php echo e($par[0]['document_date']); ?></p>
                    </div>
                    <div class="mg-t-5 mg-sm-t-0">
                        <a href="#upload-file" class="btn btn-white btn_upload" data-toggle="modal"><i data-feather="upload" class="mg-r-5"></i> Upload Files</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Accountable To</label>
                <h6 class="tx-15"><?php if($par[0]['is_dept'] == 1): ?> <?php echo e($par[0]['dept_id']); ?> <?php else: ?> <?php echo e($par[0]['employee_id']); ?> <?php echo e($par[0]['accountable']); ?> <?php endif; ?></h6>
                <p class="mg-b-0" style="font-style: italic;"><?php if($par[0]['is_dept'] == 0): ?> <?php echo e($par[0]['dept']); ?> <?php endif; ?></p>
            </div>
            <div class="col-sm-6 tx-right d-none d-md-block">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Document Status</label>
                <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">
                    <?php if($par[0]['doc_status'] == 'saved'): ?>
                        SAVED
                    <?php endif; ?>

                    <?php if($par[0]['doc_status'] == 'posted'): ?>
                        POSTED
                    <?php endif; ?>

                    <?php if($par[0]['doc_status'] == 'closed'): ?>
                        CLOSED
                    <?php endif; ?></h1>
            </div>
            <div class="col-sm-6 col-lg-8 mg-sm-t-20">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Par Details</label>
                <p class="mg-b-0">Par Type : <?php echo e(strtoupper($par[0]['ptype'])); ?></p>
                <p class="mg-b-0">Location : <?php echo e(strtoupper($par[0]['p_location'])); ?></p>
                <p class="mg-b-0">Site : <?php echo e(strtoupper($par[0]['p_site'])); ?></p>
            </div>
            <div class="col-sm-6 col-lg-4 mg-sm-t-20">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Reference Information</label>
                <ul class="list-unstyled lh-7">
                    <li>
                        <span>Issuance Doc Ref # : </span>
                        <span><?php echo e($par[0]['doc_ref']); ?></span>
                    </li>
                    <li>
                        <span>Safety : </span>
                        <span><?php echo e($par[0]['safety']); ?></span>
                    </li>
                    <li>
                        <span>Reference Par # : </span>
                        <span><?php echo e($par[0]['bis_header_id']); ?></span>
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-8 mg-t-10 mg-sm-t-0">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                <p class="mg-b-0">Added By :  <?php echo e($par[0]['added_by']); ?></p>
                <p class="mg-b-0">Created At : <?php echo e($par[0]['created_at']); ?></p>
                <p class="mg-b-0">Remarks : <?php echo e($par[0]['remarks']); ?></p>
            </div>
            <div class="col-sm-6 col-lg-4 mg-t-10">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">&nbsp;</label>
                <ul class="list-unstyled lh-7">
                    <?php if($par[0]['doc_status'] == 'posted'): ?>
                    <li>
                        <span>Posted By : </span>
                        <span><?php echo e($par[0]['posted_by']); ?></span>
                    </li>
                    <li>
                        <span>Posted At</span>
                        <span><?php echo e($par[0]['posted_date']); ?></span>
                    </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="table-responsive mg-t-40 mg-b-20">
            <table class="table table-bordered table-invoice bd-b">
                <thead>
                    <tr>
                        <th class="wd-20p">Stock Code</th>
                        <th class="wd-40p d-none d-sm-table-cell">Description</th>
                        <th>Serial #</th>
                        <th>Status</th>
                        <th class="tx-right">Qty</th>
                        <th class="tx-right">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $g_total = 0; ?>
                    <?php $__currentLoopData = $par; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $g_total += $item->qty*$item->cost;
                        ?>
                        <tr>
                            <td><a href="/item/details/<?php echo e($item->item_id); ?>"><?php echo e(isset($item->stock_code) ? $item->stock_code : 'N/A'); ?></a></td>
                            <td class="d-none d-sm-table-cell tx-color-03"><?php echo e($item->description); ?></td>
                            <td><?php echo e($item->serial_no); ?></td>
                            <td><?php echo e($item->status); ?></td>
                            <td class="tx-right"><?php echo e($item->qty == '0.00' ? 0 : $item->qty); ?></td>
                            <td class="tx-right"><?php echo e(number_format($item->cost,2)); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <th>Grand Total</th>
                            <th colspan="5" class="text-right"><?php echo e(number_format($g_total,2)); ?></th>
                        </tr>
                </tbody>
            </table>
        </div>

        <div class="row justify-content-between divfiles">
            <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Files</label>
                <ul class="list-unstyled lh-7">
                    <?php
                        $par_id = $par[0]['header_id'];
                        $dir = '\\\\ftp\\FTP\\APP_UPLOADED_FILES\\par\\'.$par_id.'\\';
                    
                        if(is_dir($dir)){
                            $files = scandir($dir);
                            for($i=0; $i< count($files);$i++){
                                if($files[$i] != '.' && $files[$i] != '..'){
                        ?>
                                <li>
                                    <a onclick="doSomething('<?php echo e($files[$i]); ?>','<?php echo e($par_id); ?>');" href="#"><?php echo e($files[$i]); ?></a>
                                </li>
                        <?php
                                }      
                            }
                        }
                    ?>
                </ul>
            </div>
        </div>

        <div class="modal effect-scale" id="upload-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">File Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/par/file-upload" role="form" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="modal-body">
                            <input type="hidden" name="par_id" value="<?php echo e($par[0]['header_id']); ?>">
                            <input required type="file" class="form-control" name="uploadFile[]" multiple/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
<script>
    function doSomething(f,p) {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $.ajax({
            type : 'post',
            url  : '/copyFile',
            data : {
                'par'        : p,
                'fileName'  : f,
                '_token'    : $('input[name=_token]').val(),
            },
            type : 'POST',
            success : function (data) {
                window.open('<?php echo asset("storage/'+today+'/"); ?>/'+f,"_blank")
            }
        });
    }
</script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>