@extends('layouts.app')

@section('styles')
    <style>
        .box {
            padding: 15px 20px;
            border: 1px solid #E5EAEE;
            border-radius: 0.42rem;
            margin: 10px 0;
        }
    </style>
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
                        <li class="breadcrumb-item text-muted">Create</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
            <x-back-button href="{{ route('roles.index') }}"></x-back-button>
        </div>
        <!--end::Toolbar-->

        <div id="kt_app_content" class="app-content flex-column-fluid">
            <!--begin::Content container-->
            <div id="kt_app_content_container" class="app-container container-xxl">
                <!--begin::Layout-->
                <div class="d-flex flex-column flex-lg-row">
                    <!--begin::Content-->
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">
                                <!--begin::Form-->
                                <form action="{{ route('roles.create') }}" id="role_and_permission" class="role_and_permission" method="POST">
                                    @csrf
                                    <div class="row mb-8">

                                        <div class="col-xl-2">
                                            <label class="required fs-6 fw-semibold mt-2 mb-3">Role Name </label>
                                        </div>


                                        <div class="col-xl-10 fv-row fv-plugins-icon-container">

                                            <input type="text" class="form-control form-control-solid"
                                                placeholder="Enter Role Name" name="name" value="{{ old('name') }}">
                                            <span class="text-danger" id="role_name" ></span>
                                        </div>
                                    </div>
                                    <!--begin::Separator-->
                                    <div class="separator separator-dashed my-10"></div>
                                    <!--end::Separator-->
                                    <div class="row mb-7">

                                        <div class="col-xl-2">
                                            <label class="required fs-5 fw-semibold mb-2">Permissions </label>
                                        </div>


                                        <div class="col-xl-10 fv-row fv-plugins-icon-container">
                                            <div class="form-group">
                                                <label for="" class="form-check fw-bold text-gray-900 my-2">
                                                    <input type="checkbox" id="select-all" class="form-check-input">
                                                    Select All
                                                </label>
                                            </div>
                                            @isset($permissions)
                                                @foreach ($permissions as $group => $permission)
                                                    <div class="form-group box">
                                                        <div class="checkbox-header d-flex justify-content-between align-items-center ">
                                                            <label for="" class="fs-6 fw-bold ">
                                                                {{ $group }} {{ __('Management ') }}
                                                            </label>
                                                            <label for="" class="form-check fs-6 fw-bold text-gray-900 my-2 ">
                                                            <input type="checkbox" id="select-all_{{ $group }}" data-group="user" class="form-check-input select-by-group">
                                                            Select All
                                                            </label>
                                                        </div>
                                                        <div class="col-9 col-form-label">
                                                            <div class="checkbox-list">
                                                                @foreach ($permission as $value)
                                                                    <label class="checkbox text-gray-900 me-5 my-2 checkbox-success">
                                                                        <input type="checkbox" name="permissions[]" class="form-check-input permission_{{ $group }}" value="{{ $value['id'] }}"/>
                                                                        <span>{{ $value['name'] }}</span>
                                                                    </label>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endisset
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <x-button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</x-button>
                                        <x-button type="submit" class="btn btn-primary" id="btn_role_and_permission">Save Changes</x-button>
                                    </div>
                                </div>
                            </form>
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
        <!--end::Content container-->
    </div>
    </div>
    <!--end::Content wrapper-->
@endsection

@section('script')
<script src="{{ asset('assets/js/roles/validation.js') }}"></script>
    <script>
        $(document).ready(function() {
            var permissions = '{!! json_encode($permissions) !!}';
            // select-all permission with all groups
            $.each(JSON.parse(permissions), function(keys, values) {
                $(`#select-all`).click(function() {
                    if (this.checked) {
                        $(`.permission_${keys}`).each(function() {
                            $(`.permission_${keys}`).prop('checked', true);
                        })
                    } else {
                        $(`.permission_${keys}`).each(function() {
                            $(`.permission_${keys}`).prop('checked', false);
                        })
                    }

                    if ($(`.permission_${keys}`).length == $(`.permission_${keys}:checked`)
                        .length) {
                        $(`#select-all_${keys}`).prop("checked", true);

                    } else {
                        $(`#select-all_${keys}`).prop("checked", false);
                    }
                });

                //select-all permission as per the group
                $.each(values, function(key, value) {

                    if ($(`.permission_${keys}`).length == $(`.permission_${keys}:checked`)
                        .length) {
                        $(`#select-all_${keys}`).prop("checked", true);
                    }
                    $(`#select-all_${keys}`).click(function() {
                        if (this.checked) {
                            $(`.permission_${keys}`).each(function() {
                                $(`.permission_${keys}`).prop('checked', true);
                            })
                        } else {
                            $(`.permission_${keys}`).each(function() {
                                $(`.permission_${keys}`).prop('checked', false);
                            })

                            $('#select-all').prop("checked", false);
                        }

                    });

                    //checked select all and select-group-by-option as per the change permission
                    $(`.permission_${keys}`).change(function() {
                        if ($('.select-by-group').length == $('.select-by-group:checked')
                            .length) {
                            $('#select-all').prop("checked", true);
                        } else {
                            $('#select-all').prop("checked", false);
                        }

                        if ($(`.permission_${keys}`).length == $(
                                `.permission_${keys}:checked`).length) {
                            $(`#select-all_${keys}`).prop("checked", true);
                        } else {
                            $(`#select-all_${keys}`).prop("checked", false);
                        }
                    });

                    //checked select all and select-group-by-option as per the change select-group-by option
                    $(`#select-all_${keys}`).change(function() {
                        if ($('.select-by-group').length == $('.select-by-group:checked')
                            .length) {
                            $('#select-all').prop("checked", true);
                        } else {
                            $('#select-all').prop("checked", false);
                        }
                    });

                });
            });
        });
    </script>
@endsection
