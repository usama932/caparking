@extends('layouts.auth')
@section('content')
	<?php
	$setting = \App\Models\Setting::pluck('value','name')->toArray();
	$auth_logo = isset($setting['auth_logo']) ? 'uploads/'.$setting['auth_logo'] : 'assets/media/logos/logo-light.png';
	$auth_page_heading = isset($setting['auth_page_heading']) ? $setting['auth_page_heading'] : '';
	$auth_image = isset($setting['auth_image']) ? 'uploads/'.$setting['auth_image'] : 'assets/media/svg/illustrations/login-visual-1.svg';
	$copy_right = isset($setting['copy_right']) ? $setting['copy_right'] : 'com';
	?>
	<div class="d-flex flex-column flex-root">
		<!--begin::Login-->
		<div class="login login-1 login-signin-on d-flex flex-column flex-lg-row flex-column-fluid bg-white" id="kt_login">
			<!--begin::Aside-->
			<div class="login-aside d-flex flex-column flex-row-auto" style="background-color: #F2C98A;">
				<!--begin::Aside Top-->
				<div class="d-flex flex-column-auto flex-column pt-lg-40 pt-15">
					<!--begin::Aside header-->
					<a href="#" class="text-center mb-10">
						<img src="{{ asset($auth_logo) }}" class="max-h-70px" alt="" />
					</a>
					<!--end::Aside header-->
					<!--begin::Aside title-->
					<h3 class="font-weight-bolder text-center font-size-h4 font-size-h1-lg" style="color: #986923;"><?php echo stripcslashes($auth_page_heading )?></h3>
					<!--end::Aside title-->
				</div>
				<!--end::Aside Top-->
				<!--begin::Aside Bottom-->
				<div class="aside-img d-flex flex-row-fluid bgi-no-repeat bgi-position-y-bottom bgi-position-x-center"
				     style="background-image: url({{ asset($auth_image) }})"></div>
				<!--end::Aside Bottom-->
			</div>
			<!--begin::Aside-->
			<!--begin::Content-->
			<div class="login-content flex-row-fluid d-flex flex-column justify-content-center position-relative overflow-hidden p-7 mx-auto" >
				<!--begin::Content body-->
				<div class="d-flex flex-column-fluid flex-center">
					<!--begin::Signin-->
					<div class="login-form login-signin">
					
                        <form method="POST" action="{{ route('register.compnay') }}">
                        @csrf
                            <div class="pb-13 pt-lg-0 pt-5">
								<h3 class="font-weight-bolder text-dark font-size-h4 font-size-h1-lg">
									Welcome to  Dashboard Portal</h3>
								{{--<span class="text-muted font-weight-bold font-size-h4">New Here?
									<a href="javascript:;" id="kt_login_signup" class="text-primary font-weight-bolder">Create an Account</a></span>--}}
								@if (Session::has('error'))
									<h5 style="color: red"><strong>{{ Session::get('error') }}</strong></h5>
								@endif
							</div>
                        <div class="form-group ">
                            <label for="name" class="font-size-h6 font-weight-bolder text-dark">{{ __('Name') }}</label>

                          
                                <input id="name" type="text" class=" form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group ">
                            <label for="email" class="font-size-h6 font-weight-bolder text-dark">{{ __('E-Mail Address') }}</label>

                          
                                <input id="email" type="email" class=" form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                        </div>

                        <div class="form-group ">
                            <label for="password" class="font-size-h6 font-weight-bolder text-dark">{{ __('Password') }}</label>

                          
                                <input id="password" type="password" class=" form-control form-control-solid h-auto py-6 px-6 rounded-lg @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>

                        <div class="form-group ">
                            <label for="password-confirm" class="font-size-h6 font-weight-bolder text-dark">{{ __('Confirm Password') }}</label>

                            
                                <input id="password-confirm" type="password" class=" form-control form-control-solid h-auto py-6 px-6 rounded-lg" name="password_confirmation" required autocomplete="new-password">
                            
                        </div>

                        <div class="form-group ">
							<div class="col-md-12 text-center" style="background-color:#004DFF !important;  border-radius: 25px;">
								<button type="submit" class="btn btn-primary" style="background-color:#004DFF !important;  border: 0px;" >   {{ __('Register') }}</button>
							
							</div>
                        </div>
                    </form>
                    <div class="text-center">
						<strong  class="text-black">Already have an account. <a href="{{route('login')}}">(Login)</a></strong></div>
						
					</div>
					
				</div>

			</div>
			<!--end::Content-->
		</div>
		<!--end::Login-->
	</div>
@endsection
