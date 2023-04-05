@extends('front.front_layout')
@section('title', 'All Halls')
@section('content')
<style>
.ui-widget-header {
    border: 1px solid #dddddd;
    background: #57c62e;
    color: #0d0d0d;
    font-weight: bold;
}

.gj-picker-md div[role="navigator"] {
    height: 42px;
    line-height: 42px;
    background-color: #ff5b61;
}

.gj-picker div[role="navigator"] div[role="period"] {
    font-weight: bold;
    font-size: 18px;
    background: #fff;
}

.gj-textbox-md {
    color: #9d9d9d;
    background-color: #f9f9f9;
    border: 0;
    height: 50px;
    width: 100%;
    padding-left: 50px;
}

.gj-datepicker-md [role="right-icon"] {
    position: absolute;
    left: 10px;
    top: 11px;
    font-size: 24px;
    color: #9d9d9d;
}

.btnnn {
    border-radius: 1px !important;
    padding: 13px 20px !important;
    color: white;
    background-color: #ff5b61;
}

.btnnn::before {
    background-color: #ff5b61;
}

.brdr {
    border: 1px solid #000 !important;
    height: 42px;
}
</style>
<main>
    @if (!empty($contents))
    @if ($contents->others == 'all-venues')
    <div class="slider-area">
        <div class="slider-height2 d-flex align-items-center"
            style="background-color:#ff5a60; background-position: center; background-repeat: no-repeat; background-size:cover ;  height:100%; width:100%; ">
            <div class="container-fluid m-4">
                <div class="row" id="venues">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2">
                            <h2 class="banner text-center" style="text-transform: uppercase;">
                                {{ $contents->page->page_name }}
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="slider-area ">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2">
                            <h2 class="banner text-center">{{ $contents->page->page_name }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->

    <!--? gallery Products Start -->
    <section class="gallery-area fix men2">
        <!-- Gallery Top Start -->

        <div class="container">

            <div class="row justify-content-center">
                <div class="properties__button">

                    <div class="container men">
                        <div class="row">
                            <div class="col-md-11 m-auto">
                        <h2>
                            The Altius Boutique Hotel
                        </h2>
                        <p class="text-justify" style="font-family:'lato', sans-serif; font-weight:600">{!!
                            $contents->content !!}</p>
                        </div>
                        </div>
                    </div>
                </div>
                <!-- <div class="container">
                    <div class="row">
                        <div class="col-md-4 m-auto">
                            <div class="form-div availability text-center">
                                <h6 class="my-4">Check Availability</h6>
                                <form action="/banquet/all-venues" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" name="date_check" id="validityCheck"
                                            class="form-control brdr "
                                            value="{{date('d-m-Y',strtotime($searched_date))}}" required
                                            autocomplete="off">
                                        <div class="input-group-append">
                                            <button type="submit" name="submit"
                                                class="btn btnnn btn-sm btn-primary">Check</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        @endif
        @endif

        <!-- Gallery Top End -->
        <!-- Gallery Bottom Start -->
        <div class="container men3">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <a class="nav-item nav-link active show n-tab" id="nav-home-tab" data-toggle="tab" href="#nav-home"
                        role="tab" aria-controls="nav-home" aria-selected="true">INDOOR</a>
                    <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
                        aria-controls="nav-profile" aria-selected="false"> OUTDOOR</a>
                </div>
            </nav>
            <!-- Nav Card -->
            <div class="tab-content" id="nav-tabContent">
                <!-- card one -->
                <div class="row">{{-- 
                    <div class="col-md-12 my-1">
                        <div class="row">
                            <div class="col-md-6">
                                <h3 class="area">Available Areas </h3>
                            </div>
                            <div class="col-md-6 text-right">
                                <button class=" mx-5" id="countVenue">4 Venues</button>
                            </div>
                        </div>
                    </div> --}}
                </div>
                
                <div class="tab-pane fade active show" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                    <div class="row no-gutters mb-4">
                            <div class="col-md-12 my-1">
                                <div class="d-flex flex-row">
                                    <div class="col-md-6">
                                        <h3 class="area">Available Areas </h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @if(!empty($indoorVenues))
                                        <button class=" mx-5" id="countVenue">{{$indoorVenues}} Venues</button>
                                        @else
                                        <button class=" mx-5" id="countVenue">0 Venues</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @if (!empty($venues))
                        @foreach ($venues as $k => $val)
                        @if ($val->venue_type == 1 && $val->status == 1)
                        <div class="col-md-6">
                            @if ($val->bookCnt < 1) <a href="/banquet/venue/{{ $val->slug }}/{{$searched_date}}">
                                @endif
                                <div class="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image:url('/storage/images/venues/{{ $val->venueimage[0]->image ?? '' }}') ;">
                                            @if ($val->bookCnt > 0)
                                            <h5>
                                                <span class="badge badge-danger badge-sm book1">BOOKED</span>
                                            </h5>
                                            @endif
                                        </div>
                                        <h5>
                                            {{ $val->venue_name }}
                                            <span class="badge badge-danger badge-sm"><i class="fa fa-star-o"
                                                    aria-hidden="true"></i> 4.3
                                            </span>
                                        </h5>
                                        @if (!empty($val->custom_fields))
                                        <p>{{ $val->custom_fields['setting'] ?? '' }}
                                            seating | {{ $val->custom_fields['floating'] ?? '' }}
                                            Floating
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($val->bookCnt < 1) </a>
                                    @endif
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                </div>
                <!-- Card two -->
                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                    <div class="row no-gutters mb-4">
                            <div class="col-md-12 my-1">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h3 class="area">Available Areas </h3>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        @if(!empty($outdoorVenues))
                                        <button class=" mx-5" id="countVenue">{{$outdoorVenues}} Venues</button>
                                        @else
                                        <button class=" mx-5" id="countVenue">0 Venues</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @if (!empty($venues))
                        @foreach ($venues as $k => $val)
                        @if ($val->venue_type == 2 && $val->status == 1)
                        <div class="col-md-6">
                            @if ($val->bookCnt < 1) <a href="/banquet/venue/{{ $val->slug }}/{{$searched_date}}">
                                @endif
                                <div class="gallery-box">
                                    <div class="single-gallery">
                                        <div class="gallery-img big-img"
                                            style="background-image:url('/storage/images/venues/{{ $val->venueimage[0]->image ?? '' }}') ; background-position: center; background-repeat: no-repeat; background-size:cover ; ">
                                            @if ($val->bookCnt > 0)
                                            <h5>
                                                <span class="badge badge-danger badge-sm book1">BOOKED</span>
                                            </h5>
                                            @endif
                                        </div>
                                        <h5>
                                            {{ $val->venue_name }}
                                            <span class="badge badge-danger badge-sm"><i class="fa fa-star-o"
                                                    aria-hidden="true"></i> 4.3
                                            </span>
                                        </h5>
                                        @if (!empty($val->custom_fields))
                                        <p>{{ $val->custom_fields['setting'] ?? '' }}
                                            seating | {{ $val->custom_fields['floating'] ?? '' }}
                                            Floating
                                        </p>
                                        @endif
                                    </div>
                                </div>
                                @if ($val->bookCnt < 1) </a>
                                    @endif
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
    <!--? Our Services Start -->

    <!-- Our Services End -->
</main>
@endsection
@push('script')

<script>
$(document).ready(function() {
    $("#validityCheck").datepicker({
        format: 'dd-mm-yyyy', // format for date
        minDate: 0
    });
});
</script>

@endpush