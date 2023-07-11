@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('assets/global/plugins/datatables/datatables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <ul class="page-breadcrumb breadcrumb">
                    <li>
                        <a href="index.html"><i class="icon-home"></i> Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <span class="active">Add Issuance Request</span>
                    </li>
                </ul>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <form role="form" action="/irms/create" method="POST">
                    <div class="col-md-3 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-green">
                                            <i class="icon-basket font-green"></i>
                                            <span class="caption-subject bold uppercase"> Issuance Request Form</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group" id="empdiv">
                                                    <label>Employee <i class="font-red">*</i></label>
                                                    <select data-live-search="true" data-live-search-style="startsWith" class="selectpicker form-control" id='sel_employee' name='emp_id'>
                                                       <option value='0'>-- Select Employee --</option>
                                                       @foreach($emps as $e)
                                                        <option value="{{ $e->id }}">{{ $e->fullName }}</option>
                                                       @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>Document Date <i class="font-red">*</i></label>
                                                    <div class="input-icon right">
                                                        <input name="doc_date" class="form-control date-picker" size="10" type="text" value="" />
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Safety Control # <i class="font-red">*</i></label>
                                                    <div class="input-icon right">
                                                        <i class="icon-tag font-green"></i>
                                                        <input name="safety_control_no" type="text" class="form-control" placeholder="Safety Control #">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Ref Code <i class="font-red">*</i></label>
                                                    <div class="input-icon right">
                                                        <i class="icon-tag font-green"></i>
                                                        <input name="ref_code" type="text" class="form-control" placeholder="Reference Code">
                                                    </div>
                                                </div>
                                            </div>
                                    
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet light bordered">
                                    <div class="portlet-title">
                                        <div class="caption font-green">
                                            <i class="icon-basket-loaded font-green"></i>
                                            <span class="caption-subject bold uppercase"> ITEMS</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body form">
                                        <div class="form-body">
                                            <table class="table table-striped table-bordered table-hover">
                                                <thead>
                                                    <tr>
                                                        <th><i class="fa fa-cogs"></i> Item</th>
                                                        <th><i class="fa fa-comments-o"></i> Color </th>
                                                        <th><i class="fa fa-bell-o"></i> Size </th>
                                                        <th><i class="fa fa-sticky-note-o"></i> Remarks </th>
                                                        <th><i class="fa fa-tags"></i> Balance </th>
                                                        <th></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                
                                                    @foreach($irms as $i)

                                                    @php
                                                        $bal   = \App\Http\Controllers\irms\IrmsController::balance_api($i->headerId);
                                                        $count = \App\parDetails::where('irms_ref','=',$i->headerId)->count();
                                                        $ordered = 0;
                                                        $delivered = 0;
                                                    @endphp
                                                        <tr>
                                                            <td>{{ $i->itemDesc }}</td>
                                                            <td>{{ $i->itemColor }}</td>
                                                            <td>{{ $i->itemSize }}</td>
                                                            <td>{{ $i->remarks }}</td>
                                                            <td>{{ $bal[0]['qty']- $bal[0]['qtyReleased'] - $count }}</td>
                                                            <td><a class="btn btn-sm green" href="#"> Release without Par</a></td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan='6'>
                                                                <div class='portlet box'>
                                                                    <div class='portlet-body'>
                                                                        <div class="form-body">
                                                                            <div class="form-group">
                                                                                <div class="col-md-6">
                                                                                    <select data-live-search="true" name="item_id[]" data-live-search-style="startsWith" class="selectpicker form-control" name='dept_id' onchange="update_rqcode();">
                                                                                        <option value=""> -- Select Item --</option>
                                                                                        @foreach($items as $r)
                                                                                            @php
                                                                                                $arrName = explode(' ',trim($r->name));
                                                                                                $arrItem = explode(' ',trim($i->itemDesc));
                                                                                            @endphp

                                                                                            @if($arrName[0] == $arrItem[0])
                                                                                                <option  value="{{ $r->id }}">{{ $r->tracking }} - {{ $r->name }}</option>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    </select>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <input type="text" class="form-control" name="rq[]" placeholder="RQ">
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            <div class="form-actions right">
                                                <button type="submit" class="btn blue"><i class="fa fa-save"></i> Submit</button>
                                            </div>
                                        </div>   
                                    </div>
                                </div>
                                <!-- END SAMPLE FORM PORTLET-->
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection


@section('pagejs')
<script src="{{ asset('assets/global/scripts/datatable.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/datatables.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/pages/scripts/table-datatables-buttons.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/global/plugins/bootstrap-select/js/bootstrap-select.min.js') }}" type="text/javascript"></script>

<script>
    // function update_rqcode(){
    // var x = $('#item_rq').val();
    // var i = x.split("|");
    // $('#rq').val(i[0]);
    // }
</script>
@endsection



