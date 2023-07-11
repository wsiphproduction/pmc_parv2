@extends('layouts.app')

@section('pagecss')
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.profile.css') }}">
@endsection

@section('content')
<div class="container">
<div class="row">
    <div class="mg-t-10">
        @php
            $grouped = $datas->groupBy('employee_id');
            $grouped->toArray();
        @endphp

        @foreach($grouped as $d)
            <div class="card mg-b-10">
                <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                    <div>
                        <h4 class="mg-b-5">{{ $d[0]['employee_id'] }} {{ $d[0]['emp_name']}}</h4>
                        <p>{{ $d[0]['dept'] }}</p>
                    </div>
                </div>
              
                <div class="table-responsive">
                    <table class="table table-dashboard mg-b-0">
                  
                        <thead>
                            <tr class="group">
                                <div class="col">
                                <th>Document Date</th>
                                  </div>
                                 <div class="col"> 
                                <th>Par ID</th>
                                  </div>
                                  <div class="col">
                                <th>Description</th>
                                    </div>
                                  <div class="col">  
                                <th class="serial">Serial #</th>
                                 </div>
                                 <div class="col">
                                <th>Item Status</th>
                                 </div>
                                  <div class="col">  
                                <th>Document Status</th>
                                    </div>
                                  <div class="col">  
                                <th>Qty</th>
                                    </div>
                                  <div class="col">  
                                <th>Cost</th>
                                   </div>
                            </tr>
                        </thead>
                        </div>
                        
                        <tbody>
                             @php
                                $total = 0;
                            @endphp
                            @foreach($d as $i)
                                @php $total += $i->qty*$i->cost @endphp
                                @if($i->status != 'CLOSED')
                                <tr>
                                <td class="tx-color-03 tx-normal">{{ $i->document_date }}</td>
                                <td class="tx-medium">{{ $i->refcode }}</td>
                                <td class="tx-medium">{{ $i->description }}</td>
                                <td class="tx-color-03 tx-normal">{{ $i->serial_no }}</td>
                                <td class="tx-color-03 tx-normal">{{ $i->status }}</td>
                                <td class="tx-color-03 tx-normal">{{ strtoupper($i->doc_status) }}</td>
                                <td class="tx-color-03 tx-normal text-right">{{ $i->qty }}</td>
                                <td class="tx-color-03 tx-normal text-right">{{ $i->cost }}</td>
                            </tr>
                            @endif
                            @endforeach
                            <tr>
                                <td colspan="7" class="tx-medium">Grand Total</td>
                                <td class="tx-medium text-right">{{number_format($total,2)}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div>
        @endforeach
    </div>
</div>
</div>

@endsection


