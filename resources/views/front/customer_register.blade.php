<!doctype html>
<html lang="en">

<head>
    <title>
        Ms Chirpy Banquet Booking | Customers Register
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.ico') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    {{-- @yield('css') --}}
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
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <link rel="stylesheet" href="{{ asset('front/assets/css/master.css') }}">
    <script src="jquery-3.6.1.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    {{-- <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script> --}}
    <style>
    body::-webkit-scrollbar {
        display: none;
        /* overflow: hidden; */
    }
    </style>

</head>

<body style="background-color:#ff5a60 !important;">
    <main style="background-color:#ff5a60 !important;" class="h-100">
        <!--? slider Area Start-->


        <div class="container  h-100">
            <div class="row  justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card  text-white login-card">
                        <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src="{{ asset('front/assets/img/logo/logo-1.png') }}" class="brand_logo" alt="Logo"
                                    height="100px">
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                        </div>
                        @endif --}}
                        @if ($message = Session::get('error'))
                        <div class="alert  alert-block" style="background-color: #ff5a60; font-size: 13px;">
                            <button type="button" class="close text-white" data-dismiss="alert">×</button>
                            <span style="color: #fff;"><i class="fa fa-exclamation-triangle"
                                    aria-hidden="true"></i>  {{ $message }}</span>
                        </div>
                        @endif

                        <h2 class="fw-bold text-uppercase text-center text-white">Welcome</h2>
                        <form action="/banquet/add_customer" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="">Name</label>
                                    <div class="input-group  mb-4">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-user"></i>
                                                </i>
                                            </span>
                                        </div>
                                        <input type="text" name="customer_name" id="customer_name"
                                            class="form-control input_user" placeholder="Please Enter name" required>
                                    </div>

                                    <label class="">Mobile</label>
                                    <div class="input-group  mb-4">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-mobile"></i>
                                                </i>
                                            </span>
                                        </div>
                                        <input type="number" name="mobile" id="mobile" class="form-control input_user"
                                            pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Please Enter Number" required>
                                    </div>

                                    <label class="">Email</label>
                                    <div class="input-group  mb-4">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-envelope"></i>
                                                </i>
                                            </span>
                                        </div>
                                        <input type="email" name="email_id" id="email_id"
                                            class="form-control input_user" placeholder="Please Enter email" required>
                                    </div>

                                    <label class="">Password</label>
                                    <div class="input-group  mb-4">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-key" aria-hidden="true"></i>
                                            </span>
                                        </div>
                                        <input type="password" name="password" id="password"
                                            class="form-control input_user" placeholder="Please Enter Password"
                                            required>
                                    </div>

                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <button type="submit" name="submit" id="savbtn" class="buttonn login_btn">Sign
                                            in</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <div class="text-center mt-2">
                            <p class="mb-0 text-white">Already have an account ? <a href="/banquet/login"
                                    class="text-white-50 fw-bold text-primary">Log in <i class="fa fa-sign-in"
                                        aria-hidden="true"></i>
                                </a>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        </div>


        <script>
        // $('#savbtn').on('click', function() {
        //     var customer_name = $('#customer_name').val();
        //     var mobile = $('#mobile').val();
        //     var email_id = $('#email_id').val();
        //     var password = $('#password').val();
        //     if (customer_name == '' || customer_name == null || customer_name == undefined || mobile ==
        //         '' || mobile == null || mobile == undefined || email_id == '' || email_id == null ||
        //         email_id == undefined || password == '' || password == null || password == undefined) {
        //         swal({
        //             text: 'All fields are required.',
        //             icon: "warning",
        //             button: "Okay",
        //         });
        //         return false;
        //     } else {
        //         $.ajax({
        //             type: "POST",
        //             url: "/banquet/add_customer",
        //             data: {
        //                 _token: "{{ csrf_token() }}",
        //                 customer_name: customer_name,
        //                 mobile: mobile,
        //                 email_id: email_id,
        //                 password: password
        //             },
        //             cache: false,
        //             success: function(dataResult) {
        //                 console.log(dataResult);
        //                 var dataResult = JSON.parse(dataResult);
        //                 if (dataResult.statusCode == 200) {
        //                     swal({
        //                         text: 'Registration successfull Go to Login!',
        //                         icon: "success",
        //                         button: "Okay",
        //                     }).then(function() {
        //                         window.location = "/banquet/all-venues";
        //                     });
        //                 } else {
        //                     swal({
        //                         text: 'Registration Unsuccessfull try again',
        //                         icon: "error",
        //                         button: "Okay",
        //                     }).then(function() {
        //                         location.reload();
        //                     });
        //                 }
        //             }

        //         });
        //     }

        // });
        </script>

    </main>




    @push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase-app.js"></script>
    @endpush

    <script src="{{ asset('front/assets/js/vendor/modernizr-3.5.0.min.js') }}"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="{{ asset('front/assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/popper.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/bootstrap.min.js') }}"></script>
    <!-- Jquery Mobile Menu -->
    <script src="{{ asset('front/assets/js/jquery.slicknav.min.js') }}"></script>
    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="{{ asset('front/assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/slick.min.js') }}"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="{{ asset('front/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/animated.headline.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.magnific-popup.js') }}"></script>

    <!-- Date Picker -->
    <script src="{{ asset('front/assets/js/gijgo.min.js') }}"></script>
    <!-- Nice-select, sticky -->
    <script src="{{ asset('front/assets/js/jquery.nice-select.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.sticky.js') }}"></script>

    <!-- contact js -->
    <script src="{{ asset('front/assets/js/contact.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.form.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('front/assets/js/mail-script.js') }}"></script>
    <script src="{{ asset('front/assets/js/jquery.ajaxchimp.min.js') }}"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="{{ asset('front/assets/js/plugins.js') }}"></script>
    <script src="{{ asset('front/assets/js/main.js') }}"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/js/selectize.min.js"
        integrity="sha512-IOebNkvA/HZjMM7MxL0NYeLYEalloZ8ckak+NDtOViP7oiYzG5vn6WVXyrJDiJPhl4yRdmNAG49iuLmhkUdVsQ=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
    </script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
        integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
    <script type="text/javascript">
    document.addEventListener('contextmenu', (e) => e.preventDefault());

    function ctrlShiftKey(e, keyCode) {
        return e.ctrlKey && e.shiftKey && e.keyCode === keyCode.charCodeAt(0);
    }

    document.onkeydown = (e) => {
        // Disable F12, Ctrl + Shift + I, Ctrl + Shift + J, Ctrl + U
        if (
            event.keyCode === 123 ||
            ctrlShiftKey(e, 'I') ||
            ctrlShiftKey(e, 'J') ||
            ctrlShiftKey(e, 'C') ||
            (e.ctrlKey && e.keyCode === 'U'.charCodeAt(0))
        )
            return false;
    };
    </script>
</body>

</html>