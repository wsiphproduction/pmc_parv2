@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
<style>
    .duplicate {
        border: 2px solid red;
        color: red;
    }
</style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Item Creation Form</h4>
    </div>
    <div class="d-none d-md-block">
        <a href="#" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white"><i data-feather="upload" class="wd-10 mg-r-5"></i> PPE Items Batch Upload</a>

        <a href="/maintenance/stock-code" target="_blank" class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5 text-white"><i data-feather="file" class="wd-10 mg-r-5"></i> View Stock Code Masterfile</a>
      </div>
</div>

<form autocomplete="off" action="/item/store" role="form" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
    @csrf
    <div class="row row-xs">
        <div class="col-lg-8 col-xl-7 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Item Information</h6>
                </div>
                <div class="card-body">
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <div class="form-row mg-b-15">
                        <div class="col-md-8" id="empdiv">
                            <label for="employee">Item Type <i class="tx-danger">*</i></label>
                            <select required class="custom-select" name="item_kind" id="item_kind">
                                <option selected value="" >Choose One</option>
                                <option value="1">Stock Item w/ Serial</option>
                                <option value="2">Non-stock Item</option>
                                <option value="3">Stock Items w/out Serial</option>
                            </select>
                        </div>
                        <div class="col-md-4 stock_code">
                            <label for="department">Stock Code</label>
                            <input type="text" name="stock_code" id="stock_code" class="form-control stock" placeholder="Enter Stock Code">
                            <div id="stock_list"></div>
                        </div>
                    </div>

                    <div class="form-row mg-b-20">
                        <div class="col-md-12">
                            <label for="doc_date">Description <i class="tx-danger">*</i></label>
                            <textarea required class="form-control" rows="2" id="desc" name="desc" placeholder="Enter item description here . . ."></textarea>
                        </div>
                    </div> 

                    <div class="form-row mg-b-15">
                        <div class="col-md-6">
                            <label for="employee">Qty</label>
                            <input type="number" name="qty" id="qty" value="0" class="form-control text-right">
                        </div>
                        <div class="col-md-6">
                            <label for="UOM">Unit of Measurement <i class="tx-danger">*</i></label>
                            <div class="uom_static">
                                <input type="text" name="uom_input" id="uom" class="form-control" placeholder="Enter Unit of Measurement">
                            </div>
                            <div style="display: none;" class="uom_drop">
                                <select class="custom-select" name="uom_option">
                                    <option selected>Choose One</option>
                                    @foreach($uom_data as $uom)
                                    <option value="{{$uom->code}}">{{$uom->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                        </div>
                    </div>

                    <div class="form-row mg-b-20">
                        <div class="col-md-6">
                            <label for="employee">OEM ID</label>
                            <input type="text" name="oem_id" id="oem" class="form-control" placeholder="Enter OEM Id">
                        </div>
                        <div class="col-md-6">
                            <label for="cost">Unit Cost <i class="tx-danger">*</i></label>
                            <input required type="number" step="0.01" value="0.00" name="cost" class="form-control text-right">
                        </div>
                    </div>

                    <div class="form-row mg-b-15">
                        <div class="col-md-4 inv_code">
                            <label for="employee">Inventory Code</label>
                            <input type="text" name="i_inv_code" class="form-control" id="inv">
                        </div>
                        <div class="col-md-4 stock_type">
                            <label for="Stock">Stock Type</label>
                            <input type="text" name="stock_type" id="stype" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="expense_type">Expense Type <i class="tx-danger">*</i></label>
                            <select required class="custom-select" name="expense_type">
                                <option value="" selected>Choose One</option>
                                <option value="CAPEX">CAPEX</option>
                                <option value="OPEX">OPEX</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-row mg-b-30">
                        <div class="col-md-12">
                            <label for="other_specs">Other Specifications</label>
                            <textarea class="form-control" rows="2" name="other_specs" placeholder="Enter other specifications"></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4 col-xl-5 mg-t-10">

            <div class="card mg-b-10">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Serial Number(s) <i class="text-danger">*</i></h6>
                </div>
                <div class="card-body pd-20">
                    <div id="serials"></div>
                </div>
            </div>

            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Cost Codes and References</h6>
                </div>
                <div class="card-body pd-20">

                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="po">PO Number</label>
                            <input type="text" name="po" class="form-control" placeholder="Enter po number">
                        </div>
                    </div>
                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="dr_no">DR Number</label>
                            <input type="text" name="dr_no" class="form-control" placeholder="DR Number">
                        </div>

                        <div class="col-md-6">
                            <label for="invc_no">Invoice Number</label>
                            <input type="text" name="invc_no" class="form-control" placeholder="Invoice Number">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mg-t-20">
                <div class="col-md-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-sm btn-primary"><i data-feather="save"></i> Save Item</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection

@section('pagejs')
<script src="{{ asset('assets/lib/jqueryui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/lib/parsleyjs/parsley.min.js') }}"></script>
<script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>

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

                $(".stock_code,.inv_code,.stock_type,.uom_static").hide('slow');
                $("#desc,#oem,#uom,#inv,#stype,#stock_code").val('');
                $("#desc,#oem,#uom,#inv,#stype").prop("readonly",false);
                $(".uom_drop").show('slow');
                $("#qty").prop("readonly",false);
            } else {
                if(value == 3){ 
                    $("#qty").prop("readonly",true); 
                } else {
                    $("#qty").prop("readonly",false); 
                }
                $(".stock_code,.inv_code,.stock_type,.uom_static").show('slow');
                $(".uom_drop").hide('slow');
            }   
        });
    });
