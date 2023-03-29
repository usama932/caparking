<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>{{trans('admin.order')}} By </td>
			<td>{{ $order->user->name ?? ''}}</td>
		</tr>
		<tr>
			<td>{{trans('admin.plans')}}</td>
			<td> {{ $order->plan_name ?? '' }}
				</td>
		</tr>
        <tr>
			<td>{{trans('admin.amount')}}</td>
			<td> {{ $order->amount }}
				</td>
		</tr>
        <tr>
			<td>{{trans('admin.order')}} #</td>
			<td> {{ $order->order_id }}
				</td>
		</tr>
        <tr>
			<td>{{trans('admin.expiry_date')}}</td>
			<td> {{ $order->expiry_date }}
				</td>
		</tr>
        <tr>
			<td>{{trans('admin.subscription_date')}}</td>
			<td> {{ $order->subscription_date }}
				</td>
		</tr>
		<tr>
			<td>{{trans('admin.created_at')}}</td>
			<td>{{$order->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

