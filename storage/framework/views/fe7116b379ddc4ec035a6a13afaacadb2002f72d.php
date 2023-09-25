<?php $__env->startSection('pagecss'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/modals.css')); ?>">
    <link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
    <style>
        .trainings-wrapper {
            position: relative; background: #f5f5f5; padding: 0px 10px 5px 10px; margin-bottom: 5px;
        }
        
        .trainings-wrapper hr { margin: 10px 0 10px; }

        hr { border: solid #dddddd; border-width: 1px 0 0; clear: both; margin: 1.25rem 0 1.1875rem; height: 0; }

        .panel-body a { font-size: 14px; color: white; }

        .form-check {
            position: relative;
            display: block;
            padding-left: 6.25rem;
            margin-top: -22px;
        }

    </style>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-5">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Par Management</a></li>
              <li class="breadcrumb-item active" aria-current="page">Par List</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">PAR Issuance Manangement</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">  
        <div class="card-header d-md-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">&nbsp;</h6>
            <ul class="list-inline d-flex mg-md-t-0 mg-b-0">
                <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-success rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">saved</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-warning rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">posted</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-info rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Adjustment</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-danger rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Closed</span>
                </li>
            </ul>
        </div>
        <table class="table mg-b-5">
            <thead>
                <tr>
                    <form>
                    <?php echo csrf_field(); ?>
                        <th class="wd-20p"><input type="text" name="header_id" value="<?php echo e(request()->has('header_id') ? request('header_id') : ''); ?>" class="form-control" placeholder="Transaction #"></th>
                        <th class="wd-20p"><input type="text" name="description" value="<?php echo e(request()->has('description') ? request('description') : ''); ?>" class="form-control" placeholder="Item Description"></th>
                        <th class="wd-20p"><input type="text" name="accountable" value="<?php echo e(request()->has('accountable') ? request('accountable') : ''); ?>" class="form-control" placeholder="Accountable (Personal/Common)"></th>
                        <th class="wd-20p">
                            <select class="form-control" name="doc_status">
                                <option selected value="">Choose Document Status</option>
                                <option value="saved" <?php echo e(request()->has('doc_status') && request('doc_status') === 'saved' ? 'selected' : ''); ?>>Saved</option>
                                <option value="posted" <?php echo e(request()->has('doc_status') && request('doc_status') === 'posted' ? 'selected' : ''); ?>>Posted</option>
                                <option value="adjustment" <?php echo e(request()->has('doc_status') && request('doc_status') === 'adjustment' ? 'selected' : ''); ?>>Adjustment</option>
                                <option value="closed" <?php echo e(request()->has('doc_status') && request('doc_status') === 'closed' ? 'selected' : ''); ?>>Closed</option>
                                <option value="transfered" <?php echo e(request()->has('doc_status') && request('doc_status') === 'transfered' ? 'selected' : ''); ?>>Transfered</option>
                            </select>
                        </th>
                        <th class="wd-10p"><button type="submit" class="btn btn-sm btn-primary"><i data-feather="filter"></i></button></th>
                    </form>
                </tr>
            </thead>
        </table>     
    </div>
</div>

<div class="row">
    <div class="col-md-12 d-flex justify-content-center">
        <img style="height: 40px; display: none;" src="<?php echo e(asset('assets/img/spinner/spinner10.gif')); ?>" alt="" id="spinner">
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body pd-y-15 pd-x-10" id="par_list"> 
                <?php
                    $grouped = $datas->groupBy('header_id');
                    $grouped->toArray();
                    $btn ='';
                ?>

                <?php $__empty_1 = true; $__currentLoopData = $grouped; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        if($d[0]['doc_status'] == 'saved'){
                            $btn = '#10b759';
                        }elseif($d[0]['doc_status'] == 'closed'){
                        // }elseif($d[0]['doc_status'] == 'closed' || $d[0]['status'] == 'CLOSED'){
                            $btn = '#dc3545';
                        }elseif($d[0]['doc_status'] == 'posted'){
                            $btn = '#ffc107';
                        }elseif($d[0]['doc_status'] == 'adjustment'){
                            $btn = '#00b8d4';
                        }
                $header_items = \App\accountabilityDetails::where('header_id', $d[0]['header_id'])->get();
                $has_close = []; 
                foreach($header_items as $item){
                    $has_close[] = $item->status == 'CLOSED';
                }
                $all_true = array_reduce($has_close, function ($carry, $item) {
                return $carry && $item;
            }, true);
                    ?>

                    <?php if(in_array(false, $has_close)): ?>
    
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
                                    &nbsp;<small> [ <strong> doc status </strong> <?php echo e(strtoupper($d[0]['doc_status'])); ?> ] </small>
                                    &nbsp;<small> [ <strong> item status </strong> <?php echo e($all_true ? 'CLOSED' : 'OPEN'); ?> ] </small> 
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
                                                    <a href="/par/recreate/<?php echo e($d[0]['header_id']); ?>" title="Adjust Par" class="btn btn-warning btn-xs">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                    <a href="#" title="Get Link" data-toggle="modal" data-target="#email-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-primary btn-xs email-par">
                                                        <i data-feather="external-link"></i></i>
                                                    </a>
                                                
                                                    <?php if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0): ?>
                                                    <a href="#" title="Close PAR" data-toggle="modal" data-target="#close-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-danger btn-xs close-par">
                                                        <i data-feather="x-square"></i>
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
                                                    <a href="#" data-toggle="modal" title="Post Par" data-target="#post-par" data-pid="<?php echo e($d[0]['header_id']); ?>" data-refpar="<?php echo e($d[0]['ref_par']); ?>" class="btn btn-warning btn-xs post-par">
                                                        <i class="fa fa-stamp"></i>
                                                    </a>
                                                    <a href="#" title="Get Link" data-toggle="modal" data-target="#email-par" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-primary btn-xs email-par">
                                                        <i data-feather="external-link"></i></i>
                                                    </a>

                                                    <?php if($d[0]['ptype'] == 'transfer'): ?>
                                                    <a href="/par/preview/<?php echo e($d[0]['header_id']); ?>" title="Get Link" id="btn" data-pid="<?php echo e($d[0]['header_id']); ?>" class="btn btn-dark btn-xs email-par">
                                                        <i class="fa fa-eye"></i></i>
                                                    </a>
                                                    <?php endif; ?>
            
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
                                        
                                        <th>
                                            <a href="#isTransfer"><button type="button" class="btn btn-primary transfered isTransfer-<?php echo e($d[0]['header_id']); ?>" id="isTransfer" style="display:none; height:24px;" data-toggle="modal" data-target="#mod"><div class="button" style="margin-top:-4px">Transfer</div></button></a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $items = ""; ?>
                                    <?php $__currentLoopData = $d; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                    <?php
                                        $items .= $i->qty.':'.$i->item_id.'|';
                                    ?>
                                        
                                    <tr class="tx-12">

                                        <td><?php echo e(isset($i->stock_code) ? $i->stock_code : 'N/A'); ?></td>
                                        <td><?php echo e($i->description); ?></td>
                                        <td><?php echo e($i->serial_no); ?></td>
                                        <td>
                                            <?php echo e($i->status); ?>

                                        </td>
                                        <td><?php echo e($i->qty); ?></td>
                                        <td><?php echo e(number_format($i->cost,2)); ?></td>
                                        
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
                                                    
                                                    <a href="#transfer-item" class="mg-l-5 transfer-item" data-hid="<?php echo e($d[0]['header_id']); ?>" data-iid="<?php echo e($i->item_id); ?>" data-xid="<?php echo e($i->id); ?>" data-cost="<?php echo e($i->cost); ?>" data-qty="<?php echo e($i->qty); ?>" data-dept="<?php echo e($i->is_dept); ?>" data-toggle="modal" title="Transfer Item">
                                                    <i class="fa fa-link"></i>    
                                                    </a>

                                                        
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                        
                                        <?php if(count($d) > 1 && $i->status != 'CLOSED'): ?>
                                        <input class='checkbox' type="checkbox" data-check="checkbox-<?php echo e($d[0]['header_id']); ?>" name="checkboxes[]" value="<?php echo e($i->id); ?>" data-row="<?php echo e(json_encode($i)); ?>" data-header="<?php echo e($d[0]['header_id']); ?>">
                                        <?php endif; ?>
                                    </td>                                                                                                       
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <input id="<?php echo e($d[0]['header_id']); ?>_items" type="hidden" value="<?php echo e($items); ?>">
                                
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td><center>No accountability found</center></td>
                    </tr>
                <?php endif; ?>

                <div class="d-flex justify-content-end">
                    <?php echo e($datas->links()); ?>

                </div>
            </div>
        </div>
    </div>
</div>

  <!-- Modal -->
  <div class="modal fade" id="mod" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Item Transfer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form autocomplete="off" method="post" action="<?php echo e(route('multiple.par')); ?>">
                <?php echo csrf_field(); ?>
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <input type="hidden" name="iid" id="item_id" class="itemid">
                    <input type="hidden" name="hid" id="header_id" class="headerid">
                    <input type="hidden" name="cost" id="icost">
                    <input type="hidden" name="xid" class="xid">
                    <input type="hidden" class="dept" name="isdept" id="isdept">
                    
                    <div class="form-group" id="personaldiv">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Personal)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="emp" id="employees" class="form-control employees_input" placeholder="Search Lastname/ID of employee to search">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="employee_list"></div>
                            <input type="hidden" id="dept" name="emp_dept">
                        </div>
                    </div>

                    <div class="form-group" id="deptdiv" style="display: none;">                            
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Transfer To (Common)<i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="dept" id="department" class="form-control search_dept" placeholder="Enter department name to search">
                            <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="department_list"></div>
                        </div>
                    </div>
                   
                    <div class="multiply">
                        <div class="checkboxid">111</div>
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Qty <i class="tx-danger">*</i></label>
                            <input required type="number" name="qty" id="qty_t" class="form-control text-right qty_t">
                        </div>
                
                        <div class="form-group">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Condition <i class="tx-danger">*</i></label>
                            <textarea required class="form-control condition" name="new_condition" rows="3" placeholder="State the item's conditions, parts, usability, storage, location, etc..."></textarea>
                        </div>
                        
                        </div>
                    <div class="ptf">
                         </div>
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Reason <i class="tx-danger">*</i></label>
                        <textarea required class="form-control reason" name="reason" rows="3" placeholder="State your reason ..."></textarea>
                    </div>
                    

                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Transfer</button>
                </div>
            </form>
        </div>

      </div>
    </div>
  </div>


