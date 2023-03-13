@extends('front.front_layout')
@section('title', 'Package')
@section('content')


    <main>
        <!--? slider Area Start-->
        <div class="slider-area ">
            <div class="slider-active">
                <!-- Single Slider -->
                <div class="single-slider  d-flex align-items-center" id="solid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 m-auto">
                                <div class="hero__caption">
                                    <!-- <span >Discover Your Teste</span> -->
                                    <h1 class="text-center text-white">Golden Packge</h1>



                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Single Slider -->

            </div>
        </div>
        <!-- slider Area End-->
        <!--? gallery Products Start -->
        <section class="gallery-area fix ">
            <!-- Gallery Top Start -->
            <div class="gallery-top section-bg ">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="cl-xl-7 col-lg-8 col-md-10">
                            <!-- Section Tittle -->
                            <!-- <div class="section-tittle text-center mb-70">
                                                                                                                                            <span>Our Offerd Menu</span>
                                                                                                                                            <h2>Some Trendy And Popular Courses Offerd</h2>
                                                                                                                                        </div> -->
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="properties__button">
                            <!--Nav Button  -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                                        role="tab" aria-controls="nav-home" aria-selected="true">Drinks</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile"
                                        role="tab" aria-controls="nav-profile" aria-selected="false"> Sarters</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact"
                                        role="tab" aria-controls="nav-contact" aria-selected="false"> Soups </a>
                                    <a class="nav-item nav-link" id="nav-dinner-tab" data-toggle="tab" href="#nav-dinner"
                                        role="tab" aria-controls="nav-dinner" aria-selected="false">
                                        Salads </a>

                                    <a class="nav-item nav-link " id="nav-home-tab" data-toggle="tab" href="#nav-raita"
                                        role="tab" aria-controls="nav-home" aria-selected="true">Raita</a>
                                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-main"
                                        role="tab" aria-controls="nav-profile" aria-selected="false"> Main Course</a>
                                    <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-bread"
                                        role="tab" aria-controls="nav-contact" aria-selected="false"> Breads </a>
                                    <a class="nav-item nav-link" id="nav-dinner-tab" data-toggle="tab" href="#nav-deserts"
                                        role="tab" aria-controls="nav-dinner" aria-selected="false">
                                        Deserts </a>

                                    <a class="nav-item nav-link" id="nav-dinner-tab" data-toggle="tab" href="#nav-extra"
                                        role="tab" aria-controls="nav-dinner" aria-selected="false">
                                        Extras </a>
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Gallery Top End -->
            <!-- Gallery Bottom Start -->
            <div class="container p-0">
                <div class="row">
                    <div class="col-12 p-4">
                        <h5 class="pl-4">Select any four appetizers:</h5>
                        
                    </div>
                    <div class="col-md-6">
                        <h4 class="p_l">INDIAN</h4>
                        <h5 class="p_l">Veg.</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="btn-group f_r">
                            <button class="btn btn2">Filters</button>
                        </div>
                    </div>
                </div>
                <!-- Nav Card -->
                <div class="tab-content" id="nav-tabContent">
                    <!-- card one -->
                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                        <div class="container">
                        </div>
                        <div class="row no-gutters">
                        @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 1)

                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}');">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                                 @endif
                                @endforeach

                            @endif
                        </div>
                        </div>

                    <!-- Card two -->
                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 2)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}');">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                            </div>
                         </div>

                    <!-- Card three -->
                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 13)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                  @endif
                                @endforeach

                            @endif
                        </div>
                    </div>
                    <!-- Card Four -->
                    <div class="tab-pane fade" id="nav-dinner" role="tabpanel" aria-labelledby="nav-dinner">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 8)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>

                       <div class="tab-pane fade" id="nav-raita" role="tabpanel" aria-labelledby="nav-raita">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 11)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>
         
                    <div class="tab-pane fade" id="nav-main" role="tabpanel" aria-labelledby="nav-main">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 5)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}} </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>

                  <div class="tab-pane fade" id="nav-bread" role="tabpanel" aria-labelledby="nav-bread">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 12)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>
                  

                  <div class="tab-pane fade" id="nav-deserts" role="tabpanel" aria-labelledby="nav-deserts">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 3)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}}  </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>
                  
                                    <div class="tab-pane fade" id="nav-extra" role="tabpanel" aria-labelledby="nav-extra">
                        <div class="row no-gutters">
                             @if (!empty($menus))
                                @foreach ($menus as $k => $val)
                                    @if ($val->category_id == 4)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="gallery-box" id="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image: url('{{ $val->mediacollection }}')">
                                        </div>
                                        <span><i class="fa fa-plus" aria-hidden="true" id="add"></i></span>
                                        <h4 class="c-head">{{$val->name}}</h4>
                                        <p class="desc">{{$val->description}} </p>
                                        <div class="timing">
                                            <small>Serving time 9am-12pm</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                              @endif
                                @endforeach

                            @endif
                        </div>
                    </div>

                </div>
                <!-- End Nav Card -->
            </div>
            <!-- Gallery Bottom End -->
        </section>
        <!-- gallery Products End -->


        <script>
            $(document).ready(function() {
                $('#global-modal').modal('hide');

            });
        </script>
    </main>



@endsection
