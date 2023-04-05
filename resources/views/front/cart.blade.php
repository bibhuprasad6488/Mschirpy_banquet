@extends('front.front_layout')
@section('title', 'Cart')
@section('content')
<style type="text/css">
    @media only screen and (max-width: 425px) {
        .desktop_view {
            display: none;
        }
        .mobile_view {
            display: block;
        }

        #navigation_field {
            display: none;
        }
        #galleryy-boxx {
            padding: 11px;
            margin: 10px 0px;
            border: 1px solid #ff5a60;
            border-radius: 5px;
            /* background-color: white; */
        }
    }

    @media only screen and (min-width: 1200px) and (max-width: 1600px) {
        .mobile_view {
            display: none;
        }

       /* #navigation_field {
            display: none;
        }*/
    }
    @media only screen and (min-width: 1900px) and (max-width: 2300px) {
        .mobile_view {
            display: none;
        }

        #navigation_field {
            display: none;
        }
    }

    @media only screen and (min-width: 768px) and (max-width: 991px){
        .mobile_view {
            display: none;
        }

        #navigation_field {
            display: none;
        }
    }

    @media only screen and (min-width: 576px) and (max-width: 767px){
        .mobile_view {
            display: none;
        }

        #navigation_field {
            display: none;
        }
    }
    
</style>

