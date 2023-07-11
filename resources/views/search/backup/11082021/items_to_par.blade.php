

<div class="table-responsive">
	<table class="table table-sm table-striped mg-t-4">
		<tbody>
			@forelse($items as $item)
				@php
					$desc = str_replace(array("'",'"'),'`',$item->description);
				@endphp
				
				@if($type == 'transfer')
					@if(\App\Items::checkSerial($item->id) == 0)
						<tr class="tx-12" id="id{{ $item->id }}">
							<td class="wd-10p">{{ $item->id }}</td>
							<td class="wd-30p">{{ $item->description }}</td>
							<td class="wd-20p">{{ $item->serial_no }}</td>
							<td class="wd-10p">{{ $item->qty }}</td>
							<td class="wd-10p">{{ $item->uom }}</td>
							<td class="wd-10p">{{ $item->cost }}</td>
							<td class="wd-10p"></td>
							<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("{{$item->id}}","{{$desc}}","{{$item->uom}}","{{$item->serial_no}}","{{$item->cost}}","{{$item->qty}}");' role="button">Add</a></td>
						</tr>
					@endif
				@else
					@if($item->serial_no != '' )
						@if(\App\Items::checkSerial($item->id) == 1)
							<tr class="tx-12" id="id{{ $item->id }}">
								<td class="wd-10p">{{ $item->id }}</td>
								<td class="wd-30p">{{ $item->description }}</td>
								<td class="wd-20p">{{ $item->serial_no }}</td>
								<td class="wd-10p">{{ $item->qty }}</td>
								<td class="wd-10p">{{ $item->uom }}</td>
								<td class="wd-10p">{{ $item->cost }}</td>
								<td class="wd-10p"></td>
								<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("{{$item->id}}","{{$desc}}","{{$item->uom}}","{{$item->serial_no}}","{{$item->cost}}","{{$item->qty}}");' role="button">Add</a></td>
							</tr>
						@endif
					@else
						<tr class="tx-12" id="id{{ $item->id }}">
							<td class="wd-10p">{{ $item->id }}</td>
							<td class="wd-30p">{{ $item->description }}</td>
							<td class="wd-20p">{{ $item->serial_no }}</td>
							<td class="wd-10p">{{ $item->qty }}</td>
							<td class="wd-10p">{{ $item->uom }}</td>
							<td class="wd-10p">{{ $item->cost }}</td>
							<td class="wd-10p"></td>
							<td class="wd-10p"><a href="#" class="btn btn-xs btn-primary" onclick='addToItem("{{$item->id}}","{{$desc}}","{{$item->uom}}","{{$item->serial_no}}","{{$item->cost}}","{{$item->qty}}");' role="button">Add</a></td>
						</tr>
					@endif
				@endif
				
			@empty
				<tr><td colspan="5"><center><span class="badge badge-info">Item not found...</span></center></td></tr>
			@endforelse
		</tbody>
	</table>
</div>





