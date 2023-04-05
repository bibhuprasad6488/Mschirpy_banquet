<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> Ms Chirpy Banquet Booking| @yield('title')</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.ico') }}">
    <!-- CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://kit.fontawesome.com/1640028a46.css" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('front/assets/css/master.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script> --}}

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <style>
    body::-webkit-scrollbar {
        display: none;
        /* overflow: hidden; */
    }

    html {
        scroll-behavior: smooth;
    }

    .swal-size-sm {
        width: 200px !important;
    }
    </style>

    @stack('style')
</head>

<body>

    <header>
        <!--? Header Start -->
        <div class="header-area header-transparent">
            <div class="main-header header-fixed">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <!-- Logo -->
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="https://thealtius.com"><img src="{{ asset('front/assets/img/logo/logo-1.png') }}" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <!-- Main-menu -->
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="https://thealtius.com" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Home">Home</a></li>
                                            <li><a href="https://thealtius.com/room/" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Rooms">Rooms</a></li>
                                            <li><a href="https://thealtius.com/dining/" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Dinning">Dinning</a></li>
                                            <li><a href="https://thealtius.com/meetings-events/"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Meeting & Events">Meeting & Events</a></li>
                                            <li><a href="https://thealtius.com/about-us/" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="About">About</a></li>
                                            <li><a href="https://thealtius.com/local-attraction/"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Local Attraction">Local Attraction</a></li>
                                            <li><a href="https://thealtius.com/contact/" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Contact">Contact</a></li>
                                            @if (!session()->has('cid'))
                                            <li><a href="/banquet/book_now" class="menu-link menu-item {{ request()->is('banquet/book_now*') ? 'active' : '' }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Book Now">Book Now</a></li>
                                            @else
                                            <li><a href="/banquet/all-venues" class="menu-link menu-item {{ request()->is('banquet/all-venues*') ? 'active' : '' }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Book Now">Book Now</a></li>
                                            @endif
                                            @if (!session()->has('cid'))
                                            <li><a href="#"><span>Login</span> <i class="fa fa-sign-in"
                                                        aria-hidden="true"></i>
                                                </a>
                                                <ul class="submenu">
                                                    <li><a href="/banquet/login"><i class="fa fa-user"
                                                                aria-hidden="true"></i>
                                                            <span>Customer</span></a></li>
                                                    <li><a href="/login" target="_blank"><i class="fa fa-lock"
                                                                aria-hidden="true"></i>
                                                            <span>Admin</span></a></li>
                                                </ul>
                                            </li>
                                            @else
                                            <li>
                                                <a href="/banquet/profile" class="menu-link menu-item {{ request()->is('banquet/profile*') ? 'active' : '' }}" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Profile">
                                                    <i class="fa fa-user-circle-o" aria-hidden="true"></i>

                                                </a>
                                            </li>
                                            <li>
                                                <a href="/banquet/cart" class="menu-link menu-item {{ request()->is('banquet/cart*') ? 'active' : '' }}" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Cart">
                                                    <i class="fa fa-shopping-cart cart" aria-hidden="true"></i>
                                                    {{-- count(session()->get('cart'), COUNT_RECURSIVE); --}}

                                                    <span class="badge badge-pill" id="cart_badge"></span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="/banquet/logout" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="Logout">
                                                    <i class="fa fa-sign-out" aria-hidden="true"></i>

                                                </a>
                                            </li>
                                            @endif
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <!-- Mobile Menu -->
                        <div class="col-12">
                            <div class="mobile_menu d-block d-lg-none"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Header End -->
    </header>
    @php
        if (session()->has('cart')) {
            // dd(session()->get('cart'));
            $cartcnt = 0;
            foreach (session()->get('cart') as $data) {
                $cartcnt += count($data);
            }
        } else {
            $cartcnt = 0;
        }
        
    @endphp
    @push('script')
        <script>
            $(document).ready(function() {
                var cartcount = {{ $cartcnt }};
                // alert(cartcount);
                if (cartcount > 0) {
                    $('#cart_badge').text(cartcount);
                } else {
                    $('#cart_badge').text('');
                }
            });
        </script>
    @endpush
