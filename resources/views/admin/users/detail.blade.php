<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Name</td>
			<td>{{$user->name}}</td>
		</tr>
		<tr>
			<td>Email</td>
			<td>{{$user->email}}</td>
		</tr>
		<tr>
			<td>Mobile #</td>
			<td>{{$user->mobile_number}}</td>
		</tr>
		<tr>
			<td>House #</td>
			<td>{{$user->house_number}}</td>
		</tr>
		<tr>
			<td>Street</td>
			<td>{{$user->street}}</td>
		</tr>
		
		<tr>
			<td>Zip</td>
			<td>{{$user->zip}}</td>
		</tr>
		<tr>
			<td>City</td>
			<td>{{$user->city}}</td>
		</tr>
		<tr>
			<td>Country</td>
			<td>{{$user->country}}</td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				@if($user->active)
					<label class="label label-success label-inline mr-2">Active</label>
				@else
					<label class="label label-danger label-inline mr-2">Inactive</label>
				@endif
			</td>
		</tr>
		<tr>
			<td>{{trans('admin.created_at')}}</td>
			<td>{{$user->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

