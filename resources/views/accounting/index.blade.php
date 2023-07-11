@extends('accounting.layouts.app')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('assets/css/modals.css') }}">
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .trainings-wrapper {
            position: relative; background: #f5f5f5; padding: 0px 10px 5px 10px; margin-bottom: 5px;
        }
        
        .trainings-wrapper hr { margin: 10px 0 10px; }

        hr { border: solid #dddddd; border-width: 1px 0 0; clear: both; margin: 1.25rem 0 1.1875rem; height: 0; }

        .panel-body a { font-size: 14px; color: white; }
    </style>
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item"><a href="#">Par Management</a></li>
              <li class="breadcrumb-item active" aria-current="page">Par List</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">PAR Issuance Manangement</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="row">
            <div class="col-md-12">  
                <div class="card">
                    <div class="card-body">
                        <form id="filter_par_list">
                            @csrf
                            <div class="form-group-inner">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div data-label="Example" class="df-example demo-forms">
                                            <div class="wd-md-100p">
                                                <select class="form-control select2-no-search"  name="filter_category" id="filter_category">
                                                    <option></option>
                                                    <option value="1">Accountable (Employee or Department)</option>
                                                    <option value="2">Status</option>
                                                    <option value="3">PAR #</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="searchdiv">
                                        <input type="text" class="form-control" name="search">
                                    </div>
                                    <div style="display: none;" class="col-md-4" id="statusdiv">
                                        <div data-label="Example" class="df-example demo-forms">
                                            <div>
                                                <select class="form-control select2-status wd-350"  name="status" id="status">
                                                    <option></option>
                                                    <option value="saved">Saved</option>
                                                    <option value="posted">Posted</option>
                                                    <option value="adjustment">Adjustment</option>
                                                    <option value="closed">Closed</option>
                                                </select>
                                            </div>
                                        </div>
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
        <div class="card-header d-md-flex align-items-center justify-content-between">
            <h6 class="mg-b-0">&nbsp;</h6>
            <ul class="list-inline d-flex mg-md-t-0 mg-b-0">
                <li class="list-inline-item d-flex align-items-center">
                    <span class="d-block wd-10 ht-10 bg-success rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">saved</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-warning rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">posted</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-info rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Adjustment</span>
                </li>
                <li class="list-inline-item d-flex align-items-center mg-l-5">
                    <span class="d-block wd-10 ht-10 bg-danger rounded mg-r-5"></span>
                    <span class="tx-sans tx-uppercase tx-10 tx-medium tx-color-03">Closed</span>
                </li>
            </ul>
        </div>
        <div class="card">
            <div class="card-body pd-y-15 pd-x-10" id="par_list"> 
                
    
                @php
                    $grouped = $datas->groupBy('header_id');
                    $grouped->toArray();
                @endphp

                @forelse($grouped as $d)
                    @php
                        if($d[0]['doc_status'] == 'saved'){
                            $btn = '#10b759';
                        }

                        if($d[0]['doc_status'] == 'posted'){
                            $btn = '#ffc107';
                        }

                        if($d[0]['doc_status'] == 'closed'){
                            $btn = '#dc3545';
                        }

                        if($d[0]['doc_status'] == 'adjustment'){
                            $btn = '#00b8d4';
                        }
                    @endphp
                <div class="trainings-wrapper" style="border-left: 5px solid {{ $btn }};">
                    <a href="javascript:;" onclick="$('#detailsd{{ $d[0]['header_id'] }}').toggle();">
                        <div class="card-header d-sm-flex align-items-start justify-content-between pd-b-0 pd-l-1">
                            <div class="mg-t-10">
                                <h6 class="mg-b-5">{{ $d[0]['refcode'] }} : 
                                    @php
                                        if($d[0]['is_dept'] == 0){
                                            $status = \App\accountabilityHeaders::employee_status($d[0]['employee_id'], $d[0]['employee_id'].':'.$d[0]['emp_name']);
                                            if($status == 0){
                                                echo '<span class="tx-success">'.$d[0]['employee_id'].' : '.$d[0]['emp_name'].'</span>';
                                            } else {
                                                echo '<span class="tx-danger">'.$d[0]['employee_id'].' : '.$d[0]['emp_name'].'</span>';
                                            }
                                        }
                                        else {
                                            echo $d[0]['accountable'];
                                        }
                                    @endphp
                                        
                                    &nbsp;<small>{{ $d[0]['document_date'] }} </small>
                                </h6>
                            </div>

                            <div class="d-flex mg-t-20 mg-sm-t-0">
                                <span class="pull-right mg-b-5">
                                    <div class="d-none d-md-block">
                                        @if($d[0]['doc_status'] == 'closed')
                                            <a href="/par/details/{{ $d[0]['header_id'] }}" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="/par/print/{{ $d[0]['header_id'] }}" title="Print Par Details" target="_blank" title="Print PAR" class="btn btn-info btn-xs">
                                                <i class="fa fa-print"></i>
                                            </a>
                                        @else
                                                @if($d[0]['doc_status'] == 'posted')
                                                    <a href="/par/details/{{ $d[0]['header_id'] }}" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="/par/print/{{ $d[0]['header_id'] }}" title="Print Par Details" target="_blank" class="btn btn-info btn-xs">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    <a href="/par/recreate/{{ $d[0]['header_id'] }}" title="Recreate Par" class="btn btn-warning btn-xs unpost-par">
                                                        <i class="fa fa-reply"></i>
                                                    </a>
                                                    <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="{{ $d[0]['refcode'] }}" data-a="{{ $d[0]['accountable'] }}" data-dd="{{ $d[0]['document_date'] }}" data-ab="{{ $d[0]['added_by'] }}" data-ad="{{ $d[0]['created_at'] }}" data-eid="{{ $d[0]['header_id'] }}" class="btn btn-primary btn-xs email-par">
                                                        <i class="fa fa-envelope"></i>
                                                    </a>

                                                    @if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0)
                                                        <a href="#" title="Close PAR" data-toggle="modal" data-target="#cancel-par" data-pid="{{ $d[0]['header_id'] }}" class="btn btn-danger btn-xs cancel-par">
                                                            <i data-feather="x-square"></i>
                                                        </a>
                                                    @endif
                                                @else($d->doc_status == 'saved')
                                                    <a href="/par/details/{{ $d[0]['header_id'] }}" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                    <a href="/par/print/{{ $d[0]['header_id'] }}" title="Print Par Details" target="_blank" class="btn btn-info btn-xs">
                                                        <i class="fa fa-print"></i>
                                                    </a>
                                                    @if(Auth::user()->dept == '')
                                                        <a href="/par/edit/{{ $d[0]['header_id'] }}" title="Edit Par Details" target="_blank" class="btn btn-success btn-xs">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        <a href="#" data-toggle="modal" title="Post Par" data-target="#post-par" data-pid="{{ $d[0]['header_id'] }}" class="btn btn-warning btn-xs post-par">
                                                            <i class="fa fa-stamp"></i>
                                                        </a>
                                                        <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="{{ $d[0]['refcode'] }}" data-a="{{ $d[0]['accountable'] }}" data-dd="{{ $d[0]['document_date'] }}" data-ab="{{ $d[0]['added_by'] }}" data-ad="{{ $d[0]['created_at'] }}" data-eid="{{ $d[0]['header_id'] }}" class="btn btn-primary btn-xs email-par">
                                                            <i class="fa fa-envelope"></i>
                                                        </a>
                                                    @endif
                                                @endif
                                        @endif
                                    </div>
                                </span>
                            </div>
                        </div>
                    </a>


                    <div class="table-responsive" style="display: none;" id="detailsd{{ $d[0]['header_id'] }}">
                        <table class="table table-sm">
                            <thead class="thead-secondary">
                                <tr class="tx-12">
                                    <th class="wd-10p">Stock Code</th>
                                    <th class="wd-45p">Description</th>
                                    <th class="wd-10p">Serial #</th>
                                    <th class="wd-10p">Status</th>
                                    <th class="wd-5p">Qty</th>
                                    <th class="wd-10p">Cost</th>
                                    <th class="wd-10p"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($d as $i)
                                <tr class="tx-12">
                                    <td>{{ isset($i->stock_code) ? $i->stock_code : 'N/A' }}</td>
                                    <td>{{ $i->description }}</td>
                                    <td>{{ $i->serial_no }}</td>
                                    <td>
                                        @if($i->status == 'OPEN')
                                            <span class="label label-sm label-success ">OPEN</span>
                                        @endif

                                        @if($i->status == 'CLOSED')
                                            <span class="label label-sm label-danger ">CLOSED</span>
                                        @endif
                                    </td>
                                    <td>{{ $i->qty }}</td>
                                    <td>{{ $i->cost }}</td>
                                    
                                    <td>
                                        @if($d[0]['doc_status'] == 'saved' || $d[0]['doc_status'] == 'closed')
                                            <a href="/item/details/{{ $i->item_id }}" data-placement="bottom" title="View Par Details" target="_blank">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        @else
                                            @if($i->status == 'CLOSED')
                                                <a href="/item/details/{{ $i->item_id }}" class="mg-l-5" data-placement="bottom" title="View Par Details" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                            @else

                                                <a href="/item/details/{{ $i->item_id }}" class="mg-l-5" data-placement="bottom" title="View Par Details" target="_blank">
                                                    <i class="fa fa-eye"></i>
                                                </a>
                                                @if(Auth::user()->dept == '')
                                                    <a href="#close-item" class="mg-l-5 close-item" data-hid="{{$d[0]['header_id']}}" data-iid="{{$i->item_id}}" data-qty="{{$i->qty}}" data-cost="{{$i->cost}}" data-toggle="modal" title="Close Item">
                                                        <i class="fa fa-times"></i>
                                                    </a>

                                                    <a href="#transfer-item" class="mg-l-5 transfer-item" data-hid="{{$d[0]['header_id']}}" data-iid="{{$i->item_id}}" data-desc="{{$i->description}}" data-cost="{{$i->cost}}" data-qty="{{$i->qty}}" data-dept="{{$i->is_dept}}" data-toggle="modal" title="Transfer Item">
                                                        <i class="fa fa-link"></i>
                                                    </a>
                                                @endif
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @empty
                    <tr>
                        <td><center>No saved or posted accountability</center></td>
                    </tr>
                @endforelse
                {{ $datas->links() }}
            </div>
        </div>
    </div>
</div>
@include('par.modal')
@endsection

@section('pagejs')
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('scripts/tooltips.js') }}"></script>
    <script src="{{ asset('scripts/select2.js') }}"></script>
    <script src="{{ asset('scripts/transfer.js') }}"></script>
@endsection