@extends('front.front_layout')
@section('title', 'Cart')
@section('content')

    <section class="p-top">
        <div class="">
            <div class="slider-height2 d-flex align-items-center">
                <div class="container-fluid m-4">
                    <div class="row" id="venues2">
                        <div class="col-md-12 mt-4 pt-4 ">
                            <div class="hero-cap">
                                <h1 class="text-white text-center" style="font-weight: 100;">Your Cart</h1>
                            </div>
                            <div class="hero-cap">
                                <h6 class="text-white text-center"
                                    style="font-weight: 500; font-size: 20px; font-family: 'lato', 'sans-serif';">Selection
                                    (0/0)</h6>
                            </div>
                            <div class="hero-cap">
                                <h3 class="text-white text-center" style="font-weight: 100;">Your Cart is empty please
                                    select
                                    items</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row m-1 pb-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body text-center">
                            <div class="img-group">
                                <img src="{{ asset('front/assets/gif/plate-food.gif') }}"
                                    class="img-fluid img-responsive align-item-center" alt="" srcset="">
                            </div>
                            <div class="btn-group">
                                <a href="/banquet/all-venues" class="button m-2">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
