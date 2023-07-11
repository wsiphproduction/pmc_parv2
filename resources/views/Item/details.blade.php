@extends('layouts.app')

@section('pagecss')
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.profile.css') }}">
@endsection

@section('content')
<div class="row">
    <div class="col-sm-6">
        <h6 class="tx-20 mg-b-10 mg-t-10"><a href="/par/details/{{ $hid }}">{{ $item->stock_code }}</a></h6>
        <p class="mg-b-0">{{ $item->description }}</p>
    </div>
    <div class="col-sm-6 tx-right d-none d-md-block"></div>
    <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Item Details</label>
        <p class="mg-b-0">Expense Type: {{ $item->expense_type }}</p>
        <p class="mg-b-0">Stock Type: {{ $item->stock_type }}</p>
        <p class="mg-b-0">Inv Code: {{ $item->inv_code }}</p>
        <p class="mg-b-0">Cost: {{ number_format($item->cost,2) }}</p>
    </div>
    <div class="col-sm-6 col-lg-4 mg-t-40">
        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Reference Information</label>
        <ul class="list-unstyled lh-7">
            <li class="d-flex justify-content-between">
                <span>Serial #</span>
                <span>{{ $item->serial_no }}</span>
            </li>
            <li class="d-flex justify-content-between">
                <span>Issuance Doc Ref #</span>
                <span>32334300</span>
            </li>
            <li class="d-flex justify-content-between">
                <span>Asset Code</span>
                <span>{{ $item->asset_code }}</span>
            </li>
        </ul>
    </div>
</div>
@endsection

