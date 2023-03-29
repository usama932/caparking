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
			<td>{{$contract->title}}</td>
		</tr>
	
	

		<tr>
			<td>{{trans('admin.created_at')}}</td>
			<td>{{$contract->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

