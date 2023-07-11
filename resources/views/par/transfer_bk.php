@extends('layouts.app')

@section('pagecss')
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active" aria-current="page">Transfer Issuance</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Transfer Issuance Management</h4>
    </div>
</div>

@if($message = Session::get('success'))
    <div class="alert alert-solid alert-success d-flex align-items-center" role="alert">
        <i data-feather="check-circle" class="mg-r-10"></i> Success! {{ $message }}
    </div>
@endif

@if($message = Session::get('error'))
    <div class="alert alert-solid alert-danger d-flex align-items-center" role="alert">
        <i data-feather="check-circle" class="mg-r-10"></i> Error! {{ $message }}
    </div>
@endif

<form role="form" action="/par/transfer-item/manual" method="POST">
@csrf
<div class="row row-xs">
    <div class="col-lg-12 mg-t-10">
        <div class="card">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                    <h6 class="mg-b-5">Items to Transfer</h6>
                </div>
            </div>
            <table class="table table-borderless table-sm tx-13 tx-nowrap table-responsive">
                <thead>
                    <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                        <th class="wd-5p">Tracking #</th>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Details</th>
                        <th>Location</th>
                        <th>Cost</th>
                        <th>RQ</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="addedItems">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="row row-xs">
    <div class="col-lg-8 col-xl-4 mg-t-10">
        <div class="card">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                    <h6 class="mg-b-5">Transfer Issuance Form</h6>
                </div>
            </div>
            <div class="card-body pd-20">
                
                <div class="form-group" id="deptdiv">
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <label for="formGroupExampleInput" class="d-block tx-12">Department <i class="tx-danger">*</i></label>
                    <div data-label="Example" class="df-example demo-forms">
                        <div class="wd-md-100p">
                            <select name="dept" class="form-control select2">
                                <option></option>
                                
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="empdiv">
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <label for="formGroupExampleInput" class="d-block tx-12">Employee <i class="tx-danger">*</i></label>
                    <div data-label="Example" class="df-example demo-forms">
                        <div class="wd-md-100p">
                            <select name="emp" class="form-control select2">
                                <option></option>
                               
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="formGroupExampleInput2" class="d-block tx-12">Document Date <i class="tx-danger">*</i></label>
                    <div data-label="Example" class="df-example demo-forms">
                        <div class="wd-md-100p">
                            <input required type="text" name="doc_date" class="form-control" placeholder="Choose date" id="datepicker4">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2" class="d-block tx-12">Safety Control # <i class="tx-danger">*</i></label>
                    <input required type="text" name="safety_control_no" class="form-control">
                </div>
                <div class="form-group">
                    <label for="formGroupExampleInput2" class="d-block tx-12">Reference Code <i class="tx-danger">*</i></label>
                    <input required type="text" name="ref_code" class="form-control">
                </div>
                <button type="submit" class="btn btn-sm btn-secondary">Transfer Issuance</button>
            </div>
        </div>
    </div>
</form>

    <div class="col-lg-4 col-xl-8 mg-t-10">
        <div class="card">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                    <div class="search-form">
                        <input type="search" name="search" id="search" class="form-control" placeholder="Search Items here...">
                        <button class="btn" type="button"><i data-feather="search"></i></button>
                    </div>
                </div>
            </div>
            <div class="card-body pd-y-15 pd-x-10">
                <div>
                    <table class="table table-borderless table-sm tx-10 mg-b-0">
                        <thead>
                            <tr class="tx-10 tx-spacing-1 tx-color-03 tx-uppercase">
                                <th>Tracking #</th>
                                <th>Description</th>
                                <th>Details</th>
                                <th>Qty</th>
                                <th>Location</th>
                                <th>RQ</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="ItemsToTransferList">
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('pagejs')
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/lib/jqueryui/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('scripts/par.js') }}"></script>
    <script>
        $(function(){
            'use strict'
            $('.select2').select2({
                placeholder: 'Choose one',
                searchInputPlaceholder: 'Search options',
                allowClear: true
            });

            $('#datepicker4').datepicker();
        });
    </script>

    <script type="text/javascript">

    $(document).ready(function(){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#search').keyup(function(){
            var search = $('#search').val();
            if(search == ""){
                $("#ItemsToTransferList").html("");
            }
            else{
                $.get("{{ URL::to('/par/search-items-to-transfer') }}",{search:search}, function(data){
                    $('#ItemsToTransferList').empty().html(data);
                })
            }
        });
    });
</script>
@endsection