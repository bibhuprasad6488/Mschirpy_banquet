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
    </style>

</head>

<body style="background-color:#ff5a60 !important;">
    <main style="background-color:#ff5a60 !important;" class="h-100">

        <div class="container  h-100">
            <div class="row  justify-content-center align-items-center h-100">
                <div class="col-md-12 ">
                    <div class="card">
                        <div class="card-body">
                            @if ($message = Session::get('error'))
                                <div class="alert  alert-block" style="background-color: #ff5a60;">
                                    <button type="button" class="close text-white" data-dismiss="alert">×</button>
                                    <span style="color: #fff;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>  {{ $message }}</span>
                                </div>
                            @endif
                            <div class="card-title">Thank You For Choosing The Altius!</div>
                            <form action="/banquet/register" method="post" class="form" enctype="multipart/form-data" >
                                @csrf
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="">Name</label>
                                        <span class="text-danger">*</span>
                                        <input type="text" class="form-control" name="name" id="name"
                                            minlength="3" placeholder="Your Name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Event Date</label>
                                        <span class="text-danger">*</span>
                                        <input type="date" class="form-control" name="event_date" id="date"
                                            minlength="3" aria-describedby="helpId" placeholder="DD/MM/YYYY" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <span class="text-danger">*</span>
                                        <input type="email" class="form-control" name="email" id="email"
                                            aria-describedby="helpId" placeholder="Your Email" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">

                                        <label for="">Start Time</label>
                                        <span class="text-danger">*</span>

                                        <select name="start_time" class="form-control" id="start_time" required>
                                            <option disabled selected>Select Start Time</option>
                                            @foreach (range(intval('00:00:00'), intval('24:00:00')) as $time)
                                                <option value="{{ date('H:00', mktime($time + 1)) }}">
                                                    {{ date('H:00', mktime($time + 1)) }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">End Time</label>
                                        <span class="text-danger">*</span>
                                        <select name="end_time" class="form-control" id="end_time" required>
                                            <option disabled selected>Select End Time</option>
                                            @foreach (range(intval('00:30:00'), intval('24:30:00')) as $time)
                                                <option value="{{ date('H:30', mktime($time + 1)) }}">
                                                    {{ date('H:30', mktime($time + 1)) }}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Phone</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" class="form-control" name="mobile" id="mobile"
                                            pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==10) return false;"
                                            aria-describedby="helpId" placeholder="Your Number" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Password</label>
                                        <span class="text-danger">*</span>
                                        <input type="password" class="form-control" name="password" id="password"
                                            aria-describedby="helpId" placeholder="Your Password" required>
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Confirm Password</label>
                                        <input type="text" class="form-control" name="cpassword" id="cpassword"
                                            aria-describedby="helpId" placeholder="Confirm Password">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="">Number Of Gathering</label>
                                        <span class="text-danger">*</span>
                                        <input type="number" pattern="/^-?\d+\.?\d*$/"
                                            onKeyPress="if(this.value.length==5) return false;" class="form-control"
                                            name="amount_of_gathering" id="people" aria-describedby="helpId"
                                            placeholder="Number of Peoples" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">What's the Occasion?</label>
                                        <span class="text-danger">*</span>
                                        <select class="" name="party_id" id="party_id"
                                            aria-placeholder="Select Occasion" required>
                                            <option value="">Select Occasion</option>
                                            @if (!empty($parties))
                                                @foreach ($parties as $k => $party)
                                                    <option value="{{ $k }}">
                                                        {{ $party }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>

                                <div class="col-sm-6 m-auto">
                                    <div class="button-group text-center">
                                        <button name="Savebtn" id="Savebtn" class="button">Let's
                                            Get You
                                            Booked</button>
                                    </div>
                                    <div class="text-center my-2">
                                        <p>Already have an account ?<a class="text-secondary ml-1"
                                                href="/banquet/login">Login <i class="fa fa-sign-in"
                                                    aria-hidden="true"></i>
                                            </a></p>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        <script>
            // $('#Savebtn').click(function(e) {
            //     e.preventDefault();
            //     var name = $('#name').val();
            //     var date = $('#date').val();
            //     var email = $('#email').val();
            //     var start_time = $('#start_time').val();
            //     var end_time = $('#end_time').val();
            //     var mobile = $('#mobile').val();
            //     var password = $('#password').val();
            //     var amount_of_gathering = $('#people').val();
            //     var party_id = $('#party_id').val();
            //     if (name == '' || date == '' || email == '' || start_time == '' || end_time == '' || mobile == '' ||
            //         password == '' || amount_of_gathering == '' || party_id == '') {
            //         swal({
            //             icon: 'warning',
            //             text: 'Kindly fill all the fields, Thank you!',
            //             button: "Ok"
            //         }).then(function() {
            //             window.location.reload();
            //         });
            //         return false;

            //     } else {
            //         $.ajax({
            //             data: {
            //                 _token: "{{ csrf_token() }}",
            //                 customer_name: name,
            //                 date: date,
            //                 email_id: email,
            //                 start_time: start_time,
            //                 end_time: end_time,
            //                 mobile: mobile,
            //                 password: password,
            //                 amount_of_gathering: amount_of_gathering,
            //                 party_id: party_id
            //             },
            //             cache: false,
            //             url: "/banquet/register",
            //             type: "post",
            //             // dataType: 'json',
            //             success: function(data) {
            //                 console.log(data);
            //                 // return false;

            //                 if (data == "success") {
            //                     swal({
            //                         icon: 'success',
            //                         text: 'Booking Successfully registered!',
            //                         button: "Ok"
            //                     }).then(function() {
            //                     window.location.replace('/banquet/all-venues');
            //                     });
            //                 } else {
            //                     if (data == 'mobile_exist') {
            //                         swal({
            //                             text: 'Mobile no already exist',
            //                             icon: "error",
            //                             button: "Okay"
            //                         });
            //                     }
            //                     if (data == 'email_exist') {
            //                         swal({
            //                             text: 'Email already exist',
            //                             icon: "error",
            //                             button: "Okay"
            //                         });
            //                     }
            //                 }
            //             }
            //         });
            //     }
            // });


            new TomSelect("#party_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });


            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        string: true,
                        minlength: 3
                    },
                    mobile: {
                        required: true,
                        number: true,
                        min: 10
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    amount_of_gathering: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    event_date: {
                        required: true,
                        minlength: 3
                    },
                    event_time: {
                        required: true,
                        minlength: 3
                    },
                    type: {
                        required: true,
                    }
                },

                messages: {
                    name: {
                        minlength: "Name should be at least 3 characters"
                    },
                    mobile: {
                        required: "Please enter your Number",
                        number: "Please enter your number as a numerical value",
                        min: "You must be at least 10"
                    },
                    email: {
                        email: "The email should be in the format: abc@domain.tld"
                    },
                    amount_of_gathering: {
                        required: "Please enter amount of gathering",
                        number: "Please enter your number as a numerical value",
                        min: "It must be at least 1"
                    },
                    event_date: {
                        minlength: "date should be at least 3 characters"
                    },
                    event_time: {
                        minlength: "time should be at least 3 characters"
                    },
                    type: {
                        type: "Please enter your occasion "
                    }
                }
            });
        </script>


        <!-- slider Area End-->

    </main>

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
