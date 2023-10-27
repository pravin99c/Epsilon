@extends('layouts.app')

@section('content')
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-4">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Users</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('dashboard') }}" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            >>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="{{ route('users.view') }}" class="text-muted text-hover-primary">Users</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            >>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">View</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
            <x-back-button href="{{ route('users.view') }}"></x-back-button>
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-5 mb-lg-0">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-10">
                                <!--begin::Form-->
                                <div class="row">
                                    <h1>User Details</h1>
                                </div>
                                <!--begin::Separator-->
                                <div class="separator separator-dashed my-5"></div>
                                <!--end::Separator-->
                                <div class="card-body pt-5">
                                    <div class="row mb-7">
                                        <div class="col-lg-4">
                                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                                @if($user->profile_picture != null)
                                                    <img src="/storage/{{ $user->profile_picture ?? '' }}"
                                                    alt="image">
                                                    <div
                                                        class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px">
                                                    </div>
                                                @else
                                                    <span class="symbol-label fs-5x fw-semibold text-primary bg-light-success">{{ $user->first_name[0] }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">First Name</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->first_name }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">Last Name</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->last_name }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">Email</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->email }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">Phone</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->phone_number }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">Date of Birth</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->dob }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4 fs-5 fw-semibold text-muted">Gender</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5 text-gray-800">{{ $user->gender }}</span>
                                        </div>

                                    </div>
                                    <div class="row mb-7">

                                        <label class="col-lg-4  fs-5 fw-semibold text-muted">Role</label>


                                        <div class="col-lg-8">
                                            <span class="fw-bold fs-5  fa-rotate-90 text-gray-800" id="">
                                                <span class="btn btn-sm btn-light-primary" style="pointer-events: none;">
                                                    {{ $user->roles[0]->name }}
                                                </span>
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>

                            <!--end::Form-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Layout-->
        </div>
    </div>
@endsection
