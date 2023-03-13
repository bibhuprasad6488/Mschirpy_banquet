<!doctype html>
<html lang="en">

<head>
    <title>
        Ms Chirpy Banquet Booking | Customers Login
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>

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
    <style>
        body::-webkit-scrollbar {
            display: none;
            /* overflow: hidden; */
        }

        #mob:focus {
            box-shadow: none !important;
        }
    </style>

</head>

<body>
    <main style="background-color:#ff5b61;" class="h-100">
        <!--? slider Area Start-->

        {{-- <div class="container h-100">
            <div class="d-flex justify-content-center h-100">
                <div class="user_card">
                    <div class="d-flex justify-content-center">
                        <div class="brand_logo_container">
                            <img src="{{ asset('front/assets/img/logo/login1.png') }}" class="brand_logo" alt="Logo">
                        </div>
                    </div>
                    <div class="d-flex justify-content-center form_container">
                        <form action="/banquet/login" method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="mobile">Phone Number</label>
                            <div class="input-group mb-4">
                                <div class="input-group-append">
                                    <span class="input-group-text"><i class="fas fa-address-book"></i>
                                    </span>
                                </div>
                                <input type="number" name="mobile" class="form-control input_user"
                                    pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"
                                    placeholder="Please Enter Number">
                            </div>


                            <div class="d-flex justify-content-center mt-3 login_container">
                                <button type="submit" name="Login" class=" btn-lg login_btn">Sign In</button>
                            </div>
                        </form>
                    </div>

                    <div class="mt-4">
                        <div class="d-flex justify-content-center links">
                            Don't have an account? <a href="#" class="ml-2">Sign Up</a>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}
        <div class="container  h-100">
            <div class="row  justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card  text-white login-card">
                        <div class="d-flex justify-content-center">
                            <div class="brand_logo_container">
                                <img src="{{ asset('front/assets/img/logo/logo-1.png') }}" class="brand_logo"
                                    alt="Logo" height="100px">
                            </div>
                        </div>
                        <div class="card-body">
                            {{-- @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif --}}
                            {{-- <form action="/banquet/login/otp" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf --}}
                            <h2 class="fw-bold text-uppercase text-center text-white">Welcome</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="">Mobile</label>
                                    <div class="input-group  mb-4">
                                        <div class="input-group-append">
                                            <span class="input-group-text"><i class="fa fa-mobile"></i>
                                            </span>
                                        </div>
                                        <input type="number" name="mobile" id="mobile"
                                            class="form-control input_user" pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==10) return false;"
                                            placeholder="Please Enter Number" autocomplete="off" required>
                                    </div>
                                    <div class="d-flex justify-content-center mt-3 login_container">
                                        <button type="submit" name="Login" class="buttonn login_btn">Log
                                            In</button>
                                            <span id="submit"></span>
                                    </div>
                                </div>
                            </div>
                            {{-- </form> --}}

                            <div class="text-center mt-2">
                                <p class="mb-0 text-white">Don't have an account ? <a href="/banquet/register"
                                        class="text-white-50 fw-bold text-primary">Sign Up <i class="fa fa-sign-in"
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
            $('.login_btn').on('click', function() {
                var mobile = $('#mobile').val();
                $.ajax({
                    type: "post",
                    url: "/banquet/login/otp",
                    data: {
                        _token: "{{ csrf_token() }}",
                        mobile: mobile
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.text == "ok") {
                            let starPhoneNumber = data.mobile.replace(/\d(?=\d{4})/g, "*");
                            swal({
                                text: 'Otp Sent to '+ starPhoneNumber +' Number',
                                icon: "success",
                                button: "Okay",
                            }).then(function() {
                                window.location = '/banquet/otp';
                            });
                        } else {
                            swal({
                                text: "Mobile Number does not exist, Please register.",
                                icon: "error",
                                button: "Okay",
                            }).then(function() {
                                window.location = '/banquet/register';
                            });
                        }

                    }

                });
            });
        </script>


        <!-- slider Area End-->

    </main>
    @push('script')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/firebase/8.0.1/firebase-app.js"></script>
        <script>
            const firebaseConfig = {
                apiKey: "AIzaSyAM7PAZZZJfeCvlQbf-8c_ehM2ZU7k5xYk",
                authDomain: "test-bfd81.firebaseapp.com",
                projectId: "test-bfd81",
                storageBucket: "test-bfd81.appspot.com",
                messagingSenderId: "171166160308",
                appId: "1:171166160308:web:7b1ef491bf82e6e648cee1",
                measurementId: "G-460MM0FE23"
            };

            // Initialize Firebase
            const app = initializeApp(firebaseConfig);

            $(document).ready(function() {
                var number = document.getelementById("mobile").value();
                $('.login_btn').on('click', function() {
                    console.log(number);
                });
            });
        </script>
    @endpush
    <script>
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
</body>

</html>
