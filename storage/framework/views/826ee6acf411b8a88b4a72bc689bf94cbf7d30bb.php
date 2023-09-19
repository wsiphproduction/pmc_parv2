<?php $__env->startSection('pagecss'); ?>
    <link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Par Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">PAR Issuance Form</h4>
    </div>
</div>

<form autocomplete="off" role="form" action="/par/store" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
    <?php echo csrf_field(); ?>
    <div class="row row-xs">
        <div class="col-lg-12 mg-t-10">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <div class="divider-text bg-gray-400 text-white">PAR Details</div>

                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-2 col-form-label">Type <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="par_type" id="par_type">
                                <option value="">Select One</option>
                                <option selected value="new">New</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>
                        
                        <label for="inputEmail3" class="col-sm-3 col-form-label d-flex justify-content-end">Doc Date <i class="tx-danger">*</i></label>
                        <div class="col-sm-3">
                            <input required type="text" id="datepicker4" name="doc_date" value="<?php echo e(\Carbon\Carbon::today()->format('m/d/Y')); ?>" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">                            
                        <label class="col-sm-2 col-form-label">Location <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="location" id="location">
                                <option value="">Select One</option>
                                <option value="davao">Davao</option>
                                <option value="agusan">Agusan</option>
                            </select>
                        </div>

                        <label for="inputEmail3" class="col-sm-3 col-form-label d-flex justify-content-end">PO # <i class="tx-danger">*</i></label>
                        <div class="col-sm-3">
                            <input required type="text" id="po_no" name="po_no" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">                            
                        <label class="col-sm-2 col-form-label">Site <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="site" id="site">
                                <option value="">Select One</option>
                                <option value="mcd mine">MCD Mine</option>
                                <option value="mcd main">MCD Main</option>
                            </select>
                        </div>

                        <label for="inputEmail3" class="col-sm-3 col-form-label d-flex justify-content-end">CIS/S.I # <i class="tx-danger">*</i></label>
                        <div class="col-sm-3">
                            <input required type="text" id="cis_si_no" name="cis_si_no" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">                            
                        <label class="col-sm-2 col-form-label">Serial # <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <input required type="text" id="serial_no" name="serial_no" class="form-control">
                        </div>
                    </div>

                    <div class="divider-text bg-gray-400 text-white">End-User Information</div>
                    <div class="form-group row">                            
                        <label class="col-sm-2 col-form-label">End-User Type <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="e_type" id="e_type">
                                <option value="">Select One</option>
                                <option value="1">Personal</option>
                                <option value="2">Common</option>
                                <option value="3">Contractor</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row" id="empdiv">                            
                        <label class="col-sm-2 col-form-label">Personal <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <input required type="search" name="emp" id="employees" class="form-control" placeholder="Search employee id, employee lastname....">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="employee_list"></div>
                        </div>
                    </div>
                    
                    <div class="form-group row" id="contractordiv" style="display: none;">                            
                        <label class="col-sm-2 col-form-label">Contractor <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <input required type="search" name="cont" id="contractor" class="form-control" placeholder="Search contractor's ID or Lastname....">
                            <span><img style="display: none;" id="cont_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="contractor_list"></div>
                        </div>
                    </div>

                    <input type="hidden" id="dept" name="emp_dept">

                    <div class="form-group row" id="deptdiv" style="display: none;">                            
                        <label class="col-sm-2 col-form-label">Common <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <input type="search" name="dept" id="department" class="form-control" placeholder="Enter department name to search">
                            <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="department_list"></div>
                        </div>
                    </div>

                    <div class="divider-text bg-gray-400 text-white">Item Details</div>
                    <div class="form-row mg-b-10">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mg-b-0">
                                    <thead class="thead-secondary">
                                        <tr>
                                          <th class="wd-10p">ID</th>
                                          <th class="wd-10p">Stock Code</th>
                                          <th class="wd-30p">Description</th>
                                          <th class="wd-20p">Serial #</th>
                                          <th class="wd-10p">Qty</th>
                                          <th class="wd-10p">UoM</th>
                                          <th class="wd-10p">Cost</th>
                                          <th class="wd-10p"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="addedItems">
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-row">
                        <div class="col-md-12">
                            <input type="search" name="search" id="search" class="form-control" placeholder="Search item via serial number or item description...">
                            <span><img style="display: none;" id="item_spinner" class="wd-10p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="items_tbl"></div>
                        </div>
                    </div>


                    <div class="divider-text bg-gray-400 text-white">Reference</div>
                    <div class="form-row mg-b-20">
                        <div class="col-md-4">
                            <label for="department">Issuance Doc Reference(Batch#/MWIS)</label>
                            <input type="text" name="doc_ref" class="form-control">
                        </div>
                    </div> 

                    <div class="form-row">
                        <div class="col-md-12 mg-t-30 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary">Submit </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
    <script src="<?php echo e(asset('scripts/par.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/jqueryui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/parsleyjs/parsley.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>
    <script>
        $(function(){
            'use strict'
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose One'
            });

            $('#datepicker4').datepicker();
        });
    </script>

    <script>
        $('#location').change(function(){
            var value = $(this).val();
            if(value == 'davao'){
                $('#site').attr("disabled", true); 
                $('#site').removeAttr('required');
            } else {
                $('#site').attr("disabled", false);  
            }   
        });

        $(document).ready(function(){

            $('form').submit(function(){
                if($('#total_items').val() == 0){
                    alert('Please add items to par before submitting the transaction!');
                    return false;
                } else {
                    $(this).find('button[type=submit]').prop('disabled', true);
                }
                
            });

            $.ajaxSetup({ 
                headers: { 
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') 
                } 
            });

            var typingTimer;
            $('#employees').keydown(function(){
                $('#emp_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingEmployee, 2000);
            });

            function doneTypingEmployee(){
                var query = $('#employees').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "<?php echo e(route('employee.fetch')); ?>",
                    method: "POST",
                    data: { query :query, _token:_token },
                    success: function(data)
                    {
                        $('#emp_spinner').hide();
                        $('#employee_list').fadeIn();
                        $('#employee_list').html(data);
                    }
                })
            }  


            $('#department').keydown(function(){
                $('#dept_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingDepartment, 2000);
            });

            function doneTypingDepartment(){
                var query = $('#department').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "<?php echo e(route('api.dept')); ?>",
                    method: "POST",
                    data: { query :query, _token:_token },
                    success: function(data)
                    {
                        $('#dept_spinner').hide();
                        $('#department_list').fadeIn();
                        $('#department_list').html(data);
                    }
                })
            }

            $('#contractor').keydown(function(){
                $('#cont_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingContractor, 2000);
            });

            function doneTypingContractor(){
                var query = $('#contractor').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "<?php echo e(route('api.contractor')); ?>",
                    method: "POST",
                    data: { query :query, _token:_token },
                    success: function(data)
                    {
                        $('#cont_spinner').hide();
                        $('#contractor_list').fadeIn();
                        $('#contractor_list').html(data);
                    }
                })
            }

            $('#search').keydown(function(){
                $('#item_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingItem, 2000);
            });

            function doneTypingItem(){
                var search = $('#search').val();
                var p_type = $('#par_type').val();
                if(search == ""){
                    $('#item_spinner').hide();
                    $("#items_tbl").html('');
                } else {
                    $.ajax({
                        url : "/search/items",
                        method : "GET",
                        data : { 
                            search:search,
                            ptype:p_type
                        },
                        success : function(data){
                            $('#item_spinner').hide();
                            $('#items_tbl').empty().html(data);
                        }

                    })
                }
            }
        }); 

        $(document).on('click','.emp_li',function(){
            var emp = $(this).text();
            var i = emp.split("=");
            console.log(i);
            $('#employees').val(i[0]);
            $('#dept').val(i[1]);

            $('#employees').prop('readonly', true);
            $('#employee_list').fadeOut();
        });  

        $(document).on('click','.dept_li',function(){
            $('#department').val($(this).text());
            $('#department').prop('readonly', true);
            $('#department_list').fadeOut();
        });

        $(document).on('click','.cont_li',function(){
            $('#contractor').val($(this).text());
            $('#contractor').prop('readonly', true);
            $('#contractor_list').fadeOut();
        });

        $('#par_type').on('change', function(){
            $('#search').val('');
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>