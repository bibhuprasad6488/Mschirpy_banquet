@extends('front.front_layout')
@section('title', 'Package')
@section('content')

<style type="text/css">
    .switch {
        width: 50px;
        height: 17px;
        position: relative;
        display: inline-block;
    }

    .switch input {
        display: none;
    }

    .switch .slider {
        position: absolute;
        top: 0;
        bottom: 0;
        right: 0;
        left: 0;
        cursor: pointer;
        background-color: #08bc0d85;
        border-radius: 30px !important;
        border: 0;
        padding: 0;
        display: block;
        margin: 12px 10px;
        min-height: 11px;
    }

    .switch .slider:before {
        position: absolute;
        background-color: #08bc0d;
        height: 15px;
        width: 15px;
        content: "";
        left: 0px;
        bottom: -2px;
        border-radius: 50%;
        transition: ease-in-out .5s;
    }

    .switch .slider:after {
        content: "";
        color: white;
        display: block;
        position: absolute;
        transform: translate(-50%, -50%);
        top: 50%;
        left: 70%;
        transition: all .5s;
        font-size: 10px;
        font-family: Verdana, sans-serif;
    }

    .switch input:checked+.slider:after {
        transition: all .5s;
        left: 30%;
        content: "";
    }

    .switch input:checked+.slider {
        background-color: #f4094b7d;
    }

    .switch input:checked+.slider:before {
        transform: translateX(15px);
        background-color: #f4094b;
    }

    #button {
        background-color: white;
        color: #000;
        border: 1px solid #0000001c;
        padding: 0px 2px 4px 12px;
        border-radius: 10px;
        font-size: 18px;
        box-shadow: rgb(0 0 0 / 53%) 0px 5px 8px 1px, rgb(0 0 0 / 4%) 0px 10px 10px 8px;
        ;
    }

    #add_remove {
        position: absolute;
        right: 20px;
        top: 73px !important;
        border-radius: 20px !important;
        padding: 4px 19px 4px 19px !important;
        margin: 1px 3px 1px 2px;
        background-color: #fff;
        color: #ff5b61;
        font-weight: 600;
        /*z-index: 999;*/
        font-size: 10px;
        box-shadow: rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px;
    }

    small {
        font-family: 'lato', sans-serif;
        font-weight: 600;
    }

    #backward {
        font-size: 18px;
    }

    #forward {
        padding: 5px 10px 5px 10px;
        border-radius: 50%;
    }

    #navigation_field {
        position: fixed;
        bottom: 0px;
        right: 0px;
        width: -webkit-fill-available;
    }
    
    @media only screen and (max-width: 425px) {
        .desktop_view {
            display: block;
        }
        .mobile_view {
            display: none;
        }

        #navigation_field {
            display: none;
        }
    }

    @media only screen and (min-width: 1200px) and (max-width: 1600px) {
        .mobile_view {
            display: none;
        }

        #navigation_field {
            display: none;
        }
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

    <main class="desktop_view" style="background-color: #f6fbf1;" @if (session()->has('cid')) @endif>
        <div class="slider-area">
            <div class="slider-height2 d-flex align-items-center"
                style="background-image:url(''); background-position: center; background-repeat: no-repeat; background-size:cover ;   width:100%; ">
                <div class="container-fluid m-4">
                    <div class="row" id="venues2">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2 class="banner text-center "><span class="pt-4 text-uppercase">{{ $package->package_name }}</span>
                                    <span class="h6 ml-4 pb-4">
                                        <span id="appits"></span>:
                                        <span class="text-white" id="mealcourse"></span>
                                    </span>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- slider Area End-->
        <!--? gallery Products Start -->
        <section class="gallery-area fix ">
            <!-- Gallery Top Start -->
            <div class="container">
                <div class="gallery-top  ">

                    <div class="row ">
                        <div class="col-md-12">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav id="cat_btn">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @if ($cart_cat_id != null && $cart_package_id != null)
                                            <input type="hidden" id="hdn_cat_id" value="{{ $cart_cat_id }}">
                                            <input type="hidden" id="hdn_package_id" value="{{ $cart_package_id }}">
                                        @else
                                            <input type="hidden" id="hdn_cat_id" value="{{ $cats->toArray()[0]['id'] }}">
                                            <input type="hidden" id="hdn_package_id" value="{{ $package->id }}">
                                        @endif
                                        @if (!empty($cats))
                                            @foreach ($cats as $cat)
                                                <a class="nav-item nav-link act"
                                                    onclick="showcatwiseitems('','{{ $cat->id }}','{{ $package->id }}')"
                                                    href="javascript::void(0);" aria-selected="true"
                                                    id="sts{{ $cat->id }}">{{ $cat->category_name }}</a>

                                            @endforeach
                                        @endif
                                    </div>

                                </nav>
                                <!--End Nav Button  -->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="container p-0">
                <div class="row">
                    <div class="col-12 p-4">
                        <div class="row">
                        <div class="col-md-6">
                        <h5 id="appcot" class="px-4">Select any <span id="itmmxqty"></span><span id="appit"></span> :</h5>
                        </div>
                         <div class="col-md-6">
                         <button type="button" id="fliterbtn" class="btn fltr">Filters</button>
                         <div class="form-check form-check-inline float-center d-none" id="fil1">
                            <input class="form-check-input" type="radio" name="filter" id="filter" value="veg">
                            <label class="form-check-label" for="veg_filter">Veg</label>
                          </div>
                          <div class="form-check form-check-inline float-center d-none" id="fil2">
                            <input class="form-check-input" type="radio" name="filter" id="filter1" value="nonveg">
                            <label class="form-check-label" for="nonveg_filter">Non-veg</label>
                          </div>
                        </div>
                    </div>
                        <div id="responseData"></div>
                    </div>
                </div>
            </div>

        </section>
    </main>
