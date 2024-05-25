<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-wide " dir="ltr" data-theme="theme-default"
    data-assets-path="../../assets/" data-template="front-pages">

<head>
    <meta charset="utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Welcome | PicFolio Studio</title>


    {{-- <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5"> --}}



    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>
        (function(w, d, s, l, i) {
            w[l] = w[l] || [];
            w[l].push({
                'gtm.start': new Date().getTime(),
                event: 'gtm.js'
            });
            var f = d.getElementsByTagName(s)[0],
                j = d.createElement(s),
                dl = l != 'dataLayer' ? '&l=' + l : '';
            j.async = true;
            j.src =
                'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
            f.parentNode.insertBefore(j, f);
        })(window, document, 'script', 'dataLayer', 'GTM-5J3LMKC');
    </script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/branding/pic_logo.jpg') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&ampdisplay=swap"
        rel="stylesheet">


    <link rel="stylesheet" href="{{ asset('assets/vendor/fonts/tabler-icons.css') }}" />


    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-default.css') }}"
        class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page.css') }}" />
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/nouislider/nouislider.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/swiper/swiper.css') }}" />

    <!-- Page CSS -->

    <link rel="stylesheet" href="{{ asset('assets/vendor/css/pages/front-page-landing.css') }}" />

    <!-- Helpers -->
    <script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>
    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
    <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script>
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('assets/js/front-config.js') }}"></script>

</head>

