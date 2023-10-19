<div class="app-container d-flex align-items-center gap-2 gap-lg-3">
    <div class="me-0">
        <button class="btn btn-icon btn-custom btn-icon-muted btn-active-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <i class="fas fa-cog"></i>
        </button>
        <!--begin::Menu 3-->
        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px py-3" data-kt-menu="true" style="">
            <!--begin::Heading-->
            <div class="menu-item px-3">
                <div class="menu-content text-muted pb-2 px-3 fs-7 text-uppercase">Setting</div>
            </div>
            <!--end::Heading-->
            <!--begin::Menu item-->
            <div class="menu-item px-3">
                <a href="{{ route('user.change-password') }}" class="menu-link px-3">Change Password</a>
            </div>
            <!--end::Menu item-->
        </div>
        <!--end::Menu 3-->
    </div>
</div>
