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
            <h4 class="mg-b-0 tx-spacing--1">Stocked Items</h4>
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
                                    <form id="filter_saved_stock_item">
                                    @csrf
                                        <th><input type="text" name="scode" class="form-control"></th>
                                        <th><input type="text" name="icode" class="form-control"></th>
                                        <th><input type="text" name="descr" class="form-control"></th>
                                        <th><input type="text" name="serial" class="form-control"></th>
                                        <th><input type="text" name="oemid" class="form-control"></th>
                                        <th><input type="text" name="uom"   class="form-control"></th>
                                        <th><input type="text" name="extyp" class="form-control"></th>
                                        <th><button type="submit" class="btn btn-primary"><i data-feather="filter"></i></button></th>
                                    </form>
                                </thead>
                                <thead class="thead-secondary">
                                    <tr>
                                        <th class="wd-10p">Stock Code</th>
                                        <th class="wd-10p">Inv Code</th>
                                        <th class="wd-25p">Description</th>
                                        <th class="wd-15p">Serial #</th>
                                        <th class="wd-10p">OEM ID</th>
                                        <th class="wd-10p">UOM</th>
                                        <th class="wd-10p">Expense Type</th>
                                        <th class="wd-10p"></th>
                                    </tr>
                                </thead>
                                <tbody id="items_tbl">
                                    @foreach($items as $item)
                                        <tr class="tx-12">
                                            <th>{{ $item->stock_code }}</th>
                                            <td>{{ $item->inv_code }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->serial_no }}</td>
                                            <td>{{ $item->oem_id }}</td>
                                            <td>{{ $item->uom }}</td>
                                            <td>{{ $item->expense_type }}</td>
                                            <td>
                                                <a href="/item/edit/{{$item->id}}" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                                                    <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="#item-delete" data-toggle="modal" data-id="{{$item->id}}" title="Delete Item" class="btn btn-xs btn-danger btn-sm delete-item">
                                                    <i class="fa fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex flex-row justify-content-between mg-t-20">
                                <div class="pd-10">Total of {{$items->total()}} stock items</div>
                                <div class="pd-10">&nbsp;</div>
                                <div class="pd-10">{{ $items->links() }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal effect-scale" id="item-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="/item/delete" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="iid" name="iid">
                        <p>Are you sure you want to delete this item ?</p>
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
    <script type="text/javascript">
        $(document).on("click", ".delete-item", function () {
            $(".modal-body #iid").val($(this).data('id'));
        });

        $(document).ready(function(){
            $('#filter_saved_stock_item').submit(function(e){
                e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: "/filter/saved-stock-items",
                    data: $('#filter_saved_stock_item').serialize(),
                    success: function( response ) {
                        $('#items_tbl').html(response);  
                    }
                });
            });
        });
    </script>
@endsection