@phproles
if(!empty(Session::get('locale')))
    {
        app()->setLocale(Session::get('locale'));
    }

    else{
         app()->setLocale('en');
    }
@endphp
@extends('admin.layouts.master')
@section('title',$title)
@section('content')
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->

		<div class="container">

		</div>
	</div>
@endsection
