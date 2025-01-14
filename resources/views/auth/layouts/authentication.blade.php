<!DOCTYPE html>

@php
    $rtl = get_session_language()->rtl;
@endphp

@if ($rtl == 1)
    <html dir="rtl" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endif

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="index, follow">
    <meta name="description" content="@yield('meta_description', get_setting('meta_description'))" />
    <meta name="keywords" content="@yield('meta_keywords', get_setting('meta_keywords'))">
    <title>@yield('meta_title', get_setting('website_name') . ' | ' . get_setting('site_motto'))</title>

    <!-- Favicon -->
    @php
        $site_icon = uploaded_asset(get_setting('site_icon'));
    @endphp
    <link rel="icon" href="{{ $site_icon }}">
    <link rel="apple-touch-icon" href="{{ $site_icon }}">
  <!-- Google Fonts -->
   <link href="https://fonts.googleapis.com/css2?family=Ysabeau+SC:wght@1..1000&display=swap" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ static_asset('assets/css/vendors.css') }}">
    @if ($rtl == 1)
        <link rel="stylesheet" href="{{ static_asset('assets/css/bootstrap-rtl.min.css') }}">
    @endif
    <link rel="stylesheet" href="{{ static_asset('assets/css/aiz-core.css?v=') }}{{ rand(1000, 9999) }}">
    
    <style>
        :root{
            --blue: #3490f3;
            --hov-blue: #2e7fd6;
            --soft-blue: rgba(0, 123, 255, 0.15);
            --secondary-base: {{ get_setting('secondary_base_color', '#ffc519') }};
            --hov-secondary-base: {{ get_setting('secondary_base_hov_color', '#dbaa17') }};
            --soft-secondary-base: {{ hex2rgba(get_setting('secondary_base_color', '#ffc519'), 0.15) }};
            --gray: #9d9da6;
            --gray-dark: #8d8d8d;
            --secondary: #919199;
            --soft-secondary: rgba(145, 145, 153, 0.15);
            --success: #85b567;
            --soft-success: rgba(133, 181, 103, 0.15);
            --warning: #f3af3d;
            --soft-warning: rgba(243, 175, 61, 0.15);
            --light: #f5f5f5;
            --soft-light: #dfdfe6;
            --soft-white: #b5b5bf;
            --dark: #292933;
            --soft-dark: #1b1b28;
            --primary: {{ get_setting('base_color', '#d43533') }};
            --hov-primary: {{ get_setting('base_hov_color', '#9d1b1a') }};
            --soft-primary: {{ hex2rgba(get_setting('base_color', '#d43533'), 0.15) }};
        }
       body{
            font-family: "Ysabeau SC", serif;
        }

.user_login_style {
    background-image: url(/public/assets/img/login_bg_logo.webp) !important;
    background-size: 80% !important;
    background-repeat: no-repeat !important;
    background-position: center !important;
}

.user_login_style label, .user_login_style h1, .user_login_style h5 {
    color: #1D1A15 !important;
}
.user_login_style .form-control:focus {
    border-width: 0px !important;
    border-bottom: 1px solid #000 !important;
}
.login_logo_wdth img {
    width: 130px;
    margin-bottom: 50px;
}
.user_login_style label {
    padding-bottom: 0 !important;
    margin-bottom: 0;
    padding-top: 10px;
}
.user_login_style .form-control {
    padding: 0.6rem 1rem;
    font-size: 0.875rem;
    height: calc(1.3125rem + 1.2rem + 2px);
    border: 0px solid #dfdfe6;
    color: #898b92;
    border-bottom: 1px solid;
    padding: 0;
    background: transparent;
    font-size: 16px;
    padding-top: 0 !important;
}
        .form-control:focus {
            border-width: 2px !important;
        }
        .bg_dark_org
        {
            background:#DAD0C41A;
        }
        .user_login_style
        {

        }
        @media (max-width: 991px) {
            .right-content{
                background: var(--white);
                margin-top: -60%;
                border-radius: 24px;
                min-height: 550px;
            }
        }
        @media (min-width: 991px) {
            .right-content{
                height: 100%;
            }
        }
    </style>

    @yield('css')
    <script>
        var AIZ = AIZ || {};
    </script>
</head>
<body>

    @yield('content')

    <!-- SCRIPTS -->
    @include('auth.login_register_js')

    @yield('script')

</body>
</html>
