@extends('layouts.app')

@section('pagecss')
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Par Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">PAR Adjustment Form</h4>
    </div>
</div>

    <form autocomplete="off" role="form" action="/par/adjustments" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
        @csrf
        <div class="row row-xs">
            <div class="col-lg-12 mg-t-10">
                <div class="card">
                    <div class="card-body">
                        <input type="hidden" id="total_items" name="total_items" value="0">
                        <div class="divider-text bg-gray-400 text-white">PAR Details</div>

                        <div class="form-group row">
                            <input type="hidden" id="par_type" value="{{ $par->ptype }}">
                            <input type="hidden" name="hid" value="{{ $par->id }}">
                            <label class="col-sm-2 col-form-label">Location <i class="tx-danger">*</i></label>
                            <div class="col-sm-4">
                                <select required class="form-control select2-no-search" name="location" id="location">
                                    <option value="">Select One</option>
                                    <option @if($par->p_location == 'davao') selected @endif value="davao">Davao</option>
                                    <option @if($par->p_location == 'agusan') selected @endif value="agusan">Agusan</option>
                                </select>
                            </div>
                            
                            <label for="inputEmail3" class="col-sm-3 col-form-label d-flex justify-content-end">Doc Date <i class="tx-danger">*</i></label>
                            <div class="col-sm-3">
                                <input required type="text" id="datepicker4" name="doc_date" value="{{ date('m/d/Y', strtotime($par->document_date)) }}" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">                            
                            <label class="col-sm-2 col-form-label">Site <i class="tx-danger">*</i></label>
                            <div class="col-sm-4">
                                <select required class="form-control select2-no-search" name="site" id="site">
                                    <option value="">Select One</option>
                                    <option @if($par->p_site == 'mcd mine') selected @endif value="mcd mine">MCD Mine</option>
                                    <option @if($par->p_site == 'mcd main') selected @endif value="mcd main">MCD Main</option>
                                </select>
                            </div>
                        </div>

                        <div class="divider-text bg-gray-400 text-white">End-User Information</div>
                        <div class="form-group row">                            
                            <label class="col-sm-2 col-form-label">End-User Type <i class="tx-danger">*</i></label>
                            <div class="col-sm-4">
                                <select required class="form-control select2-no-search" name="e_type" id="e_type">
                                    <option value="">Select One</option>
                                    <option @if($par->is_dept == 0) selected @endif value="1">Personal</option>
                                    <option @if($par->is_dept == 1) selected @endif value="2">Common</option>
                                </select>
                            </div>
                        </div>
                        

                        <div @if($par->is_dept == 1) style="display:none;" @endif class="form-group row" id="empdiv">                            
                            <label class="col-sm-2 col-form-label">Personal <i class="tx-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="search" name="emp" id="employees" class="form-control emp" value="@if($par->is_dept == 0) {{ $par->employee_id }} - {{ $par->emp_name }} @endif">
                                <span><img style="display: none;" id="emp_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                                <div id="employee_list"></div>
                            </div>
                        </div>

                        <input type="hidden" id="dept" name="emp_dept" value="{{$par->dept}}">

                        <div @if($par->is_dept == 0) style="display:none;" @endif class="form-group row" id="deptdiv">                            
                            <label class="col-sm-2 col-form-label">Common <i class="tx-danger">*</i></label>
                            <div class="col-sm-4">
                                <input type="search" name="dept" id="department" class="form-control dept" value="@if($par->is_dept == 1) {{ $par->dept_id }} @endif">
                                <span><img style="display: none;" id="dept_spinner" class="wd-15p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
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
                                              <th class="wd-30p">Description</th>
                                              <th class="wd-15p">OEM</th>
                                              <th class="wd-5p">UoM</th>
                                              <th class="wd-10p">Serial #</th>
                                              <th class="wd-10p">Qty</th>
                                              <th class="wd-10p">Cost</th>
                                              <th class="wd-10p"></th>
                                            </tr>
                                        </thead>
                                        @php
                                            $grouped = $items->groupBy('header_id');
                                            $grouped->toArray();
                                        @endphp
                                        <tbody id="addedItems">
                                            @foreach($grouped as $item)
                                                @foreach($item as $i)
                                                    <tr id="tr{{$i->item_id}}">
                                                        <td style="display:none;" ><input type="text" class="form-control" name="item_id[]" value="{{$i->item_id}}"></td>
                                                        <td class="wd-10p">{{ $i->item_id }}</td>
                                                        <td class="wd-30p">{{ $i->description }}</td>
                                                        <td class="wd-8p">{{ $i->oem_id }}</td>
                                                        <td class="wd-8p">{{ $i->uom }}</td>
                                                        <td class="wd-10p">{{ $i->serial_no }}</td>
                                                        <td class="wd-10p"><input type="text" @if($i->serial_no != '') readonly @endif name="qty[]" value="{{$i->qty}}" class="form-control input-xs text-right"></td>
                                                        <td class="wd-10p"><input type="text" readonly name="cost[]" class="form-control input-xs text-right" value="{{$i->cost}}"></td>             
                                                        <td class="wd-2p"><button class="btn btn-danger btn-sm" onclick="removeItem($('.item_id').val());"><i class="fa fa-trash"></i></button></td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="col-md-12">
                                <input type="text" name="search" id="search" class="form-control" placeholder="Search item item id, serial number, items description...">
                                <span><img style="display: none;" id="item_spinner" class="wd-10p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                                <div id="items_tbl"></div>
                            </div>
                        </div>


                        <div class="divider-text bg-gray-400 text-white">Reference</div>
                        <div class="form-row mg-b-20">
                            <div class="col-md-4">
                                <label for="department">Issuance Doc Reference(Batch#/MWIS) <i class="tx-danger">*</i></label>
                                <input required type="text" name="doc_ref" class="form-control" value="{{ $par->doc_ref }}">
                            </div>
                            @if($par->safety != '')
                            <div class="col-md-4">
                                <label for="department">Safety Control #</label>
                                <input type="text" name="safety" class="form-control" value="{{ $par->safety }}">
                            </div>
                            @endif
                        </div> 

                        <div class="form-row">
                            <div class="col-md-12 mg-t-30 d-flex justify-content-end">
                                <button type="submit" class="btn btn-sm btn-primary">Adjust Par</button>
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
    <script src="{{ asset('assets/lib/parsleyjs/parsley.min.js') }}"></script>
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
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

            $('#employees').val(i[0]);
            $('#dept').val(i[1]);

            $('#employee_list').fadeOut();
        });  

        $(document).on('click','.dept_li',function(){
            $('#department').val($(this).text());
            $('#department_list').fadeOut();
        });

        $('#par_type').on('change', function(){
            $('#search').val('');
        });

        $('#e_type').on('change', function(){
            if($(this).val() == 1){
                $('#empdiv').show('slow');
                $('#deptdiv').hide('slow');
                $('.dept').val('');
            } else {
                $('#deptdiv').show('slow');
                $('#empdiv').hide('slow');
                $('.emp').val('');
            }
        });
    </script>
@endsection
