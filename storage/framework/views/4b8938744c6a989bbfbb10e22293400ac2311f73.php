<?php $__env->startSection('pagecss'); ?>
<link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Item Update Form</h4>
    </div>
</div>

<form autocomplete="off" action="/item/update" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
    <?php echo csrf_field(); ?>
    <div class="row row-xs">
        <div class="col-lg-8 col-xl-7 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Item Information</h6>
                </div>
                <div class="card-body">
                    <div class="form-row mg-b-20">
                        <div class="col-md-12">
                            <label for="doc_date">Description <i class="tx-danger">*</i></label>
                            <input type="hidden" name="iid" value="<?php echo e($item->id); ?>">
                            <textarea required class="form-control" rows="2" id="desc" name="desc"><?php echo e(old('desc',$item->description)); ?></textarea>
                        </div>
                    </div> 

                    <div class="form-row mg-b-15">
                        <div class="col-md-6">
                            <label for="employee">OEM ID <i class="tx-danger">*</i></label>
                            <input type="text" name="oem_id" id="oem" class="form-control" value="<?php echo e(old('oem',$item->oem_id)); ?>">
                        </div>
                        <div class="col-md-6">
                            <label for="UOM">Unit of Measurement</label>
                            <select required class="custom-select" name="uom" id="uom">
                                <option value="">Choose One</option>
                                <?php $__currentLoopData = $uom_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $uom): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option <?php if($uom->code == $item->uom): ?> selected <?php endif; ?> value="<?php echo e($uom->code); ?>"><?php echo e($uom->code); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <?php if($item->item_kind == 1): ?>
                        <div class="form-row mg-b-15">
                                <div class="col-md-4 inv_code">
                                    <label for="employee">Inventory Code</label>
                                    <select class="custom-select" name="inv_code">
                                        <option value="">Choose One</option>
                                        <?php $__currentLoopData = $inv_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $inv): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($inv->inv_code == $item->inv_code): ?> selected <?php endif; ?> value="<?php echo e($inv->inv_code); ?>"><?php echo e($inv->inv_code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                               
                                <div class="col-md-4 stock_type">
                                    <label for="Stock">Stock Type</label>
                                    <select class="custom-select" name="stock_type" id="stype">
                                        <option value="">Choose One</option>
                                        <?php $__currentLoopData = $stock_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $stock): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option <?php if($stock->code == $item->stock_type): ?> selected <?php endif; ?> value="<?php echo e($stock->code); ?>"><?php echo e($stock->code); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            <div class="col-md-4">
                                <label for="doc_date">Expense Type <i class="tx-danger">*</i></label>
                                <select required class="custom-select" name="expense_type">
                                    <option value="" selected>Choose One</option>
                                    <option <?php if($item->expense_type == 'CAPEX'): ?> selected <?php endif; ?> value="CAPEX">CAPEX</option>
                                    <option <?php if($item->expense_type == 'OPEX'): ?> selected <?php endif; ?>  value="OPEX">OPEX</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mg-b-30">
                            <div class="col-md-6">
                                <label for="cost">Cost <i class="tx-danger">*</i></label>
                                <input required type="number" step="0.01" name="cost" id="cost" class="form-control text-right" value="<?php echo e(old('cost',$item->cost)); ?>">
                            </div>
                            <?php if($item->qty == 1): ?>
                            <div class="col-md-6">
                                <label for="doc_date">Serial Number <?php if($item->item_kind == 2): ?><i class="tx-danger">*</i><?php endif; ?></label>
                                <input <?php if($item->item_kind == 2): ?>  required <?php endif; ?> type="text" name="serial" id="serial" class="form-control" value="<?php echo e(old('serial',$item->serial_no)); ?>">
                            </div>
                            <?php endif; ?>
                        </div>
                    <?php else: ?>
                        <div class="form-row mg-b-15">
                            <div class="col-md-4">
                                <label for="doc_date">Expense Type <i class="tx-danger">*</i></label>
                                <select required class="custom-select" name="expense_type">
                                    <option value="" selected>Choose One</option>
                                    <option <?php if($item->expense_type == 'CAPEX'): ?> selected <?php endif; ?> value="CAPEX">CAPEX</option>
                                    <option <?php if($item->expense_type == 'OPEX'): ?> selected <?php endif; ?>  value="OPEX">OPEX</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cost">Cost <i class="tx-danger">*</i></label>
                                <input required type="number" name="cost" id="cost" class="form-control" value="<?php echo e(old('cost',$item->cost)); ?>">
                            </div>
                            <div class="col-md-4">
                                <label for="doc_date">Serial Number <i class="tx-danger">*</i></label>
                                <input required type="text" name="serial" id="serial" class="form-control" value="<?php echo e(old('serial',$item->serial_no)); ?>">
                            </div>
                        </div>
                    <?php endif; ?>



                    <div class="form-row mg-b-30">
                        <div class="col-md-12">
                            <label for="doc_date">Other Specifications</label>
                            <textarea class="form-control" rows="2" name="other_specs" id="specs"><?php echo e(old('specs',$item->other_specs)); ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-xl-5 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Cost Codes and References</h6>
                </div>
                <div class="card-body pd-20">
                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="doc_date">PO number</label>
                            <input type="text" name="po" id="po" class="form-control" value="<?php echo e(old('po',$item->po_no)); ?>">
                        </div>
                    </div>
                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="doc_date">DR Number</label>
                            <input type="text" name="dr_no" id="dr_no" class="form-control" value="<?php echo e(old('dr_no',$item->dr_no)); ?>">
                        </div>

                        <div class="col-md-6">
                            <label for="doc_date">Invoice Number</label>
                            <input type="text" name="invc_no" id="invc" class="form-control" value="<?php echo e(old('invc',$item->invoice_no)); ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mg-t-20">
                <div class="col-md-12 d-flex justify-content-end">
                    <?php if($item->item_kind == 1): ?>
                        <a href="/item/stocked" class="btn btn-sm btn-secondary mg-r-10">Cancel</a>
                    <?php else: ?>
                        <a href="/item/non-stock" class="btn btn-sm btn-secondary mg-r-10">Cancel</a>
                    <?php endif; ?>
                    <button type="submit" class="btn btn-sm btn-primary"><i data-feather="save"></i> Save Changes</button>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
