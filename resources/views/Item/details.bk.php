@extends('layouts.app')

@section('pagecss')
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.profile.css') }}">
@endsection

@section('content')
<div class="media d-block d-lg-flex">
    <div class="media-body mg-t-40 mg-lg-t-0 pd-lg-x-10">

        <div class="card mg-b-20 mg-lg-b-25">
            <div class="card-header pd-y-15 pd-x-20 d-flex align-items-center justify-content-between">
                <h6 class="tx-uppercase tx-semibold mg-b-0">Item Details</h6>
                <nav class="nav nav-with-icon tx-13">
                    <span class="badge badge-primary">OPEN</span>
                </nav>
            </div>
            <div class="card-body pd-25">
                <div class="media d-block d-sm-flex">
                    <div class="wd-80 ht-80 bg-ui-04 rounded d-flex align-items-center justify-content-center">
                        <i data-feather="briefcase" class="tx-white-7 wd-40 ht-40"></i>
                    </div>
                    <div class="media-body pd-t-25 pd-sm-t-0 pd-sm-l-25">
                        <h5 class="mg-b-5">{{ $item->stock_code }}</h5>
                        <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">{{ $item->description }}</span></p>
                        <span class="d-block tx-13 tx-color-03 mg-b-20">{{ $item->expense_type }}</span>

                        <span class="tx-13">Other Specifications : {{ $item->other_specs }}</span>
                        
                        <div class="row">
                            <div class="col-sm-6 col-lg-4 mg-t-40 mg-sm-t-0 mg-md-t-40">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Item Information</label>

                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Item Kind</span>
                                        <span>{{ ($item->item_kind == 1) ? 'Stocked Item' : 'Non-stock Item' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Stock Type</span>
                                        <span>{{ $item->stock_type }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Inventory Code</span>
                                        <span>{{ isset($item->inv_code) ? $item->inv_code : '-' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">OEM ID</span>
                                        <span>{{ $item->oem_id }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">UOM</span>
                                        <span>{{ $item->uom }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-6 col-lg-4 mg-t-40">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Cost Code &amp; References</label>
                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Cost</span>
                                        <span>{{ number_format($item->cost,2) }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Serial No</span>
                                        <span>{{ isset($item->serial_no) ? $item->serial_no : '-' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Asset Code</span>
                                        <span>{{ isset($item->asset_code) ? $item->asset_code : '-' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">PO #</span>
                                        <span>{{ isset($item->po_no) ? $item->po_no : '-' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">DR #</span>
                                        <span>{{ isset($item->dr_no) ? $item->dr_no : '-' }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Invoice</span>
                                        <span>{{ isset($item->invoice_no) ? $item->invoice_no : '-' }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-6 col-lg-4 mg-t-40 mg-sm-t-0 mg-md-t-40">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>

                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Added By</span>
                                        <span>{{ $item->added_by }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Created At</span>
                                        <span class="tx-12">{{ $item->created_at }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Updated At</span>
                                        <span class="tx-12">{{ isset($item->updated_at) ? $item->updated_at : '-' }}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="profile-sidebar mg-t-40 mg-lg-t-0 pd-lg-l-25">
        <div class="row">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h6 class="mg-b-0">Employee(s) with Accountability</h6>
                </div>
                <div class="card-body pd-20">
                    <ul class="activity tx-13">
                        @foreach($history as $h)
                        <li class="activity-item">
                            <div class="activity-icon @if($h->status == 'CLOSED') bg-success-light @else bg-success @endif tx-white"><i data-feather="user"></i></div>
                            <div class="activity-body mg-t-10">
                                <a href="/par/details/{{ $h->header_id }}"><p class="mg-b-2"><strong>{{ $h->accountable }}</strong></p></a>
                                <small class="tx-color-03">{{ $h->accountable_created }}</small>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