<!-------------------- DESKTOP VIEW END HERE ---------------->


<!---------------------- FOR MOBILE VIEW ---------------------->

<main class="mobile_view" style="background-color: #f6fbf1;" @if (session()->has('cid')) @endif >
    <div class="slider-area">
        <div class="slider-height2 d-flex align-items-center" style="background-image:url(''); background-position: center; background-repeat: no-repeat; background-size:cover ;   width:100%; ">
            <div class="container-fluid">
                <div class="row" id="venues2">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2">
                            <h2 class="banner text-center"><span class="pt-4">{{ $package->package_name }}</span>
                                <br> <span class="h6 ml-4 pb-4">
                                    Meal Course:
                                    <span class="text-white" id="">2/6</span>
                                </span>
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- slider Area End-->
    <!--? gallery Products Start -->
    <section class="gallery-area fix ">
        <!-- Gallery Top Start -->
        <div class="container">
            <div class="gallery-top  ">
                <div class="row ">
                    <div class="col-md-12 mt-4">
                        <div class="properties__button">
                            <!--Nav Button  -->
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    @if ($cart_cat_id != null && $cart_package_id != null)
                                    <input type="hidden" id="hdn_cat_id" value="{{ $cart_cat_id }}">
                                    <input type="hidden" id="hdn_package_id" value="{{ $cart_package_id }}">
                                    @else
                                    <input type="hidden" id="hdn_cat_id" value="{{ $cats->toArray()[0]['id'] }}">
                                    <input type="hidden" id="hdn_package_id" value="{{ $package->id }}">
                                    @endif

                                    @if (!empty($cats))
                                    @foreach ($cats as $cat)

                                    <a class="nav-item nav-link act" onclick="showcatwiseitems('','{{ $cat->id }}','{{ $package->id }}')" href="javascript::void(0)" aria-selected="true" id="sts{{ $cat->id }}">{{ $cat->category_name }}</a>
                                    @endforeach
                                    {{-- <nav class="mt-3">
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <a class="nav-item nav-link act" href="javascript::void(0);" style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px; background-color: #ff5b61; color: #fff;" aria-selected="true" id="sts">Indian</a>


                                            <a class="nav-item nav-link act"  style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px;" href="javascript::void(0);" aria-selected="true" id="sts">Chinese</a>

                                                    <a class="nav-item nav-link act"  style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px;" href="javascript::void(0);" aria-selected="true" id="sts">Continental</a>
                                        </div>

                                    </nav> --}}
                                    @endif
                                </div>
                            </nav>
                            <!--End Nav Button  -->
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <div class="container p-0">
            <div class="row">
                <div class="col-12 p-4">
                    <div class="row">
                        <div class="col-md-12">
                            <nav>
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    {{-- @if (!empty($cats))
                                    @foreach ($cats as $cat)
                                    @foreach($cat['cuisines_id'] as $key =>$val)
                                     <a class="nav-item nav-link act" onclick="showcatwiseitems('')" href="javascript::void(0);" style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px; background-color: #ff5b61; color: #fff;" aria-selected="true" id="sts">{{$val}}</a>
                                    @endforeach
                                    @endforeach
                                    @endif --}}

                                    <a class="nav-item nav-link act" onclick="showcatwiseitems('')" style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px; background-color: #ff5b61; color: #fff;" href="javascript::void(0);" aria-selected="true" id="sts">Indian</a>

                                    <a class="nav-item nav-link act" onclick="showcatwiseitems('')" style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px;" href="javascript::void(0);" aria-selected="true" id="sts">Chinese</a>

                                    <a class="nav-item nav-link act" onclick="showcatwiseitems('')" style="border-radius: 50px !important;border-radius: 20px !important; padding: 4px 15px 4px 13px !important;margin: 1px 3px 1px 2px;" href="javascript::void(0);" aria-selected="true" id="sts">Continental</a>
                                </div>
                            </nav>
                        </div>
                <div class="col-md-12">
                    <h6 class="pl-3 pb-0" style="font-family: 'lato', 'sans-serif'">Select any <span id="">two</span>
                        <span>Appitizer</span>:
                    </h6>
                </div>

                <div class="col-md-6">
                    <div class="d-flex flex-row">
                        <div class="col-sm-6">
                            <h4>INDIAN</h4>
                            <h6>Veg.</h6>
                        </div>
                        <div class="col-sm-6 text-right">
                            <button id="button">
                                <span>Veg</span>
                                <label class="switch">
                                    <input type="checkbox" />
                                    <div class="slider"></div>
                                </label>
                            </button>
                        </div>
                    </div>


                </div>
                <div class="col-sm-6">
                    <div class="car bg-gray border-bottom border-danger pb-2">
                        <div class=" card-body py-1 px-2 d-flex">
                            <div class="p-2 w-100 col-sm-8">
                                <h6>Mexican Peanut Masala</h6>
                                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</small>
                                <small>Serving Time 9am to 6pm</small>
                            </div>
                            <div class="p-2 flex-shrink-1 col-sm-4">
                                <img src="{{ asset('front/assets/img/content.jpg') }}" alt="" class="img-responsive float-right " width="90px" height="80px">
                                <a class="nav-item nav-link act" href="javascript::void(0);" aria-selected="true" id="add_remove">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="car bg-gray border-bottom border-danger pb-2">
                        <div class=" card-body py-1 px-2 d-flex">
                            <div class="p-2 w-100 col-sm-8">
                                <h6>Masala Papad</h6>
                                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</small>
                                <small>Serving Time 9am to 6pm</small>
                            </div>
                            <div class="p-2 flex-shrink-1 col-sm-4">
                                <img src="{{ asset('front/assets/img/content.jpg') }}" alt="" class="img-responsive float-right " width="90px" height="80px">
                                <a class="nav-item nav-link act" href="javascript::void(0);" aria-selected="true" id="add_remove">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="car bg-gray border-bottom border-danger pb-2">
                        <div class=" card-body py-1 px-2 d-flex">
                            <div class="p-2 w-100 col-sm-8">
                                <h6>Bharva Golgappa</h6>
                                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</small>
                                <small>Serving Time 9am to 6pm</small>
                            </div>
                            <div class="p-2 flex-shrink-1 col-sm-4">
                                <img src="{{ asset('front/assets/img/content.jpg') }}" alt="" class="img-responsive float-right " width="90px" height="80px">
                                <a class="nav-item nav-link act" href="javascript::void(0);" aria-selected="true" id="add_remove">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="car bg-gray border-bottom border-danger pb-2">
                        <div class=" card-body py-1 px-2 d-flex">
                            <div class="p-2 w-100 col-sm-8">
                                <h6>Mushroom Ki Galouti</h6>
                                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</small>
                                <small>Serving Time 9am to 6pm</small>
                            </div>
                            <div class="p-2 flex-shrink-1 col-sm-4">
                                <img src="{{ asset('front/assets/img/content.jpg') }}" alt="" class="img-responsive float-right " width="90px" height="80px">
                                <a class="nav-item nav-link act" href="javascript::void(0);" aria-selected="true" id="add_remove">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="car bg-gray border-bottom border-danger pb-2">
                        <div class=" card-body py-1 px-2 d-flex">
                            <div class="p-2 w-100 col-sm-8">
                                <h6>Mexican Peanut Masala</h6>
                                <small>Lorem ipsum dolor sit amet, consectetur adipisicing elit,</small>
                                <small>Serving Time 9am to 6pm</small>
                            </div>
                            <div class="p-2 flex-shrink-1 col-sm-4">
                                <img src="{{ asset('front/assets/img/content.jpg') }}" alt="" class="img-responsive float-right " width="90px" height="80px">
                                <a class="nav-item nav-link act" href="javascript::void(0);" aria-selected="true" id="add_remove">ADD</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="row bg-danger" id="navigation_field">
            <div class="col-md-12 py-3">
                <div class="d-flex flex-row">
                    <div class="col-md-6">
                        <a href="#" class="bg-transparent border-none" id="backward"><i class="fa fa-arrow-left"></i> Back</a href="#">
                    </div>
                    <div class="col-md-6 text-right pt-1">
                        <a href="#" id="forward" class="bg-white text-danger"><i class="fa fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