<body>

    <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0"
            style="display: none; visibility: hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->

    <script src="{{ asset('assets/vendor/js/dropdown-hover.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/mega-dropdown.js') }}"></script>

    <!-- Navbar: Start -->
    <nav class="layout-navbar shadow-none py-0">
        <div class="container">
            <div class="navbar navbar-expand-lg landing-navbar px-3 px-md-4">
                <!-- Menu logo wrapper: Start -->
                <div class="navbar-brand app-brand demo d-flex py-0 py-lg-2 me-4">
                    <!-- Mobile menu toggle: Start-->
                    <button class="navbar-toggler border-0 px-0 me-2" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-menu-2 ti-sm align-middle"></i>
                    </button>
                    <!-- Mobile menu toggle: End-->
                    <a href="{{ url('/') }}" class="app-brand-link">
                        <img class="img-fluid justicon rounded" width="40"
                            src="{{ asset('assets/img/branding/pic_logo.jpg') }}" alt="PicFolio Studio" />
                        <span class="app-brand-logo demo">
                        </span>
                        {{-- <span class="app-brand-text demo menu-text fw-bold ms-2 ps-1">PicFolio Studio</span> --}}
                    </a>
                </div>
                <!-- Menu logo wrapper: End -->
                <!-- Menu wrapper: Start -->
                <div class="collapse navbar-collapse landing-nav-menu" id="navbarSupportedContent">
                    <button class="navbar-toggler border-0 text-heading position-absolute end-0 top-0 scaleX-n1-rtl"
                        type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="ti ti-x ti-sm"></i>
                    </button>
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link fw-medium" aria-current="page" href="#landingHero">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingFeatures">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingFAQ">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fw-medium" href="#landingContact">Contact us</a>
                        </li>
                        <li class="nav-item mega-dropdown">
                            <a href="javascript:void(0);"
                                class="nav-link dropdown-toggle navbar-ex-14-mega-dropdown mega-dropdown fw-medium"
                                aria-expanded="false" data-bs-toggle="mega-dropdown" data-trigger="hover">
                                <span data-i18n="Pages">Shoots</span>
                            </a>
                            <div class="dropdown-menu p-4">
                                <div class="row gy-4">
                                    <div class="col-12 col-lg">
                                        <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                            <span class="ps-1">Wedding</span>
                                        </div>
                                        <ul class="nav flex-column">

                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Pricing">Pre Wedding</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Payment">Mendhi</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Checkout">Barat</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Help Center">Walima</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                            <span class="ps-1">Occassion</span>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Pricing">Insta Shoot</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Payment">Vloging</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Checkout">Party Shoot</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Help Center">Baby & Kids</span>
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#">
                                                    <i class='ti ti-circle me-1'></i>
                                                    <span data-i18n="Help Center">Vocation</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-12 col-lg">
                                        <div class="h6 d-flex align-items-center mb-2 mb-lg-3">
                                            <span class="ps-1">Business</span>
                                        </div>
                                        <ul class="nav flex-column">
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Food
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Interior
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Product Shoot
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Corporate Events
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Brand Video
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link mega-dropdown-link" href="#"
                                                    target="_blank">
                                                    <i class='ti ti-circle me-1'></i>
                                                    Profile & Headshot
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </li>
                        {{-- <li class="nav-item">
                            <a class="nav-link fw-medium" href="{{ asset('vertical-menu-template/index.html') }}"
                                target="_blank">Admin</a>
                        </li> --}}
                    </ul>
                </div>
                <div class="landing-menu-overlay d-lg-none"></div>
                <!-- Menu wrapper: End -->
                <!-- Toolbar: Start -->
                <ul class="navbar-nav flex-row align-items-center ms-auto">

                    <!-- Style Switcher -->
                    <li class="nav-item dropdown-style-switcher dropdown me-2 me-xl-0">
                        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);"
                            data-bs-toggle="dropdown">
                            <i class='ti ti-sm'></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-styles">
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="light">
                                    <span class="align-middle"><i class='ti ti-sun me-2'></i>Light</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="dark">
                                    <span class="align-middle"><i class="ti ti-moon me-2"></i>Dark</span>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0);" data-theme="system">
                                    <span class="align-middle"><i class="ti ti-device-desktop me-2"></i>System</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <!-- / Style Switcher-->

                    <!-- navbar button: Start -->
                    <li>
                        @if (Auth::user())
                            <a href="{{ route('dashboard') }}" class="dropdown-item">
                                <button class="btn btn-primary waves-effect waves-light px-2 px-md-3">
                                    <span class="scaleX-n1-rtl me-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon menu-icon icon-tabler icon-tabler-layout-dashboard me-0"
                                            width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="currentColor" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                            <path d="M4 4h6v8h-6z"></path>
                                            <path d="M4 16h6v4h-6z"></path>
                                            <path d="M14 12h6v8h-6z"></path>
                                            <path d="M14 4h6v4h-6z"></path>
                                        </svg>
                                    </span>
                                    <span class="d-none d-md-block">Dashboard</span>
                                </button>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="dropdown-item">
                                <button class="btn btn-primary waves-effect waves-light">
                                    <span class="scaleX-n1-rtl me-md-1">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            class="icon icon-tabler icon-tabler-login" width="24" height="24"
                                            viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                            fill="none" stroke-linecap="round" stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path
                                                d="M15 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" />
                                            <path d="M21 12h-13l3 -3" />
                                            <path d="M11 15l-3 -3" />
                                        </svg>
                                    </span>
                                    <span class="d-none d-md-block">Login/Register</span>
                                </button>
                            </a>
                        @endif
                    </li>
                    <!-- navbar button: End -->
                </ul>
                <!-- Toolbar: End -->
            </div>
        </div>
    </nav>
    <!-- Navbar: End -->

    <!-- Sections:Start -->

    <div data-bs-spy="scroll" class="scrollspy-example">
        <!-- Hero: Start -->
        <section id="hero-animation">
            <div id="landingHero" class="section-py landing-hero position-relative">
                <div class="container">
                    <div class="hero-text-box text-center">
                        <h1 class="text-primary hero-title  fw-bold">PicFolio Studio</h1>
                        <h2 class="hero-sub-title h6 mb-4 pb-1">
                            Bringing Photo Shoots To Your Doorstep.
                        </h2>
                        <div class="landing-hero-btn d-inline-block position-relative">
                            <span class="hero-btn-item position-absolute d-none d-md-flex text-heading">Join Us
                                <img src="{{ asset('assets/img/front-pages/icons/Join-community-arrow.png') }}"
                                    alt="Join community arrow" class="scaleX-n1-rtl" /></span>
                            <a href="#landingContact" class="btn btn-primary btn-lg">Contact Us</a>
                        </div>
                    </div>
                    {{-- <div id="heroDashboardAnimation" class="hero-animation-img">
                        <a href="#">
                            <div id="heroAnimationImg" class="position-relative hero-dashboard-img">
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-dashboard-light.png') }}"
                                    alt="hero dashboard" class="animation-img"
                                    data-app-light-img="front-pages/landing-page/hero-dashboard-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-dashboard-dark.png" />
                                <img src="{{ asset('assets/img/front-pages/landing-page/hero-elements-light.png') }}"
                                    alt="hero elements"
                                    class="position-absolute hero-elements-img animation-img top-0 start-0"
                                    data-app-light-img="front-pages/landing-page/hero-elements-light.png"
                                    data-app-dark-img="front-pages/landing-page/hero-elements-dark.png" />
                            </div>
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="py-5 my-4">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col-md-5">
                            <img style="height: 342px; object-fit: cover; " class="w-100 rounded-3"
                                src="{{ asset('/assets/img/backgrounds/photographers.jpg') }}" alt="Marketing">
                        </div>
                        <div class="col-md-7 pt-4 pt-md-0 ps-0 ps-md-5">
                            <h2>About Us</h2>
                            <p style="text-align: justify;">
                                PicFolio Studio has made Professional Photography service this easy to access. Doesn't
                                matter if
                                you want multiple shoots at a time or multiple locations at a time. We're present across
                                135 International destinations with multiple teams at every location.
                            </p>
                            {{-- <a href="javascript:void(0)" class="btn btn-primary btn-lg">About Us</a> --}}
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <!-- Hero: End -->

        <!-- Useful features: Start -->
        <section id="landingFeatures" class="section-py bg-body landing-features">
            <div class="container">
                {{-- <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Useful Features</span>
                </div> --}}
                <h3 class="text-center mb-3 mb-md-5 pb-3">
                    We Bleed Photographs.
                    Offerings For All. </h3>
                {{-- <p class="text-center mb-3 mb-md-5 pb-3">
                    Not just a set of tools, the package includes ready-to-deploy conceptual application.
                </p> --}}
                <div class="features-icon-wrapper row gx-0 gy-4 g-sm-5">
                    <div class="col-lg-6 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <i class="ti ti-device-mobile ti-lg text-primary"></i>
                            {{-- <img src="{{ asset('assets/img/front-pages/icons/laptop.png') }}"
                                alt="laptop charging" /> --}}
                        </div>
                        <h5 class="mb-3">
                            Corporate</h5>
                        <p class="features-icon-description">
                            Mass photography Solution. Let us handle the chaos. </p>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <i class="ti ti-user ti-lg text-primary"></i>
                            {{-- <img src="{{ asset('assets/img/front-pages/icons/rocket.png') }}" alt="transition up" /> --}}
                        </div>
                        <h5 class="mb-3">
                            Photographers</h5>
                        <p class="features-icon-description">
                            Get Jobs, get recognition. Join the fleet today.
                        </p>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <i class="ti ti-user ti-lg text-primary"></i>
                            {{-- <img src="{{ asset('assets/img/front-pages/icons/paper.png') }}" alt="edit" /> --}}
                        </div>
                        <h5 class="mb-3">Travel Agents</h5>
                        <p class="features-icon-description">
                            Sell with Holiday Packages. Add value to your offerings.
                        </p>
                    </div>
                    <div class="col-lg-6 col-sm-6 text-center features-icon-box">
                        <div class="text-center mb-3">
                            <i class="ti ti-users ti-lg text-primary"></i>
                            {{-- <img src="{{ asset('assets/img/front-pages/icons/check.png') }}" alt="3d select solid" /> --}}
                        </div>
                        <h5 class="mb-3">Attractions & Hotels</h5>
                        <p class="features-icon-description">
                            Add On-Premises activity. Get social engagement.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Useful features: End -->

        <!-- Real customers reviews: Start -->
        <section id="landingReviews" class="section-py landing-reviews pb-0">
            <!-- What people say slider: Start -->
            <div class="container">
                <div class="row align-items-center gx-0 gy-4 g-lg-5">
                    <div class="col-md-6 col-lg-5 col-xl-3">
                        <div class="mb-3 pb-1">
                            <span class="badge bg-label-primary">Real Customers Reviews</span>
                        </div>
                        <h3 class="mb-1"><span class="section-title">What people say</span></h3>
                        <p class="mb-3 mb-md-5">
                            See what our customers have to<br class="d-none d-xl-block" />
                            say about their experience.
                        </p>
                        <div class="landing-reviews-btns">
                            <button id="reviews-previous-btn"
                                class="btn btn-label-primary reviews-btn me-3 scaleX-n1-rtl" type="button">
                                <i class="ti ti-chevron-left ti-sm"></i>
                            </button>
                            <button id="reviews-next-btn" class="btn btn-label-primary reviews-btn scaleX-n1-rtl"
                                type="button">
                                <i class="ti ti-chevron-right ti-sm"></i>
                            </button>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-7 col-xl-9">
                        <div class="swiper-reviews-carousel overflow-hidden mb-5 pb-md-2 pb-md-3">
                            <div class="swiper" id="swiper-reviews">
                                <div class="swiper-wrapper">
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-1.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “Vuexy is hands down the most useful front end Bootstrap theme I've
                                                    ever used. I can't wait
                                                    to use it again for my next project.”
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Cecilia Payne</h6>
                                                        <p class="small text-muted mb-0">CEO of Airbnb</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-2.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “I've never used a theme as versatile and flexible as Vuexy. It's my
                                                    go to for building
                                                    dashboard sites on almost any project.”
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/2.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Eugenia Moore</h6>
                                                        <p class="small text-muted mb-0">Founder of Hubspot</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-3.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    This template is really clean & well documented. The docs are really
                                                    easy to understand and
                                                    it's always easy to find a screenshot from their website.
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/3.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Curtis Fletcher</h6>
                                                        <p class="small text-muted mb-0">Design Lead at Dribbble</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-4.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    All the requirements for developers have been taken into
                                                    consideration, so I’m able to build
                                                    any interface I want.
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/4.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Sara Smith</h6>
                                                        <p class="small text-muted mb-0">Founder of Continental</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-5.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    “I've never used a theme as versatile and flexible as Vuexy. It's my
                                                    go to for building
                                                    dashboard sites on almost any project.”
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/5.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Eugenia Moore</h6>
                                                        <p class="small text-muted mb-0">Founder of Hubspot</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-slide">
                                        <div class="card h-100">
                                            <div
                                                class="card-body text-body d-flex flex-column justify-content-between h-100">
                                                <div class="mb-3">
                                                    <img src="{{ asset('assets/img/front-pages/branding/logo-6.png') }}"
                                                        alt="client logo" class="client-logo img-fluid" />
                                                </div>
                                                <p>
                                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veniam nemo
                                                    mollitia, ad eum
                                                    officia numquam nostrum repellendus consequuntur!
                                                </p>
                                                <div class="text-warning mb-3">
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star-filled ti-sm"></i>
                                                    <i class="ti ti-star ti-sm"></i>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="avatar me-2 avatar-sm">
                                                        <img src="{{ asset('assets/img/avatars/1.png') }}"
                                                            alt="Avatar" class="rounded-circle" />
                                                    </div>
                                                    <div>
                                                        <h6 class="mb-0">Sara Smith</h6>
                                                        <p class="small text-muted mb-0">Founder of Continental</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="swiper-button-next"></div>
                                <div class="swiper-button-prev"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- What people say slider: End -->
            <hr class="m-0" />
            <!-- Logo slider: Start -->
            <div class="container">
                <div class="swiper-logo-carousel py-4 my-lg-2">
                    <div class="swiper" id="swiper-clients-logos">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/front-pages/branding/logo_1-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo_1-light.png"
                                    data-app-dark-img="front-pages/branding/logo_1-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/front-pages/branding/logo_2-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo_2-light.png"
                                    data-app-dark-img="front-pages/branding/logo_2-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/front-pages/branding/logo_3-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo_3-light.png"
                                    data-app-dark-img="front-pages/branding/logo_3-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/front-pages/branding/logo_4-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo_4-light.png"
                                    data-app-dark-img="front-pages/branding/logo_4-dark.png" />
                            </div>
                            <div class="swiper-slide">
                                <img src="{{ asset('assets/img/front-pages/branding/logo_5-light.png') }}"
                                    alt="client logo" class="client-logo"
                                    data-app-light-img="front-pages/branding/logo_5-light.png"
                                    data-app-dark-img="front-pages/branding/logo_5-dark.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Logo slider: End -->
        </section>
        <!-- Real customers reviews: End -->

        <section id="landingPricing" class="section-py  bg-body landing-pricing">
            <div class="container">
                <div class="row gy-3">
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-primary shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/laptop.png') }}" alt="laptop"
                                    class="mb-2" />
                                <h5 class="h2 mb-1">99.9%</h5>
                                <p class="fw-medium mb-0">
                                    Our Online<br />
                                    Presence
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-success shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/user-success.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">50k+</h5>
                                <p class="fw-medium mb-0">
                                    Our Valuable<br />
                                    clients
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-info shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/diamond-info.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">4.8/5</h5>
                                <p class="fw-medium mb-0">
                                    Highly Rated<br />
                                    Process
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-lg-3">
                        <div class="card border border-label-warning shadow-none">
                            <div class="card-body text-center">
                                <img src="{{ asset('assets/img/front-pages/icons/check-warning.png') }}"
                                    alt="laptop" class="mb-2" />
                                <h5 class="h2 mb-1">100%</h5>
                                <p class="fw-medium mb-0">
                                    Money Back<br />
                                    Guarantee
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ: Start -->
        <section id="landingFAQ" class="section-py landing-fun-facts">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">FAQ</span>
                </div>
                <h3 class="text-center mb-1">Frequently asked <span class="section-title">questions</span></h3>
                <p class="text-center mb-5 pb-3">Browse through these FAQs to find answers to commonly asked questions.
                </p>
                <div class="row gy-5">
                    <div class="col-lg-5">
                        <div class="text-center">
                            <img src="{{ asset('assets/img/illustrations/FAQ.jpg') }}" alt="faq boy with logos"
                                class="faq-image img-fluid rounded w-75" />
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="accordion" id="accordionExample">
                            <div class="card accordion-item active">
                                <h2 class="accordion-header" id="headingOne">
                                    <button type="button" class="accordion-button" data-bs-toggle="collapse"
                                        data-bs-target="#accordionOne" aria-expanded="true"
                                        aria-controls="accordionOne">
                                        How do I get started?
                                    </button>
                                </h2>

                                <div id="accordionOne" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        The easiest way to begin is to use the contact form to get in touch with one of
                                        PicFolio Studio's account executives to hear about your goals and how we can
                                        help you achieve them.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionTwo"
                                        aria-expanded="false" aria-controls="accordionTwo">
                                        What markets does PicFolio Studio have access to?
                                    </button>
                                </h2>
                                <div id="accordionTwo" class="accordion-collapse collapse"
                                    aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        PicFolio Studio has a network of partners and individual across the Islamabad,
                                        Pakistan. We can serve messaging to just about any market you’re looking to
                                        target.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionThree"
                                        aria-expanded="false" aria-controls="accordionThree">
                                        How does PicFolio Studio address privacy concerns when targeting customers?
                                    </button>
                                </h2>
                                <div id="accordionThree" class="accordion-collapse collapse"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        PicFolio Studio abide industry best practices and GDPR compliance requirements
                                        to ensure consumer privacy is maintained and protected.
                                    </div>
                                </div>
                            </div>
                            <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFour"
                                        aria-expanded="false" aria-controls="accordionFour">
                                        How much does advertising with PicFolio Studio cost?
                                    </button>
                                </h2>
                                <div id="accordionFour" class="accordion-collapse collapse"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        PicFolio Studio cost a fraction of a cost of a billboard and comes with
                                        trackable
                                        analytics to know its working.
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="card accordion-item">
                                <h2 class="accordion-header" id="headingFive">
                                    <button type="button" class="accordion-button collapsed"
                                        data-bs-toggle="collapse" data-bs-target="#accordionFive"
                                        aria-expanded="false" aria-controls="accordionFive">
                                        Which license is applicable for SASS application?
                                    </button>
                                </h2>
                                <div id="accordionFive" class="accordion-collapse collapse"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Sequi molestias
                                        exercitationem ab cum
                                        nemo facere voluptates veritatis quia, eveniet veniam at et repudiandae mollitia
                                        ipsam quasi
                                        labore enim architecto non!
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- FAQ: End -->

        <!-- CTA: Start -->
        {{-- <section id="landingCTA" class="section-py landing-cta p-lg-0 pb-0">
            <div class="container">
                <div class="row align-items-center gy-5 gy-lg-0">
                    <div class="col-lg-6 text-center text-lg-start">
                        <h6 class="h2 text-primary fw-bold mb-1">Ready to Get Started?</h6>
                        <p class="fw-medium mb-4">Start your project with a 14-day free trial</p>
                        <a href="payment-page.html" class="btn btn-lg btn-primary">Get Started</a>
                    </div>
                    <div class="col-lg-6 pt-lg-5 text-center text-lg-end">
                        <img src="{{ asset('assets/img/front-pages/landing-page/cta-dashboard.png') }}"
                            alt="cta dashboard" class="img-fluid" />
                    </div>
                </div>
            </div>
        </section> --}}
        <!-- CTA: End -->

        <!-- Contact Us: Start -->
        <section id="landingContact" class="section-py  bg-body landing-contact">
            <div class="container">
                <div class="text-center mb-3 pb-1">
                    <span class="badge bg-label-primary">Contact US</span>
                </div>
                <h3 class="text-center mb-1"><span class="section-title">Let's work</span> together</h3>
                <p class="text-center mb-4 mb-lg-5 pb-md-3">Any question or remark? just write us a message</p>
                <div class="row gy-4">
                    <div class="col-lg-5">
                        <div class="contact-img-box position-relative border p-2 h-100">
                            <img src="{{ asset('assets/img/front-pages/landing-page/contact-customer-service.png') }}"
                                alt="contact customer service" class="contact-img w-100 scaleX-n1-rtl" />
                            <div class="pt-3 px-4 pb-1">
                                <div class="row gy-3 gx-md-4">
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-primary rounded p-2 me-2"><i
                                                    class="ti ti-mail ti-sm"></i></div>
                                            <div>
                                                <p class="mb-0">Email</p>
                                                <h5 class="mb-0">
                                                    <a href="mailto:example@gmail.com"
                                                        class="text-heading">PicFolioStudio@gmail.com</a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-lg-12 col-xl-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge bg-label-success rounded p-2 me-2">
                                                <i class="ti ti-phone-call ti-sm"></i>
                                            </div>
                                            <div>
                                                <p class="mb-0">Phone</p>
                                                <h5 class="mb-0"><a href="tel:+92-310-584-5840"
                                                        class="text-heading">+92 310 584 5840</a></h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="mb-1">Send a message</h4>
                                <p class="mb-4">
                                    If you would like to discuss anything related to payment, account,<br
                                        class="d-none d-lg-block" />
                                    order, or have pre-sales questions, you’re at the right place.
                                </p>
                                <form>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-fullname">Full Name</label>
                                            <input type="text" class="form-control" id="contact-form-fullname"
                                                placeholder="john" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label" for="contact-form-email">Email</label>
                                            <input type="text" id="contact-form-email" class="form-control"
                                                placeholder="johndoe@gmail.com" />
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label" for="contact-form-message">Message</label>
                                            <textarea id="contact-form-message" class="form-control" rows="8" placeholder="Write a message"></textarea>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" class="btn btn-primary">Send inquiry</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Contact Us: End -->
    </div>

    <!-- / Sections:End -->

    <!-- Footer: Start -->
    <footer class="landing-footer  footer-text">
        <div class="footer-top">
            <div class="container">
                <div class="row gx-0 gy-4 g-md-5">
                    <div class="col-lg-5">
                        <a href="{{ url('/') }}" class="app-brand-link mb-4">
                            <img class="img-fluid justicon rounded" width="40"
                                src="{{ asset('assets/img/branding/pic_logo.jpg') }}" alt="PicFolio Studio" />
                            {{-- <span class="app-brand-text demo footer-link fw-bold ms-2 ps-1">PicFolio Studio</span> --}}
                        </a>
                        <p class="footer-text footer-logo-description mb-4">PicFolio Studio has made Professional
                            Photography service this easy to access. Doesn't matter if you want multiple shoots at a
                            time or multiple locations at a time. We're present across 135 International destinations
                            with multiple teams at every location.</p>
                        {{-- <form class="footer-form">
                            <label for="footer-email" class="small">Subscribe to newsletter</label>
                            <div class="d-flex mt-1">
                                <input type="email"
                                    class="form-control rounded-0 rounded-start-bottom rounded-start-top"
                                    id="footer-email" placeholder="Your email" />
                                <button type="submit"
                                    class="btn btn-primary shadow-none rounded-0 rounded-end-bottom rounded-end-top">
                                    Subscribe
                                </button>
                            </div>
                        </form> --}}
                    </div>
                    <div class="col-lg-3 col-md-4 col-sm-6">
                        <h6 class="footer-title mb-4">Details</h6>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="#landingHero" class="footer-link">Home</a>
                            </li>
                            <li class="mb-3">
                                <a href="#landingFeatures" class="footer-link">Services</a>
                            </li>
                            <li class="mb-3">
                                <a href="#landingFAQ" class="footer-link">FAQ</a>
                            </li>
                            <li class="mb-3">
                                <a href="#landingContact" class="footer-link">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <h6 class="footer-title mb-4">Contact Us</h6>
                        <p>
                            Islamabad<br>
                            Pakistan <br>
                            <strong>Phone:</strong> +92 319 500 6898<br>
                            <strong>Email:</strong> PicFolioStudiomarketing@gmail.com<br>
                        </p>

                        <div>
                            <a href="#" class="footer-link me-3" target="_blank">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="icon icon-tabler icon-tabler-brand-linkedin" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                    <path d="M8 11l0 5" />
                                    <path d="M8 8l0 .01" />
                                    <path d="M12 16l0 -5" />
                                    <path d="M16 16v-3a2 2 0 0 0 -4 0" />
                                </svg>
                            </a>
                            <a href="#" class="footer-link me-3" target="_blank">
                                <img src="{{ asset('assets/img/front-pages/icons/facebook-light.png') }}"
                                    alt="facebook icon" data-app-light-img="front-pages/icons/facebook-light.png"
                                    data-app-dark-img="front-pages/icons/facebook-dark.png" />
                            </a>
                            <a href="#" class="footer-link me-3" target="_blank">
                                <img src="{{ asset('assets/img/front-pages/icons/twitter-light.png') }}"
                                    alt="twitter icon" data-app-light-img="front-pages/icons/twitter-light.png"
                                    data-app-dark-img="front-pages/icons/twitter-dark.png" />
                            </a>
                            <a href="#" class="footer-link" target="_blank">
                                <img src="{{ asset('assets/img/front-pages/icons/instagram-light.png') }}"
                                    alt="google icon" data-app-light-img="front-pages/icons/instagram-light.png"
                                    data-app-dark-img="front-pages/icons/instagram-dark.png" />
                            </a>
                        </div>

                        {{-- <div class="social-links">
                            <a href="#" class="twitter"><i class="ti ti-twitter"></i></a>
                            <a href="#" class="facebook"><i class="ti ti-facebook"></i></a>
                            <a href="#" class="instagram"><i class="ti ti-instagram"></i></a>
                            <a href="#" class="google-plus"><i class="ti ti-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="ti ti-linkedin"></i></a>
                        </div> --}}

                        {{-- <ul class="list-unstyled">
                            <li class="mb-3">
                                <a href="pricing-page.html" class="footer-link">Pricing</a>
                            </li>
                            <li class="mb-3">
                                <a href="payment-page.html" class="footer-link">Payment<span
                                        class="badge rounded bg-primary ms-2">New</span></a>
                            </li>
                            <li class="mb-3">
                                <a href="checkout-page.html" class="footer-link">Checkout</a>
                            </li>
                            <li class="mb-3">
                                <a href="help-center-landing.html" class="footer-link">Help Center</a>
                            </li>
                            <li class="mb-3">
                                <a href="{{ route('login') }}" class="footer-link">Login/Register</a>
                            </li>
                        </ul> --}}
                    </div>
                    {{-- <div class="col-lg-3 col-md-4">
                        <h6 class="footer-title mb-4">Download our app</h6>
                        <a href="javascript:void(0);" class="d-block footer-link mb-3 pb-2"><img
                                src="{{ asset('assets/img/front-pages/landing-page/apple-icon.png') }}"
                                alt="apple icon" /></a>
                        <a href="javascript:void(0);" class="d-block footer-link"><img
                                src="{{ asset('assets/img/front-pages/landing-page/google-play-icon.png') }}"
                                alt="google play icon" /></a>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="footer-bottom py-3">
            <div
                class="container d-flex flex-wrap justify-content-between flex-md-row flex-column text-center text-md-start">
                <div class="mb-2 mb-md-0">
                    <span class="footer-text">
                        ©
                        <script>
                            document.write(new Date().getFullYear())
                        </script>
                        , PicFolio Studio, All Rights Reserved
                </div>
                <div>
                    {{-- <a href="#" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/github-light.png') }}" alt="github icon"
                            data-app-light-img="front-pages/icons/github-light.png"
                            data-app-dark-img="front-pages/icons/github-dark.png" />
                    </a> --}}
                    <a href="#" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/facebook-light.png') }}" alt="facebook icon"
                            data-app-light-img="front-pages/icons/facebook-light.png"
                            data-app-dark-img="front-pages/icons/facebook-dark.png" />
                    </a>
                    <a href="#" class="footer-link me-3" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/twitter-light.png') }}" alt="twitter icon"
                            data-app-light-img="front-pages/icons/twitter-light.png"
                            data-app-dark-img="front-pages/icons/twitter-dark.png" />
                    </a>
                    <a href="#" class="footer-link" target="_blank">
                        <img src="{{ asset('assets/img/front-pages/icons/instagram-light.png') }}" alt="google icon"
                            data-app-light-img="front-pages/icons/instagram-light.png"
                            data-app-dark-img="front-pages/icons/instagram-dark.png" />
                    </a>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer: End -->

    <div class="buy-now">
        <a href="{{ route('register') }}" target="_blank" class="btn btn-danger btn-buy-now">Get Started</a>
    </div>

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>

    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('assets/vendor/libs/nouislider/nouislider.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/swiper/swiper.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('assets/js/front-main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('assets/js/front-page-landing.js') }}"></script>

</body>

</html>

<!-- beautify ignore:end -->
