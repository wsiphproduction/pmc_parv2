@extends('layouts.app')

@section('pagecss')
<link rel="stylesheet" href="{{ asset('assets/css/dashforge.profile.css') }}">
<style>
    .content {
        overflow: hidden;
    }
    @media print{
        .btn_print {
            display: none;
        }

        .btn_upload {
            display: none;
        }
       .content-footer {
            display: none;
        }
        .dept_header {
            display: none;
        }

        .divfiles {
            display: none;
        }
    }
</style>
@endsection

@section('content')

    @php
        $grouped = $par_details->groupBy('header_id');
        $grouped->toArray();
    @endphp

    @foreach($grouped as $par)
    @php
    $par_header = \App\accountabilityHeaders::find($par[0]['refcode']);
    @endphp
        <div class="bd-b mg-t-20">
            <div class="container pd-x-0 pd-lg-x-10 pd-xl-x-0">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div>
                        <h4 class="mg-b-5">Par #{{ $par[0]['refcode'] }}</h4>
                        <p class="mg-b-0 tx-color-03">Transaction Date : {{ $par[0]['document_date'] }}</p>
                    </div>
                    <div class="mg-t-5 mg-sm-t-0">
                        <a href="#upload-file" class="btn btn-white btn_upload" data-toggle="modal"><i data-feather="upload" class="mg-r-5"></i> Upload Files</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-6">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Accountable To</label>
                <h6 class="tx-15">@if($par[0]['is_dept'] == 1) {{ $par[0]['dept_id'] }} @else {{ $par[0]['employee_id'] }} {{ $par[0]['accountable'] }} @endif</h6>
                <p class="mg-b-0" style="font-style: italic;">@if($par[0]['is_dept'] == 0) {{ $par[0]['dept'] }} @endif</p>
            </div>
            <div class="col-sm-6 tx-right d-none d-md-block">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Document Status
                    {{$par[0]['doc_status']}}
                </label>
                <h1 class="tx-normal tx-color-04 mg-b-10 tx-spacing--2">
                    @if($par[0]['doc_status'] == 'saved')
                        SAVED
                    @endif

                    @if($par[0]['doc_status'] == 'posted')
                        POSTED
                    @endif

                    @if($par[0]['doc_status'] == 'closed')
                        CLOSED
                    @endif
                    </h1>
            </div>
            <div class="col-sm-6 col-lg-8 mg-sm-t-20">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Par Details</label>
                <p class="mg-b-0">Par Type : {{ strtoupper($par[0]['ptype']) }}</p>
                <p class="mg-b-0">Location : {{ strtoupper($par[0]['p_location']) }}</p>
                <p class="mg-b-0">Site : {{ strtoupper($par[0]['p_site']) }}</p>
            </div>
            <div class="col-sm-6 col-lg-4 mg-sm-t-20">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Reference Information</label>
                <ul class="list-unstyled lh-7">
                    <li>
                        <span>Issuance Doc Ref # : </span>
                        <span>{{ $par[0]['doc_ref']}}</span>
                    </li>
                    <li>
                        <span>Safety : </span>
                        <span>{{ $par[0]['safety'] }}</span>
                    </li>
                    <li>
                        <span>Reference Par # : </span>
                        <span>{{ $par[0]['ref_par'] }}</span>
                    </li>
                    <li>
                        <span>PO # : </span>
                        <span>{{ $par[0]['po_no'] }}</span>    
                    </li>
                    <li>
                        <span>CIS/S.I # : </span>
                        <span>{{ $par[0]['cis_si_no'] }}</span>
                        
                    </li>
                </ul>
            </div>

            <div class="col-sm-6 col-lg-8 mg-t-10 mg-sm-t-0">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Other Information</label>
                <p class="mg-b-0">Added By :  {{ $par[0]['added_by'] }}</p>
                <p class="mg-b-0">Created At : {{ $par[0]['created_at'] }}</p>
                <p class="mg-b-0">Remarks : {{$par[0]['remarks']}}</p>
            </div>
            <div class="col-sm-6 col-lg-4 mg-t-10">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">&nbsp;</label>
                <ul class="list-unstyled lh-7">
                    @if($par[0]['doc_status'] == 'posted')
                    <li>
                        <span>Posted By : </span>
                        <span>{{ $par[0]['posted_by'] }}</span>
                    </li>
                    <li>
                        <span>Posted At</span>
                        <span>{{ $par[0]['posted_date'] }}</span>
                    </li>
                    @endif
                </ul>
            </div>
        </div>

        <div class="table-responsive mg-t-40 mg-b-20">
            <table class="table table-bordered table-invoice bd-b">
                <thead>
                    <tr>
                        <th class="wd-20p">Stock Code</th>
                        <th class="wd-40p d-none d-sm-table-cell">Description</th>
                        <th>Serial #</th>
                        <th>Status</th>
                        <th class="tx-right">Qty</th>
                        <th class="tx-right">Cost</th>
                    </tr>
                </thead>
                <tbody>
                    @php $g_total = 0; @endphp
                    @foreach($par as $item)
                        @php
                            $g_total += $item->qty*$item->cost;
                        @endphp
                        <tr>
                            <td><a href="/item/details/{{ $item->item_id }}">{{ isset($item->stock_code) ? $item->stock_code : 'N/A' }}</a></td>
                            <td class="d-none d-sm-table-cell tx-color-03">{{ $item->description }}</td>
                            <td>{{ $par_header->serial_no }}</td>
                            <td>{{ $item->status }}</td>
                            <td class="tx-right">{{ $item->qty == '0.00' ? 0 : $item->qty }}</td>
                            <td class="tx-right">{{ number_format($item->cost,2) }}</td>
                        </tr>
                    @endforeach
                        <tr>
                            <th>Grand Total</th>
                            <th colspan="5" class="text-right">{{ number_format($g_total,2) }}</th>
                        </tr>
                </tbody>
            </table>
        </div>

        <div class="row justify-content-between divfiles">
            <div class="col-sm-6 col-lg-6 order-2 order-sm-0 mg-t-40 mg-sm-t-0">
                <label class="tx-sans tx-uppercase tx-10 tx-medium tx-spacing-1 tx-color-03">Files</label>
                <ul class="list-unstyled lh-7">
                    @php
                        $par_id = $par[0]['header_id'];
                        $dir = '\\\\ftp\\FTP\\APP_UPLOADED_FILES\\par\\'.$par_id.'\\';
                    
                        if(is_dir($dir)){
                            $files = scandir($dir);
                            for($i=0; $i< count($files);$i++){
                                if($files[$i] != '.' && $files[$i] != '..'){
                        @endphp
                                <li>
                                    <a onclick="doSomething('{{$files[$i]}}','{{$par_id}}');" href="#">{{$files[$i]}}</a>
                                </li>
                        @php
                                }      
                            }
                        }
                    @endphp
                </ul>
            </div>
        </div>

        <div class="modal effect-scale" id="upload-file" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">File Upload</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="/par/file-upload" role="form" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="par_id" value="{{ $par[0]['header_id'] }}">
                            <input required type="file" class="form-control" name="uploadFile[]" multiple/>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-sm btn-primary">Upload</button>
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@section('pagejs')
<script>
    function doSomething(f,p) {

        var today = new Date();
        var dd = String(today.getDate()).padStart(2, '0');
        var mm = String(today.getMonth() + 1).padStart(2, '0');
        var yyyy = today.getFullYear();

        today = yyyy + '-' + mm + '-' + dd;

        $.ajax({
            type : 'post',
            url  : '/copyFile',
            data : {
                'par'        : p,
                'fileName'  : f,
                '_token'    : $('input[name=_token]').val(),
            },
            type : 'POST',
            success : function (data) {
                window.open('{!!asset("storage/'+today+'/")!!}/'+f,"_blank")
            }
        });
    }
</script>
@endsection

