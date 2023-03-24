<div class="card-datatable table-responsive">
	<table id="clints" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Contract Name Party</td>
			<td>{{$contract->name_contracting_party}}</td>
		</tr>
		<tr>
			<td>Contracts</td>
			<td>
				{{ $contract->contract->title }}
			</td>
		</tr>
		<tr>
			<td>Subject</td>
			<td>{{$contract->subject}}</td>
		</tr>
		<tr>
			<td>File</td>
			<td><input type="image" src="{{asset('contractfile')}}/{{$contract->file->file}}"  width="48" height="48"></td>
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
			<td>Contract Start Date</td>
			<td>{{$contract->contract_start_date}}</td>
		</tr>
			<tr>
			<td>Contract End Date</td>
			<td>{{$contract->contract_end_date}}</td>
		</tr>
		<tr>
			<td>Created at</td>
			<td>{{$contract->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

