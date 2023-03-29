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
@section('title','Contract Kampaner')
@section('content')
<div class="container p-5">
<h2 class="text-center">Select Your Plan</h2>
<div class="col-md-12 bg-light text-right mt-5">
   <div class="tab-pane show active row text-center" id="kt-pricing-2_content1" role="tabpanel" aria-labelledby="pills-tab-1">
      <div class="card-body bg-white col-11 col-lg-12 col-xxl-10 mx-auto">
      @if(!empty($plans))
         <div class="row">
            <!-- begin: Pricing-->
            <div class="col-md-6">
               <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                  <!--begin::Icon-->
                  <div class="d-flex flex-center position-relative mb-25">
                     <span class="svg svg-fill-primary opacity-4 position-absolute">
                        <svg width="175" height="200">
                           <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0"></polyline>
                        </svg>
                     </span>
                     <span class="svg-icon svg-icon-5x svg-icon-primary">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Home/Flower3.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <polygon points="0 0 24 0 24 24 0 24"></polygon>
                              <path d="M1.4152146,4.84010415 C11.1782334,10.3362599 14.7076452,16.4493804 12.0034499,23.1794656 C5.02500006,22.0396582 1.4955883,15.9265377 1.4152146,4.84010415 Z" fill="#000000" opacity="0.3"></path>
                              <path d="M22.5950046,4.84010415 C12.8319858,10.3362599 9.30257403,16.4493804 12.0067693,23.1794656 C18.9852192,22.0396582 22.5146309,15.9265377 22.5950046,4.84010415 Z" fill="#000000" opacity="0.3"></path>
                              <path d="M12.0002081,2 C6.29326368,11.6413199 6.29326368,18.7001435 12.0002081,23.1764706 C17.4738192,18.7001435 17.4738192,11.6413199 12.0002081,2 Z" fill="#000000" opacity="0.3"></path>
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Content-->
                  <h4 class="font-size-h3 mb-10">{{ $plans['0']['name']}}</h4>
                  <div class="d-flex flex-column line-height-xl pb-10">
                     <span>Monthly Subscribe</span>
                     <span>Auto Subscribe</span>
                    
                  </div>
                  <span class="font-size-h1 d-block font-weight-boldest text-dark">{{ $plans['0']['price']}}<sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                  <div class="mt-7">
                     <a href= "{{route('make.payment',$plans['0']['id'])}}">
                        <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Subscribe</button>
                     </a>
                  </div>
                  <!--end::Content-->
               </div>
            </div>
            <!-- end: Pricing-->
            <!-- begin: Pricing-->
            <div class="col-md-6 border-x-0 border-x-md border-y border-y-md-0">
               <div class="pt-30 pt-md-25 pb-15 px-5 text-center">
                  <!--begin::Icon-->
                  <div class="d-flex flex-center position-relative mb-25">
                     <span class="svg svg-fill-primary opacity-4 position-absolute">
                        <svg width="175" height="200">
                           <polyline points="87,0 174,50 174,150 87,200 0,150 0,50 87,0"></polyline>
                        </svg>
                     </span>
                     <span class="svg-icon svg-icon-5x svg-icon-primary">
                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Tools/Compass.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                           <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                              <rect x="0" y="0" width="24" height="24"></rect>
                              <path d="M7.07744993,12.3040451 C7.72444571,13.0716094 8.54044565,13.6920474 9.46808594,14.1079953 L5,23 L4.5,18 L7.07744993,12.3040451 Z M14.5865511,14.2597864 C15.5319561,13.9019016 16.375416,13.3366121 17.0614026,12.6194459 L19.5,18 L19,23 L14.5865511,14.2597864 Z M12,3.55271368e-14 C12.8284271,3.53749572e-14 13.5,0.671572875 13.5,1.5 L13.5,4 L10.5,4 L10.5,1.5 C10.5,0.671572875 11.1715729,3.56793164e-14 12,3.55271368e-14 Z" fill="#000000" opacity="0.3"></path>
                              <path d="M12,10 C13.1045695,10 14,9.1045695 14,8 C14,6.8954305 13.1045695,6 12,6 C10.8954305,6 10,6.8954305 10,8 C10,9.1045695 10.8954305,10 12,10 Z M12,13 C9.23857625,13 7,10.7614237 7,8 C7,5.23857625 9.23857625,3 12,3 C14.7614237,3 17,5.23857625 17,8 C17,10.7614237 14.7614237,13 12,13 Z" fill="#000000" fill-rule="nonzero"></path>
                           </g>
                        </svg>
                        <!--end::Svg Icon-->
                     </span>
                  </div>
                  <!--end::Icon-->
                  <!--begin::Content-->
                  <h4 class="font-size-h3 mb-10">{{ $plans['1']['name']}}</h4>
                  <div class="d-flex flex-column line-height-xl mb-10">
                     <span>Monthly Subscribe</span>
                     <span>Auto Subscribe</span>
                  </div>
                  <span class="font-size-h1 d-block font-weight-boldest text-dark">{{ $plans['1']['price']}}<sup class="font-size-h3 font-weight-normal pl-1">$</sup></span>
                  <div class="mt-7">
                     <a href= "{{route('make.payment',$plans['1']['id'])}}">
                        <button type="button" class="btn btn-primary text-uppercase font-weight-bolder px-15 py-3">Subscribe</button>
                     </a>
                  </div>
                  <!--end::Content-->
               </div>
            </div>
          
         </div>
      @else
      <h1 class="text-center">No Plans Found</h1>
      @endif
      </div>
   </div>
</div>
@endsection
@section('stylesheets')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
@endsection