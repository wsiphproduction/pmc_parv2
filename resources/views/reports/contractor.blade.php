@extends('layouts.app')

@section('pagecss')
<link rel="stylesheet" href="{{ asset('assets/css/modals.css') }}">
@endsection


@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item"><a href="#">Reports</a></li>
                <li class="breadcrumb-item active" aria-current="page">Contractor List</li>
            </ol>
        </nav>
        <h4 class="mg-b-0 tx-spacing--1">Contractor List</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body pd-20">
                <h6>Search Contractor</h6>  
                <div class="form-inline">
                    <input type="text" name="" class="form-control col-md-3" placeholder="Contractor Name">
                    <button class="btn btn-primary ml-1"><i class="fa fa-search"></i></button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-12">
        <div class="card">
            <div class="card-body pd-20">
                <table class="table mg-b-0 table-hover">
                    <thead>
                        <tr>
                            <th class="wd-20p">Team Leader ID</th>
                            <th class="wd-30p">Name</th>
                            <th class="wd-30p">Company</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contractors as $con)
                        <tr>
                            <td>{{$con->contractor_id}}</td>
                            <td>{{$con->contractor_fname}} {{$con->contractor_mname}} {{$con->contractor_lname}}</td>
                            <td>{{$con->contractor_dept}}</td>
                        </tr>
                        @empty
                        <tr><td colspan="4"><center>No Contractors found</center></td></tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex flex-row justify-content-between mg-t-20">
                    <div class="pd-10">Total of {{$contractors->total()}} contractors</div>
                    <div class="pd-10">&nbsp;</div>
                    <div class="pd-10">{{ $contractors->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalContractor" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered wd-sm-650" role="document">
        <div class="modal-content">
            <div class="modal-header pd-y-20 pd-x-20 pd-sm-x-30">
                <a href="" role="button" class="close pos-absolute t-15 r-15" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </a>
                <div class="media align-items-center">
                    <span class="tx-color-03 d-none d-sm-block"><i data-feather="credit-card" class="wd-60 ht-60"></i></span>
                    <div class="media-body mg-sm-l-20">
                        <h4 class="tx-18 tx-sm-20 mg-b-2">Enter Contractor Info</h4>
                    </div>
                </div>
            </div>
            <form action="/contractor/store" method="post">
                @csrf
                <div class="modal-body pd-sm-t-30 pd-sm-b-40 pd-sm-x-30">
                    <div class="row row-sm mg-t-5">
                        <div class="col-sm-5">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Contracto ID <i class="tx-danger">*</i></label>
                            <input required type="text" name="cid" class="form-control" placeholder="Enter contractor ID">
                        </div>
                        <div class="col-sm">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">First Name <i class="tx-danger">*</i></label>
                            <input required type="text" name="c_fname" class="form-control" placeholder="Enter first name">
                        </div>
                    </div>

                    <div class="row row-sm  mg-t-15 ">
                        <div class="col-sm-5mg-sm-t-0">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Middle Name <i class="tx-danger">*</i></label>
                            <input required type="text" name="c_mname" class="form-control" placeholder="Enter middle name">
                        </div>
                        <div class="col-sm">
                            <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Last Name <i class="tx-danger">*</i></label>
                            <input required type="text" name="c_lname" class="form-control" placeholder="Enter first name">
                        </div>
                    </div>

                    <div class="form-group mg-t-15">
                        <label class="tx-10 tx-uppercase tx-medium tx-spacing-1 mg-b-5 tx-color-03">Department <i class="tx-danger">*</i></label>
                        <input required type="text" name="c_dept" class="form-control" placeholder="Enter department">
                    </div>
                </div>
                <div class="modal-footer pd-x-20 pd-y-15">
                    <button type="button" class="btn btn-white" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Info</button>
                </div>
            </form>    
        </div>
    </div>
</div>

<div class="modal effect-scale" id="batch-upload-contractor" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Contractor Batch Upload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/upload/contractors" method="post" role="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input required type="file" class="form-control" name="file">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                    <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('maintenance.modal')
@endsection

@section('pagejs')

@endsection

