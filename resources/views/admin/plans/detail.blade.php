<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Name</td>
			<td>{{ $plan->name }}</td>
		</tr>
		<tr>
			<td>Price</td>
			<td> {{ $plan->price }}
				</td>
		</tr>
        <tr>
			<td>Plan</td>
			<td> {{ $plan->plan_id }}
				</td>
		</tr>
		<tr>
			<td>Created at</td>
			<td>{{$plan->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

