<div class="card mb-5 mb-xl-10">
    <div class="card-body pt-9 pb-0">
        <!--begin::Details-->
        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
            <!--begin: Pic-->
            <div class="me-7 mb-4">
                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                    <img src="{{ asset('storage/'.auth()->user()->profile_picture) }}" alt="image">
                    <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div>
                </div>
            </div>
            <!--end::Pic-->
            <!--begin::Info-->
            <div class="flex-grow-1">
                <!--begin::Title-->
                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                    <!--begin::User-->
                    <div class="d-flex flex-column">
                        <!--begin::Name-->
                        <div class="d-flex align-items-center me-5 mb-2">
                            <span class="text-gray-900 text-hover-primary fs-2 fw-bold me-1">{{ ucfirst(auth()->user()->first_name) }} {{ ucfirst(auth()->user()->last_name ) }}</span>
                        </div>
                        <!--end::Name-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap fw-semibold fs-6">
                            <div class="py-5">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="font-weight-bold mr-2 me-5 w-100px">Email:</span>
                                    <span class="pe-2 text-muted text-hover-primary">{{ auth()->user()->email }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="font-weight-bold mr-2 me-5 w-100px">Phone:</span>
                                    <span class="text-muted">{{ auth()->user()->phone_number ?? '-' }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="font-weight-bold mr-2 me-5 w-100px">DOB:</span>
                                    <span class="text-muted">{{ auth()->user()->dob ?? '-' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::User-->
                </div>
                <!--end::Title-->
            </div>
            <!--end::Info-->
        </div>
        <!--end::Details-->
        <!--begin::Navs-->
        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bold">
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::currentRouteName() ==  'user.profile.overview' ? 'active' : ''}}" href="{{ route('user.profile.overview') }}">Overview</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::currentRouteName() ==  'user.profile.edit' ? 'active' : ''}}" href="{{ route('user.profile.edit') }}">Edit Profile</a>
            </li>
            <!--end::Nav item-->
            <!--begin::Nav item-->
            <li class="nav-item mt-2">
                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{ Route::currentRouteName() ==  'user.change-password' ? 'active' : ''}}" href="{{ route('user.change-password') }}">Change Password</a>
            </li>
            <!--end::Nav item-->
        </ul>
        <!--begin::Navs-->
    </div>
</div>