<script src="<?php echo e(asset('assets/lib/jqueryui/jquery-ui.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/lib/parsleyjs/parsley.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>

<script>
    $(function(){
        'use strict'

        // Disable search
        $('.select2-no-search').select2({
            minimumResultsForSearch: Infinity,
            placeholder: 'Choose One'
        });


        $('#item_kind').change(function(){
            var value = $(this).val();

            if(value == 2){
                $(".stock_code,.inv_code,.stock_type").hide('slow');
                $("#desc,#oem,#uom,#inv,#stype").val('');
                $("#desc,#oem,#uom,#inv,#stype").prop("readonly",false);
            } else {
                $(".stock_code,.inv_code,.stock_type").show('slow');
            }
        });
    });
</script>

<script>
        $(document).ready(function(){

            var typingTimer;
            $('#stock_code').keydown(function(){

                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingItem, 800);
            });

            function doneTypingItem(){
                var search = $('#stock_code').val();
                if(search == ""){
                    $("#stock_list").html('');
                    
                    $("#desc,#oem,#uom,#inv,#stype").val('');
                    $("#desc,#oem,#uom,#inv,#stype").prop("readonly",false);

                } else {
                    $.ajax({
                        url : "/search/stock",
                        method : "GET",
                        data : { search:search },
                        success : function(data){
                            $('#stock_list').fadeIn();
                            $('#stock_list').html(data);
                        }
                    })
                }
            }
        });

        function populate_fields(stock_code,description,oem_id,uom,inv_code,stock_type){

            $('#stock_code').val(stock_code);
            $('#desc').val(description);
            $('#oem').val(oem_id);
            $('#uom').val(uom);
            $('#inv').val(inv_code);
            $('#stype').val(stock_type);

            $("#desc,#oem,#uom,#inv,#stype").prop("readonly",true);
            $('#stock_list').fadeOut();
        }

    
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>