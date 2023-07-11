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
                        <h5 class="mg-b-5">{{ $item->tracking }}</h5>
                        <p class="mg-b-3 tx-color-02"><span class="tx-medium tx-color-01">{{ $item->name }}</span></p>
                        <span class="d-block tx-13 tx-color-03 mg-b-20">{{ $item->location }}</span>

                        <span class="tx-13">Details : {{ $item->details }}</span>
                        
                        <div class="row">
                            <div class="col-sm-6 col-lg-6 mg-t-40 mg-sm-t-0 mg-md-t-40">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Title Here</label>
                                @php 
                                    if($item->category == 1){
                                        $category = 'PPE';
                                    }
                                    elseif($item->category == 2){
                                        $category = 'Tools';
                                    }
                                    elseif($item->category == 3){
                                        $category = 'CAPEX';
                                    }
                                    elseif($item->category == 4){
                                        $category = 'Others';
                                    }
                                @endphp 
                                
                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Category</span>
                                        <span>{{ $category }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Price</span>
                                        <span>{{ $item->price }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Quantity</span>
                                        <span>{{ $item->qty }} {{ $item->uom }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Created By</span>
                                        <span>{{ $item->addedBy }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Create At</span>
                                        <span>{{ $item->created_at }}</span>
                                    </li>
                                </ul>
                            </div>

                            <div class="col-sm-6 col-lg-6 mg-t-40">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Serial No</span>
                                        <span>{{ $item->serialNo }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Purchase Order</span>
                                        <span>{{ $item->po }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">RQ</span>
                                        <span>{{ $item->rq }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">Invoice</span>
                                        <span>{{ $item->invoice }}</span>
                                    </li>
                                    <li class="d-flex justify-content-between">
                                        <span class="tx-primary">BIS Header ID</span>
                                        <span>{{ $item->bis }}</span>
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
                <div class="card-header pd-b-0 pd-x-20 bd-b-0">
                    <div class="d-sm-flex align-items-center justify-content-between">
                        <h6 class="mg-b-0">Item Accountability History</h6>
                    </div>
                </div>
                <div class="card-body pd-20">
                    <ul class="activity tx-13">
                        @foreach($history as $h)
                        <li class="activity-item">
                            <div class="activity-icon @if($h->status == 'CLOSED') bg-success-light @else bg-success @endif tx-white"><i data-feather="user"></i></div>
                            <div class="activity-body mg-t-10">
                                <a href="/par/details/{{ $h->header_id }}" target="_blank"><p class="mg-b-2"><strong>{{ $h->accountable }}</strong></p></a>
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