</main>

<!--------------------  MOBILE VIEW ENDS HERE ---------------------->
@endsection
@push('script')
<script>
$(document).ready(function() {
    var hdn_cat_id = $('#hdn_cat_id').val();
    var hdn_package_id = $('#hdn_package_id').val();
    common('', hdn_cat_id, hdn_package_id);
});

function showcatwiseitems(search, cat_id, package_id) {
    common(search, cat_id, package_id);
    $('#hdn_cat_id').val(cat_id);
    $('#filter, #filter1').prop('checked', false);
}

function common(search, cat_id, package_id) {
    $.ajax({
        type: "post",
        url: "/banquet/showitems_cat",
        data: {
            _token: "{{ csrf_token() }}",
            search: search,
            cat_id: cat_id,
            package_id: package_id
        },
        beforeSend: function() {
            $("#loading-image").show();
        },
        success: function(data) {
            $("#loading-image").hide();
            console.log(data);
            // return false;
            if (data) {
                $('#responseData').html(data.renderData);
                $('#itmmxqty').html(data.qtyVal);
                $('#mealcourse').html(data.mealcourse);
                $(".act").removeClass("active");
                $('#sts' + cat_id).addClass("active");
                $('#catlimit').val(data.catlimit);
                $('#appit').html(data.cat_data.category_name);
                $('#appits').html(data.cat_data.category_name);
            } else {
                swal({
                    text: 'Oops! No data to display',
                    icon: "error",
                    button: "Okay",
                }).then(function() {
                    window.location.reload();
                });
            }

        }
    });
}

