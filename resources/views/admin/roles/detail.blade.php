@php 
if(!empty(Session::get('locale'))) 
    {
        app()->setLocale(Session::get('locale'));
    }
            
    else{
         app()->setLocale('en');
    }
@endphp
<div class="card-datatable table-responsive">
	<table id="clients" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>Name</td>
			<td>{{ $role->name }}</td>
		</tr>
		<tr>
			<td>{{trans('admin.permissions')}}</td>
			<td> 
				@if(!empty($rolePermissions))
					@foreach($rolePermissions as $v)
					{{ $v->name }},
					@endforeach
            	@endif</td>
		</tr>
	
		<tr>
			<td>{{trans('admin.created_at')}}</td>
			<td>{{$role->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

