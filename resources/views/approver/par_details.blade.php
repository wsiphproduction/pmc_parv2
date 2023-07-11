

    <div>
        <div class="mail-content-header">
            <a href="" id="mailContentClose" class="link-02 d-none d-lg-block d-xl-none mg-r-20"><i data-feather="arrow-left"></i></a>
            <div class="media">
            <div class="avatar avatar-sm"><img src="../https://via.placeholder.com/600" class="rounded-circle" alt=""></div>
                <div class="media-body mg-l-10">
                <h6 class="mg-b-2 tx-13 tx-uppercase">
                    @if($data->status == 'approved')
                        <span class="badge badge-primary">approved</span>
                    @endif

                    @if($data->status == 'waiting')
                        <span class="badge badge-success">waiting</span>
                    @endif
                    
                    @if($data->status == 'disapproved')
                        <span class="badge badge-danger">disapproved</span>
                    @endif
                </h6>
                </div>
             </div>
        </div>  
        <div class="pd-20 pd-lg-25 pd-xl-30">

            <h6 class="tx-semibold mg-b-0">Mr/Mrs. Xeena</h6>

            <p class="mg-t-50">Greetings!</p>
            <p>{{ $data->reason }}.</p>
            <p>
                <span>Sincerely yours,</span><br>
                <strong>{{ $data->requested_by }}</strong>
            </p>

            @php
                $grouped = $details->groupBy('header_id');
            @endphp

            @foreach($grouped as $d)
                <div class="card">
                    <div class="card-body pl-l-30 pd-r-30 pd-t-20 pd-b-20">
                        <div class="row">
                            <div class="col-sm-6"></div>

                            <div class="col-sm-6 tx-right d-none d-md-block">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">PAR Number</label>
                                <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">{{ $d[0]['refcode'] }}</h1>
                            </div>
                            <div class="col-sm-6 col-lg-8 mg-t-20 mg-md-t-20">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Accountable To</label>
                                <h6 class="tx-15 mg-b-10">{{ $d[0]['accountable'] }}</h6>
                                <p class="mg-b-0">Status : {{ $d[0]['doc_status'] }}</p>
                                <p class="mg-b-0">Posted By : {{ $d[0]['posted_by'] }}</p>
                                <p class="mg-b-0">Document Date : {{ $d[0]['document_date'] }}</p>
                            </div>
                            <div class="col-sm-6 col-lg-4 mg-t-20">
                                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                                <h6 class="tx-15 mg-b-10"></h6>
                                <p class="mg-b-0">Reference Code : {{ $d[0]['ref_code'] }}</p>
                                <p class="mg-b-0">Safety : {{ $d[0]['safety'] }}</p>
                                <p class="mg-b-0">BIS Header ID : {{ $d[0]['bis_header_id'] }}</p>
                            </div>
                        </div>

                        <div class="table-responsive mg-t-40">
                            <table class="table table-invoice bd-b">
                                <thead>
                                    <tr>
                                        <th class="wd-20p">ID #</th>
                                        <th class="wd-10p d-none d-sm-table-cell">Stock Code</th>
                                        <th class="wd-40p d-none d-sm-table-cell">Description</th>
                                        <th class="wd-20p">Expense Type</th>
                                        <th class="tx-right">Asset Code</th>
                                        <th class="tx-right">Cost</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($d as $i)
                                        <tr>
                                            <td class="tx-nowrap">{{ $i->item_id }}</td>
                                            <td class="tx-nowrap">{{ isset($i->stock_code) ? $i->stock_code : 'N/A' }}</td>
                                            <td class="d-none d-sm-table-cell tx-color-03">{{ $i->description }}</td>
                                            <td class="d-none d-sm-table-cell tx-color-03">{{ $i->expense_type }}</td>
                                            <td>{{ $i->asset_code }}</td>
                                            <td class="tx-right">{{ number_format(floor($i->cost),2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0"></div>
                            <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
                                <ul class="list-unstyled lh-7">
                                    <li class="d-flex justify-content-between">
                                        <strong>Grand Total</strong>
                                        <strong>&#8369; {{ number_format(floor($total),2) }}</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @if($data->status == 'waiting')
            <div class="pd-20 pd-lg-25 pd-xl-30 pd-t-0-f">
                <div class="d-flex align-items-center justify-content-between mg-t-10">
                    <a href="#approve" data-toggle="modal" data-rid="{{ $data->id }}" data-pid="{{ $data->par_id }}" class="btn btn-primary approve">Approved</a>
                    <a href="#disapprove" data-toggle="modal" data-rid="{{ $data->id }}" data-pid="{{ $data->par_id }}" class="btn btn-danger disapprove">Disapproved</a>
                </div>
            </div>
        @endif
    </div>
