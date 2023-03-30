@extends('client.layouts.master')
@section('title',$title)
@section('content')
<!--begin::Entry-->
	<div class="d-flex flex-column-fluid">
		<!--begin::Container-->
		<div class="container">
			<div id="cardbody" class="card card-custom">



			<div class="card-spacer mt-3">
				<!--begin::Row-->
			
				<div class="row m-0">
					<div class="col bg-light-warning px-6 py-8 rounded-xl mr-3 mb-7">
						<span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">
							<!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Add-user.svg-->
							<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
								<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
									<rect x="0" y="0" width="24" height="24" />
									<path d="M10.5,5 L20.5,5 C21.3284271,5 22,5.67157288 22,6.5 L22,9.5 C22,10.3284271 21.3284271,11 20.5,11 L10.5,11 C9.67157288,11 9,10.3284271 9,9.5 L9,6.5 C9,5.67157288 9.67157288,5 10.5,5 Z M10.5,13 L20.5,13 C21.3284271,13 22,13.6715729 22,14.5 L22,17.5 C22,18.3284271 21.3284271,19 20.5,19 L10.5,19 C9.67157288,19 9,18.3284271 9,17.5 L9,14.5 C9,13.6715729 9.67157288,13 10.5,13 Z" fill="#000000" />
									<rect fill="#000000" opacity="0.3" x="2" y="5" width="5" height="14" rx="1" />
								</g>
							</svg>
							<!--end::Svg Icon-->
						</span>
						<a href="#" class="text-warning font-weight-bold font-size-h6">Contracts: </a>
						<a href="#" class="text-warning font-weight-bold ">{{$contracts ?? '0'}}</a>
						</svg>
					</div>

					
					
				</div>
			
			
			</div>





		</div>
		
		</div>
		<!--end::Container-->
	</div>
	<!--end::Entry-->
@endsection
