@extends('front.front_layout')
@section('title', 'Banquet Hall')
@section('content')
    <main>
        <div class="slider-area mt-4">
            <div class=" d-flex align-items-center min">

                <div class="container" id="main">
                    <div class="card" style="border: none;">
                        <div class="card-body" style="border: none;">
                            <div class="row ">
                                <div class="col-md-6 col-12">

                                    {{-- <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                            <li data-target="#myCarousel" data-slide-to="1"></li>
                                            <li data-target="#myCarousel" data-slide-to="2"></li>
                                        </ol>

                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner">
                                            <div class="item active">
                                                <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="Los Angeles"
                                                    style="width:100%;">
                                            </div>

                                            <!--  <div class="item">
                                                    <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="Chicago" style="width:100%;">
                                                </div>

                                                <div class="item">
                                                    <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="New york" style="width:100%;">
                                                </div> -->
                                        </div>

                                        <!-- Left and right controls -->
                                        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
                                            <span class="glyphicon glyphicon-chevron-left"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="right carousel-control" href="#myCarousel" data-slide="next">
                                            <span class="glyphicon glyphicon-chevron-right"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                        <p id="counter" class="cntr"></p>
                                    </div> --}}
                                    <!-- Carousel -->
                                    <div id="demo" class="carousel slide" data-bs-ride="carousel">

                                        <!-- Indicators/dots -->
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="0"
                                                class="active"></button>
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#demo" data-bs-slide-to="2"></button>
                                        </div>

                                        <!-- The slideshow/carousel -->
                                        <div class="carousel-inner">
                                            <div class="carousel-item active">
                                                <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="Los Angeles"
                                                    style="width:100%;">

                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="Chicago"
                                                    style="width:100%;">

                                            </div>
                                            <div class="carousel-item">
                                                <img src="{{ asset('front/assets/img/dnrr.jpg') }}" alt="New york"
                                                    style="width:100%;">

                                            </div>
                                        </div>

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
                                        {{ $venues->venue_name }}
                                    </h5>
                                    @if (!empty($venues->custom_fields))
                                        <p>{{ $venues->custom_fields['setting'] ?? '' }}
                                            seating | {{ $venues->custom_fields['floating'] ?? '' }}
                                            Floating
                                        </p>
                                    @else
                                        <p> 0 Seating | 0 Floating</p>
                                    @endif
                                    <p class="text-justify">
                                        {{ $venues->custom_fields['address'] ?? '' }}

                                    </p>

                                    <div class="row">
                                        @if (!empty($amenities))
                                            @foreach ($amenities as $key => $val)
                                                <div class="col-md-1 col-sm-1 col-2 m-1 ">

                                                    <div>
                                                        @if (!empty($val->mediacollection))
                                                            <img class="avatar-img rounded-circle"
                                                                src="{{ $val->mediacollection }}" alt="{{ $val->name }}"
                                                                height="35px" title="{{ $val->name }}">
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>

                                </div>

                                {{-- <div class="col-md-6 col-12">
                                    <h5 class="ban1">
                                        Banquet hall
                                    </h5>
                                    <p class="text-dark">140 seating | 200 Floating</p>
                                    <p class="text-justify text-dark">when an unknown printer took a galley of type and
                                        scrambled
                                        it to make a type
                                        specimen
                                        book.
                                        It has survived not only five centuries, but also the leap into electronic
                                        typesetting,
                                        remaining essentially unchanged.
                                    </p>
                                    <span><i class="fa fa-wifi fa1 clr" aria-hidden="true"></i></span>
                                    <span><i class="fa fa-snowflake-o clr" aria-hidden="true"></i></span>
                                    <span><i class="fa-solid fa-trash fa fa1 clr"></i></span>
                                    <span><i class="fa fa-sign-in clr"></i></span>
                                </div> --}}


                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
        </div>
        <!-- Dynamically generated content -->
        <div class="glry">
            <div class="container p-l">
                <div class="row no-gutters ">
                    @if (!empty($packages))
                        @foreach ($packages as $key => $val)
                            <div class="col-md-6">
                                <div class="gallery-box" id="galleryy-box">
                                    <div class="single-gallery" id="single-gall">
                                        <div class="gallery-img  big-img">
                                            <h5>
                                                <span class="badge badge-danger badge-sm book">INR {{ $val->price }} /-
                                                </span>
                                            </h5>
                                        </div>
                                        <h3 style="text-transform: capitalize;">
                                            {{ $val->package_name }}
                                        </h3>
                                        <p>{{ $val->menuitem->title }}

                                        </p>
                                        <div class="menus">

                                            <h3>Choose from:</h3>
                                            <div class="row">
                                                <div class="col-12">Welcomes Drinks</div>
                                                @foreach ($val->no_of_items as $k => $v)
                                                    <div class="col-sm-3 col-3">
                                                        <ul>
                                                            @foreach ($menus as $key => $val)
                                                                @if ($k == $val->id)
                                                                    <li id="name">{{ $val->name }} </li>
                                                                @endif
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-sm-3 col-3">
                                                        <ul>
                                                            <li>
                                                                {{ $v }}
                                                            </li>

                                                        </ul>
                                                    </div>
                                                @endforeach

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif



                </div>


            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-11 m-auto acc ">
                        <h3 class="faq">FaQs</h3>

                        <button class="accordion" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">What are the payment methods available
                            ?<span class="material-symbols-outlined">expand_more</span></button>

                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>

                        <button class="accordion">What are the terms regrading cancellation of booking ?<span
                                class="material-symbols-outlined">expand_more</span></button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>

                        <button class="accordion">What are the terms regrading cancellation of booking ?<span
                                class="material-symbols-outlined">expand_more</span></button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>

                        <button class="accordion">What are the terms regrading cancellation of booking ?<span
                                class="material-symbols-outlined">expand_more</span></button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4 mb-4">
                <button type="button" class="button btn-secondary btnn mb-4 " data-toggle="modal" data-target="#myModal2"
                    data-whatever="@mdo">WRITE A REVIEW</button>
            </div>
        </div>
        <!-- End Dynamically generated content -->
        {{-- <div class="glry">
            <div class="container p-l">
                <div class="row no-gutters mb-4">
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book">Select
                                        </span>
                                    </h5>
                                </div>
                                <h3>
                                    ALa-carte
                                </h3>
                                <p>Venue+Multi course meal</p>
                                <h3>Choose from:</h3>
                                <p> It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book"> INR 3399/-4 Taxes
                                        </span>
                                    </h5>
                                </div>
                                <h3>
                                    Conference Package
                                </h3>
                                <p>Venue+Tea</p>
                                <h3>Includes:</h3>
                                <p> It has survived not only five centuries, but also the leap into electronic
                                    typesetting,
                                    remaining essentially unchanged.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row no-gutters mb-4">
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book"> INR 1299/-4 Taxes</span>
                                    </h5>
                                </div>
                                <h3>
                                    Sliver Package
                                </h3>
                                <p>Venue+Multi course meal</p>
                                <h3>Choose from:</h3>
                                <div class="row">
                                    <div class="col-12">Welcomes Drinks</div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li></li>
                                            <li>Soups</li>
                                            <li>Salads</li>
                                            <li>Main Course</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>1</li>
                                            <li>5</li>
                                            <li>6</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>Staters</li>
                                            <li>Raita</li>
                                            <li>Breads</li>
                                            <li>Desserts</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>6</li>
                                            <li>1</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book"> INR 1399/-4 Taxes
                                        </span>
                                    </h5>
                                </div>
                                <h3>
                                    Gold Package
                                </h3>
                                <p>Venue+Multi course meal</p>
                                <h3>Includes:</h3>
                                <div class="row">
                                    <div class="col-12">Welcomes Drinks</div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li></li>
                                            <li>Soups</li>
                                            <li>Salads</li>
                                            <li>Main Course</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li></li>
                                            <li>1</li>
                                            <li>5</li>
                                            <li>6</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>Staters</li>
                                            <li>Raita</li>
                                            <li>Breads</li>
                                            <li>Desserts</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>6</li>
                                            <li>1</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book"> INR 1399/-4 Taxes
                                        </span>
                                    </h5>
                                </div>
                                <h3>
                                    Platinum Package
                                    </h5>
                                    <p>Venue+Multi course meal</p>
                                    <h3>Choose From:</h3>
                                    <div class="row">
                                        <div class="col-12">Welcomes Drinks</div>
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li></li>
                                                <li>Soups</li>
                                                <li>Salads</li>
                                                <li>Main Course</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li></li>
                                                <li>1</li>
                                                <li>5</li>
                                                <li>6</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li>Staters</li>
                                                <li>Raita</li>
                                                <li>Breads</li>
                                                <li>Desserts</li>
                                            </ul>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <ul>
                                                <li>6</li>
                                                <li>1</li>
                                                <li>3</li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img big-img">
                                    <h5>
                                        <span class="badge badge-danger badge-sm book"> INR 1199/-4 Taxes
                                        </span>
                                    </h5>
                                </div>
                                <h3>
                                    Chef's Special
                                </h3>
                                <p>Venue+Multi course meal</p>
                                <h3>Includes:</h3>
                                <div class="row">
                                    <div class="col-12">Welcomes Drinks</div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>Soups</li>
                                            <li>Salads</li>
                                            <li>Main Course</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>1</li>
                                            <li>5</li>
                                            <li>6</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>Staters</li>
                                            <li>Raita</li>
                                            <li>Breads</li>
                                            <li>Desserts</li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3 col-3">
                                        <ul>
                                            <li>6</li>
                                            <li>1</li>
                                            <li>3</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <h3 class="">FaQs</h3>
                <div class="row">
                    <div class="col-md-10 panel-heading">
                        <button class="accordion" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                            aria-expanded="false" aria-controls="collapseOne">What are the payment methods available
                            ?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>
                        <button class="accordion">What are the terms regrading cancellation of booking ?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>
                        <button class="accordion">What are the terms regrading cancellation of booking ?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>
                        <button class="accordion">What are the terms regrading cancellation of booking ?</button>
                        <div class="panel">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor
                                incididunt ut labore
                                et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                                laboris nisi ut
                                aliquip ex ea commodo consequat.</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-4 mb-4">
                <button type="button" class="button btn-secondary btnn mb-4 " data-toggle="modal"
                    data-target="#myModal2" data-whatever="@mdo">WRITE A REVIEW</button>
            </div>
        </div> --}}


        <div class="modal fade bs-example-modal-lg" id="myModal2" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel">
            <div class="modal-dialog modal-lg" id="mode" role="document">
                <div class="modal-content">
                    <div class="text-center">
                        <h4 class="text-danger text-danger md-h">TELL US YOUR EXPERIENCE!</h4>
                        <button type=" button" class="close md-hh" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-12 ">
                                    <div class="row">

                                        <div class=" col-sm-6  col-md-3 col-6">
                                            <label for="example-text-input" id="demo"class="col-form-label">Name</label>
                                            <input class=" frm-cnt form-control" name="customer_name" id="customer_name"
                                                type="text" required >
                                        </div>

                                        <div class=" col-sm-6  col-md-3 col-6">
                                            <label for="example-text-input" class="col-form-label">Room no.</label>
                                            <input class=" frm-cnt form-control" name="room_no" id="room_no"
                                                type="number">
                                        </div>
                                        <div class="col-sm-6  col-md-3 col-6">
                                            <label for="example-text-input" class="col-form-label">D.O.B</label>
                                            <input class=" frm-cnt form-control" name="dob" id="dob"
                                                type="date">
                                        </div>
                                        <div class="col-sm-6 col-md-3 col-6">
                                            <label for="example-text-input" class="col-form-label">Anniversary</label>
                                            <input class=" frm-cnt form-control" name="anniversary" id="anniversary"
                                                type="date">
                                        </div>
                                    </div>

                                    <h4 class="text-danger mt-4">The Quality of Our Services</h4>
                                    <div class="row">
                                        <div class="col-md-3 col-sm-6 col-6">
                                            <p class="text-danger">Staff</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="staff"
                                                    value="Polite" id="staff">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Polite
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="staff"
                                                    value="Unmannerly" id="staff">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Unmannerly
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-6">
                                            <p class="text-danger">Service</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="service"
                                                    value="Efficient" id="service">
                                                <span class="form-check-label" for="flexRadioDefault1">
                                                    Efficient
                                                </span>
                                            </div>


                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="service"
                                                    value=" Needs work" id="service">
                                                <span class="form-check-label" for="flexRadioDefault1">
                                                    Needs work
                                                </span>
                                            </div>
                                        </div>

                                        <div class="col-md-3 col-sm-6 col-6">
                                            <p class="text-danger">Vibe</p>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="vibe"
                                                    value="Gorgeous" id="vibe">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Gorgeous
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="vibe"
                                                    value="Uninspiring" id="vibe">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Uninspiring
                                                </label>
                                            </div>

                                        </div>
                                        <div class="col-md-3 col-sm-6 col-6">
                                            <p class="text-danger"> Cleanliness</p>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cleanliness"
                                                    value="Spotless" id="cleanliness">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Spotless
                                                </label>
                                            </div>

                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="cleanliness"
                                                    value="Messy" id="cleanliness">
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
                                                <input type="radio" name="food_quality" id="food_quality"
                                                    class="rounded-checkbox" value="Excellent">
                                            </label>

                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <p class="text-danger">Good</p>
                                            <label class="radio-inline">
                                                <input type="radio" name="food_quality" id="food_quality"
                                                    class="rounded-checkbox" value="Good">
                                            </label>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <p class="text-danger">Adequate</p>
                                            <span class="radio-inline">
                                                <input type="radio" name="food_quality" id="food_quality"
                                                    class="rounded-checkbox" value="Adequate">
                                            </span>
                                        </div>
                                        <div class="col-sm-3 col-3">
                                            <p class="text-danger"> Poor</p>
                                            <span class="radio-inline">
                                                <input type="radio" name="food_quality" id="food_quality"
                                                    class="rounded-checkbox" value="Poor">
                                            </span>
                                        </div>
                                    </div>
                                    <h4 class="text-danger">Delighted or Disappointed ?</h4>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="delight_or_disapoint" value="Yay all the Way!"
                                                    id="delight_or_disapoint">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Yay all the Way!
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <span class="form-check">
                                                <input class="form-check-input" type="radio"
                                                    name="delight_or_disapoint" value="Meh." id="delight_or_disapoint">
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
                                            <input type="text" placeholder="Write Something ..." required
                                                class="form-control frm-cnt" name="about_altius"
                                                id="about_altius"aria-describedby="passwordHelpInline">
                                        </div>
                                        <div class="col-md-12">
                                            <label for="example-text-input" class="col-form-label">Would you like to
                                                mention a member of
                                                our team who stood out and provided exceptional service? </label>
                                        </div>
                                        <div class="col-md-8 col-10">
                                            <input class="form-control frm-cnt" placeholder="Write Something ..." required
                                                type="text" name="staff_service_exp" id="staff_service_exp">
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
        </div>


        <style>
            body.modal-open {
                overflow-x: hidden;
            }
        </style>
    </main>
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
                        swal('Thank You', 'Thank you for your feedback!', 'success');
                    }

                    $('#myModal2').remove();
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);

                }
            });
            };



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
