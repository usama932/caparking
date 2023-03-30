
<style>
.menu-link{
    background-color:#004dff !important;
}
.menu-link-active{
    background-color:#fffff !important;
}
</style>
<div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">

    <!--begin::Brand-->
    <div class="brand flex-column-auto" id="kt_brand" style="background-color:#F9FAFB !important;">

        <!--begin::Logo-->
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <img alt="Logo" src="{{ asset($logo) }}"   width="200"/>
            {{-- <h3>Pay Subcription</h3> --}}
        </a>
        
        <!--end::Logo-->

        <!--begin::Toggle-->
        <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
            <span class="svg-icon svg-icon svg-icon-xl">

                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0  24 0" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24" />
                        <path
                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                            fill="#000000" fill-rule="nonzero"
                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)" />
                        <path
                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)" />
                    </g>
                </svg>

                <!--end::Svg Icon-->
            </span>
        </button>

        <!--end::Toolbar-->
    </div>

    <!--end::Brand-->

    <!--begin::Aside Menu-->
    <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper" style="background-color:#004dff !important";>

        <!--begin::Menu Container-->
        <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
            data-menu-dropdown-timeout="500" style="background-color:#004dff !important";>

            <!--begin::Menu Nav-->
            <ul class="menu-nav" >
                @if(auth()->user()->is_admin == 1  && auth()->user()->assign_role == 1  && auth()->user()->user_type == 'admin' )
                <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Book-open.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
                                    <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.dashboard')}}</span>
                     
                    </a>
                </li> 
                <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'roles') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('roles.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">

                         <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Layout/Layout-top-panel-5.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path d="M3,4 L20,4 C20.5522847,4 21,4.44771525 21,5 L21,7 C21,7.55228475 20.5522847,8 20,8 L3,8 C2.44771525,8 2,7.55228475 2,7 L2,5 C2,4.44771525 2.44771525,4 3,4 Z M10,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,13 C21,13.5522847 20.5522847,14 20,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L20,16 C20.5522847,16 21,16.4477153 21,17 L21,19 C21,19.5522847 20.5522847,20 20,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="2" y="10" width="5" height="10" rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white"> {{trans('admin.role&permission')}}</span>
                    </a>
                </li>

                {{-- <li class="menu-item <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'permissions') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('permissions.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                        r="10" />
                                    <path
                                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text text-white">Manage Permissions</span>
                    </a>
                </li> --}}


                <li class="menu-item  <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'Plans') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('plans.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">

                          <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Electric/Washer.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M6,4 C5.44771525,4 5,4.44771525 5,5 L5,8 L19,8 L19,5 C19,4.44771525 18.5522847,4 18,4 L6,4 Z M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,20 C21,21.6568542 19.6568542,23 18,23 L6,23 C4.34314575,23 3,21.6568542 3,20 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,21.5 C15.3137085,21.5 18,18.8137085 18,15.5 C18,12.1862915 15.3137085,9.5 12,9.5 C8.6862915,9.5 6,12.1862915 6,15.5 C6,18.8137085 8.6862915,21.5 12,21.5 Z M7,7 C7.55228475,7 8,6.55228475 8,6 C8,5.44771525 7.55228475,5 7,5 C6.44771525,5 6,5.44771525 6,6 C6,6.55228475 6.44771525,7 7,7 Z M10,7 C10.5522847,7 11,6.55228475 11,6 C11,5.44771525 10.5522847,5 10,5 C9.44771525,5 9,5.44771525 9,6 C9,6.55228475 9.44771525,7 10,7 Z" fill="#000000" fill-rule="nonzero"/>
                                    <path d="M12,19.5 C14.209139,19.5 16,17.709139 16,15.5 C16,13.290861 14.209139,11.5 12,11.5 C9.790861,11.5 8,13.290861 8,15.5 C8,17.709139 9.790861,19.5 12,19.5 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.plans')}}</span>
                    </a>
                </li>

                <li class="menu-item  <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'clients') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('clients.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">

                          <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Building.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M13.5,21 L13.5,18 C13.5,17.4477153 13.0522847,17 12.5,17 L11.5,17 C10.9477153,17 10.5,17.4477153 10.5,18 L10.5,21 L5,21 L5,4 C5,2.8954305 5.8954305,2 7,2 L17,2 C18.1045695,2 19,2.8954305 19,4 L19,21 L13.5,21 Z M9,4 C8.44771525,4 8,4.44771525 8,5 L8,6 C8,6.55228475 8.44771525,7 9,7 L10,7 C10.5522847,7 11,6.55228475 11,6 L11,5 C11,4.44771525 10.5522847,4 10,4 L9,4 Z M14,4 C13.4477153,4 13,4.44771525 13,5 L13,6 C13,6.55228475 13.4477153,7 14,7 L15,7 C15.5522847,7 16,6.55228475 16,6 L16,5 C16,4.44771525 15.5522847,4 15,4 L14,4 Z M9,8 C8.44771525,8 8,8.44771525 8,9 L8,10 C8,10.5522847 8.44771525,11 9,11 L10,11 C10.5522847,11 11,10.5522847 11,10 L11,9 C11,8.44771525 10.5522847,8 10,8 L9,8 Z M9,12 C8.44771525,12 8,12.4477153 8,13 L8,14 C8,14.5522847 8.44771525,15 9,15 L10,15 C10.5522847,15 11,14.5522847 11,14 L11,13 C11,12.4477153 10.5522847,12 10,12 L9,12 Z M14,12 C13.4477153,12 13,12.4477153 13,13 L13,14 C13,14.5522847 13.4477153,15 14,15 L15,15 C15.5522847,15 16,14.5522847 16,14 L16,13 C16,12.4477153 15.5522847,12 15,12 L14,12 Z" fill="#000000"/>
                                    <rect fill="#FFFFFF" x="13" y="8" width="3" height="3" rx="1"/>
                                    <path d="M4,21 L20,21 C20.5522847,21 21,21.4477153 21,22 L21,22.4 C21,22.7313708 20.7313708,23 20.4,23 L3.6,23 C3.26862915,23 3,22.7313708 3,22.4 L3,22 C3,21.4477153 3.44771525,21 4,21 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.companies')}}</span>
                       
                    </a>
                    
                </li>

                {{-- <li class="menu-item <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'contacts') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('contacts.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">

                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24" />
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                        r="10" />
                                    <path
                                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                                        fill="#000000" opacity="0.3" />
                                </g>
                            </svg>

                            <!--end::Svg Icon-->
                        </span>
                        <span class="menu-text">Contracts</span>
                    </a>
                </li>  --}}
                <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'orders') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('orders.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Electric/Socket-eu.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M11,3.05492878 L11,5 C11,5.55228475 11.4477153,6 12,6 C12.5522847,6 13,5.55228475 13,5 L13,3.05492878 C17.4999505,3.55237307 21,7.36744635 21,12 C21,16.6325537 17.4999505,20.4476269 13,20.9450712 L13,19 C13,18.4477153 12.5522847,18 12,18 C11.4477153,18 11,18.4477153 11,19 L11,20.9450712 C6.50004954,20.4476269 3,16.6325537 3,12 C3,7.36744635 6.50004954,3.55237307 11,3.05492878 Z M8.5,13 C9.32842712,13 10,12.3284271 10,11.5 C10,10.6715729 9.32842712,10 8.5,10 C7.67157288,10 7,10.6715729 7,11.5 C7,12.3284271 7.67157288,13 8.5,13 Z M15.5,13 C16.3284271,13 17,12.3284271 17,11.5 C17,10.6715729 16.3284271,10 15.5,10 C14.6715729,10 14,10.6715729 14,11.5 C14,12.3284271 14.6715729,13 15.5,13 Z" fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.orders')}}</span>
                    </a>
                </li>
                <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'setting') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('setting.index') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                           <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Tools/Tools.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M15.9497475,3.80761184 L13.0246125,6.73274681 C12.2435639,7.51379539 12.2435639,8.78012535 13.0246125,9.56117394 L14.4388261,10.9753875 C15.2198746,11.7564361 16.4862046,11.7564361 17.2672532,10.9753875 L20.1923882,8.05025253 C20.7341101,10.0447871 20.2295941,12.2556873 18.674559,13.8107223 C16.8453326,15.6399488 14.1085592,16.0155296 11.8839934,14.9444337 L6.75735931,20.0710678 C5.97631073,20.8521164 4.70998077,20.8521164 3.92893219,20.0710678 C3.1478836,19.2900192 3.1478836,18.0236893 3.92893219,17.2426407 L9.05556629,12.1160066 C7.98447038,9.89144078 8.36005124,7.15466739 10.1892777,5.32544095 C11.7443127,3.77040588 13.9552129,3.26588995 15.9497475,3.80761184 Z" fill="#000000"/>
                                    <path d="M16.6568542,5.92893219 L18.0710678,7.34314575 C18.4615921,7.73367004 18.4615921,8.36683502 18.0710678,8.75735931 L16.6913928,10.1370344 C16.3008685,10.5275587 15.6677035,10.5275587 15.2771792,10.1370344 L13.8629656,8.7228208 C13.4724413,8.33229651 13.4724413,7.69913153 13.8629656,7.30860724 L15.2426407,5.92893219 C15.633165,5.5384079 16.26633,5.5384079 16.6568542,5.92893219 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.Settings')}}</span>
                    </a>
                </li>
                @endif
                @if(auth()->user()->is_admin == 1  && auth()->user()->assign_role == 2  && auth()->user()->user_type == 'company' )
                <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'dashboard') {
                    echo 'menu-item-active';
                    } ?>" aria-haspopup="true">
                    <a href="{{ route('admin.dashboard') }}" class="menu-link">
                        <span class="svg-icon menu-icon">
                              <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Home/Book-open.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z" fill="#000000"/>
                                    <path d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z" fill="#000000" opacity="0.3"/>
                                </g>
                            </svg><!--end::Svg Icon--></span>
                        </span>
                        <span class="menu-text text-white">{{trans('admin.dashboard')}}</span>
                    </a>
                </li>
                    @if(auth()->user()->order)
                       
                        @if(auth()->user()->order->plan_name == 'Premium') 
                            <li class="menu-item  text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'users') {
                                echo 'menu-item-active';
                                } ?>" aria-haspopup="true">
                                <a href="{{ route('users.index') }}" class="menu-link">
                                    <span class="svg-icon menu-icon">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Food/Orange.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path d="M12,19 C15.8659932,19 19,15.8659932 19,12 C19,8.13400675 15.8659932,5 12,5 C8.13400675,5 5,8.13400675 5,12 C5,15.8659932 8.13400675,19 12,19 Z M12,21 C7.02943725,21 3,16.9705627 3,12 C3,7.02943725 7.02943725,3 12,3 C16.9705627,3 21,7.02943725 21,12 C21,16.9705627 16.9705627,21 12,21 Z" fill="#000000" fill-rule="nonzero"/>
                                                <path d="M12,9.66666667 C11.3333333,8.64514991 11,7.88126102 11,7.375 C11,6.61560847 11.4477153,6 12,6 C12.5522847,6 13,6.61560847 13,7.375 C13,7.88126102 12.6666667,8.64514991 12,9.66666667 Z M12,14 C12.6666667,15.0215168 13,15.7854056 13,16.2916667 C13,17.0510582 12.5522847,17.6666667 12,17.6666667 C11.4477153,17.6666667 11,17.0510582 11,16.2916667 C11,15.7854056 11.3333333,15.0215168 12,14 Z M14.3333333,12 C15.3548501,11.3333333 16.118739,11 16.625,11 C17.3843915,11 18,11.4477153 18,12 C18,12.5522847 17.3843915,13 16.625,13 C16.118739,13 15.3548501,12.6666667 14.3333333,12 Z M10,12 C8.97848324,12.6666667 8.21459435,13 7.70833333,13 C6.9489418,13 6.33333333,12.5522847 6.33333333,12 C6.33333333,11.4477153 6.9489418,11 7.70833333,11 C8.21459435,11 8.97848324,11.3333333 10,12 Z M13.6499158,10.3500842 C13.9008327,9.15635823 14.2052815,8.38050496 14.5632621,8.02252436 C15.100233,7.48555345 15.8521164,7.36683502 16.2426407,7.75735931 C16.633165,8.1478836 16.5144465,8.89976702 15.9774756,9.43673792 C15.619495,9.79471852 14.8436418,10.0991673 13.6499158,10.3500842 Z M10.5857864,13.4142136 C10.3348695,14.6079395 10.0304208,15.3837928 9.67244018,15.7417734 C9.13546928,16.2787443 8.38358587,16.3974627 7.99306157,16.0069384 C7.60253728,15.6164141 7.72125572,14.8645307 8.25822662,14.3275598 C8.61620722,13.9695792 9.39206049,13.6651305 10.5857864,13.4142136 Z M13.6499158,13.6499158 C14.8436418,13.9008327 15.619495,14.2052815 15.9774756,14.5632621 C16.5144465,15.100233 16.633165,15.8521164 16.2426407,16.2426407 C15.8521164,16.633165 15.100233,16.5144465 14.5632621,15.9774756 C14.2052815,15.619495 13.9008327,14.8436418 13.6499158,13.6499158 Z M10.5857864,10.5857864 C9.39206049,10.3348695 8.61620722,10.0304208 8.25822662,9.67244018 C7.72125572,9.13546928 7.60253728,8.38358587 7.99306157,7.99306157 C8.38358587,7.60253728 9.13546928,7.72125572 9.67244018,8.25822662 C10.0304208,8.61620722 10.3348695,9.39206049 10.5857864,10.5857864 Z" fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg><!--end::Svg Icon--></span>
                                    </span>
                                    <span class="menu-text text-white">{{trans('admin.users')}}</span>
                                </a>
                            </li>
                        @endif
                        <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'contact_types') {
                            echo 'menu-item-active';
                            } ?>" aria-haspopup="true">
                            <a href="{{ route('contact_types.index') }}" class="menu-link">
                                <span class="svg-icon menu-icon">

                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Layout/Layout-top-panel-1.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" x="2" y="4" width="19" height="4" rx="1"/>
                                            <path d="M3,10 L6,10 C6.55228475,10 7,10.4477153 7,11 L7,19 C7,19.5522847 6.55228475,20 6,20 L3,20 C2.44771525,20 2,19.5522847 2,19 L2,11 C2,10.4477153 2.44771525,10 3,10 Z M10,10 L13,10 C13.5522847,10 14,10.4477153 14,11 L14,19 C14,19.5522847 13.5522847,20 13,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M17,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,19 C21,19.5522847 20.5522847,20 20,20 L17,20 C16.4477153,20 16,19.5522847 16,19 L16,11 C16,10.4477153 16.4477153,10 17,10 Z" fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>
                                </span>
                                <span class="menu-text text-white">{{trans('admin.contract_type')}}</span>
                            </a>
                        </li>
                        <li class="menu-item text-white <?php if (Request::segment(1) == 'admin' && Request::segment(2) == 'contacts') {
                            echo 'menu-item-active';
                            } ?>" aria-haspopup="true">
                            <a href="{{ route('contacts.index') }}" class="menu-link">
                                <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/Layout/Layout-top-panel-5.svg--><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path d="M3,4 L20,4 C20.5522847,4 21,4.44771525 21,5 L21,7 C21,7.55228475 20.5522847,8 20,8 L3,8 C2.44771525,8 2,7.55228475 2,7 L2,5 C2,4.44771525 2.44771525,4 3,4 Z M10,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,13 C21,13.5522847 20.5522847,14 20,14 L10,14 C9.44771525,14 9,13.5522847 9,13 L9,11 C9,10.4477153 9.44771525,10 10,10 Z M10,16 L20,16 C20.5522847,16 21,16.4477153 21,17 L21,19 C21,19.5522847 20.5522847,20 20,20 L10,20 C9.44771525,20 9,19.5522847 9,19 L9,17 C9,16.4477153 9.44771525,16 10,16 Z" fill="#000000"/>
                                            <rect fill="#000000" opacity="0.3" x="2" y="10" width="5" height="10" rx="1"/>
                                        </g>
                                    </svg><!--end::Svg Icon--></span>
                                </span>
                                <span class="menu-text text-white">{{trans('admin.contract')}}</span>
                            </a>
                        </li>
                    @endif
                @endif
            </ul>

            <!--end::Menu Nav-->
        </div>

        <!--end::Menu Container-->
    </div>

    <!--end::Aside Menu-->
</div>

<!--end::Aside-->
