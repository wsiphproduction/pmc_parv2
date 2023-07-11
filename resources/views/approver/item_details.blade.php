

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

            <div class="card">
                <div class="card-body pl-l-30 pd-r-30 pd-t-20 pd-b-20">
                    <div class="row">
                        <div class="col-sm-6"></div>

                        <div class="col-sm-6 tx-right d-none d-md-block">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Tracking Number</label>
                            <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">{{ $item->tracking }}</h1>
                        </div>
                        <div class="col-sm-6 col-lg-8 mg-t-20 mg-md-t-20">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Item Details</label>
                            <h6 class="tx-15 mg-b-10">{{ $item->name }}</h6>
                            <p class="mg-b-0">Details : {{ $item->details }}</p>
                            <p class="mg-b-0">Price : {{ $item->price }}</p>
                            <p class="mg-b-0">Qty : {{ $item->qty }} {{ $item->uom }}</p>
                        </div>
                        <div class="col-sm-6 col-lg-4 mg-t-20">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                            <h6 class="tx-15 mg-b-10"></h6>
                            <p class="mg-b-0">Serial # : {{ $item->serialNo }}</p>
                            <p class="mg-b-0">PO # : {{ $item->po }}</p>
                            <p class="mg-b-0">Invoice : {{ $item->invoice }}</p>
                            <p class="mg-b-0">RQ : {{ $item->rq }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($data->status == 'waiting')
            <div class="pd-20 pd-lg-25 pd-xl-30 pd-t-0-f">
                <div class="d-flex align-items-center justify-content-between mg-t-10">
                    <a href="#open" data-toggle="modal" data-iid="{{ $item->tracking }}" class="btn btn-primary open">Approved</button>
                    <a href="#decline" data-toggle="modal" data-iid="{{ $item->tracking }}" class="btn btn-danger decline">Disapproved</a>
                </div>
            </div>
        @endif
    </div>
