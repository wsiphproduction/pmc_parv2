@extends('accounting.layouts.app')

@section('pagecss')
<link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-10 mg-lg-b-25 mg-xl-b-10">
    <div>
        <h4 class="mg-b-0 tx-spacing--1">Item Creation Form</h4>
    </div>
</div>

<form autocomplete="off" action="/item/verify" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
    @csrf
    <div class="row row-xs">
        <div class="col-lg-8 col-xl-7 mg-t-10">
            <div class="card">
                <div class="card-header pd-y-20 d-md-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Item Information</h6>
                </div>
                <div class="card-body">
                    <div class="form-row mg-b-20">
                        <div class="col-md-12">
                            <label for="doc_date">Description</label>
                            <input type="hidden" name="iid" value="{{$item->id}}">
                            <textarea readonly class="form-control" rows="2" name="desc">{{ old('desc',$item->description) }}</textarea>
                        </div>
                    </div> 

                     <div class="form-row mg-b-15">
                        <div class="col-md-6">
                            <label for="employee">Qty</label>
                            <input readonly type="text" value="{{ old('qty',$item->qty) }}" name="qty" class="form-control text-right">
                        </div>
                        <div class="col-md-6">
                            <label for="UOM">Unit of Measurement</label>
                            <input readonly type="text" name="uom" class="form-control" value="{{ old('uom',$item->uom) }}">
                        </div>
                    </div>

                    <div class="form-row mg-b-20">
                        <div class="col-md-6">
                            <label for="employee">OEM ID</label>
                            <input readonly type="text" name="oem_id" class="form-control" value="{{ old('oem',$item->oem) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="cost">Unit Cost</label>
                            <input readonly type="text" value="{{ old('cost',$item->cost) }}" name="cost" class="form-control text-right">
                        </div>
                    </div>

                    <div class="form-row mg-b-15">
                        <div class="col-md-6 inv_code">
                            <label for="employee">Inventory Code</label>
                            <input readonly type="text" name="inv_code" class="form-control" value="{{ old('inv',$item->inv_code) }}">
                        </div>
                        <div class="col-md-6 stock_type">
                            <label for="Stock">Stock Type</label>
                            <input readonly type="text" name="stock_type" class="form-control" value="{{ old('stype',$item->stock_type) }}">
                        </div>
                    </div>

                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="doc_date">Expense Type</label>
                            <select required class="custom-select" name="expense_type">
                                <option value="" selected>Choose One</option>
                                <option @if($item->expense_type == 'CAPEX') selected @endif value="CAPEX">CAPEX</option>
                                <option @if($item->expense_type == 'OPEX') selected @endif  value="OPEX">OPEX</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="doc_date">Serial Number</label>
                            <input type="text" name="serial" class="form-control" value="{{ old('serial',$item->serial_no) }}">
                        </div>
                    </div>

                    <div class="form-row mg-b-30">
                        <div class="col-md-12">
                            <label for="doc_date">Other Specifications</label>
                            <textarea readonly class="form-control" rows="2" name="other_specs">{{ old('specs',$item->other_specs) }}</textarea>
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
                            <label for="doc_date">Asset Code</label>
                            <input type="text" name="asset_code" class="form-control" value="{{ old('asset_code',$item->asset_code) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="doc_date">PO number</label>
                            <input readonly type="text" name="po" id="po" class="form-control" value="{{ old('po',$item->po_no) }}">
                        </div>
                    </div>
                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="doc_date">Supplier's Document</label>
                            <input readonly type="text" name="dr_no" id="dr_no" class="form-control" value="{{ old('dr_no',$item->dr_no) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="doc_date">&nbsp;</label>
                            <input readonly type="text" name="invc_no" id="invc" class="form-control" value="{{ old('invc',$item->invoice_no) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mg-t-20">
                <div class="col-md-12 d-flex justify-content-end">
                    <a href="/accounting/item-verification" class="btn btn-sm btn-secondary mg-r-10">Cancel</a>
                    <button type="submit" class="btn btn-sm btn-primary"><i data-feather="save"></i> Verify Item</button>
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
@endsection
