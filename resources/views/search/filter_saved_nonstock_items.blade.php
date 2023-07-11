
@forelse($items as $item)
    <tr class="tx-12">
        <th scope="row" class="wd-5p"><a href="/item/details/{{ $item->id }}" target="_blank">{{ $item->id }}</a></th>
        <td class="wd-390">{{ strtoupper($item->description) }}</td>
        <td>{{ $item->expense_type }}</td>
        <td>{{ $item->serial_no }}</td>
        <td>{{ $item->cost }}</td>
        <td>{{ $item->asset_code }}</td>
        <td>{{ $item->po_no }}</td>
        <td>{{ $item->dr_no }}</td>
        <td>
            @php 
                $check = \App\Items::check_item_status($item->id); 
            @endphp
            @if($check == 1)
                <a href="/item/edit/{{$item->id}}" title="Edit Item" class="btn btn-xs btn-primary btn-sm">
                    <i class="fa fa-edit"></i>
                </a>
            @endif
        </td>
    </tr>
@empty
    <tr>
        <td colspan="11"><center>Item not found</center></td>
    </tr>
@endforelse