// function changeIcon(anchor) {
//     var icon = anchor.querySelector("i");
//     icon.classList.toggle("fa-plus");
//     icon.classList.toggle("fa-check");

// }

function add_to_box(item_id) {
    var cat_id = $('#hdn_cat_id').val();
    var package_id = $('#hdn_package_id').val();
    var limit = $('#catlimit').val();
    var buttonValue = $(".active").val();
    $.ajax({
        type: "post",
        url: "/banquet/add_to_box",
        data: {
            _token: "{{ csrf_token() }}",
            cat_id: cat_id,
            item_id: item_id,
            package_id: package_id,
            limit: limit
        },
        success: function(data) {
            console.log(data);
            if (data.text == "no_login") {
                swal({
                    text: 'You need to login to access this feature',
                    icon: "info",
                    button: "Okay",
                }).then(function() {
                    window.location = '/banquet/login';
                });
            } else {
                // $('.hide_cart').show();
                $('#cart_badge').text(data.cartCount);
                if (data.cat_limit == 1) {
                    if (!$.isEmptyObject(data.nextcat)) {
                    var exd = 'Continue to '+data.nextcat.category_name;
                    var url = 'Preview Items';
                    var moretext = 'You have have reached the items limit';
                    var showcancelbtn = true;
                    var showconfirmbtn = true;
                }else{

                    var url = 'Preview Items';
                    var moretext = 'You have have reached the items limit';
                    var showcancelbtn = true;
                    var showconfirmbtn = false;
                }
                        Swal.fire({
                            text: moretext,
                            icon: 'error',
                            showCancelButton: showcancelbtn,
                            showConfirmButton: showconfirmbtn,
                            confirmButtonColor: '#30ff',
                            cancelButtonColor: '#ff5a6b',
                            confirmButtonText: exd,
                            cancelButtonText: url
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Swal.close();
                                showcatwiseitems('',data.nextcat.id,package_id);
                            } else {
                                window.location = '/banquet/cart';
                                // showcatwiseitems('',data.nextcat.id,package_id);
                            }
                        });


                    // const Toast = Swal.mixin({
                    //     toast: true,
                    //     position: 'top-end',
                    //     showConfirmButton: false,
                    //     timer: 3000,
                    //     timerProgressBar: true,
                    //     didOpen: (toast) => {
                    //         toast.addEventListener('mouseenter', Swal.stopTimer)
                    //         toast.addEventListener('mouseleave', Swal.resumeTimer)
                    //     }
                    // })
                    // Toast.fire({
                    //     icon: 'error',
                    //     title: exd
                    // });

                } else {
                    if (data.is_exist == 1) {
                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true,
                            didOpen: (toast) => {
                                toast.addEventListener('mouseenter', Swal.stopTimer)
                                toast.addEventListener('mouseleave', Swal.resumeTimer)
                            }
                        })
                        Toast.fire({
                            icon: 'error',
                            title: 'This Item is already exist'
                        });
                    } else {
                        if (data.is_limit == 1 && data.extraPrice > 0) {
                                console.log(data.nextcat);
                            if (!$.isEmptyObject(data.nextcat)) {
                            var moremsg = "You have selected "+data.category_item_count+" "+data.currentcat.category_name+"  Would you like to select more "+data.currentcat.category_name+" or continue to "+data.nextcat.category_name+" .";
                            var selectmore = 'Select more '+data.currentcat.category_name;
                            var continueto = 'Continue to '+data.nextcat.category_name;
                            var showcancelbtn = true;
                            }else{
                            var moremsg = "You have selected "+data.category_item_count+" "+data.currentcat.category_name+",  Would you like to select more "+data.currentcat.category_name+" .";
                            var selectmore = 'Select more '+data.currentcat.category_name;
                            var continueto = '';
                            var showcancelbtn = false;
                            } 
                            Swal.fire({
                                text: moremsg,
                                icon: 'success',
                                showCancelButton: showcancelbtn,
                                confirmButtonColor: '#30ff',
                                cancelButtonColor: '#ff5a6b',
                                confirmButtonText: selectmore,
                                cancelButtonText: continueto
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    Swal.close();
                                } else {
                                    showcatwiseitems('',data.nextcat.id,package_id);
                                }
                            })
                            $('#iconschng' + item_id).removeClass('fa-plus');
                            $('#iconschng' + item_id).toggleClass('fa-check');
                            $("#boxbtn" + item_id).attr("onclick", "remove_to_box('" + item_id + "')");
                        } else {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.addEventListener('mouseenter', Swal.stopTimer)
                                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                                }
                            })
                            Toast.fire({
                                icon: 'success',
                                title: 'Item Added To List'
                            });

                            $('#iconschng' + item_id).removeClass('fa-plus');
                            $('#iconschng' + item_id).toggleClass('fa-check');
                            $("#boxbtn" + item_id).attr("onclick", "remove_to_box('" + item_id + "')");
                        }
                    }
                }

            }

        }
    });
}

