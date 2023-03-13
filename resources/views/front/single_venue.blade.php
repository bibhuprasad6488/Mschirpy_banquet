@extends('front.front_layout')
@section('title', 'Banquet Hall')
@section('content')


<main>
    <!------------------------------------- FIRST SECTION START HERE -------------------------------->

    <div class="slider-area mt-4">
        <div class=" d-flex align-items-center min">
            <div class="container" id="main">
                <div class="card" style="border: none;">
                    <div class="card-body" style="border: none;">
                        <div class="row ">
                            <div class="col-md-6 col-12">

                                <!-- Carousel -->
                                <div id="demo" class="carousel slide" data-bs-ride="carousel">
                                    @if (!empty($venue->venueimage))
                                    @foreach ($venue->venueimage as $key => $val)
                                    <div class="carousel-inner">
                                        <div class="carousel-item @if ($loop->first) active @endif">
                                            <img src="/storage/images/venues/{{ $val->image }}" alt="{{ $venue->venue_name }}" style="width:100%;height:300px;">
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    {{ 'Not Ok' }}
                                    @endif
                                    <!-- Left and right controls/icons -->
                                    <button class="carousel-control-prev" data-bs-target="#demo" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon"></span>
                                    </button>
                                    <button class="carousel-control-next" data-bs-target="#demo" data-bs-slide="next">
                                        <span class="carousel-control-next-icon"></span>
                                    </button>

                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <h5 class="ban1">
                                    {{ $venue->venue_name }}
                                </h5>
                                @if (!empty($venue->custom_fields))
                                <p class="text-dark">{{ $venue->custom_fields['setting'] ?? '' }}
                                    seating | {{ $venue->custom_fields['floating'] ?? '' }}
                                    Floating
                                </p>
                                @endif
                                <p class="text-justify text-dark">
                                    {{ $venue->custom_fields['address'] ?? '' }}
                                </p>
                                <div class="row">
                                    @if (!empty($venue->amenity_datas))
                                    @foreach ($venue->amenity_datas as $key => $val)
                                    <div class="col-md-1 col-sm-2 col-2 m-1 text-center " style="color: #ff5b61;">
                                        @if (!empty($val->icon))
                                        <div data-bs-toggle="tooltip" data-bs-placement="top" title="{{$val->amenity_name}}">
                                            {!! $val->icon !!}
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------- FIRST SECTION END HERE -------------------------------->


    <!------------------------------------- SECOND SECTION START HERE -------------------------------->

    <!-- Dynamically generated content -->
    <div class="glry">
        <div class="container p-l">
            <div class="row no-gutters ">
                @if (!empty($venue->package_datas))
                @foreach ($venue->package_datas as $key => $val)
                <div class="col-md-6">
                    <a href="/banquet/{{ $venue->slug }}/{{ $val->slug }}/{{$searched_date}}">
                        <div class="gallery-box" id="galleryy-box">
                            <div class="single-gallery" id="single-gall">
                                <div class="gallery-img  big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book">INR {{ $val->price }}
                                            /- + Taxes
                                        </span>
                                    </h5>
                                </div>

                                <h3 style="text-transform: capitalize;">
                                    {{ $val->package_name }}
                                </h3>
                                <p>{{ $val->menuitem->title }}</p>
                                <div class="menus">
                                    <h5>Choose from:</h5>
                                    <div class="row">
                                        <div class="col-12">Welcomes Drinks</div>
                                        @foreach ($val->package_items as $k => $v)
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li class="text-dark">{{ $k }}</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li class="text-dark">{{ $v }}</li>
                                            </ul>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>

        <div class="container">
            <div class="row mt-4">
                <div class="col-md-11 m-auto acc ">
                    <h3 class="faq">FaQs</h3>
                    @if (!empty($faq))
                    @foreach ($faq as $k => $v)
                    <button class="accordion" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne" onclick="changeIcon(this)">{{ $v->title }}<i class="material-symbols-outlined fa fa-plus"></i></button>

                    <div class="panel">
                        <p>{!! $v->content !!}</p>
                    </div>
                    @endforeach

                    @endif
                </div>
            </div>
        </div>

        <div class="text-center mt-4 mb-4">
            <button type="button" class="button  btnn mb-4 " data-toggle="modal" data-target="#myModal2" data-whatever="@mdo">WRITE A REVIEW</button>
        </div>
    </div>
    <!------------------------------------- SECOND SECTION END HERE -------------------------------->


    <!------------------------------------- MODAL START HERE -------------------------------->

    <div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" id="mode" role="document">
            <div class="modal-content">
                <div class="text-center">
                    <h4 class="text-danger text-danger md-h">TELL US YOUR EXPERIENCE!</h4>
                    <button type=" button" class="close md-hh" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12 ">
                                <div class="row">

                                    <div class=" col-sm-6  col-md-3 col-6">
                                        <label for="example-text-input" id="demo" class="col-form-label">Name</label>
                                        <input class=" frm-cnt form-control" name="customer_name" id="customer_name" type="text" required>
                                    </div>

                                    <div class=" col-sm-6  col-md-3 col-6">
                                        <label for="example-text-input" class="col-form-label">Room no.</label>
                                        <input class=" frm-cnt form-control" name="room_no" id="room_no" type="number">
                                    </div>
                                    <div class="col-sm-6  col-md-3 col-6">
                                        <label for="example-text-input" class="col-form-label">D.O.B</label>
                                        <input class=" frm-cnt form-control" name="dob" id="dob" type="date">
                                    </div>
                                    <div class="col-sm-6 col-md-3 col-6">
                                        <label for="example-text-input" class="col-form-label">Anniversary</label>
                                        <input class=" frm-cnt form-control" name="anniversary" id="anniversary" type="date">
                                    </div>
                                </div>

                                <h4 class="text-danger mt-4">The Quality of Our Services</h4>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 col-6">
                                        <p class="text-danger">Staff</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="staff" value="Polite" id="staff">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Polite
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="staff" value="Unmannerly" id="staff">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Unmannerly
                                            </label>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-6">
                                        <p class="text-danger">Service</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="service" value="Efficient" id="service">
                                            <span class="form-check-label" for="flexRadioDefault1">
                                                Efficient
                                            </span>
                                        </div>


                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="service" value=" Needs work" id="service">
                                            <span class="form-check-label" for="flexRadioDefault1">
                                                Needs work
                                            </span>
                                        </div>
                                    </div>

                                    <div class="col-md-3 col-sm-6 col-6">
                                        <p class="text-danger">Vibe</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="vibe" value="Gorgeous" id="vibe">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Gorgeous
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="vibe" value="Uninspiring" id="vibe">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Uninspiring
                                            </label>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-sm-6 col-6">
                                        <p class="text-danger"> Cleanliness</p>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cleanliness" value="Spotless" id="cleanliness">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Spotless
                                            </label>
                                        </div>

                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="cleanliness" value="Messy" id="cleanliness">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Messy
                                            </label>
                                        </div>

                                    </div>
                                </div>

                                <h4 class="text-danger">How was your food ?</h4>
                                <div class="row">
                                    <div class="col-sm-3 col-3">
                                        <p class="text-danger">Excellent</p>
                                        <label class="radio-inline">
                                            <input type="radio" name="food_quality" id="food_quality" class="rounded-checkbox" value="Excellent">
                                        </label>

                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <p class="text-danger">Good</p>
                                        <label class="radio-inline">
                                            <input type="radio" name="food_quality" id="food_quality" class="rounded-checkbox" value="Good">
                                        </label>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <p class="text-danger">Adequate</p>
                                        <span class="radio-inline">
                                            <input type="radio" name="food_quality" id="food_quality" class="rounded-checkbox" value="Adequate">
                                        </span>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <p class="text-danger"> Poor</p>
                                        <span class="radio-inline">
                                            <input type="radio" name="food_quality" id="food_quality" class="rounded-checkbox" value="Poor">
                                        </span>
                                    </div>
                                </div>
                                <h4 class="text-danger">Delighted or Disappointed ?</h4>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="delight_or_disapoint" value="Yay all the Way!" id="delight_or_disapoint">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Yay all the Way!
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <span class="form-check">
                                            <input class="form-check-input" type="radio" name="delight_or_disapoint" value="Meh." id="delight_or_disapoint">
                                            <label class="form-check-label" for="flexRadioDefault1">
                                                Meh.

                                            </label>
                                        </span>

                                    </div>
                                </div>


                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">How did you hear
                                            about Altius ?</label>
                                    </div>
                                    <div class="col-md-6 col-10">
                                        <input type="text" placeholder="Write Something ..." required class="form-control frm-cnt" name="about_altius" id="about_altius" aria-describedby="passwordHelpInline">
                                    </div>
                                    <div class="col-md-12">
                                        <label for="example-text-input" class="col-form-label">Would you like to
                                            mention a member of
                                            our team who stood out and provided exceptional service? </label>
                                    </div>
                                    <div class="col-md-8 col-10">
                                        <input class="form-control frm-cnt" placeholder="Write Something ..." required type="text" name="staff_service_exp" id="staff_service_exp">
                                    </div>
                                </div>

                                <div class="col-md-2 m-auto ">
                                    <button class="button btnn mt-4" id="butsave">Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!------------------------------------- MODAL END HERE -------------------------------->


    <style>
        body.modal-open {
            overflow-x: hidden;
        }
    </style>