<!---------------------- FOR DESKTOP VIEW ---------------------->
    <section class="p-top desktop_view">
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
                                    ({{ $others['toatl_limit_with_extra'] ?? '' }}/{{ $others['total_limit'] ?? '' }})</h6>
                            </div>
                            <div class="hero-cap">
                                <h2 class="text-white text-center" style="font-weight: 100;">Thank You for your selection
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row m-4 pb-4">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-10 m-auto">
                            <div class="row">
                                @if (!empty($data))
                                    @foreach ($data as $k => $val)
                                        @if (array_key_exists('nonveg', $val) && array_key_exists('veg', $val))
                                            <div class="col-md-12">
                                                <div class="gallery-box" id="galleryy-boxx">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="single-gallery" id="single-gall">

                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h3 style="text-transform: capitalize;">
                                                                            {{ $k }}</h3>
                                                                        @if ($val['isExtra'] == 'yes')
                                                                            <p><small>Package includes any
                                                                                    {{ $val['countAllExtra'] }}
                                                                                    Options</small></p>
                                                                        @endif
                                                                    </div>
                                                                    <div class="col-md-6 text-right">
                                                                        <a href="/banquet/{{ $val['slug']['venue_slug'] }}/{{ $val['slug']['package_slug'] }}/{{$val['slug']['searched_date']}}/{{ $val['cat_id'] }}/{{ $val['package_id'] }}"
                                                                            class="button mx-4 button-large ">Edit Item</a>
                                                                    </div>
                                                                </div>
                                                                <div class="menus">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><small class="text-danger">VEGETARIAN</small>
                                                                            </p>
                                                                            <div class="row">
                                                                                @if (!empty($val['veg']['main_menu']))
                                                                                    @foreach ($val['veg']['main_menu'] as $menuName)
                                                                                        <div class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if (!empty($val['veg']['extra_menus']))
                                                                                    @foreach ($val['veg']['extra_menus'] as $menuName)
                                                                                        <div class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-gallery" id="single-gall">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h3 style="text-transform: capitalize;"
                                                                            class="text-white">
                                                                            .</h3>
                                                                        <p><small class="text-white">.</small></p>
                                                                    </div>
                                                                </div>
                                                                <div class="menus">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><small
                                                                                    class="text-danger">NON-VEGETARIAN</small>
                                                                            </p>
                                                                            <div class="row">
                                                                                @if (!empty($val['nonveg']['main_menu']))
                                                                                    @foreach ($val['nonveg']['main_menu'] as $menuName)
                                                                                        <div class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if (!empty($val['nonveg']['extra_menus']))
                                                                                    @foreach ($val['nonveg']['extra_menus'] as $menuName)
                                                                                        <div class="col-6">
                                                                                            {{ $menuName }}</div>
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
                                            </div>
                                        @else
                                            <div class="col-md-6 ">
                                                <div class="gallery-box" id="galleryy-boxx">
                                                    <div class="single-gallery" id="single-gall">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h3 style="text-transform: capitalize;">
                                                                    {{ $k }}
                                                                </h3>
                                                                @if ($val['isExtra'] == 'yes')
                                                                    <p><small>Package includes any
                                                                            {{ $val['countAllExtra'] }} Options</small></p>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <a href="/banquet/{{ $val['slug']['venue_slug'] }}/{{ $val['slug']['package_slug'] }}/{{$val['slug']['searched_date']}}/{{ $val['cat_id'] }}/{{ $val['package_id'] }}"
                                                                    class="button mx-2 button-large ">Edit Item</a>
                                                            </div>
                                                            <div class="col-md-6">

                                                            </div>
                                                        </div>

                                                        <div class="menus">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        @if (!empty($val['veg']['main_menu']))
                                                                            @foreach ($val['veg']['main_menu'] as $menuName)
                                                                                <div class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['veg']['extra_menus']))
                                                                            @foreach ($val['veg']['extra_menus'] as $menuName)
                                                                                <div class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['nonveg']['main_menu']))
                                                                            @foreach ($val['nonveg']['main_menu'] as $menuName)
                                                                                <div class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['nonveg']['extra_menus']))
                                                                            @foreach ($val['nonveg']['extra_menus'] as $menuName)
                                                                                <div class="col-6">{{ $menuName }}
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
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <h3 class="txt-dark" id="sum">Sum Total</h3 class="txt-dark">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="txt-dark ">
                                        <div class="card" id="price_card">
                                            <div class="card-body border-bottom" style="padding: 30px;">
                                                <h3 class="text-white ml-4 pl-2">
                                                    {{ strtoupper($others['package']->package_name ?? '') }}</h3>
                                                <ul class="list-unstyled" id="list">
                                                    <li>Package Price = &#8377;
                                                        {{ number_format($others['package']->price ?? 0) }} /- </li>
                                                    <li> Extra Items Price = &#8377; {{number_format($others['extra_all_items_price'] ?? 0)}} /-</li>
                                                </ul>
                                                <button id="open-modal-button" class="btn button-small"
                                                    onclick="confirm_booking()">CONFIRM</button>
                                            </div>
                                            @php
                                                $total = $others['package']->price + $others['extra_all_items_price'];

                                            @endphp
                                            <span class="p-1 px-4 pb-4"> Total Amount = &#8377;
                                                {{number_format($total)}} /-</span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" value="{{$others['customer']->id}}" name="customer_id" id="customer_id">
            <input type="hidden" value="{{$others['venue_id']}}" name="venue_id" id="venue_id">
            <input type="hidden" value="{{$others['searched_date']}}" name="searched_date" id="searched_date">
            <input type="hidden" value="{{$others['package']->id}}" name="package_id" id="package_id">
            <input type="hidden" value="{{$total}}" name="total_amount" id="total_amount">
        </div>
        {{-- @endif --}}
        <!-- Modal Popup  -->
        <div class="modal fade" id="global-modal" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal Content -->
                <div class="modal-content ">
                    {{-- <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 text-center m-auto">
                                    <p class="text-dark">Kindly connect with the manager to confirm your reservation</p>
                                </div>
                                <div class="col-sm-6 col-md-6  text-center">
                                    <a href="tel:+918926049402" onclick="thankYou()" class="btn call-btn btn-sm">Call</a>
                                </div>
                                <div class="col-sm-6 col-md-6  text-center">
                                    <a href="" class="btn btn-success w-btn btn-sm whtsp">Whatsapp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Popup End -->
        <script>
            function openModal() {
                // alert('Open');
                $('#global-modal').modal('show');
            }
        </script>
    </section>
<!-------------------- DESKTOP VIEW END HERE ---------------->


<!---------------------- FOR MOBILE VIEW ---------------------->

<section class="p-top mobile_view">
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
                                    ({{ $others['toatl_limit_with_extra'] ?? '' }}/{{ $others['total_limit'] ?? '' }})</h6>
                            </div>
                            <div class="hero-cap">
                                <h2 class="text-white text-center" style="font-weight: 100;">Thank You for your selection
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid ">
            <div class="row m-4 pb-4">
                <div class="col-md-12">
                            <div class="row">
                                @if (!empty($data))
                                    @foreach ($data as $k => $val)
                                        @if (array_key_exists('nonveg', $val) && array_key_exists('veg', $val))
                                            <div class="col-md-12">
                                                <div class="gallery-box" id="galleryy-boxx">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="single-gallery" id="single-gall">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h3 style="text-transform: capitalize;">
                                                                            {{ $k }}</h3>
                                                                    </div>
                                                                    <div class="col-md-6 text-right">
                                                                        <a style="position:relative; top:-30px;" href="/banquet/{{ $val['slug']['venue_slug'] }}/{{ $val['slug']['package_slug'] }}/{{$val['slug']['searched_date']}}/{{ $val['cat_id'] }}/{{ $val['package_id'] }}"
                                                                            class="button mx-2 button-large ">Edit Item</a>
                                                                    </div>
                                                                    <div class="col">
                                                                        @if ($val['isExtra'] == 'yes')
                                                                            <p style="position:relative; top:-27px;"><small>Package includes any
                                                                                    {{ $val['countAllExtra'] }}
                                                                                    Options</small></p>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                <div class="menus">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><small class="text-danger">VEGETARIAN</small>
                                                                            </p>
                                                                            <div class="row">
                                                                                @if (!empty($val['veg']['main_menu']))
                                                                                    @foreach ($val['veg']['main_menu'] as $menuName)
                                                                                        <div style="font-size: 12px;" class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if (!empty($val['veg']['extra_menus']))
                                                                                    @foreach ($val['veg']['extra_menus'] as $menuName)
                                                                                        <div style="font-size: 12px;" class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="single-gallery" id="single-gall">
                                                                
                                                                <div class="menus">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <p><small
                                                                                    class="text-danger">NON-VEGETARIAN</small>
                                                                            </p>
                                                                            <div class="row">
                                                                                @if (!empty($val['nonveg']['main_menu']))
                                                                                    @foreach ($val['nonveg']['main_menu'] as $menuName)
                                                                                        <div style="font-size: 12px;" class="col-6">
                                                                                            {{ $menuName }}</div>
                                                                                    @endforeach
                                                                                @endif
                                                                                @if (!empty($val['nonveg']['extra_menus']))
                                                                                    @foreach ($val['nonveg']['extra_menus'] as $menuName)
                                                                                        <div style="font-size: 12px;" class="col-6">
                                                                                            {{ $menuName }}</div>
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
                                            </div>
                                        @else
                                            <div class="col-md-6 ">
                                                <div class="gallery-box" id="galleryy-boxx">
                                                    <div class="single-gallery" id="single-gall">

                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h3 style="text-transform: capitalize;">
                                                                    {{ $k }}
                                                                </h3>
                                                            </div>
                                                            <div class="col-md-6 text-right">
                                                                <a style="position:relative; top:-30px;" href="/banquet/{{ $val['slug']['venue_slug'] }}/{{ $val['slug']['package_slug'] }}/{{$val['slug']['searched_date']}}/{{ $val['cat_id'] }}/{{ $val['package_id'] }}"
                                                                    class="button mx-2 button-large ">Edit Item</a>
                                                            </div>
                                                            <div class="col-md-6">

                                                                @if ($val['isExtra'] == 'yes')
                                                                    <p style="position:relative; top:-27px;"><small>Package includes any
                                                                            {{ $val['countAllExtra'] }} Options</small></p>
                                                                @endif
                                                            </div>
                                                        </div>

                                                        <div class="menus">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="row">
                                                                        @if (!empty($val['veg']['main_menu']))
                                                                            @foreach ($val['veg']['main_menu'] as $menuName)
                                                                                <div style="font-size: 12px;" class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['veg']['extra_menus']))
                                                                            @foreach ($val['veg']['extra_menus'] as $menuName)
                                                                                <div style="font-size: 12px;" class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['nonveg']['main_menu']))
                                                                            @foreach ($val['nonveg']['main_menu'] as $menuName)
                                                                                <div style="font-size: 12px;" class="col-6">{{ $menuName }}
                                                                                </div>
                                                                            @endforeach
                                                                        @endif
                                                                        @if (!empty($val['nonveg']['extra_menus']))
                                                                            @foreach ($val['nonveg']['extra_menus'] as $menuName)
                                                                                <div style="font-size: 12px;" class="col-6">{{ $menuName }}
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
                                        @endif
                                    @endforeach
                                @endif
                            </div>
                            <div class="row">
                                <div class="col-md-6 text-right">
                                    <h3 class="txt-dark" id="sum">Sum Total</h3 class="txt-dark">
                                </div>
                                <div class="col-md-6">
                                    <h3 class="txt-dark ">
                                        <div class="card" id="price_card">
                                            <div class="card-body border-bottom" style="padding: 30px;">
                                                <h3 class="text-white text-center">
                                                    {{ strtoupper($others['package']->package_name ?? '') }}</h3>
                                                <ul class="list-unstyled" id="list">
                                                    <li>Package Price = &#8377;
                                                        {{ number_format($others['package']->price ?? 0) }} /- </li>
                                                    <li> Extra Items Price = &#8377; {{number_format($others['extra_all_items_price'] ?? 0)}} /-</li>
                                                </ul>
                                                <button id="open-modal-button" class="btn button-small"
                                                    onclick="confirm_booking()">CONFIRM</button>
                                            </div>
                                            @php
                                                $total = $others['package']->price + $others['extra_all_items_price'];

                                            @endphp
                                            <span class="p-1 px-4 pb-4"> Total Amount = &#8377;
                                                {{number_format($total)}} /-</span>
                                        </div>
                                    </h3>
                                </div>
                            </div>
                </div>
            </div>
            <input type="hidden" value="{{$others['customer']->id}}" name="customer_id" id="customer_id">
            <input type="hidden" value="{{$others['venue_id']}}" name="venue_id" id="venue_id">
            <input type="hidden" value="{{$others['searched_date']}}" name="searched_date" id="searched_date">
            <input type="hidden" value="{{$others['package']->id}}" name="package_id" id="package_id">
            <input type="hidden" value="{{$total}}" name="total_amount" id="total_amount">
        </div>
        {{-- @endif --}}
        <!-- Modal Popup  -->
        <div class="modal fade" id="global-modal" role="dialog">
            <div class="modal-dialog modal-md">
                <!-- Modal Content -->
                <div class="modal-content ">
                    {{-- <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div> --}}
                    <div class="modal-body">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-10 text-center m-auto">
                                    <p class="text-dark">Kindly connect with the manager to confirm your reservation</p>
                                </div>
                                <div class="col-sm-6 col-md-6  text-center">
                                    <a href="tel:+918926049402" onclick="thankYou()" class="btn call-btn btn-sm">Call</a>
                                </div>
                                <div class="col-sm-6 col-md-6  text-center">
                                    <a href="" class="btn btn-success w-btn btn-sm whtsp">Whatsapp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal Popup End -->
        <script>
            function openModal() {
                // alert('Open');
                $('#global-modal').modal('show');
            }
        </script>
    </section>

<!--------------------  MOBILE VIEW ENDS HERE ---------------------->
@endsection
@push('script')
    <script>
        function confirm_booking()
        {
            var customer_id = $('#customer_id').val();
            var venue_id = $('#venue_id').val();
            var searched_date = $('#searched_date').val();
            var package_id = $('#package_id').val();
            var total_amount = $('#total_amount').val();

            $.ajax({
                type: "post",
                url: "/banquet/confirm_booking",
                data: {
                    _token: "{{ csrf_token() }}",
                    customer_id: customer_id,
                    venue_id: venue_id,
                    searched_date: searched_date,
                    package_id: package_id,
                    total_amount:total_amount
                },
                success: function(data) {
                    console.log(data);
                    // return false;
                    $(".whtsp").attr("href", "/banquet/thank_you");
                    $('#global-modal').modal('show');
                }

            });
        }

        function thankYou()
        {
            window.location = "/thank_you";
        }

    </script>

@endpush
