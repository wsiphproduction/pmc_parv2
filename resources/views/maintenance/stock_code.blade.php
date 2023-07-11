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
                  <li class="breadcrumb-item active" aria-current="page">Item Management</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">Stock Code Masterfile</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <form action="/upload/stocked_items" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="file" name="file" class="form-control">
                    </div>
                    <div class="form-group col-md-2">
                         <button type="submit" class="btn btn-sm btn-primary"><i data-feather="upload"></i> Upload</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-4">
            <div class="d-flex justify-content-end">
                <a href="#" data-toggle="modal" data-target="#create-stock-code" class="btn btn-sm btn-primary"><i data-feather="plus"></i> Create Stock Code</a>
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
                                <thead>
                                    <form id="filter_stock_item">
                                    @csrf
                                        <th><input type="text" name="inv_code" class="form-control"></th>
                                        <th><input type="text" name="stock_c" class="form-control"></th>
                                        <th><input type="text" name="dscrptn" class="form-control"></th>
                                        <th><input type="text" name="oem_id"  class="form-control"></th>
                                        <th><input type="text" name="uom"     class="form-control"></th>
                                        <th><button type="submit" class="btn btn-primary"><i data-feather="filter"></i></button></th>
                                    </form>
                                </thead>
                                <thead class="thead-secondary">
                                    <tr>
                                        <th class="wd-10p">Inv Code</th>
                                        <th class="wd-10p">Stock Code</th>
                                        <th class="wd-50p">Description</th>
                                        <th class="wd-10p">OEM ID</th>
                                        <th class="wd-10p">UOM</th>
                                        <th class="wd-10p"></th>
                                    </tr>
                                </thead>
                                <tbody id="items_tbl">
                                    @foreach($items as $item)
                                        <tr class="tx-12">
                                            <th>{{ $item->inv_code }}</th>
                                            <td>{{ $item->stock_code }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->oem_id }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td class="d-flex justify-content-end">
                                                <a href="/create/item/{{$item->stock_code}}" target="_blank" class="btn btn-sm btn-primary mg-r-5"><i class="fa fa-share"></i></a>
                                                <a href="#" data-toggle="modal" data-target="#delete-stock" data-id="{{$item->id}}" class="btn btn-sm btn-danger stock_delete"><i data-feather="trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-between mg-t-20">
                                <div class="pd-10">Total of {{$items->total()}} stocked items</div>
                                <div class="pd-10">&nbsp;</div>
                                <div class="pd-10">{{ $items->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="create-stock-code" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Create Stock Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/create/stock-code" method="post" role="form">
                    @csrf
                    <div class="modal-body">
                        <div class="row row-sm">
                            <div class="col-sm">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Stock Type <i class="tx-danger">*</i></label>
                                <select required class="form-control" name="stock_type">
                                    @foreach($stock_typ as $stype)
                                    <option value="{{$stype->stock_type}}">{{$stype->stock_type}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Inventory Code <i class="tx-danger">*</i></label>
                                <select required class="form-control" name="inv_code">
                                    @foreach($inv_codes as $inv)
                                    <option value="{{$inv->inv_code}}">{{$inv->inv_code}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Stock Code<i class="tx-danger">*</i></label>
                                <input required type="text" class="form-control" name="stock_code" placeholder="Enter stock code">
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-sm">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Item Desription <i class="tx-danger">*</i></label>
                                <textarea required class="form-control" name="description" id="" cols="30" rows="4" placeholder="Item Description"></textarea>
                            </div>
                        </div>
                        <br>
                        <div class="row row-sm">
                            <div class="col-sm">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">OEM ID</label>
                                <input type="text" class="form-control" name="oem">
                            </div>
                            <div class="col-sm-5 mg-t-20 mg-sm-t-0">
                                <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">UoM <i class="tx-danger">*</i></label>
                                 <select required class="form-control" name="uom">
                                    @foreach($uom_data as $uom)
                                    <option value="{{$uom->code}}">{{$uom->code}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-primary">Submit</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="delete-stock" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/delete/stock-code" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="sid" name="sid">
                        <p>Are you sure you want to delete this stock code in the list?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-sm btn-danger">Yes, Delete</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script>
        $(document).on("click", ".stock_delete", function () {
            $(".modal-body #sid").val($(this).data('id'));
        });

        $(document).ready(function(){
            $('#filter_stock_item').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/filter/stock-items",
                    data: $('#filter_stock_item').serialize(),
                    success: function( response ) {
                        $('#items_tbl').html(response);  
                    }
                });
            });
        });
    </script>
@endsection