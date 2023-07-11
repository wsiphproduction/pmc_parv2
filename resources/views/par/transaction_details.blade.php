<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <title>PMC - PAR v2</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/icons/Download-Tools-PNG-Image.png') }}">

    <!-- vendor css -->
    <link href="{{ asset('assets/lib/@fortawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/lib/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.dashboard.css') }}">

    <style>
        .content {
            overflow: hidden;
        }
        @media print{
            .btn_print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="content tx-13">
        <div class="container pd-30">
            <div class="row">
                <div class="col-md-12">
                    <a class="btn btn-primary btn-sm btn_print text-white tx-15 mg-b-5 float-right" onclick="javascript:window.print();"> Print
                        <i data-feather="printer"></i>
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="pd-10 mg-t-20">
                        <h2>Philsaga Mining Corporation</h2>
                        <span>Purok 1-A Bayugan, Rosario, Agusan Del Sur</span>
                        <span class="float-right">{{ Carbon\Carbon::now()->format('F d, Y') }}</span>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex flex-row justify-content-between">
                        <div class="pd-10"></div>
                        <div class="pd-10 mg-t-20"><h3>Accountability Report</h3></div>
                        <div class="pd-10"></div>
                    </div>
                </div>
            </div>

            @php
                $grouped = $par_details->groupBy('header_id');
                $grouped->toArray();
            @endphp

            @foreach($grouped as $a)
                <div class="row">
                    <div class="col-sm-6">&nbsp;</div>

                    <div class="col-sm-6 tx-right d-none d-md-block">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">PAR Number</label>
                        <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $a[0]['refcode'] }}</h1>
                    </div><!-- col -->
                    <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Accountable To</label>
                        <h6 class="tx-15 mg-b-10">{{ $a[0]['accountable'] }}</h6>
                        <p class="mg-b-0">Department : {{ $a[0]['dept'] }}</p>
                        <p class="mg-b-0">Transaction Date : {{ $a[0]['document_date'] }}</p>
                    </div><!-- col -->
                    <div class="col-sm-6 col-lg-4 mg-t-40">
                        <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                        <ul class="list-unstyled lh-7">
                            <li class="d-flex justify-content-between">
                                <span>Issuance Doc Reference</span>
                                <span>{{ $a[0]['doc_ref'] }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Safety</span>
                                <span>{{ $a[0]['safety'] }}</span>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>BIS Header ID</span>
                                <span>{{ $a[0]['bis_header_id'] }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="table-responsive mg-t-40">
                    <table class="table table-bordered table-invoice bd-b">
                        <thead>
                            <tr>
                                <th class="wd-10p">Stock Code</th>
                                <th class="wd-30p">Description</th>
                                <th class="wd-30p">Serial #</th>
                                <th class="wd-10p">Status</th>
                                <th class="wd-5p">Qty</th>
                                <th class="wd-5p">UOM</th>
                                <th class="wd-10p">Cost</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $total_cost = 0; @endphp
                            @foreach($a as $i)
                                @php $total_cost += $i->qty*$i->cost; @endphp
                                <tr>
                                    <td>{{ isset($i->stock_code) ? $i->stock_code : 'N/A' }}</td>
                                    <td>{{ $i->description }}</td>
                                    <td>{{ $i->serial_no }}</td>
                                    <td>{{ $i->status }}</td>
                                    <td>{{ $i->qty }}</td>
                                    <td>{{ $i->uom }}</td>
                                    <td class="tx-right">{{ number_format(floor($i->cost),2) }}</td>
                                </tr>
                            @endforeach
                                <tr>
                                    <th colspan="6">Grand Total</th>
                                    <th class="text-right">&#8369; {{ number_format(floor($total_cost),2) }}</th>
                                </tr>
                        </tbody>
                    </table>
                </div>
            @endforeach
            <div class="row justify-content-between mg-t-10">
                <div class="col-sm-12 col-lg-12 order-2 order-sm-0 mg-t-30 mg-sm-t-0">
                    <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Notes</label>
                    <textarea class="form-control" rows="3" placeholder="Enter your notes here . . ."></textarea>
                </div>
            </div>

            <div class="row mg-t-40" style="border-style: none dashed;border-width: 1px;">
                <div class="col-md-12">
                    <p>I, the undersigned, acknowledge receipt assets listed above. I fully understand that this properties belong to the company and I am expected to exercise due care in my use and to utilize such property for authorized or business purposes only.  Any damage or lost due to my negligence in care and use will be considered cause for disciplinary action. </p>
                    <p>I also understand that the company property must be returned at the time of my separation or when it is requested to be returned and i hereby authorized the company to deduct against my salary on any damage, loss and unreturned company property due to my negligence.</p>
                </div>
            </div>

            <div class="row mg-t-50">
                <div class="col-md-12">
                    <div class="form-group row">
                        <label for="inputEmail3" class="col-sm-4 col-form-label"><strong>Prepared By :</strong></label>

                        <label for="inputEmail3" class="col-sm-4 col-form-label"><strong>Received By :</strong></label>

                    </div>

                    <div class="form-group row">
                        <div class="col-sm-4 text-center"><p>{{Auth::user()->fullName }}<br>_____________________________</p></div>

                        <div class="col-sm-4 text-center"><p>&nbsp;<br>_____________________________</p></div> 
         
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

    <script src="{{ asset('assets/js/dashforge.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.aside.js') }}"></script>
    <script src="{{ asset('assets/js/dashforge.sampledata.js') }}"></script>
</body>
</html>
