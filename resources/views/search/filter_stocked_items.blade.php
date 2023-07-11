
@forelse($items as $item)
    <tr class="tx-12">
        <th>{{ $item->inv_code }}</th>
        <td>{{ $item->stock_code }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->oem_id }}</td>
        <td>{{ $item->uom }}</td>
        <td class="d-flex justify-content-end">
        	<a href="/create/item/{{$item->stock_code}}" target="_blank" class="btn btn-sm btn-primary mg-r-5"><i class="fa fa-share"></i></a>
        	<a href="#" data-toggle="modal" data-target="#delete-stock" data-id="{{$item->id}}" class="btn btn-sm btn-danger stock_delete"><i class="fa fa-trash"></i></a>
        </td>
    </tr>
@empty
	<tr><td colspan="6"><center>Stock code not found</center></td></tr>
@endforelse