@extends('accounting.layouts.app')

@section('pagecss')
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active" aria-current="page">Item Management</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Item List</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mg-b-20">  
            <div class="card">
                <div class="card-body">
                    <form id="filter_item_list">
                        @csrf
                        <div class="form-group-inner">
                            <div class="row">
                                <div class="col-md-4">
                                    <div data-label="Example" class="df-example demo-forms">
                                        <div class="wd-md-100p">
                                            <select class="form-control select2-no-search"  name="filter_category">
                                                <option></option>
                                                <option value="1">Item #</option>
                                                <option value="2">Serial #</option>
                                                <option value="3">Description</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search">
                                </div>
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 mg-t-2">
                                            <button class="btn btn-sm pd-x-15 btn-primary btn-uppercase mg-l-5" type="submit">Search</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>          
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pd-y-15 pd-x-10">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table class="table mg-b-0 table-striped">
                                <thead class="thead-secondary">
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Stock Code</th>
                                        <th class="wd-300">Description</th>
                                        <th scope="col">Expense Type</th>
                                        <th scope="col">Serial #</th>
                                        <th scope="col">Qty</th>
                                        <th scope="col">Cost</th>
                                        <th scope="col">Asset Code</th>
                                        <th scope="col">PO #</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item_list">
                                    @forelse($items as $item)
                                        <tr class="tx-12">
                                            <th scope="row" class="wd-5p">{{ $item->id }}</th>
                                            <td>{{ $item->stock_code }}</td>
                                            <td class="wd-390">{{ strtoupper($item->description) }}</td>
                                            <td>{{ $item->expense_type }}</td>
                                            <td>{{ $item->serial_no }}</td>
                                            <td>{{ $item->qty }}</td>
                                            <td>{{ $item->cost }}</td>
                                            <td>{{ $item->asset_code }}</td>
                                            <td>{{ $item->po_no }}</td>
                                            <td>
                                                <a href="/item/verify/{{$item->id}}" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#modalVerifyItem" data-toggle="modal" data-iid="{{$item->id}}" title="Verified Item" class="btn btn-xs btn-success modal-verify">
                                                    <i class="fa fa-check"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="12"><center>No verified items found</center></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mg-t-5">{{ $items->links() }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="modalVerifyItem" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Item Verification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="/item/modal-verify" method="post">
                        @csrf
                        <input type="hidden" id="iid" name="iid">
                        <div class="modal-body">
                            <p>You're about to verify this item. Do you want to continue?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Yes, Verify</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>

    <script>
        $(function(){
            'use strict'
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Search Category'
            });
        });

        $(document).on('click','.modal-verify', function(){
            $('.modal-body #iid').val($(this).data('iid'));
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#filter_item_list').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/search/unverified-items",
                    data: $('#filter_item_list').serialize(),
                    success: function( response ) {
                    $('#item_list').html(response);
                        
                    }
                });
            });
        });
    </script>
@endsection