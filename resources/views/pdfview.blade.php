<link rel="stylesheet" type="text/css" href="{{asset('../public/css/bulma.css')}}">
<script type="text/javascript" src="{{asset('../public/js/jquery.js')}}"></script>
<script type="text/javascript" src="{{asset('../public/js/jquery.min.js')}}"></script>

	Invoice Name <br>

	{{ $invoice->inv_name}}

	<table class="table">
		<thead>
			<tr>
				<th>Invoice name</th>
				<th># of Items</th>
				<th>Price</th>
				<th>Total</th>
				<th></th>
			</tr>
		</thead> 

		@foreach($invoice->item as $item)
			<tr>
				<td>{{ $item->item_name}} </td>
				<td> {{ $item->no_item}} </td>
				<td> {{ $item->price}} </td>
				<td> {{$item->no_item * $item->price}} </td>
			</tr>
		@endforeach

		<div style="margin-left:600px;">
			SubTotal <br>

			<input type="text" value="{{ $invoice->sub_total}}" ><br> 

			Tax<br>

			<input type="text" value="{{ $invoice->tax}}" ><br>

			Total<br>

			<input type="text" value="{{ $invoice->total}} " >

		</div>
	</table>