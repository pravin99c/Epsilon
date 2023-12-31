<!DOCTYPE html>

<html lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <title>Sign in</title>
    <meta charset="utf-8" />

    <link rel="shortcut icon" href="{{ asset('assets/media/logos/default-small.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
	<!--end::Global Stylesheets Bundle-->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <x-toster></x-toster>
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body" class="app-blank app-blank">
        <!--begin::Main-->
        {{-- @yield('content') --}}
        {{ $slot }}
        <!--end::Main-->
    {{-- script --}}
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/custom/authentication/sign-in/general.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
           toastr.options =
           {
               "closeButton" : true,
               "progressBar" : true
           }
           toastr.success("{{ session('message') }}", "success");
       @endif

       @if(Session::has('error'))
           toastr.options =
           {
               "closeButton" : true,
               "progressBar" : true
           }
           toastr.error("{{ session('error') }}");
       @endif

       @if(Session::has('warning'))
           toastr.options =
           {
               "closeButton" : true,
               "progressBar" : true
           }
           toastr.warning("{{ session('warning') }}");
       @endif
    </script>
</body>
</html>
