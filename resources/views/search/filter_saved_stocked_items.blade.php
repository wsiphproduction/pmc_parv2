
@forelse($items as $item)
    <tr class="tx-12">
        <th>{{ $item->stock_code }}</th>
        <td>{{ $item->inv_code }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->serial_no }}</td>
        <td>{{ $item->oem_id }}</td>
        <td>{{ $item->uom }}</td>
        <td>{{ $item->expense_type }}</td>
        <td>
            <a href="/item/edit/{{$item->id}}" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                <i class="fa fa-edit"></i>
            </a>
            <a href="/item/delete/{{$item->id}}" title="Delete Item" class="btn btn-xs btn-danger btn-sm">
                <i class="fa fa-trash"></i>
            </a>
        </td>
    </tr>
@empty
	<tr><td colspan="8"><center>Stock item not founds</center></td></tr>
@endforelse