
@forelse($item_details as $item)
	<tr class="tx-12">
        <th scope="row">{{ $item->stock_code }}</th>
        <td>{{ $item->stock_type }}</td>
        <td>{{ $item->inv_code }}</td>
        <td>{{ $item->description }}</td>
        <td>{{ $item->oem_id }}</td>
        <td>{{ $item->uom }}</td>
        <td>{{ $item->expense_type }}</td>
    </tr>
@empty
	<tr><td colspan="7"><center><span class="badge badge-info">No records found . . .</span></center></td></tr>
@endforelse