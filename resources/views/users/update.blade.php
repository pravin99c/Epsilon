@extends('layouts.app')

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
                        <li class="breadcrumb-item text-muted">Update</li>
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
                    <div class="flex-lg-row-fluid mb-10 mb-lg-0">
                        <!--begin::Card-->
                        <div class="card">
                            <!--begin::Card body-->
                            <div class="card-body p-12">
                                <!--begin::Form-->
                                <div class="row">
                                    <h1>Update User</h1>
                                </div>
                                 <!--begin::Separator-->
                                 <div class="separator separator-dashed my-10"></div>
                                 <!--end::Separator-->
                                <form action="{{ route('users.update', encrypt($user->id)) }}" id="users_update_form" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label required fw-semibold fs-6">Full Name</label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-10">
                                            <!--begin::Row-->
                                            <div class="row">
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="first_name" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0 text-input" placeholder="First name" value="{{ isset($user) ? $user->first_name : old('first_name') }}">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                                <!--end::Col-->
                                                <!--begin::Col-->
                                                <div class="col-lg-6 fv-row fv-plugins-icon-container">
                                                    <input type="text" name="last_name" class="form-control form-control-lg form-control-solid text-input" placeholder="Last name" value="{{ isset($user) ? $user->last_name : old('last_name') }}">
                                                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                                <!--end::Col-->
                                            </div>
                                            <!--end::Row-->
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                            <span class="required">Email</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                            <input type="email" name="email" class="form-control form-control-lg form-control-solid text-input" placeholder="Email Address" value="{{ isset($user) ? $user->email : old('email') }}" autocomplete="off" readonly>
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                            <span class="required">Contact Phone</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" aria-label="Phone number must be active" data-bs-original-title="Phone number must be active" data-kt-initialized="1"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-10 fv-row fv-plugins-icon-container">
                                            <input type="tel" name="phone_number" class="form-control form-control-lg form-control-solid text-input" placeholder="Phone Number" value="{{ isset($user) ? $user->phone_number : old('phone_number') }}">
                                        <div class="fv-plugins-message-container invalid-feedback"></div></div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                            <span class="required">Date of Birth</span>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-10 fv-row">
                                            <div class="position-relative d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen014.svg-->
                                                <span class="svg-icon position-absolute ms-4 mb-1 svg-icon-2">
                                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.3" d="M21 22H3C2.4 22 2 21.6 2 21V5C2 4.4 2.4 4 3 4H21C21.6 4 22 4.4 22 5V21C22 21.6 21.6 22 21 22Z" fill="currentColor"></path>
                                                        <path d="M6 6C5.4 6 5 5.6 5 5V3C5 2.4 5.4 2 6 2C6.6 2 7 2.4 7 3V5C7 5.6 6.6 6 6 6ZM11 5V3C11 2.4 10.6 2 10 2C9.4 2 9 2.4 9 3V5C9 5.6 9.4 6 10 6C10.6 6 11 5.6 11 5ZM15 5V3C15 2.4 14.6 2 14 2C13.4 2 13 2.4 13 3V5C13 5.6 13.4 6 14 6C14.6 6 15 5.6 15 5ZM19 5V3C19 2.4 18.6 2 18 2C17.4 2 17 2.4 17 3V5C17 5.6 17.4 6 18 6C18.6 6 19 5.6 19 5Z" fill="currentColor"></path>
                                                        <path d="M8.8 13.1C9.2 13.1 9.5 13 9.7 12.8C9.9 12.6 10.1 12.3 10.1 11.9C10.1 11.6 10 11.3 9.8 11.1C9.6 10.9 9.3 10.8 9 10.8C8.8 10.8 8.59999 10.8 8.39999 10.9C8.19999 11 8.1 11.1 8 11.2C7.9 11.3 7.8 11.4 7.7 11.6C7.6 11.8 7.5 11.9 7.5 12.1C7.5 12.2 7.4 12.2 7.3 12.3C7.2 12.4 7.09999 12.4 6.89999 12.4C6.69999 12.4 6.6 12.3 6.5 12.2C6.4 12.1 6.3 11.9 6.3 11.7C6.3 11.5 6.4 11.3 6.5 11.1C6.6 10.9 6.8 10.7 7 10.5C7.2 10.3 7.49999 10.1 7.89999 10C8.29999 9.90003 8.60001 9.80003 9.10001 9.80003C9.50001 9.80003 9.80001 9.90003 10.1 10C10.4 10.1 10.7 10.3 10.9 10.4C11.1 10.5 11.3 10.8 11.4 11.1C11.5 11.4 11.6 11.6 11.6 11.9C11.6 12.3 11.5 12.6 11.3 12.9C11.1 13.2 10.9 13.5 10.6 13.7C10.9 13.9 11.2 14.1 11.4 14.3C11.6 14.5 11.8 14.7 11.9 15C12 15.3 12.1 15.5 12.1 15.8C12.1 16.2 12 16.5 11.9 16.8C11.8 17.1 11.5 17.4 11.3 17.7C11.1 18 10.7 18.2 10.3 18.3C9.9 18.4 9.5 18.5 9 18.5C8.5 18.5 8.1 18.4 7.7 18.2C7.3 18 7 17.8 6.8 17.6C6.6 17.4 6.4 17.1 6.3 16.8C6.2 16.5 6.10001 16.3 6.10001 16.1C6.10001 15.9 6.2 15.7 6.3 15.6C6.4 15.5 6.6 15.4 6.8 15.4C6.9 15.4 7.00001 15.4 7.10001 15.5C7.20001 15.6 7.3 15.6 7.3 15.7C7.5 16.2 7.7 16.6 8 16.9C8.3 17.2 8.6 17.3 9 17.3C9.2 17.3 9.5 17.2 9.7 17.1C9.9 17 10.1 16.8 10.3 16.6C10.5 16.4 10.5 16.1 10.5 15.8C10.5 15.3 10.4 15 10.1 14.7C9.80001 14.4 9.50001 14.3 9.10001 14.3C9.00001 14.3 8.9 14.3 8.7 14.3C8.5 14.3 8.39999 14.3 8.39999 14.3C8.19999 14.3 7.99999 14.2 7.89999 14.1C7.79999 14 7.7 13.8 7.7 13.7C7.7 13.5 7.79999 13.4 7.89999 13.2C7.99999 13 8.2 13 8.5 13H8.8V13.1ZM15.3 17.5V12.2C14.3 13 13.6 13.3 13.3 13.3C13.1 13.3 13 13.2 12.9 13.1C12.8 13 12.7 12.8 12.7 12.6C12.7 12.4 12.8 12.3 12.9 12.2C13 12.1 13.2 12 13.6 11.8C14.1 11.6 14.5 11.3 14.7 11.1C14.9 10.9 15.2 10.6 15.5 10.3C15.8 10 15.9 9.80003 15.9 9.70003C15.9 9.60003 16.1 9.60004 16.3 9.60004C16.5 9.60004 16.7 9.70003 16.8 9.80003C16.9 9.90003 17 10.2 17 10.5V17.2C17 18 16.7 18.4 16.2 18.4C16 18.4 15.8 18.3 15.6 18.2C15.4 18.1 15.3 17.8 15.3 17.5Z" fill="currentColor"></path>
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                <input class="form-control form-control-solid ps-12 flatpickr-input active text-input" name="dob" placeholder="Pick a date" id="date_of_birth" type="text" readonly="readonly" value="{{ isset($user) ? $user->dob : old('dob') }}">
                                                @error('dob')
                                                    <x-input-label for="dob" :value="$message"> </x-input-label>
                                                @enderror
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                            <span class="required">Gender</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Gender"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->
                                        <div class="col-lg-10 fv-row">
                                            <select name="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid form-select-lg fw-semibold select-input" onchange="handleSelectChange(this,0)">
                                                <option value="">Select a Gender...</option>
                                                <option value="Male" @if($user->gender == 'Male') selected @endif>Male</option>
                                                <option value="Female" @if($user->gender == 'Female') selected @endif>Female</option>
                                                <option value="Other" @if($user->gender == 'Other') selected @endif>Other</option>
                                            </select>
                                            @error('gender')
                                                <x-input-label for="gender" :value="$message"> </x-input-label>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                    </div>

                                    <div class="row mb-6">
                                        <!--begin::Label-->
                                        <label class="col-lg-2 col-form-label fw-semibold fs-6">
                                            <span class="required">Role</span>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Gender"></i>
                                        </label>
                                        <!--end::Label-->
                                        <!--begin::Col-->

                                        <div class="col-lg-10 fv-row">
                                            <select name="role" id="role" aria-label="Select a Role" data-control="select2" data-placeholder="Select a Role..." class="form-select form-select-solid form-select-lg fw-semibold select-input" onchange="handleSelectChange(this,1)">
                                                <option value="">Select a Role...</option>
                                                @isset($roles)
                                                    @foreach($roles as $role)
                                                        <option value="{{ $role->id }}" @if($user->roles[0]->id == $role->id) selected @endif>{{ $role->name }}</option>
                                                    @endforeach
                                                @endisset
                                            </select>
                                            @error('gender')
                                                <x-input-label for="gender" :value="$message"> </x-input-label>
                                            @enderror
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <div class="card-footer d-flex justify-content-end py-6 px-9">
                                        <x-button type="reset" class="btn btn-light btn-active-light-primary me-2">Discard</x-button>
                                        <x-button type="submit" class="btn btn-primary" id="users_submit_btn" disabled>Save Changes</x-button>
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
    <!--end::Content wrapper-->
@endsection

@section('script')
<script src="{{ asset('assets/js/users/update_validation.js') }}"></script>
<script>
    $("#date_of_birth").flatpickr();

    var textInputs = document.querySelectorAll('.text-input');
    var selectInputs = document.querySelectorAll('.select-input');
    var saveButton = document.getElementById('users_submit_btn');

    // Store original values for text inputs and select inputs
    var originalTextValues = Array.from(textInputs).map(function(input) {
        return input.value;
    });

    var originalSelectValues = Array.from(selectInputs).map(function(input) {
        return input.value;
    });
    // Add event listeners to text inputs
    textInputs.forEach(function(textInput, index) {
        textInput.addEventListener('input', function() {
            toggleButtonState(textInput, originalTextValues[index]);
        });
    });

    function handleSelectChange(input,index) {
        toggleButtonState(input,originalSelectValues[index]);
    }

    // Function to toggle the button state based on input values
    function toggleButtonState(input, originalValue) {
        // Check if input value is different from the original
        var hasChanges = input.value !== originalValue;
        // Enable or disable the button based on changes
        saveButton.disabled = !hasChanges;
    }
</script>
@endsection
