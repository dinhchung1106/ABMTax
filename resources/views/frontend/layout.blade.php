<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
   <!-- Mobile Specific Metas -->
   <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
    <title>@yield('title', $company->name ?? 'ABM Tax')</title>
    <meta name="description" content="@yield('meta_description', $company->description ?? '')">
    <meta name="keywords" content="@yield('meta_description', $company->description ?? '')">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/> -->

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/bootstrap.css') }}" />
    <!-- Animate -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/animate.min.css') }}" />
    <!-- Magnific-popup -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/magnific-popup.min.css') }}" />
    <!-- Nice-select -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nice-select.css') }}">
    <!-- Nouislider -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/nouislider.min.css') }}">
    <!-- Jquery-ui -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery-ui.min.css') }}">
    <!-- Swiper-bundle -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/swiper-bundle.min.css') }}">
    <!-- Theme Style -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/styles.css') }}" />

    <!-- Icon -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/icons/icomoon/style.css') }}" />

    <!-- Favicon and Touch Icons  -->
    <link rel="shortcut icon" href="{{ asset('frontend/image/logo/favicon.png') }}" />
    <link rel="apple-touch-icon-precomposed" href="{{ asset('frontend/image/logo/favicon.png') }}" />

    
    @vite('resources/css/app.css')
    @stack('styles')
</head>
<body class="total-number-variant hover-boxcard date-picker">
    <div id="wrapper">

        @include('frontend.components.header', ['company' => $company])
    
        @yield('content')

        @include('frontend.components.footer', ['company' => $company])
    </div>
     <!-- Javascript -->
    <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/lazysize.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery.nice-select.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/magnific-popup.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/rangle-slider.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/nouislider.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/swiper-bundle.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/swiper.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/jquery-validate.js') }}"></script>

    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <!-- /Javascript -->
    @stack('scripts')
</body>
</html> 