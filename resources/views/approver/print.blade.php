<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="Responsive Bootstrap 4 Dashboard Template">
    <meta name="author" content="ThemePixels">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="../../assets/img/favicon.png">

    <title>PMC - PAR v2</title>

    <!-- vendor css -->
    <link href="{{ asset('assets/lib/@fontawesome/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <!-- DashForge CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/dashforge.auth.css') }}">

    <style>
       
        @media print{
            .btn_print {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="content content-fixed content-auth">
        @php
            $grouped = $items->groupBy('header_id');
        @endphp

        @foreach($grouped as $a)
            <div class="content tx-13">
                <div class="container pd-30">
                    <div class="row">
                        <div class="col-sm-6">
                            <a class="btn btn-primary btn-sm btn_print text-white tx-15" onclick="javascript:window.print();"> Print</a>
                        </div>

                        <div class="col-sm-6 tx-right d-none d-md-block">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">PAR Number</label>
                            <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">#{{ $a[0]['refcode'] }}</h1>
                        </div>

                        <div class="col-sm-6 col-lg-8 mg-t-40 mg-sm-t-0 mg-md-t-40">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Accountable To</label>
                            <h6 class="tx-15 mg-b-10">{{ $a[0]['accountable'] }}</h6>
                            <p class="mg-b-0">Status : {{ $a[0]['doc_status'] }}</p>
                            <p class="mg-b-0">Posted By : {{ $a[0]['posted_by'] }}</p>
                            <p class="mg-b-0">Document Date : {{ $a[0]['document_date'] }}</p>
                        </div>

                        <div class="col-sm-6 col-lg-4 mg-t-40">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                            <ul class="list-unstyled lh-7">
                                <li class="d-flex justify-content-between">
                                    <span>Reference Code</span>
                                    <span>{{ $a[0]['ref_code'] }}</span>
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
                        <table class="table table-invoice bd-b">
                            <thead>
                                <tr>
                                    <th class="wd-20p">Tracking #</th>
                                    <th class="wd-40p d-none d-sm-table-cell">Description</th>
                                    <th class="wd-40p d-none d-sm-table-cell">Details</th>
                                    <th class="wd-20p">Status</th>
                                    <th class="tx-right">Quantity</th>
                                    <th class="tx-right">UOM</th>
                                    <th class="tx-right">Cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($a as $i)
                                    <tr>
                                        <td class="tx-nowrap">{{ $i->tracking }}</td>
                                        <td class="d-none d-sm-table-cell tx-color-03">{{ $i->itemName }}</td>
                                        <td class="d-none d-sm-table-cell tx-color-03">{{ $i->details }}</td>
                                        <td>{{ $i->status }}</td>
                                        <td class="tx-right">{{ $i->qty }}</td>
                                        <td class="tx-right">{{ $i->uom }}</td>
                                        <td class="tx-right">{{ number_format(floor($i->price),2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="row justify-content-between">
                        <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                            <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Enter your notes here . . ."></textarea>
                        </div>
                        <div class="col-sm-6 col-lg-4 order-1 order-sm-0">
                            <ul class="list-unstyled lh-7 pd-r-10">
                                <li class="d-flex justify-content-between">
                                    <strong>Grand Total</strong>
                                    <strong>&#8369; {{ number_format(floor($total),2) }}</strong>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-lg-4 tx-center mg-t-100">
                            ________________________________________
                        </div>
                        <div class="col-sm-4 col-lg-4 tx-center mg-t-100">
                            ________________________________________
                        </div>
                        <div class="col-sm-4 col-lg-4 tx-center mg-t-100">
                            ________________________________________
                        </div>

                        <div class="col-sm-4 col-lg-4 tx-center mg-t-20">
                            Prepared By
                        </div>
                        <div class="col-sm-4 col-lg-4 tx-center mg-t-20">
                            Received By
                        </div>
                        <div class="col-sm-4 col-lg-4 tx-center mg-t-20">
                            Approved By
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/lib/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('assets/lib/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
</body>
</html>
