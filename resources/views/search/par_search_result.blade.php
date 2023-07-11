@php
    $grouped = $par_details->groupBy('header_id');
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
    <div class="card-header d-sm-flex align-items-start justify-content-between pd-b-0 pd-l-1">
        <div class="mg-t-10">
            <h6 class="mg-b-5"><a href="javascript:;" onclick="$('#detailsd{{ $d[0]['header_id'] }}').toggle();">{{ $d[0]['refcode'] }} :</a>
                
                @if($d[0]['is_dept'] == 0)
                    <a href="/{{$d[0]['employee_id']}}/accountability">{{ $d[0]['employee_id'] }} : {{ $d[0]['emp_name'] }}</a>
                @else
                    {{ $d[0]['accountable'] }}
                @endif
                    
                &nbsp;<small>{{ $d[0]['dept'] }} </small> - 
                &nbsp;<small>{{ $d[0]['document_date'] }} </small> - 
                &nbsp;<small> [ <strong> doc status </strong> {{ strtoupper($d[0]['doc_status']) }} ] </small> - 
                &nbsp;<small> [ <strong> item status </strong> {{ strtoupper($d[0]['status']) }} ] </small> 
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
                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write')
                                    <a href="/par/recreate/{{ $d[0]['header_id'] }}" title="Recreate Par" class="btn btn-warning btn-xs">
                                        <i class="fa fa-reply"></i>
                                    </a>
                                    <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="{{ $d[0]['refcode'] }}" data-a="{{ $d[0]['accountable'] }}" data-dd="{{ $d[0]['document_date'] }}" data-ab="{{ $d[0]['added_by'] }}" data-ad="{{ $d[0]['created_at'] }}" data-eid="{{ $d[0]['header_id'] }}" class="btn btn-primary btn-xs email-par">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    @if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0)
                                    <a href="#" title="Close PAR" data-toggle="modal" data-target="#close-par" data-pid="{{ $d[0]['header_id'] }}" class="btn btn-danger btn-xs close-par">
                                        <i class="fa fa-times"></i>
                                    </a>
                                    @endif
                                @endif
                            @else($d->doc_status == 'saved')
                                <a href="/par/details/{{ $d[0]['header_id'] }}" title="View Par Details" target="_blank" class="btn btn-secondary btn-xs">
                                    <i class="fa fa-eye"></i>
                                </a>
                                <a href="/par/print/{{ $d[0]['header_id'] }}" title="Print Par Details" target="_blank" class="btn btn-info btn-xs">
                                    <i class="fa fa-print"></i>
                                </a>
                                 @if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write')
                                    <a href="/par/edit/{{ $d[0]['header_id'] }}" title="Edit Par Details" target="_blank" class="btn btn-success btn-xs">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="#" data-toggle="modal" title="Post Par" data-target="#post-par" data-pid="{{ $d[0]['header_id'] }}" class="btn btn-warning btn-xs post-par">
                                        <i class="fa fa-stamp"></i>
                                    </a>
                                    <a href="#" title="Email Par Details" data-toggle="modal" data-target="#email-par" data-p="{{ $d[0]['refcode'] }}" data-a="{{ $d[0]['accountable'] }}" data-dd="{{ $d[0]['document_date'] }}" data-ab="{{ $d[0]['added_by'] }}" data-ad="{{ $d[0]['created_at'] }}" data-eid="{{ $d[0]['header_id'] }}" class="btn btn-primary btn-xs email-par">
                                        <i class="fa fa-envelope"></i>
                                    </a>
                                    @if(\App\accountabilityDetails::countItemQty($d[0]['header_id']) == 0)
                                        <a href="#" title="Close PAR" data-toggle="modal" data-target="#close-par" data-pid="{{ $d[0]['header_id'] }}" class="btn btn-danger btn-xs close-par">
                                            <i data-feather="x-square"></i>
                                        </a>
                                    @endif
                                @endif
                            @endif
                    @endif
                </div>
            </span>
        </div>
    </div>
    
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
                        @if($d[0]['doc_status'] == 'saved' || $d[0]['doc_status'] == 'closed' || $d[0]['doc_status'] == 'adjustment')
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
                                @if(Auth::user()->role == 'admin' || Auth::user()->role == 'read and write')
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
                    <td>
                        <input class='checkbox' type="checkbox" data-check="checkbox-{{$d[0]['header_id']}}" name="checkboxes[]" value="{{$i->id}}" data-row="{{json_encode($i)}}" data-header="{{$d[0]['header_id']}}">
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@empty
    <center><span class="badge badge-info">No accountability founds . . .</span></center>
@endforelse
<!-- new update search -->
