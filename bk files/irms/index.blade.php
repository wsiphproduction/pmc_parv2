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
                  <li class="breadcrumb-item"><a href="#">PAR Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">PPE Issuance Request</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">PPE Issuance Request Management</h4>
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
                                                <option value="1">Control</option>
                                                <option value="2">Location ( Mines / Mill )</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="search" placeholder="Enter Location, Control # here">
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
                            <table class="table mg-b-0">
                                <thead class="thead-primary">
                                    <tr>
                                        <th scope="col">Control #</th>
                                        <th scope="col">Recepient</th>
                                        <th scope="col">Document Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item_list">
                                    @foreach($requests as $req)
                                        <tr>
                                            <td>{{ $req->controlNum }}</td>
                                            <td>{{ $req->rec }}</td>
                                            <td>{{ $req->ddate }}</td>
                                            <td>{{ $req->location }}</td>
                                            <td></td>
                                            <td><a href="/process-irms/{{$req->controlNum}}/{{ $req->rec }}" class="btn btn-xs btn-primary">Process</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mg-t-5"></div>
                        </div>
                    </div>
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
    </script>
@endsection