<?php echo $__env->make('par.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/tooltips.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/select2.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/transfer.js')); ?>"></script>



    <script type="text/javascript">   
    
    $(".transfered").click(function() {

        // $("#qty_t").val($(this).data("row").qty)
        $(".employees_input").val("");
        var checkedCheckboxes = $(".checkbox:checked");
        console.log(checkedCheckboxes.length);
        if (checkedCheckboxes.length > 0) {
            checkedCheckboxes.each(function() {
              var obj = $(this).data("row")
            
            });
        }
         var multiply = $(".multiply");
         multiply.empty();
         $('.ptf').empty();
         checkedCheckboxes.each(function(index,element) {
            var checkbox = $(element).data('row');

            console.log('element',element);
            $(".ptf").append(
            `            <div class="checkboxid">${checkbox.id}</div>
                      <div>${checkbox.description}</div>
                      <input type="hidden" name="item_ids[]" id="item_ids" class="form-control text-right item_ids" value="${checkbox.item_id}">

                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Qty <i class="tx-danger">*</i></label>
                        <input required type="number" name="quantity[]" id="qty_t" class="form-control text-right qty_t" value="${checkbox.qty}">
                    </div>
                    
                    <div class="form-group">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Condition <i class="tx-danger">*</i></label>
                        <textarea required class="form-control condition" name="condition[]" rows="3" placeholder="State the item's conditions, parts, usability, storage, location, etc..."></textarea>
                    </div>
                   
                `
            );
            $('.itemid').val(checkbox.item_id)
            $('.headerid').val(checkbox.header_id)      
            });
            

        $(".multiply").each(function() {
            
        
    });

    });

   
    $("#submit").click(function () {
            var name = $("#name").val();
            var marks = $("#marks").val();
            var str = "You Have Entered " 
                + "Name: " + name 
                + " and Marks: " + marks;
            $("#modal_body").html(str);
        });

        $(document).on('click','input[type="checkbox"]', function(){
            var i = '';
            $(".checkbox").each(function (){
                $('.selected_data').val('');
    
                if($(this).is(":checked")){
                    i = i + "|"+ $(this).val();
                }
            });
            $('.selected_data').val(i);
        });    
    </script>


    
    <script type="text/javascript"> 

    $(document).ready(function() {
        // Function to check if more than one checkbox is checked
        function checkCheckboxCount(checkboxes, header) {
            var count = 0;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                count++;
                }
            }
            if (count > 1) {
                $('.isTransfer-'+header).show(); // Display the button
            } else {
                $('.isTransfer-'+header).hide(); // Hide the button
            }
        }

            // Call the function whenever a checkbox is clicked
            $('input[type="checkbox"]').on('change', function() {
                var header = $(this).data('header');
                var checkboxes = document.querySelectorAll('input[data-check="checkbox-'+header+'"]');
                checkCheckboxCount(checkboxes, header);
            });

        });

        $(".checkbox").click(function() {
          
            var headerId = $(this).closest('div.table-responsive').attr('id').replace('detailsd', '');

            // Get the checked checkbox value
            var checkedCheckbox = $(this).find('.checkbox:checked');

            // Check if any checkbox is checked in the row
            if (checkedCheckbox.length > 0) {
            // Get the table ID
                var tableId = checkedCheckbox.closest('table').attr('id');

            // Perform actions with the table ID
                console.log('Table ID: ' + tableId);
            }
        });

        $('.checkbox').change(function() {
            if ($(this).is(':checked')) {
            // Get the table ID of the checked checkbox
            var tableId = $(this).closest('div.table-responsive').attr('id');
            
            // Perform actions with the table ID
            
            }
        });
</script>


    <script>
        $(document).ready(function(){
            $('#filter_par_list').submit(function(e){
                e.preventDefault();

                $('#spinner').show();
                $.ajax({
                    type: "GET",
                    url: "/filter/par-list",
                    data: $('#filter_par_list').serialize(),
                    success: function( response ) {
                        $('#spinner').hide();
                        $('#par_list').html(response);  
                    }
                });
            });
        });

        $(document).on("click", ".email-par", function () {
            $("#parid").val('https://mlappsvr.philsaga.com:8007/par/transaction-details/'+$(this).data('pid'));
        });

        function copyLink(){
            var copyText = document.getElementById("parid");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
        }


        $(document).ready(function(){

var typingTimer;
$('.employees-input').keydown(function(){
    $('#emp_spinner').show();
    clearTimeout(typingTimer);
    console.log('gee');
    typingTimer = setTimeout(doneTypingEmployee, 2000);
});

function doneTypingEmployee(){
    var query = $('.employees-input').val();
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: "<?php echo e(route('employee.fetch')); ?>",
        method: "POST",
        data: { query :query, _token:_token },
        success: function(data)
        {
            $('#emp_spinner').hide();
            $('.empt').fadeIn();
            $('.empt').html(data);
        }
    })
}
});


$(document).on('click','.emp_li',function(){
            var emp = $(this).text();
            var i = emp.split("=");
            console.log(i);
            $('.employees-input').val(i[0]);
            $('.emp_dept').val(i[1]);

            $('.empt').fadeOut();
        });


    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>