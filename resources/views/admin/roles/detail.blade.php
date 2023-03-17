<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Name</td>
			<td>{{ $role->name }}</td>
		</tr>
		<tr>
			<td>Permissions</td>
			<td> 
				@if(!empty($rolePermissions))
					@foreach($rolePermissions as $v)
					{{ $v->name }},
					@endforeach
            	@endif</td>
		</tr>
	
		<tr>
			<td>Created at</td>
			<td>{{$role->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

