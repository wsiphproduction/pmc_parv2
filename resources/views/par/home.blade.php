@extends('layouts.app')

@section('pagecss')
<link href="{{ asset('assets/lib/jqvmap/jqvmap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
    <div>
        <h4 class="mg-b-0 tx-spacing--1">Welcome to Dashboard</h4>
    </div>
</div>

<div class="row row-xs">
    <div class="col-12 mg-t-10">
        <div class="card">
            <div class="card-header">
                <h6 class="mg-b-0">Statistics</h6>
            </div>
            <div class="card-body pd-0">
                <div class="row no-gutters">
                    <div class="col col-sm-6 col-lg">
                        <div class="crypto">
                            <div class="media mg-b-10">
                                <div class="crypto-icon bg-purple">
                                    <i class="cf cf-ltc"></i>
                                </div>
                                <div class="media-body pd-l-8">
                                    <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Active Accountabilities</h6>
                                    <div class="d-flex align-items-baseline tx-rubik">
                                        <h5 class="tx-20 mg-b-0">{{App\parDetails::totalActiveAccountability()}}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="chart-twelve">
                                <div id="flotChart2" class="flot-chart"></div>
                            </div>

                            <div class="pos-absolute b-5 l-20 tx-medium">
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                    <a href="" class="link-01 tx-semibold">{{App\parDetails::docStatus('saved')}}</a> SAVED
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\parDetails::docStatus('posted')}}</a> POSTED
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\parDetails::docStatus('closed')}}</a> CLOSED
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\parDetails::docStatus('transfer')}}</a> TRANSFERRED
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\parDetails::docStatus('adjustment')}}</a> ADJUSTMENT
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-6 col-lg bd-t bd-sm-t-0 bd-sm-l">
                        <div class="crypto">
                            <div class="media mg-b-10">
                                <div class="crypto-icon bg-teal">
                                    <i class="cf cf-ltc"></i>
                                </div>
                                <div class="media-body pd-l-8">
                                    <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Items</h6>
                                    <div class="d-flex align-items-baseline tx-rubik">
                                        <h5 class="tx-20 mg-b-0">{{App\Items::totalItems()}}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="chart-twelve">
                                <div id="flotChart3" class="flot-chart"></div>
                            </div>

                            <div class="pos-absolute b-5 l-20 tx-medium">
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                    <a href="" class="link-01 tx-semibold">{{App\Items::itemType(1)}}</a> STOCK
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\Items::itemType(2)}}</a> NON-STOCK
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">{{App\Items::totalUnserveItems()}}</a> UNSERVED
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="col col-sm-6 col-lg bd-t bd-lg-t-0 bd-sm-l">
                        <div class="crypto">
                            <div class="media mg-b-10">
                                <div class="crypto-icon bg-primary">
                                    <i class="cf cf-dash"></i>
                                </div>
                                <div class="media-body pd-l-8">
                                    <h6 class="tx-11 tx-spacing-1 tx-uppercase tx-semibold mg-b-5">Lost/Damaged Items</h6>
                                    <div class="d-flex align-items-baseline tx-rubik">
                                        <h5 class="tx-20 mg-b-0">35</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="chart-twelve">
                                <div id="flotChart5" class="flot-chart"></div>
                            </div>

                            <div class="pos-absolute b-5 l-20 tx-medium">
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03">
                                    <a href="" class="link-01 tx-semibold">6</a> Lost
                                </label>
                                <label class="tx-9 tx-uppercase tx-sans tx-color-03 mg-l-10">
                                    <a href="" class="link-01 tx-semibold">31</a> Damage
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-12 mg-t-10">
        <div class="card mg-b-10">
            <div class="card-header pd-t-20 d-sm-flex align-items-start justify-content-between bd-b-0 pd-b-0">
                <div>
                    <h6 class="mg-b-5">Item Total Cost</h6>
                </div>
            </div>
            <div class="card-body pd-y-30">
                <div class="d-sm-flex">
                    <div class="media">
                        <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-teal tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-6">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold tx-nowrap mg-b-5 mg-md-b-8">CAPEX</h6>
                            <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">1,958,104</h4>
                        </div>
                    </div>
                    <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                        <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-pink tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-5">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">OPEX</h6>
                            <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">234,769<small>.50</small></h4>
                        </div>
                    </div>
                    <div class="media mg-t-20 mg-sm-t-0 mg-sm-l-15 mg-md-l-40">
                        <div class="wd-40 wd-md-50 ht-40 ht-md-50 bg-primary tx-white mg-r-10 mg-md-r-10 d-flex align-items-center justify-content-center rounded op-4">
                            <i data-feather="bar-chart-2"></i>
                        </div>
                        <div class="media-body">
                            <h6 class="tx-sans tx-uppercase tx-10 tx-spacing-1 tx-color-03 tx-semibold mg-b-5 mg-md-b-8">Damage</h6>
                            <h4 class="tx-20 tx-sm-18 tx-md-24 tx-normal tx-rubik mg-b-0">1,608,469<small>.50</small></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table class="table table-dashboard mg-b-0">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Description</th>
                            <th>Expense Type</th>
                            <th class="text-right">Qty</th>
                            <th class="text-right">Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="tx-color-03 tx-normal">10/05/2019</td>
                            <td class="tx-medium">Dell Laptop</td>
                            <td class="tx-teal">CAPEX</td>
                            <td class="text-right tx-pink">1</td>
                            <td class="tx-medium text-right">28,670.90</td>
                        </tr>
                        <tr>
                            <td class="tx-color-03 tx-normal">10/05/2019</td>
                            <td class="tx-medium">Dell Laptop</td>
                            <td class="tx-teal">CAPEX</td>
                            <td class="text-right tx-pink">1</td>
                            <td class="tx-medium text-right">28,670.90</td>
                        </tr>
                        <tr>
                            <td class="tx-color-03 tx-normal">10/05/2019</td>
                            <td class="tx-medium">Dell Laptop</td>
                            <td class="tx-teal">CAPEX</td>
                            <td class="text-right tx-pink">1</td>
                            <td class="tx-medium text-right">28,670.90</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-xl-12 mg-t-10">
            <div class="card card-dashboard-table">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th colspan="2">Total Cost per Department</th>
                                <th colspan="4">Item Category</th>
                            </tr>
                            <tr>
                                <th>Department</th>
                                <th>Accountable Employees</th>
                                <th>Grand Total</th>
                                <th>PPE</th>
                                <th>Non/Stock Items</th>
                                <th>Opex</th>
                                <th>Capex</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><a href="">IT/Communications</a></td>
                                <td><strong>350</strong></td>
                                <td><strong>2.65M</strong></td>
                                <td><strong>22</strong></td>
                                <td><strong>25</strong></td>
                                <td><strong>192</strong></td>
                                <td><strong>302</strong></td>
                            </tr>
                            <tr>
                                <td><a href="">Accounting</a></td>
                                <td><strong>276</strong></td>
                                <td><strong>2.51M</strong></td>
                                <td><strong>18</strong></td>
                                <td><strong>23</strong></td>
                                <td><strong>189</strong></td>
                                <td><strong>123</strong></td>
                            </tr>
                            <tr>
                                <td><a href="">Material Control Department</a></td>
                                <td><strong>246</strong></td>
                                <td><strong>2.1M</strong></td>
                                <td><strong>17</strong></td>
                                <td><strong>26</strong></td>
                                <td><strong>178</strong></td>
                                <td><strong>12</strong></td>
                            </tr>
                            <tr>
                                <td><a href="">Receiving</a></td>
                                <td><strong>187</strong></td>
                                <td><strong>1.86M</strong></td>
                                <td><strong>14</strong></td>
                                <td><strong>24</strong></td>
                                <td><strong>135</strong></td>
                                <td><strong>520</strong></td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- table-responsive -->
            </div><!-- card -->
    </div>

    <div class="col-md-6 col-xl-6 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Transaction History</h6>
            </div>
            <ul class="list-group list-group-flush tx-13">
                @php
                    $grouped = $transactions->groupBy('ref_id');
                    $grouped->toArray();
                    $row = 0;
                @endphp

                @foreach($grouped as $d)
                    @php 
                        $records = $row++; 
                        $log_dt  = $d[0]['activity_date'];
                    @endphp

                    @if($records <= 10)
                    <li class="list-group-item d-flex pd-sm-x-20">
                        @if($d[0]['new_value'] == 'saved')
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-teal"><i class="icon ion-md-checkmark"></i></span></div>
                        @endif

                        @if($d[0]['new_value'] == 'closed')
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-danger"><i class="icon ion-md-close"></i></span></div>
                        @endif

                        @if($d[0]['new_value'] == 'posted')
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-orange op-5"><i class="icon ion-md-bus"></i></span></div>
                        @endif

                        @if($d[0]['new_value'] == 'adjustment')
                        <div class="avatar d-none d-sm-block"><span class="avatar-initial rounded-circle bg-info"><i class="icon ion-md-checkmark"></i></span></div>
                        @endif

                        <div class="pd-sm-l-10">
                            <p class="tx-medium mg-b-0">Transaction #{{App\accountabilityHeaders::parHeaderId($d[0]['ref_id'])}}</p>
                            <small class="tx-12 tx-color-03 mg-b-0">{{ date('M d, Y, h:s A', strtotime($log_dt)) }}, {{$d[0]['activity_desc']}}</small>
                        </div>
                        <div class="mg-l-auto text-right">
                            <p class="tx-12 tx-color-03 mg-b-0">{{$d[0]['domain']}}</p>
                            <small class="tx-12 tx-success mg-b-10">{{$d[0]['new_value']}}</small>
                        </div>
                    </li>
                    @endif
                @endforeach
            </ul>
            <div class="card-footer text-center tx-13">
                <a href="" class="link-03">View All Transactions <i class="icon ion-md-arrow-down mg-l-5"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-xl-6 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Item History</h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                    <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>
            </div>
            <ul class="list-group list-group-flush tx-13">
                @php $row = 0; @endphp
                @foreach($items as $item)
                    @php 
                        $records = $row++; 
                        $log_dt  = $item->activity_date;
                        $ref     = explode(' - ',$item->ref_id);
                    @endphp

                    @if($records <= 10)
                        <li class="list-group-item d-flex pd-sm-x-20">
                            <div class="avatar"><img src="{{ asset('avatars/'.Auth::user()->avatar.'') }}" class="rounded-circle" alt=""></div>
                            <div class="pd-l-10">
                                <p class="tx-medium mg-b-0">{{ $item->domain }}</p>
                                @if(strpos($item->ref_id, ' - ') !== false)
                                <small class="tx-12 tx-color-03 mg-b-0">Par#{{$ref[0]}}, Item ID#{{$ref[1]}}</small>
                                @else
                                <small class="tx-12 tx-color-03 mg-b-0">PAR#{{$item->ref_id}}</small>
                                @endif
                            </div>
                            <div class="mg-l-auto text-right">
                                <p class="tx-medium mg-b-0">&nbsp;</p>
                                <small class="tx-12 tx-success mg-b-10">{{$item->activity_desc}}</small>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div class="card-footer text-center tx-13">
                <a href="" class="link-03">View All History <i class="icon ion-md-arrow-down mg-l-5"></i></a>
            </div>
        </div>
    </div>

    <div class="col-md-12 col-xl-12 mg-t-10">
        <div class="card ht-100p">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h6 class="mg-b-0">Par Activities</h6>
                <div class="d-flex align-items-center tx-18">
                    <a href="" class="link-03 lh-0"><i class="icon ion-md-refresh"></i></a>
                    <a href="" class="link-03 lh-0 mg-l-10"><i class="icon ion-md-more"></i></a>
                </div>
            </div>
            <table class="table table-stripped">
                <thead>
                    <th>Reference #</th>
                    <th>Type</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th>Table</th>
                    <th>Affected Field</th>
                    <th>New Value</th>
                    <th>Old Value</th>
                </thead>
                <tbody>
                    @foreach($activities as $activity)
                    <tr>
                        <td>{{ $activity->ref_id }}</td>
                        <td>{{ $activity->activity_type }}</td>
                        <td>{{ $activity->activity_desc }}</td>
                        <td>{{ $activity->activity_date }}</td>
                        <td>{{ $activity->db_table }}</td>
                        <td>{{ $activity->affected_field }}</td>
                        <td>{{ $activity->new_value }}</td>
                        <td>{{ $activity->old_value }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-12 col-xl-12 mg-t-10">
        <div class="d-flex justify-content-end">
            {{ $activities->links() }}
        </div>
    </div>
</div>
@endsection



