<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Order By </td>
			<td>{{ $order->user->name ?? ''}}</td>
		</tr>
		<tr>
			<td>Plan</td>
			<td> {{ $order->plan_name ?? '' }}
				</td>
		</tr>
        <tr>
			<td>Amount</td>
			<td> {{ $order->amount }}
				</td>
		</tr>
        <tr>
			<td>Order #</td>
			<td> {{ $order->order_id }}
				</td>
		</tr>
        <tr>
			<td>Expiry Date</td>
			<td> {{ $order->expiry_date }}
				</td>
		</tr>
        <tr>
			<td>Subscription Date</td>
			<td> {{ $order->subscription_date }}
				</td>
		</tr>
		<tr>
			<td>Created at</td>
			<td>{{$order->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

