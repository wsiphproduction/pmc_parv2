

<div class="table-responsive">
	<table class="table table-sm mg-t-4">
		<tbody>
			@forelse($items as $item)
				@php
					$desc = str_replace(array("'",'"'),'`',$item->description);
				@endphp
				<tr class="tx-12" id="id{{ $item->id }}">
					<td><a href="#" class="btn btn-xs" onclick="populate_fields('{{$item->stock_code}}','{{$item->oem_id}}','{{$item->uom}}','{{$item->inv_code}}','{{$item->stock_type}}','{{$desc}}');" role="button">{{ $item->stock_code }}</a></td>
				</tr>
			@empty
				<tr><td><center><span class="badge badge-info">No stock code found</span></center></td></tr>
			@endforelse
		</tbody>
	</table>
</div>





