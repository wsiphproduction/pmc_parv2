    

<?php $__env->startSection('pagecss'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/css/modals.css')); ?>">
    <link href="<?php echo e(asset('assets/lib/select2/css/select2.min.css')); ?>" rel="stylesheet">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Maintenance</a></li>
                <li class="breadcrumb-item active" aria-current="page">Users</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">User Management</h4>
    </div>
</div>

<div class="row row-xs">
    <div class="col-lg-8 col-xl-4 mg-t-10">
        <div class="card">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                    <h6 class="mg-b-5">User Form</h6>
                </div>
            </div>
            <div class="card-body pd-20">
                <form role="form" action="/user/add" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label class="d-block">Employee <i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <input type="search" name="emp" id="employees" class="form-control" placeholder="Search employee id, employee lastname....">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="<?php echo e(asset('assets/img/spinner/spinner5.gif')); ?>" alt=""></span>
                            <div id="employee_list"></div>
                            <input type="hidden" class="form-control" id="dept" name="dept">
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label class="d-block">Username <i class="tx-danger">*</i></label>
                        <input type="text" class="form-control" placeholder="Enter your lastname" required name="domain">
                    </div>

                    <div class="form-group">
                        <label class="d-block">Password <i class="tx-danger">*</i></label>
                        <input type="password" class="form-control" placeholder="**********" required name="pword">
                    </div>

                    <div class="form-group">
                        <label class="d-block">Role <i class="tx-danger">*</i></label>
                        <div class="wd-md-100p">
                            <select class="form-control select2-no-search" name="role">
                                <option></option>
                                <option value="read and write">Read &amp; Write</option>
                                <option value="read only">Read Only</option>
                                <option value="admin">Admin</option>
                                <option value="department user">Department User</option>
                            </select>
                        </div>
                    </div>

                    <button class="btn btn-primary" type="submit">Submit</button>
                    <a href="/maintenance/user" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-xl-8 mg-t-10">
        <div class="card">
            <div class="card-body pd-20">
                <table id="example1" class="table mg-b-0">
                    <thead>
                        <tr>
                            <th class="wd-20p">Username</th>
                            <th class="wd-30p">Name</th>
                            <th class="wd-30p">Role</th>
                            <th class="wd-20p">Actions</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $u): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($u->domainAccount); ?></td>
                                <td><?php echo e($u->fullName); ?></td>
                                <td><?php echo e(ucwords($u->role)); ?></td>
                                <td>
                                    <?php if($u->isActive == 1): ?>
                                        <a data-toggle="modal" data-uid="<?php echo e($u->id); ?>" class="btn btn-primary btn-xs deactivate" href="#deactivate">
                                            <i data-feather="check-square"> </i>
                                        </a>
                                    <?php else: ?>
                                        <a data-toggle="modal" data-uid="<?php echo e($u->id); ?>" class="btn btn-danger btn-xs activate" href="#activate">
                                            <i data-feather="x-square"> </i>
                                        </a>
                                    <?php endif; ?>
                                    <a data-toggle="modal" data-uid="<?php echo e($u->id); ?>" data-domain="<?php echo e($u->domainAccount); ?>" class="btn btn-secondary btn-xs update" href="#update"><i data-feather="edit"></i></a>
                            </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php echo $__env->make('maintenance.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('pagejs'); ?>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/jqueryui/jquery-ui.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/select2/js/select2.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/datatables.net/js/jquery.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js')); ?>"></script>
    <script src="<?php echo e(asset('scripts/user.js')); ?>"></script>
    <script>
        $(function(){
            'use strict'
            $('.select2').select2({
                placeholder: 'Search Employee',
                searchInputPlaceholder: 'Search options',
                allowClear: true
            });

            $('.select2-no-search').select2({
              minimumResultsForSearch: Infinity,
              placeholder: 'Select Role'
            });

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

        $(document).ready(function(){

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
        }); 

        $(document).on('click','.emp_li',function(){
            var emp = $(this).text();
            var i = emp.split("=");

            $('#employees').val(i[0]);
            $('#dept').val(i[1]);

            $('#employee_list').fadeOut();
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>