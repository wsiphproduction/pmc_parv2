@forelse($item_details as $item)
	<tr class="tx-12">
        <th scope="row">{{ $item->id }}</th>
        <td>{{ $item->stock_code }}</td>
        <td>{{ str_limit($item->description, 50, '...') }}</td>
        <td>{{ $item->expense_type }}</td>
        <td>{{ $item->serial_no }}</td>
        <td>{{ $item->qty }}</td>
        <td>{{ $item->cost }}</td>
        <td>{{ $item->asset_code }}</td>
        <td>{{ $item->po_no }}</td>
        <td>
            <a href="/item/edit/{{$item->id}}" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                <i class="fa fa-edit"></i>
            </a>
            <a href="#modalVerifyItem" data-toggle="modal" data-iid="{{$item->id}}" title="Verified Item" class="btn btn-xs btn-success modal-verify">
                <i class="fa fa-check"></i>
            </a>
        </td>
    </tr>
@empty
	<tr><td colspan="11"><center><span class="badge badge-info">No records found . . .</span></center></td></tr>
@endforelse