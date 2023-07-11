

<div class="table-responsive">
	<table class="table table-sm table-striped mg-t-4">
		<tbody>
			@forelse($items as $item)
				<tr class="tx-12" id="id{{ $item->id }}">
					<td class="wd-10p">{{ $item->stock_code }}</td>
					<td class="wd-60p">{{ $item->description }}</td>
					<td class="wd-20p">{{ $item->expense_type }}</td>
					<td class="wd-10p">{{ $item->cost }}</td>
					<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick="addToItem('{{$item->id}}','{{$item->stock_code}}','{{$item->description}}','{{$item->expense_type}}','{{$item->cost}}');" role="button">Add</a></td>
				</tr>
			@empty
				<tr><td colspan="5"><center><span class="badge badge-info">Item not found . . .</span></center></td></tr>
			@endforelse
		</tbody>
	</table>
</div>








