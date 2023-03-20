@extends('admin.layouts.master')
@section('title',$title)
@section('content')
  <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
    <!--begin::Subheader-->
    <div class="subheader py-2 py-lg-6 subheader-solid" id="kt_subheader" kt-hidden-height="54" style="">
      <div class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
        <!--begin::Info-->
        <div class="d-flex align-items-center flex-wrap mr-1">
          <!--begin::Page Heading-->
          <div class="d-flex align-items-baseline flex-wrap mr-5">
            <!--begin::Page Title-->
            <h5 class="text-dark font-weight-bold my-1 mr-5">Dashboard</h5>
            <!--end::Page Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
              <li class="breadcrumb-item text-muted">
                <a href="" class="text-muted">Manage Contract</a>
              </li>
              <li class="breadcrumb-item text-muted">
                Edit Client
              </li>
              <li class="breadcrumb-item text-muted">
               {{ $contract->contract_person }}
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
    <div class="d-flex flex-column-fluid">
      <!--begin::Container-->
      <div class="container">
        <!--begin::Card-->
        <div class="card card-custom card-sticky" id="kt_page_sticky_card">
          <div class="card-header" style="">
            <div class="card-title">
              <h3 class="card-label">Contract  Edit Form
                <i class="mr-2"></i>
                <small class="">try to scroll the page</small></h3>

            </div>
            <div class="card-toolbar">
                <a href="{{ route('contacts.index') }}" class="btn btn-light-primary
                    font-weight-bolder mr-2">
                <i class="ki ki-long-arrow-back icon-sm"></i>Back</a>
                <div class="btn-group">
                    <a href=""  onclick="event.preventDefault(); document.getElementById('contract_update_form').submit();" id="kt_btn" class="btn btn-primary font-weight-bolder">
                    <i class="ki ki-check icon-sm"></i>update</a>
                </div>
            </div>
          </div>
          <div class="card-body">
          @include('admin.partials._messages')
          <!--begin::Form-->
            {{ Form::model($contract, [ 'method' => 'PATCH','route' => ['contacts.update', $contract->id],'class'=>'form' ,"id"=>"contract_update_form", 'enctype'=>'multipart/form-data'])}}
              @csrf
              <div class="row">
                <div class="col-xl-2"></div>
                <div class="col-xl-8">
                  <div class="my-5">
                    <h3 class="text-dark font-weight-bold mb-10">Contract  Info: </h3>
                           <div class="form-group row {{ $errors->has('contract_type_id') ? 'has-error' : '' }}">
                      <label class="col-3">Contract Type</label>
                      <div class="col-9">
                        <select name="contract_type_id" class="form-control form-control-solid">
                            @foreach($contract_types as $contract_type)
                                <option value="{{$contract_type->id}}" class="form-control form-control-solid">{{$contract_type->title}}</option>
                            @endforeach
                            
                        </select>
                        <span class="text-danger">{{ $errors->first('contract_type_id') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('nacontract_type_idme') ? 'has-error' : '' }}">
                      <label class="col-3">User</label>
                      <div class="col-9">
                        <select name="user_id" class="form-control form-control-solid">
                            @foreach($users as $user)
                                <option value="{{$user->id}}" class="form-control form-control-solid">{{$user->name}}</option>
                            @endforeach
                            
                        </select>
                        <span class="text-danger">{{ $errors->first('contract_type_id') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('contract_person') ? 'has-error' : '' }}">
                      <label class="col-3">Contract Person</label>
                      <div class="col-9">
                        {{ Form::text('contract_person', null, ['class' => 'form-control form-control-solid','id'=>'contract_person','placeholder'=>'Enter contract_person','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('contract_person') }}</span>
                      </div>
                    </div>
                    <div class="form-group row {{ $errors->has('address') ? 'has-error' : '' }}">
                      <label class="col-3">Address</label>
                      <div class="col-9">
                        {{ Form::textarea('address', null, ['class' => 'form-control form-control-solid','id'=>'address','placeholder'=>'Enter address','required'=>'true']) }}
                        <span class="text-danger">{{ $errors->first('address') }}</span>
                      </div>
                    </div>
                  </div>

                </div>
                <div class="col-xl-2"></div>
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
