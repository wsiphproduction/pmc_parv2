@extends('layouts.app')

@section('pagecss')
    <link href="{{ asset('assets/lib/select2/css/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mg-b-20 mg-lg-b-25 mg-xl-b-30">
        <div>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-style1 mg-b-10">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item"><a href="#">PAR Management</a></li>
                  <li class="breadcrumb-item active" aria-current="page">PPE Issuance Request</li>
                </ol>
            </nav>
            <h4 class="mg-b-0 tx-spacing--1">PPE Issuance Request Management</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body pd-y-15 pd-x-10">
                    <div class="table-responsive">
                        <div class="table-responsive">
                            <table id="example1" class="table mg-b-0">
                                <thead>
                                    <tr>
                                        <th scope="col">Control #</th>
                                        <th scope="col">Recepient</th>
                                        <th scope="col">Document Date</th>
                                        <th scope="col">Location</th>
                                        <th scope="col">Balance</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="item_list">
                                    @foreach($requests as $req)
                                        <tr>
                                            <td>{{ $req->controlNum }}</td>
                                            <td>{{ $req->rec }}</td>
                                            <td>{{ $req->ddate }}</td>
                                            <td>{{ $req->location }}</td>
                                            <td>{{ $req->total_released }} / {{ $req->total_qty }} </td>
                                            <td>
                                                @if($req->total_released != $req->total_qty)
                                                <a href="/process-irms/{{$req->controlNum}}/{{ str_replace('/',':',$req->rec) }}" class="btn btn-xs btn-primary">Process</a>
                                                @else
                                                <span class="badge badge-success">COMPLETED</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-end mg-t-5"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('pagejs')
    <script src="{{ asset('assets/lib/select2/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/lib/datatables.net-dt/js/dataTables.dataTables.min.js') }}"></script>

    <script>
      $(function(){
        'use strict'

        $('#example1').DataTable({
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
          }
        });
        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>
    <script>
        $(function(){
            'use strict'
            $('.select2-no-search').select2({
                minimumResultsForSearch: Infinity,
                placeholder: 'Choose Search Category'
            });
        });
    </script>
@endsection
