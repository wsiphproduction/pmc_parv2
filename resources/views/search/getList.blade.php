@if(count($items)>0)

<table class="table table-striped table-bordered table-hover" id="sample_3">
    <thead>
        <tr>
            <th width="30px"> Tracking # </th>
            <th> Description </th>
            <th> Qty - UOM </th>
            <th> Cost </th>
            <th> Serial </th>
            <th> Location </th>
            <th> PAR #</th>
            <th></th>                                                           
        </tr>
    </thead>
    <tbody>

        @foreach ($items as $item)
        <tr>
            <td>{{ $item->tracking }}</td>
            <td>{{ $item->name }}</td>
            <td>{{ $item->qty }}  {{ $item->uom }}</td>
            <td>{{ $item->price }}</td>
            <td>{{ $item->serialNo }}</td>
            <td>{{ $item->location }}</td>
            <td>
                @php
                $items = App\accountabilityDetails::where('item','=',$item->id)->count();
                $h_id  = App\accountabilityDetails::where('item','=',$item->id)->first();

                @endphp

                @if($items > 0)
                <a data-container="body" data-placement="top" data-original-title="View PAR Details" href="/par/details/{{$item->id}}/{{ $h_id->header_id }}" class="btn btn-sm green tooltips">{{ $h_id->header_id}}</a>
                @else
                <span class="label label-sm label-danger ">NOT SERVED</span>
                @endif
            </td>
            <td>
                <div class="btn-toolbar margin-bottom-10">
                    <div class="btn-group btn-group-circle btn-group-sm btn-group-solid">
                        <a data-container="body" data-placement="top" data-original-title="EDIT" class="btn btn-sm green tooltips"><i class="icon-note"></i></a>
                        <a href="#openItem" data-toggle="modal" data-container="body" data-placement="top" data-original-title="REQUEST TO OPEN" class="btn btn-sm red tooltips"><i class="icon-basket-loaded"></i></a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>

    <tfoot>
        <tr>
            <td colspan="8">{{ $items->render() }}</td>
        </tr>
    </tfoot>
</table>

@else

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <b> {{ $search }} Not Found </b>
            </div>
        </div>
    </div>
</div>

@endif