</main>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
<script>
    $('#butsave').on('click', function() {
        var customer_name = $('#customer_name').val();
        var room_no = $('#room_no').val();
        var dob = $('#dob').val();
        var anniversary = $('#anniversary').val();

        var staff = $('input:radio[name="staff"]:checked').val();
        var service = $('input:radio[name="service"]:checked').val();
        var vibe = $('input:radio[name="vibe"]:checked').val();
        var cleanliness = $('input:radio[name="cleanliness"]:checked').val();
        var food_quality = $('input:radio[name="food_quality"]:checked').val();
        var delight_or_disapoint = $('input:radio[name="delight_or_disapoint"]:checked').val();
        var about_altius = $('#about_altius').val();
        var staff_service_exp = $('#staff_service_exp').val();

        if (customer_name == '' || customer_name == null || customer_name == undefined || room_no == '' ||
            room_no == null || room_no == undefined || dob == '' || dob == null || dob == undefined ||
            anniversary == '' || anniversary == null || anniversary == undefined || staff == '' || staff == null ||
            staff == undefined || service == '' || service == null || service == undefined || vibe == '' || vibe ==
            null || vibe == undefined || cleanliness == '' || cleanliness == null || cleanliness == undefined ||
            food_quality == '' || food_quality == null || food_quality == undefined || delight_or_disapoint == '' ||
            delight_or_disapoint == null || delight_or_disapoint == undefined || about_altius == '' ||
            about_altius == null || about_altius == undefined || staff_service_exp == '' || staff_service_exp ==
            null || staff_service_exp == undefined) {
            swal({
                icon: 'error',
                text: 'Kindly fill all the fields, Thank you!',
                button: "Okay"
            });
            return false;
        } else {
            $.ajax({
                url: "/banquet/customer_store",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    customer_name: customer_name,
                    room_no: room_no,
                    dob: dob,
                    anniversary: anniversary,
                    staff: staff,
                    service: service,
                    vibe: vibe,
                    cleanliness: cleanliness,
                    food_quality: food_quality,
                    delight_or_disapoint: delight_or_disapoint,
                    about_altius: about_altius,
                    staff_service_exp: staff_service_exp


                },
                cache: false,
                success: function(dataResult) {
                    console.log(dataResult);
                    var dataResult = JSON.parse(dataResult);
                    if (dataResult.statusCode == 200) {
                        swal({
                            text: 'Thank you for your feedback!',
                            icon: "success",
                            button: "Okay",
                        }).then(function() {
                            $('#myModal2').remove();
                            window.location.reload();
                        });
                    }
                    // $(".bs-example-modal-lg").modal('hide');
                    // $('#myModal2').remove();




                }
            });
        }

    });

    function changeIcon(anchor) {
        var icon = anchor.querySelector("i");
        icon.classList.toggle('fa-plus');
        icon.classList.toggle('fa-minus');

        // anchor.querySelector("span").textContent = icon.classList.contains('fa-plus') ? "Read more" : "Read less";
    }
    $(function() {
        var owl = $('#mycarousel');
        owl.owlCarousel({
            autoplay: 2000,
            items: 1,
            loop: true,
            onInitialized: counter, //When the plugin has initialized.
            onTranslated: counter //When the translation of the stage has finished.
        });

        function counter(event) {
            var element = event.target; // DOM element, in this example .owl-carousel
            var items = event.item.count; // Number of items
            var item = event.item.index + 1; // Position of the current item

            // it loop is true then reset counter from 1
            if (item > items) {
                item = item - items
            }
            $('#counter').html(item + " / " + items + " " + "Images")
        }
    });

    // it is  accordian  section
    var acc = document.getElementsByClassName("accordion");
    var i;

    for (i = 0; i < acc.length; i++) {
        acc[i].addEventListener("click", function() {
            this.classList.toggle("active");
            var panel = this.nextElementSibling;
            if (panel.style.display === "block") {
                panel.style.display = "none";
            } else {
                panel.style.display = "block";
            }
        });
    }



    function myFunction() {
        let x = document.getElementById("customer_name").value;
        let text;
        if (isNaN(x) || x < 1 || x > 10) {
            text = "This field is required ";
        } else {
            text = "Input OK";
        }
        document.getElementById("demo").innerHTML = text;
    }
</script>
@endsection