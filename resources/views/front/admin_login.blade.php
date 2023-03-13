<!doctype html>
<html lang="en">

<head>
    <title>
        Ms Chirpy Banquet Booking | Customers Login
    </title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
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
    <link rel="stylesheet" href="{{ asset('front/assets/css/master.css') }}">

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
                            <form action="/banquet/login" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <h2 class="fw-bold text-uppercase text-center text-white">Welcome</h2>
                                <div class="row">
                                    <div class="col-md-12">
                                        <label class="">Mobile</label>
                                        <div class="input-group  mb-4">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="fa fa-mobile"></i>

                                                    </i>
                                                </span>
                                            </div>
                                            <input type="number" name="mobile" class="form-control input_user"
                                                pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==10) return false;"
                                                placeholder="Please Enter Number" required>
                                        </div>
                                        <div class="d-flex justify-content-center mt-3 login_container">
                                            <button type="submit" name="Login" class="buttonn login_btn">Sign
                                                In</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            {{-- <div>
                                <p class="mb-0">Don't have an account? <a href="#!"
                                        class="text-white-50 fw-bold">Sign Up</a>
                                </p>
                            </div> --}}

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        @if (Session::get('error'))
            <script>
                Toastify({
                    text: "Mobile Number does not exist, Please register.",
                    duration: 3000,
                    icon: 'error',
                    newWindow: true,
                    close: true,
                    gravity: "top", // `top` or `bottom`
                    position: "center", // `left`, `center` or `right`
                    stopOnFocus: true, // Prevents dismissing of toast on hover
                    style: {
                        color: "red",
                        background: "linear-gradient(to right, #fff, #fff)",
                    }
                }).showToast();
            </script>
        @endif
    </main>






    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
