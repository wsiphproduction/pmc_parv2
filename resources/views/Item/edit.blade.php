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
                <li class="breadcrumb-item active" aria-current="page">Item Management</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Item Update Form</h4>
    </div>
</div>

<form autocomplete="off" action="/item/update" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
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
                            <label for="doc_date">Description <i class="tx-danger">*</i></label>
                            <input type="hidden" name="iid" value="{{$item->id}}">
                            <textarea required class="form-control" rows="2" id="desc" name="desc">{{ old('desc',$item->description) }}</textarea>
                        </div>
                    </div> 

                    <div class="form-row mg-b-15">
                        <div class="col-md-6">
                            <label for="employee">OEM ID <i class="tx-danger">*</i></label>
                            <input type="text" name="oem_id" id="oem" class="form-control" value="{{ old('oem',$item->oem_id) }}">
                        </div>
                        <div class="col-md-6">
                            <label for="UOM">Unit of Measurement</label>
                            <select required class="custom-select" name="uom" id="uom">
                                <option value="">Choose One</option>
                                @foreach($uom_data as $uom)
                                <option @if($uom->code == $item->uom) selected @endif value="{{$uom->code}}">{{$uom->code}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    @if($item->item_kind == 1)
                        <div class="form-row mg-b-15">
                                <div class="col-md-4 inv_code">
                                    <label for="employee">Inventory Code</label>
                                    <select class="custom-select" name="inv_code">
                                        <option value="">Choose One</option>
                                        @foreach($inv_data as $inv)
                                        <option @if($inv->inv_code == $item->inv_code) selected @endif value="{{$inv->inv_code}}">{{$inv->inv_code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                               
                                <div class="col-md-4 stock_type">
                                    <label for="Stock">Stock Type</label>
                                    <select class="custom-select" name="stock_type" id="stype">
                                        <option value="">Choose One</option>
                                        @foreach($stock_data as $stock)
                                        <option @if($stock->code == $item->stock_type) selected @endif value="{{$stock->code}}">{{$stock->code}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            <div class="col-md-4">
                                <label for="doc_date">Expense Type <i class="tx-danger">*</i></label>
                                <select required class="custom-select" name="expense_type">
                                    <option value="" selected>Choose One</option>
                                    <option @if($item->expense_type == 'CAPEX') selected @endif value="CAPEX">CAPEX</option>
                                    <option @if($item->expense_type == 'OPEX') selected @endif  value="OPEX">OPEX</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row mg-b-30">
                            <div class="col-md-6">
                                <label for="cost">Cost <i class="tx-danger">*</i></label>
                                <input required type="number" step="0.01" name="cost" id="cost" class="form-control text-right" value="{{old('cost',$item->cost)}}">
                            </div>
                            @if($item->qty == 1)
                            <div class="col-md-6">
                                <label for="doc_date">Serial Number @if($item->item_kind == 2)<i class="tx-danger">*</i>@endif</label>
                                <input @if($item->item_kind == 2)  required @endif type="text" name="serial" id="serial" class="form-control" value="{{ old('serial',$item->serial_no) }}">
                            </div>
                            @endif
                        </div>
                    @else
                        <div class="form-row mg-b-15">
                            <div class="col-md-4">
                                <label for="doc_date">Expense Type <i class="tx-danger">*</i></label>
                                <select required class="custom-select" name="expense_type">
                                    <option value="" selected>Choose One</option>
                                    <option @if($item->expense_type == 'CAPEX') selected @endif value="CAPEX">CAPEX</option>
                                    <option @if($item->expense_type == 'OPEX') selected @endif  value="OPEX">OPEX</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="cost">Cost <i class="tx-danger">*</i></label>
                                <input required type="number" name="cost" id="cost" class="form-control" value="{{old('cost',$item->cost)}}">
                            </div>
                            <div class="col-md-4">
                                <label for="doc_date">Serial Number <i class="tx-danger">*</i></label>
                                <input required type="text" name="serial" id="serial" class="form-control" value="{{ old('serial',$item->serial_no) }}">
                            </div>
                        </div>
                    @endif



                    <div class="form-row mg-b-30">
                        <div class="col-md-12">
                            <label for="doc_date">Other Specifications</label>
                            <textarea class="form-control" rows="2" name="other_specs" id="specs">{{ old('specs',$item->other_specs) }}</textarea>
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
                            <input type="text" name="po" id="po" class="form-control" value="{{ old('po',$item->po_no) }}">
                        </div>
                    </div>
                    <div class="form-row mg-b-30">
                        <div class="col-md-6">
                            <label for="doc_date">DR Number</label>
                            <input type="text" name="dr_no" id="dr_no" class="form-control" value="{{ old('dr_no',$item->dr_no) }}">
                        </div>

                        <div class="col-md-6">
                            <label for="doc_date">Invoice Number</label>
                            <input type="text" name="invc_no" id="invc" class="form-control" value="{{ old('invc',$item->invoice_no) }}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-row mg-t-20">
                <div class="col-md-12 d-flex justify-content-end">
                    @if($item->item_kind == 1)
                        <a href="/item/stocked" class="btn btn-sm btn-secondary mg-r-10">Cancel</a>
                    @else
                        <a href="/item/non-stock" class="btn btn-sm btn-secondary mg-r-10">Cancel</a>
                    @endif
                    <button type="submit" class="btn btn-sm btn-primary"><i data-feather="save"></i> Save Changes</button>
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
