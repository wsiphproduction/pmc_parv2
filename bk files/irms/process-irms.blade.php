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
        <h4 class="mg-b-0 tx-spacing--1">PPE Issuance Form</h4>
    </div>
</div>

<form autocomplete="off" action="/ppe/store" role="form" action="" method="POST" id="selectForm2" class="parsley-style-1" data-parsley-validate novalidate>
    @csrf
    <div class="row row-xs">
        <div class="col-lg-12 mg-t-10">
            <div class="card">
                <div class="card-body">
                    <input type="hidden" id="total_items" name="total_items" value="0">
                    <div class="divider-text bg-gray-400 text-white">PPE Issuance Details</div>

                    <div class="form-group row">
                        <div class="col-sm-4" style="display: none;">
                            <select class="form-control select2-no-search" name="par_type" id="par_type">
                                <option value="">Select One</option>
                                <option selected value="new">New</option>
                                <option value="transfer">Transfer</option>
                            </select>
                        </div>

                        <label class="col-sm-2 col-form-label">Location <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="location">
                                <option value="">Select One</option>
                                <option value="davao">Davao</option>
                                <option value="agusan">Agusan</option>
                            </select>
                        </div>
                        
                        <label for="inputEmail3" class="col-sm-3 col-form-label d-flex justify-content-end">Doc Date <i class="tx-danger">*</i></label>
                        <div class="col-sm-3">
                            <input readonly type="text" id="datepicker4" name="doc_date" value="{{ \Carbon\Carbon::today()->format('m/d/Y') }}" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row">                            
                        <label class="col-sm-2 col-form-label">Site <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <select required class="form-control select2-no-search" name="site">
                                <option value="">Select One</option>
                                <option value="mcd mine">MCD Mine</option>
                                <option value="mcd main">MCD Main</option>
                            </select>
                        </div>
                    </div>

                    <div class="divider-text bg-gray-400 text-white">End-User Information</div>
                    <div class="form-group row" id="empdiv">                            
                        <label class="col-sm-2 col-form-label">Personal <i class="tx-danger">*</i></label>
                        <div class="col-sm-4">
                            <input readonly type="text" name="emp" class="form-control" value="{{$emp}}">
                        </div>
                    </div>


                    <div class="divider-text bg-gray-400 text-white">Item Details</div>
                    <div class="form-row mg-b-10">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-sm mg-b-0">
                                    <thead class="thead-secondary">
                                        <tr>
                                          <th class="wd-25p">Description</th>
                                          <th class="wd-20p">Color</th>
                                          <th class="wd-5p">Size</th>
                                          <th class="wd-25p">Remarks</th>
                                          <th class="wd-5p">Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody id="addedItems">
                                        @foreach($irms as $i)
                                            @php
                                                $bal   = \App\Http\Controllers\irms\IrmsController::balance_api($i->headerId);
                                                $count = \App\parDetails::where('irms_ref','=',$i->headerId)->count();
                                                $ordered = 0;
                                                $delivered = 0;
                                            @endphp
                                                <tr>
                                                    <td>{{ $i->itemDesc }}</td>
                                                    <td>{{ $i->itemColor }}</td>
                                                    <td>{{ $i->itemSize }}</td>
                                                    <td>{{ $i->remarks }}</td>
                                                    <td>{{ $bal[0]['qty']- $bal[0]['qtyReleased'] - $count }}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan='6'>
                                                        <div class="form-row">
                                                            <div class="col-md-6">
                                                                <input type="text" name="item_id[]" id="item_search" class="form-control" placeholder="Search item description...">
                                                                <span><img style="display: none;" id="item_spinner" class="wd-10p mg-t-4" src="{{ asset('assets/img/spinner/spinner5.gif') }}" alt=""></span>
                                                                <div id="items_tbl"></div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="number" class="form-control" name="qty[]" placeholder="Quantity">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <input type="text" class="form-control" name="rq[]" placeholder="RQ">
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div class="divider-text bg-gray-400 text-white">Reference</div>
                    <div class="form-row mg-b-20">
                        <div class="col-md-4">
                            <label for="department">RQ / Word Order # <i class="tx-danger">*</i></label>
                            <input type="text" name="wr_no" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="department">Batch # <i class="tx-danger">*</i></label>
                            <input required type="text" name="batch" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="department">Safety Control # <i class="tx-danger">*</i></label>
                            <input readonly type="text" name="safety" class="form-control" value="{{$id}}">
                        </div>
                    </div> 

                    <div class="form-row">
                        <div class="col-md-12 mg-t-30 d-flex justify-content-end">
                            <button type="submit" class="btn btn-sm btn-primary">Submit</button>
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
        });

        function update_rqcode(){
            var x = $('#item_rq').val();
            var i = x.split("|");
            $('#rq').val(i[0]);
        }
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
            $('#item_search').keydown(function(){
                $('#item_spinner').show();
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTypingItem, 2000);
            });

            function doneTypingItem(){
                var query = $('#item_search').val();
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{ route('item.fetch') }}",
                    method: "POST",
                    data: { query :query, _token:_token },
                    success: function(data)
                    {
                        $('#item_spinner').hide();
                        $('#items_tbl').fadeIn();
                        $('#items_tbl').html(data);
                    }
                })
            }
        });

        $(document).on('click','.item_li',function(){
            $('#item_search').val($(this).text());
            $('#items_tbl').fadeOut();
        });  
    </script>
@endsection
