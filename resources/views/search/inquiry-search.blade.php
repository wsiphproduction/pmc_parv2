<table class="table table-striped table-bordered table-advance table-hover">
    <thead>
        <tr>
            <th> Tracking </th>
            <th> Description </th>
            <th> Qty - Uom </th>
            <th> Cost</th>
                                            
        </tr>
    </thead>
    <tbody>
        @foreach($search as $i)
        <tr>
            <td>{{ $i->tracking }}</td>
        </tr>
        @endforeach
    </tbody>
</table>