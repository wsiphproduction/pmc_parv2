@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('assets/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <h4 class="mg-b-0 tx-spacing--1">Hello! {{ Auth::user()->fullName }}, welcome to Par v2 </h4>
    </div>
</div>

<div class="row d-flex justify-content-center">
    <div class="row tx-14">
        <div class="col-sm-6 ">
            <div style="background-color: #4C3F54;" class="bd pd-20 pd-lg-30 ht-sm-300 d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-center mg-b-25"><i data-feather="layers" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 style="color:#fefcf7;" class="d-flex justify-content-center tx-inverse mg-b-20">Par List</h5>
                <a href="/par/index" class="d-flex justify-content-end tx-medium text-white">Go to Par List Page <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
            </div>
        </div>
        <div class="col-sm-6 mg-t-20 mg-sm-t-0">
            <div style="background-color: #D13525;" class="bd pd-20 pd-lg-30 ht-sm-300 d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-center mg-b-25"><i data-feather="user-plus" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 style="color:#fefcf7;" class="d-flex justify-content-center tx-inverse mg-b-20">New Par</h5>
                <a href="/par/add" class="d-flex justify-content-end tx-medium text-white">Go to Add Par Form <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
            </div>
        </div>
        <div class="col-sm-6 mg-t-20 mg-sm-t-25">
            <div style="background-color: #F2C057;" class="bd pd-20 pd-lg-30 ht-sm-300 d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-center mg-b-25"><i data-feather="gift" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 style="color:#fefcf7;" class="d-flex justify-content-center tx-inverse mg-b-20">Add Item</h5>
                <a href="/item/add" class="d-flex justify-content-end tx-medium text-white">View to Add Item Form <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
            </div>
        </div>
        <div class="col-sm-6 mg-t-20 mg-sm-t-25">
            <div style="background-color: #486824;" class="bd pd-20 pd-lg-30 ht-sm-300 d-flex flex-column justify-content-end">
                <div class="d-flex justify-content-center mg-b-25"><i data-feather="file-text" class="wd-50 ht-50 tx-gray-500"></i></div>
                <h5 style="color:#fefcf7;" class="d-flex justify-content-center tx-inverse mg-b-20">Reports</h5>
                <a href="/report/par-summary" class="d-flex justify-content-end tx-medium text-white">Go to Reports Page <i class="icon ion-md-arrow-forward mg-l-5"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection



