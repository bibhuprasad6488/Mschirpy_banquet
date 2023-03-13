<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ms Chirpy| @yield('title')</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/assets/logos/fav.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://kit.fontawesome.com/1640028a46.css" crossorigin="anonymous">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css') }}">

    <!-- Feathericon CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/feathericon.min.css') }}">

    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/morris/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/summernote/dist/summernote-bs4.css') }}">
    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap-datetimepicker.min.css') }}">
    <style type="text/css">
        .select2-selection--multiple {
            height: 2.4rem;
        }

        select {
            /* for Firefox */
            -moz-appearance: none;
            /* for Chrome */
            -webkit-appearance: none;
        }

        /* For IE10 */
        select::-ms-expand {
            display: none;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        body::-webkit-scrollbar {
            display: none;
            /* overflow: hidden; */
        }
    </style>
    <!--[if lt IE 9]>
   <script src="{{ asset('admin/assets/js/html5shiv.min.js') }}"></script>
   <script src="assets/js/respond.min.js"></script>
  <![endif]-->

    <!-- Datatables CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/plugins/datatables/datatables.min.css') }}">

    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/swal.js') }}"></script>
    <script src="{{ asset('admin/assets/ckeditor/ckeditor.js') }}"></script>


    @stack('style')
</head>

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Header -->
        <div class="header">

            <!-- Logo -->
            <div class="header-left">
                <a href="index.html" class="logo">
                    <img src="{{ asset('admin/assets/logos/logo_mschirpy.png') }}" alt="Logo" height="50px">
                </a>
                <a href="index.html" class="logo logo-small">
                    <img src="{{ asset('admin/assets/logos/logo_mschirpy.png') }}" alt="Logo" width="30"
                        height="50">
                </a>
            </div>
            <!-- /Logo -->

            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fe fe-text-align-left"></i>
            </a>

            <!-- <div class="top-nav-search">
    <form>
     <input type="text" class="form-control" placeholder="Search here">
     <button class="btn" type="submit"><i class="fa fa-search"></i></button>
    </form>
   </div> -->

            <!-- Mobile Menu Toggle -->
            <a class="mobile_btn" id="mobile_btn">
                <i class="fa fa-bars"></i>
            </a>
            <!-- /Mobile Menu Toggle -->

            <!-- Header Right Menu -->
            <ul class="nav user-menu">

                <!-- App Lists -->
                <li class="nav-item dropdown app-dropdown">
                    <a class="nav-link dropdown-toggle" aria-expanded="false" role="button" data-toggle="dropdown"
                        href="#"><i class="fe fe-app-menu"></i></a>
                    <ul class="dropdown-menu app-dropdown-menu">
                        <li>
                            <div class="app-list">
                                <div class="row">
                                    <div class="col"><a class="app-item" href="inbox.html"><i
                                                class="fa fa-envelope"></i><span>Email</span></a></div>
                                    <div class="col"><a class="app-item" href="calendar.html"><i
                                                class="fa fa-calendar"></i><span>Calendar</span></a></div>

                                </div>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- /App Lists -->

                <!-- Notifications -->
                <li class="nav-item dropdown noti-dropdown">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <i class="fe fe-bell"></i> <span class="badge badge-pill">3</span>
                    </a>
                </li>
                <!-- /Notifications -->

                <!-- User Menu -->
                <li class="nav-item dropdown has-arrow">
                    <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                        <span class="user-img"><img class="rounded-circle"
                                src="{{ asset('admin/assets/img/noImage.jpg') }}" width="31"
                                alt="{{ Auth::user()->name }}"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('admin/assets/img/noImage.jpg') }}" alt="User Image"
                                    class="avatar-img rounded-circle">
                            </div>
                            <div class="user-text">
                                <h6>{{ Auth::user()->name }}</h6>
                                <p class="text-muted mb-0">Administrator</p>
                            </div>
                        </div>
                        <a class="dropdown-item" href="#">My Profile</a>
                        <a class="dropdown-item" href="/change_password">Change Password</a>
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="dropdown-item"><i class="fa fa-sign-out fa-fw"></i>Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                            style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </div>
                </li>
                <!-- /User Menu -->

            </ul>
            <!-- /Header Right Menu -->

        </div>
