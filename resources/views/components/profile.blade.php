 <!--begin::User menu-->
 <div class="app-navbar-item ms-1 ms-md-3" id="kt_header_user_menu_toggle">
    <!--begin::Menu wrapper-->
    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
        data-kt-menu-trigger="{default: 'click', lg: 'hover'}" data-kt-menu-attach="parent"
        data-kt-menu-placement="bottom-end">
        @if(auth()->user()->profile_picture != null)
            <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="image">
        @else
            <span class="symbol-label fs-2x fw-semibold text-primary bg-light-success">{{ auth()->user()->first_name[0]}}</span>
        @endif
    </div>
    <!--begin::User account menu-->
    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
        data-kt-menu="true">
        <!--begin::Menu item-->
        <div class="menu-item px-3">
            <div class="menu-content d-flex align-items-center px-3">
                <!--begin::Avatar-->
                <div class="symbol symbol-50px me-5">
                    @if(auth()->user()->profile_picture != null)
                        <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="image">
                    @else
                        <span class="symbol-label fs-2x fw-semibold text-primary bg-light-success">{{ auth()->user()->first_name[0]}}</span>
                    @endif
                </div>
                <!--end::Avatar-->
                <!--begin::Username-->
                <div class="d-flex flex-column">
                    <div class="fw-bold d-flex align-items-center fs-5">{{ ucfirst(auth()->user()->first_name) }} {{ ucfirst(auth()->user()->last_name) }}
                        <span
                            class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2"></span>
                    </div>
                    <span class="fw-semibold text-muted text-hover-primary fs-7">{{ auth()->user()->email }}</span>
                </div>
                <!--end::Username-->
            </div>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="{{ route('users.profile.overview') }}" class="menu-link px-5">My Profile</a>
        </div>
        <!--end::Menu item-->
        <!--begin::Menu separator-->
        <div class="separator my-2"></div>
        <!--end::Menu separator-->
        <!--begin::Menu item-->
        <div class="menu-item px-5">
            <a href="{{ route('logout') }}"
                class="menu-link px-5">Sign Out</a>
        </div>
        <!--end::Menu item-->
    </div>
    <!--end::User account menu-->
    <!--end::Menu wrapper-->
</div>
<!--end::User menu-->
