
<!--begin::Header-->
					<div id="kt_header" class="header header-fixed" style="background-color:#F9FAFB !important;">

						<!--begin::Container-->
						<div class="container-fluid d-flex align-items-stretch justify-content-between">
							<div></div>

							<!--begin::Topbar-->
							<div class="topbar">
								
								<!--begin::User-->
								<div class="topbar-item">
									<ul class="navbar-nav ml-auto">
										<li class="nav-item dropdown">
											<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
												Language <span class="caret"></span>
											</a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
												<form action="{{ route('changeLanguage') }}" method="POST">
													@csrf
													<select name="locale" onchange="this.form.submit()">
														@foreach(config('app.locales') as $locale => $name)
															<option value="{{ $locale }}" @if(app()->getLocale() == $locale) selected @endif>{{ $name }}</option>
														@endforeach
													</select>
												</form>
											</div>
										</li>
									</ul>
									<div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
										<span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">Hi,</span>
										<span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
										<span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
											<span class="symbol-label font-size-h5 font-weight-bold">{{ substr( Auth::user()->name, 0, 1) }}</span>
										</span>
									</div>
								</div>

								<!--end::User-->
							</div>

							<!--end::Topbar-->
						</div>

						<!--end::Container-->
					</div>

					<!--end::Header-->