function remove_to_box(item_id) {
    var cat_id = $('#hdn_cat_id').val();
    var package_id = $('#hdn_package_id').val();
    var limit = $('#catlimit').val();
    // console.log("category id-- " + cat_id + ", package id ---- " + package_id + ", Item id --- " + item_id +
    // ", limit--- " + limit);
    $.ajax({
        type: "post",
        url: "/banquet/remove_to_box",
        data: {
            _token: "{{ csrf_token() }}",
            cat_id: cat_id,
            item_id: item_id,
            package_id: package_id,
            limit: limit
        },
        success: function(data) {
            // console.log(data);
            // return false;
            $('#cart_badge').text(data.cartCount);

            $('#iconschng' + item_id).removeClass('fa-check');
            $('#iconschng' + item_id).toggleClass('fa-plus');
            $("#boxbtn" + item_id).attr("onclick", "add_to_box('" + item_id + "')");
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })
            Toast.fire({
                title: 'Item removed from list',
                icon: 'warning'
            });
        }
    });
}

function functionCall(key) {
    var id = key;
    var data_id = $(".add" + key).data("id");
    console.log(data_id);
    $(".remove").removeAttr("data-id");
    if (data_id != undefined) {
        console.log("ok");
    } else {
        console.log("error");
        return false;

    }


    // alert('ok');
}



$('#search').hide();
$('.btn2').on('click', function() {
    $('#search').show();
    $('.btn2').hide();
});
// var search = document.getElementById('search');
// var btn = document.getElementById('searchBtn');
// btn.addEventListener("click", function(e) {
//     // alert('Search');
//     search.style.display = "block";
//     btn.style.display = "none";

// });
// document.addEventListener("click", function(e) {
//     // alert('ok');
//     // search.style.display = "none";
//     btn.style.display = "block";



// });
$("#fliterbtn").click(function(){
    $('#fil1, #fil2').toggleClass('d-none');
});

$('#filter, #filter1').on('change',function(){
        var val = $(this).val();
        var hdn_cat_id = $('#hdn_cat_id').val();
        var hdn_package_id = $('#hdn_package_id').val();
        // console.log(hdn_cat_id, hdn_package_id, val);
        common(val, hdn_cat_id, hdn_package_id);
    });

function filter_item(val) {
    var hdn_cat_id = $('#hdn_cat_id').val();
    var hdn_package_id = $('#hdn_package_id').val();
    console.log(hdn_cat_id, hdn_package_id);
    common(val, hdn_cat_id, hdn_package_id);
}




</script>
@endpush
