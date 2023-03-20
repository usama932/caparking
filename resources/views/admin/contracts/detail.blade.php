<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>User</td>
			<td>{{$contract->user->name}}</td>
		</tr>
		<tr>
			<td>Contracts</td>
			<td>
				{{ $contract->contract->title }}
				
				
			</td>
		</tr>
		<tr>
			<td>Address</td>
			<td>{{$contract->address}}</td>
		</tr>
		<tr>
			<td>Contract Person</td>
			<td>{{$contract->contract_person}}</td>
		</tr>
		
		
		<tr>
			<td>Created at</td>
			<td>{{$contract->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

