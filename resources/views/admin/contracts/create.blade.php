@php 
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
  <div class="content d-flex flex-column flex-column-fluid overflow-auto" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
          <!--begin::Page Heading-->
          <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">{{trans('admin.dashboard')}}</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">{{trans('admin.manage')}} {{trans('admin.contract')}} </a>
              </li>
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">{{trans('admin.add')}} {{trans('admin.contract')}}</a>
              </li>
            </ul>
            <!--end::Breadcrumb-->
          </div>
          <!--end::Page Heading-->
        </div>
        <!--end::Info-->
      </div>
    </div>
    <!--end::Subheader-->
    <!--begin::Entry-->
    <div class="d-flex flex-column-fluid overflow-auto">
      <!--begin::Container-->
      <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-sticky" id="kt_page_sticky_card">
          <div class="card-header" style="">
            <div class="card-title">
              <h3 class="card-label">{{trans('admin.contract')}} {{trans('admin.add')}} {{trans('admin.form')}}
                <i class="mr-2"></i>
                <small class="">{{trans('admin.try_to_scroll_the_page')}}</small></h3>

            </div>
            <div class="card-toolbar">

              <a href="{{ route('contacts.index') }}" class="btn btn-light-primary
              font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>{{trans('admin.back')}}</a>

              <div class="btn-group">
                <a href="{{ route('contacts.store') }}"  onclick="event.preventDefault(); document.getElementById('contacts_add_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                  <i class="ki ki-check icon-sm"></i>{{trans('admin.save')}}</a>



              </div>
            </div>
          </div>
          <div class="card-body">
          @include('admin.partials._messages')
          <!--begin::Form-->
            {{ Form::open([ 'route' => 'contacts.store','class'=>'form' ,"id"=>"contacts_add_form", 'enctype'=>'multipart/form-data']) }}
              @csrf
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                  <div class="my-5">
                    <h3 class="text-dark font-weight-bold mb-10">{{trans('admin.contract')}} {{trans('admin.info')}}: </h3>
                    <div class="form-group row {{ $errors->has('contract_type_id') ? 'has-error' : '' }}">
                    
                      <label class="col-3">{{trans('admin.contract')}} {{trans('admin.type')}}</label>
                      <div class="col-9">
                        <select name="contract_type_id" class="form-control form-control-solid">
                            @foreach($contract_types as $contract_type)
                                <option value="{{$contract_type->id}}" class="form-control form-control-solid">{{$contract_type->title}}</option>
                            @endforeach
                            
                        </select>
                        <span class="text-danger">{{ $errors->first('contract_type_id') }}</span>
                      </div>
                    </div>   
                    @if(auth()->user()->user_type == "company")
                      @if(auth()->user()->order->plan_name == 'Premium') 
                        <div class="form-group row {{ $errors->has('users') ? 'has-error' : '' }}">
                          <label class="col-3">Assign {{trans('admin.user')}}</label>
                          <div class="col-9">
                            <select name="users"  id="select2Multiple" class="select2-multiple form-control form-control-solid">
                                @foreach($users as $user)
                                    <option value="{{$user->id}}" class="form-control form-control-solid">{{$user->name}}</option>
                                @endforeach
                                
                            </select>
                            <span class="text-danger">{{ $errors->first('contract_type_id') }}</span>
                          </div>
                        </div> 
                      
                      @endif
                    @endif
                    <div class="form-group row {{ $errors->has('contract_party') ? 'has-error' : '' }}">
                        <label class="col-3">Name {{trans('admin.contract')}} Party</label>
                        <div class="col-9">  
                        {{ Form::text('contract_party', null, ['class' => 'form-control form-control-solid','id'=>'contract_party','placeholder'=>'Enter Name Contract Party','required'=>'true']) }}
                          <span class="text-danger">{{ $errors->first('contract_party') }}</span>
                        </div>
                    </div>
                    <div class="form-group row {{ $errors->has('subject') ? 'has-error' : '' }}">
                      <label class="col-3">{{trans('admin.subject')}}</label>
                      <div class="col-9">
                        {{ Form::text('subject', null, ['class' => 'form-control form-control-solid','id'=>'address','placeholder'=>'Enter subject','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('subject') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('name') ? 'has-error' : '' }}">
                      <label class="col-3">{{trans('admin.contract')}} Person</label>
                      <div class="col-9">
                        {{ Form::text('contract_person', null, ['class' => 'form-control form-control-solid','id'=>'contract_person','placeholder'=>'Enter Contract Person','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('contract_person') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                      <label class="col-3">{{trans('admin.address')}}</label>
                      <div class="col-9">
                        <textarea rows="2" cols="50" class = "form-control form-control-solid" name="address" placeholder="Enter Address here..."></textarea>
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('contract_start_date') ? 'has-error' : '' }}">
                      <label class="col-3">{{trans('admin.contract')}} {{trans('admin.start_date')}}</label>
                      <div class="col-9">
                        {{ Form::date('contract_start_date', null, ['class' => 'form-control form-control-solid','id'=>"contract_start_date",'placeholder'=>'Enter contract_start_date','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('contract_start_date') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('contract_end_date') ? 'has-error' : '' }}">
                      <label class="col-3">{{trans('admin.contract')}} {{trans('admin.end_date')}}</label>
                      <div class="col-9">
                        {{ Form::date('contract_end_date', null, ['class' => 'form-control form-control-solid','id'=>"contract_end_date",'placeholder'=>'Enter Contract_end_date','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('contract_end_date') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('file') ? 'has-error' : '' }}">
                      <label class="col-3">Contract File</label>
                      <div class="col-9">
                        {{ Form::file('file', null, ['class' => 'form-control form-control-solid','id'=>"file" ]) }}
                        <span class="text-danger">{{ $errors->first('file') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('notify_by_email') ? 'has-error' : '' }}">
                      <label class="col-3">Notify By Email</label>
                      <div class="col-9">
                        <select name="notify_by_email" class="form-control form-control-solid">
                          <option value="1" class="form-control form-control-solid">Yes</option>
                          <option value="0" class="form-control form-control-solid">No</option>
                        </select>
                        <span class="text-danger">{{ $errors->first('notify_by_email') }}</span>
                      </div>
                    </div>
                  </div>

                </div>
              </div>
          {{Form::close()}}
            <!--end::Form-->
          </div>
        </div>
        <!--end::Card-->

      </div>
      <!--end::Container-->
    </div>
    <!--end::Entry-->
  </div>

@endsection
