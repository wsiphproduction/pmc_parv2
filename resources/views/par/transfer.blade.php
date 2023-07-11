@extends('layouts.app')

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Par Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Transfer Issuance Form</h4>
    </div>
</div>

<form autocomplete="off" role="form" action="/par/transfer-item/manual" method="POST">
    @csrf
    <div class="row row-xs">
        <div class="col-lg-12 mg-t-10">
            <div class="card">
                <div class="card-body">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i data-feather="alert-circle" class="mg-r-10"></i> Select Department input field if PAR is not charged to specific employee. This will also hide the employee input field!
                    </div>
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <div class="form-row mg-b-15">
                        <div class="col-md-6" id="empdiv">
                            <label for="employee">Employee</label>
                            <input type="text" name="emp" id="employees" class="form-control" placeholder="Search lastname of employee to search">
                            <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="employee_list"></div>
                        </div>
                        <div class="col-md-6" id="deptdiv">
                            <label for="department">Department</label>
                            <input type="text" name="dept" id="department" class="form-control" placeholder="Enter department name to search">
                            <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="department_list"></div>
                        </div>
                    </div> 
                    <div class="form-row mg-b-20">
                        <div class="col-md-4">
                            <label for="employee">Document Date <i class="tx-danger">*</i></label>
                            <input required type="text" name="doc_date" class="form-control" value="{{ \Carbon\Carbon::today()->format('m/d/Y') }}" id="datepicker4">
                        </div>
                        <div class="col-md-4">
                            <label for="department">Safety Control # <i class="tx-danger">*</i></label>
                            <input required type="text" name="safety_control_no" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="department">Reference # <i class="tx-danger">*</i></label>
                            <input required type="text" name="ref_code" class="form-control">
                        </div>
                    </div> 
                    
                    <div class="form-row mg-b-30">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mg-b-0">
                                    <thead class="thead-secondary">
                                        <tr>
                                          <th class="wd-60p">Description</th>
                                          <th class="wd-20p">Expense Type</th>
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
                            <input type="text" name="search" id="search" class="form-control" placeholder="Search items here . . .">
                            <span><img style="display: none;" id="item_spinner" class="wd-10p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                            <div id="items_tbl"></div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="col-md-12 mg-t-30 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary">Transfer</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('pagejs')
    <script src="{{ asset('scripts/par.js') }}"></script>
    <script src="{{ asset('assets/lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $("#employees").focus(function() {
                $('#deptdiv').hide('slow');       
            });
            
            $('#employees').blur(function(){
                if( !$(this).val() ) {
                    $('#deptdiv').show('slow');
                }
            });

            $("#department").focus(function() {
                $('#empdiv').hide('slow');       
            });
            
            $('#department').blur(function(){
                if( !$(this).val() ) {
                    $('#empdiv').show('slow');
                }
            });
        });

        $(function(){
            'use strict'
            $('#datepicker4').datepicker();
        });
    </script>
    <script>
        $(document).ready(function(){

            $('form').submit(function(){
                $(this).find('button[type=submit]').prop('disabled', true);
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
                    url: "{{ route('employee.fetch') }}",
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
                    url: "{{ route('department.fetch') }}",
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


            $('#search').keydown(function(){
                $('#item_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingItem, 2000);
            });

            function doneTypingItem(){
                var search = $('#search').val();
                if(search == ""){
                    $('#item_spinner').hide();
                    $("#items_tbl").html('');
                } else {
                    $.ajax({
                        url : "/par/search-items-to-transfer",
                        method : "GET",
                        data : { search:search },
                        success : function(data){
                            $('#item_spinner').hide();
                            $('#items_tbl').empty().html(data);
                        }

                    })
                }
            }
        }); 

        $(document).on('click','.emp_li',function(){
            $('#employees').val($(this).text());
            $('#employee_list').fadeOut();
        });  

        $(document).on('click','.dept_li',function(){
            $('#department').val($(this).text());
            $('#department_list').fadeOut();
        });
    </script>
@endsection
