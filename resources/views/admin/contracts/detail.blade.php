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
	<table id="clints" class="datatables-demo table table-striped table-bordered">
		<tbody>
		<tr>
			<td>{{trans('admin.contract')}} Name Party</td>
			<td>{{$contract->name_contracting_party}}</td>
		</tr>
		<tr>
			<td>{{trans('admin.contract')}}</td>
			<td>
				{{ $contract->contract->title }}
			</td> 
		</tr>
		<tr>
			<td>Assign {{trans('admin.user')}}</td>
			<td>
			{{ $contract->users ?? 'Not assign' }}
			</td>
		</tr>
		<tr>
			<td>{{trans('admin.subject')}}</td>
			<td>{{$contract->subject}}</td>
		</tr>
		@if(!empty($contract->file))
		<tr>
			<td>{{trans('admin.file')}}</td>
			<td><input type="image" src="{{asset('contractfile')}}/{{$contract->file->file }}"  width="48" height="48"></td>
		</tr>
		@endif
		<tr>
			<td>{{trans('admin.address')}}</td>
			<td>{{$contract->address}}</td>
		</tr>
		<tr>
			<td>{{trans('admin.contract')}} Person</td>
			<td>{{$contract->contract_person}}</td>
		</tr>
		
		<tr>
			<td>{{trans('admin.contract')}} {{trans('admin.start_date')}}</td>
			<td>{{$contract->contract_start_date}}</td>
		</tr>
			<tr>
			<td>{{trans('admin.contract')}} {{trans('admin.end_date')}}</td>
			<td>{{$contract->contract_end_date}}</td>
		</tr>
		<tr>
			<td>{{trans('admin.created_at')}}</td>
			<td>{{$contract->created_at}}</td>
		</tr>
		
		</tbody>
	</table>
</div>

