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
                    <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Account
                        Overview</h1>
                    <!--end::Title-->
                    <!--begin::Breadcrumb-->
                    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            <a href="index.html" class="text-muted text-hover-primary">Home</a>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">
                            >>
                        </li>
                        <!--end::Item-->
                        <!--begin::Item-->
                        <li class="breadcrumb-item text-muted">Dashboard</li>
                        <!--end::Item-->
                    </ul>
                    <!--end::Breadcrumb-->
                </div>
                <!--end::Page title-->
            </div>
            <!--end::Toolbar container-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Content wrapper-->
    <div id="kt_app_content" class="app-content flex-column-fluid">
        <div id="kt_app_content_container" class="app-container container-fluid">
            <div class="row g-5 g-xl-10 mb-5 mb-xl-10">
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-5">
                    <div class="card card-flush mb-5" style="background-color: #181c32;">
                        <div class="card-header pt-5">
                            <span class="svg-icon svg-icon-3x svg-icon-success "><svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24"
                                    version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            fill="#fff" fill-rule="nonzero" opacity="0.7"></path>
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            fill="#fff" fill-rule="nonzero"></path>
                                    </g>
                                </svg></span>

                        </div>
                        <div class="card-body align-items-center">

                            <span class="fs-2hx fw-bold text-white mt-2 me-2 lh-1 ls-n2" id="trainees">21</span>

                            <span class="text-white opacity-75 pt-1 fw-semibold fs-6 d-block">Total
                                Trainees</span>

                        </div>
                    </div>
                    <div class="card card-flush" style="background-color: #dd1845;">
                        <div class="card-body align-items-center">

                            <div class="d-flex flex-wrap">

                                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                                    <div
                                        class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                        <span class="fs-2qx fw-bold text-white" id="total_programs">1</span>
                                        <span class="fs-6 fw-semibold text-center text-gray-200">Total Programs</span>
                                    </div>
                                    <canvas id="total_programs_chart"
                                        style="display: block; box-sizing: border-box; height: 175px; width: 175px;"
                                        width="175" height="175"></canvas>
                                </div>


                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">

                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-200">Active</div>
                                        <div class="ms-auto fw-bold text-gray-100 " id="active_programs">1</div>
                                    </div>


                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-white me-3"></div>
                                        <div class="text-gray-200">Inactive</div>
                                        <div class="ms-auto fw-bold text-gray-100 " id="inactive_programs">0</div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-5">
                    <div class="card card-flush mb-5" style="background-color: #fff;">
                        <div class="card-header pt-5">
                            <span class="svg-icon svg-icon-3x svg-icon-success "><svg xmlns="http://www.w3.org/2000/svg"
                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24"
                                    version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                        <path
                                            d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                            fill="#000" fill-rule="nonzero" opacity="0.7"></path>
                                        <path
                                            d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                            fill="#000" fill-rule="nonzero"></path>
                                    </g>
                                </svg></span>

                        </div>
                        <div class="card-body align-items-center">

                            <span class="fs-2hx fw-bold text-dark mt-2 me-2 lh-1 ls-n2" id="system_users">5</span>

                            <span class="text-dark opacity-75 pt-1 fw-semibold fs-6 d-block">Total
                                System Users</span>

                        </div>
                    </div>
                    <div class="card card-flush" style="background-color: #181c32;">
                        <div class="card-body align-items-center">

                            <div class="d-flex flex-wrap">

                                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                                    <div
                                        class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                        <span class="fs-2qx fw-bold text-white" id="total_courses">4</span>
                                        <span class="fs-6 fw-semibold text-center text-gray-200">Total Courses</span>
                                    </div>
                                    <canvas id="total_courses_chart"
                                        style="display: block; box-sizing: border-box; height: 175px; width: 175px;"
                                        width="175" height="175"></canvas>
                                </div>


                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">

                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bold text-gray-100" id="active_courses">1</div>
                                    </div>


                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-white me-3"></div>
                                        <div class="text-gray-400">Inactive</div>
                                        <div class="ms-auto fw-bold text-gray-100" id="inactive_courses">3</div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-5">
                    <div class="card card-flush mb-5" style="background-color: #dd1845;">
                        <div class="card-body pt-5">

                            <div class="d-flex flex-stack mt-7">

                                <div class="text-gray-100 fw-semibold fs-6 me-2">Batches</div>


                                <div class="d-flex align-items-senter">
                                    <span class="text-gray-200 fw-bolder fs-6" id="batches">2</span>
                                </div>

                            </div>


                            <div class="separator separator-dashed my-3"></div>


                            <div class="d-flex flex-stack">

                                <div class="text-gray-100 fw-semibold fs-6 me-2">Departments</div>


                                <div class="d-flex align-items-senter">

                                    <span class="svg-icon svg-icon-2 svg-icon-danger me-2">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <rect opacity="0.5" x="7.05026" y="15.5355" width="13" height="2"
                                                rx="1" transform="rotate(-45 7.05026 15.5355)" fill="currentColor">
                                            </rect>
                                            <path
                                                d="M9.17158 14.0284L9.17158 8.11091C9.17158 7.52513 8.6967 7.05025 8.11092 7.05025C7.52513 7.05025 7.05026 7.52512 7.05026 8.11091L7.05026 15.9497C7.05026 16.502 7.49797 16.9497 8.05026 16.9497L15.8891 16.9497C16.4749 16.9497 16.9498 16.4749 16.9498 15.8891C16.9498 15.3033 16.4749 14.8284 15.8891 14.8284L9.97158 14.8284C9.52975 14.8284 9.17158 14.4703 9.17158 14.0284Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </span>


                                    <span class="text-gray-200 fw-bolder fs-6" id="departments">6</span>

                                </div>

                            </div>


                            <div class="separator separator-dashed my-3"></div>


                            <div class="d-flex flex-stack mb-4">

                                <div class="text-gray-100 fw-semibold fs-6 me-2">Designations</div>


                                <div class="d-flex align-items-senter">

                                    <span class="text-gray-200 fw-bolder fs-6" id="designations">8</span>

                                </div>

                            </div>

                        </div>
                    </div>
                    <div class="card card-flush" style="background-color: #fff;">
                        <div class="card-body">

                            <div class="d-flex flex-wrap">

                                <div class="position-relative d-flex flex-center h-175px w-175px me-15 mb-7">
                                    <div
                                        class="position-absolute translate-middle start-50 top-50 d-flex flex-column flex-center">
                                        <span class="fs-2qx fw-bold" id="total_tasks">12</span>
                                        <span class="fs-6 fw-semibold text-center text-gray-400">Total Tasks</span>
                                    </div>
                                    <canvas id="total_tasks_chart"
                                        style="display: block; box-sizing: border-box; height: 175px; width: 175px;"
                                        width="175" height="175"></canvas>
                                </div>


                                <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">

                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-primary me-3"></div>
                                        <div class="text-gray-400">Active</div>
                                        <div class="ms-auto fw-bold text-gray-700" id="active_tasks">12</div>
                                    </div>


                                    <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                        <div class="bullet bg-success me-3"></div>
                                        <div class="text-gray-400">Inactive</div>
                                        <div class="ms-auto fw-bold text-gray-700" id="inactive_tasks">0</div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
