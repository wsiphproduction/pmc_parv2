@extends('layouts.app')

@section('pagecss')
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .content {
            overflow: hidden;
        }
        @media print{
            .filter { display: none; }
            .b-head { display: none; }
            .content-footer { display: none; }
            .btnCSV { display: none; }
            .dept_header { display: none; }
            .p_header { display: block !important; }
            .btnPrint { display: none; }
        }
    </style>
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div class="b-head">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Reports</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Par Summary Report</h4>
        </div>
    </div>

    <div class="row filter">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">  
            <div class="card">
                <div class="card-body">
                    <form autocomplete="off" id="par_summary_form">
                        @csrf
                        <div class="form-group-inner">
                            <div class="row mg-b-10">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <div data-label="Example" class="df-example demo-forms">
                                        <div class="wd-md-100p">
                                            <select required class="form-control select2-no-search" name="rtype" id="rtype">
                                                <option value="">Select One</option>
                                                <option selected value="1">End-user type - Personal</option>
                                                <option value="2">End-user type - Common</option>
                                                <option value="3">Document Status</option>
                                                <option value="4">Item Status</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mg-t-2">
                                            <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" type="submit">Generate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div style="display: none;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="doc_status">
                                    <div data-label="Example" class="df-example demo-forms">
                                        <div>
                                            <select class="wd-250 form-control select2-status" name="d_status">
                                                <option value="">Select One</option>
                                                <option value="saved">Saved</option>
                                                <option value="posted">Posted</option>
                                                <option value="closed">Closed</option>
                                                <option value="adjustment">Adjustment</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div style="display: none;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="item_status">
                                    <div data-label="Example" class="df-example demo-forms">
                                        <div>
                                            <select class="wd-250 form-control select2-status" name="i_status">
                                                <option value="">Select One</option>
                                                <option value="OPEN">OPEN</option>
                                                <option value="CLOSED">CLOSED</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="opt_sel">
                                    <div data-label="Example" class="df-example demo-forms">
                                        <div>
                                            <select class="wd-250 form-control select2-option" name="opt_sel" id="opt_select">
                                                <option value="">Select One</option>
                                                <option value="1">All</option>
                                                <option selected value="2">Single</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="personal">
                                    <input type="search" name="emp" id="employees" class="form-control emp" placeholder="Search employee lastname">
                                    <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                                    <div id="employee_list"></div>
                                </div>

                                <div style="display: none;" class="col-lg-3 col-md-3 col-sm-3 col-xs-12" id="common">
                                    <input type="search" name="dept" id="department" class="form-control dept" placeholder="Enter department name to search">
                                    <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                                    <div id="department_list"></div>
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="docdatefrom" name="date_from" placeholder="From" class="form-control docdatefrom">
                                </div>

                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                    <input type="text" id="docdateto" name="date_to" placeholder="To" class="form-control docdateto">
                                </div> 
                            </div>

                        </div>
                    </form>
                </div>
            </div>          
        </div>
    </div>

    <center><img id="loader" src="{{ asset('assets/img/spinner/spinner10.gif') }}"  style="display:none;height:100px;"></center>
        
        <div style="display: none;" class="row mg-t-10 p_header">
            <div class="col-md-12">
                <div class="d-flex flex-row justify-content-start bg-gray-200 mg-b-10">
                    <div class="pd-10"><img style="height: 80px;" src="{{ asset('images/logo_default.jpg') }}" alt=""></div>
                    <div class="pd-10 mg-t-20"><h2>Philsaga Mining Corporation</h2><span>Purok 1-A Bayugan, Rosario, Agusan Del Sur</span></div>
                    <div class="pd-10"></div>
                </div>
                <div class="d-flex justify-content-end">{{ Carbon\Carbon::now()->format('F d, Y') }}</div>
            </div>
        </div>

        <div class="row">
            <div id="department_tbl"> </div>
        </div>
    
@endsection

@section('pagejs')
    <script src="{{ asset('assets/lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('scripts/report.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            $.ajaxSetup({
              headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
            });

            $('#par_summary_form').submit(function(e){
                e.preventDefault();
                $('#loader').show();

                $.ajax({
                    type: "GET",
                    url: "/ajax/par_summary_report",
                    data: $('#par_summary_form').serialize(),
                    success: function( response ) {
                        $('#loader').hide();
                        $('#department_tbl').html(response);     
                    }
                });
            });


            var typingTimer;
            $('#employees').keydown(function(){
                $('#emp_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingEmployee, 1500);
            });

            function doneTypingEmployee(){
                var query = $('#employees').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('accountable.fetch') }}",
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
                typingTimer = setTimeout(doneTypingDepartment, 1500);
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

        });

    </script>
@endsection
