@extends('layouts.app')

@section('styles')
    <link href="{{ asset('assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!--begin::Content wrapper-->
    <div class="d-flex flex-column flex-column-fluid">
        <!--begin::Toolbar-->
        <div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-4">
            <!--begin::Toolbar container-->
            <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
                <!--begin::Page title-->
                <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
                    <!--begin::Title-->
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Account
                        Overview</h1>
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
                            <a href="{{ route('roles.index') }}" class="text-muted text-hover-primary">Role</a>
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
            <x-back-button href="{{ route('roles.index') }}"></x-back-button>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
        <div id="kt_app_content" class="app-content flex-column-fluid">
            <div class="app-container container-xxl pb-6">
                <div class="card h-lg-100">
                    <div class="card-header d-flex align-items-center" id="kt_chat_contacts_header">

                        <div class="card-title">
                            <h2>Role Details</h2>
                        </div>

                    </div>
                    <div class="card-body pt-10">
                        <div class="row mb-7">

                            <label class="col-lg-4 fs-4 fw-semibold text-muted">Role Name</label>


                            <div class="col-lg-8">
                                <span class="fw-bold fs-4 text-gray-800">{{ isset($role) ? $role->name : '' }}</span>
                            </div>

                        </div>
                        <div class="row mb-7">

                            <label class="col-lg-4 fs-4 fw-semibold text-muted">Permissions</label>


                            <div class="col-lg-8">
                                <span class="fw-bold fs-6 fa-rotate-90 text-gray-800" id="view-permissions">
                                    @isset($rolePermission)
                                        @foreach($rolePermission as $permission)
                                            <span class="badge badge-light-success fs-6 px-5 py-4 me-4 mb-4">
                                                {{ $permission->name }}
                                            </span>
                                        @endforeach
                                    @endisset
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Content wrapper-->
@endsection