</script>

<script>

    $("#qty").change(function() {
        var elem = $('#serials').empty();
        var value = +$(this).val();
        var nr = 0;
        while (nr < value) {
            //elem.append($('<input>',{name : "serialno[]", id: "serial_"+nr, class: "form-control mg-b-10", required : "required"}));
            elem.append($('<input required type="text" name="serial[]" id="serial_'+nr+'" onkeyup=\'isSerialExist($(this).val(),'+nr+')\' class="form-control mg-b-5 givenclass"><span class="mg-b-10" style="font-size:12px;color:red;" id="ser_'+nr+'"></span>'));
            nr++;
        }
    });
    
    $(document).ready(function(){
        $('form').submit(function(){
            $(this).find('button[type=submit]').prop('disabled', true);
        });

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

    function isSerialExist(a,b){
        var _token = $('input[name="_token"]').val();
        if(a.length >= 3){
            
            var arr = [];
            $("input[name='serial[]']").each(function(){
                var value = $(this).val();
                
                if(arr.indexOf(value) < 0){
                    arr.push(value);
                    $(this).removeClass("duplicate");

                    $.ajax({
                        url: "{{ route('serial.check') }}",
                        method: "POST",
                        data: { serial: a,
                                inp_no: b,
                                _token:_token 
                        },
                        success: function( response ) {
                            if(response != 'none'){
                                $('#serial_'+b).css('border', '2px solid red');
                            } else {
                                $('#serial_'+b).css('border', '');
                            }
                        }
                    });

                } else {
                    $(this).addClass("duplicate");
                }
            });
        }
    }

    function populate_fields(stock_code,description,oem_id,uom,inv_code,stock_type){

        $('#stock_code').val(stock_code);
        $('#desc').val(description);
        $('#oem').val(oem_id);
        $('#uom').val(uom);
        $('#inv').val(inv_code);
        $('#stype').val(stock_type);

        if(inv_code == 'SAF'){
            $("#qty").prop("readonly",true);
        } else {
            if($('#item_kind').val() == 3){
                $("#qty").prop("readonly",true);
            } else {
                $("#qty").prop("readonly",false);
            }
        }

        $('#inv').prop("readonly", true); 
        $("#desc,#oem,#uom,#stype").prop("readonly",true);
        $('#stock_list').fadeOut();
    }
    
</script>
@endsection
