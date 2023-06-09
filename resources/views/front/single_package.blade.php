@extends('front.front_layout')
@section('title', 'Package')
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
                display: block;
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

        @media only screen and (min-width: 768px) and (max-width: 991px) {
            .mobile_view {
                display: none;
            }

            #navigation_field {
                display: none;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .mobile_view {
                display: block;
            }

            #navigation_field {
                display: block;
            }

            .desktop_view {
                display: none;
            }
        }
    </style>

    <!---------------------- FOR DESKTOP VIEW ---------------------->

    <main class="desktop_view" style="background-color: #f6fbf1;" @if (session()->has('cid'))  @endif>
        <div class="slider-area">
            <div class="slider-height2 d-flex align-items-center"
                style="background-image:url(''); background-position: center; background-repeat: no-repeat; background-size:cover ;   width:100%; ">
                <div class="container-fluid m-4">
                    <div class="row" id="venues2">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2 class="banner text-center "><span
                                        class="pt-4 text-uppercase">{{ $package->package_name }}</span>
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
                                <h5 id="appcot" class="px-4">Select any <span id="itmmxqty"></span><span
                                        id="appit"></span> :</h5>
                            </div>
                            <div class="col-md-6">
                                <button type="button" id="fliterbtn" class="btn fltr">Filters</button>
                                <div class="form-check form-check-inline float-center d-none" id="fil1">
                                    <input class="form-check-input" type="radio" name="filter" id="filter"
                                        value="veg">
                                    <label class="form-check-label" for="veg_filter">Veg</label>
                                </div>
                                <div class="form-check form-check-inline float-center d-none" id="fil2">
                                    <input class="form-check-input" type="radio" name="filter" id="filter1"
                                        value="nonveg">
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

    <main class="mobile_view" style="background-color: #f6fbf1;" @if (session()->has('cid'))  @endif>
        <div class="slider-area">
            <div class="slider-height2 d-flex align-items-center"
                style="background-image:url(''); background-position: center; background-repeat: no-repeat; background-size:cover ;   width:100%; ">
                <div class="container-fluid">
                    <div class="row" id="venues2">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2 class="banner text-center"><span class="pt-4">{{ $package->package_name }}</span>
                                    <br> <span class="h6 ml-4 pb-4">
                                        <span id="m_mealcourse"></span>:
                                        <span class="text-white" id="m_mealcourses"></span>
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
                        <div class="col-md-12 mt-1">
                            <div class="properties__button">
                                <!--Nav Button  -->
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        @if ($m_cart_cat_id != null && $m_cart_package_id != null)
                                            <input type="text" id="m_hdn_cat_id" value="{{ $cart_cat_id }}">
                                            <input type="text" id="m_hdn_package_id" value="{{ $cart_package_id }}">
                                        @else
                                            <input type="hidden" id="m_hdn_cat_id"
                                                value="{{ $cats->toArray()[0]['id'] }}">
                                            <input type="hidden" id="m_hdn_package_id" value="{{ $package->id }}">
                                        @endif

                                        @if (!empty($m_cats))
                                            @foreach ($m_cats as $cat)
                                                <a class="nav-item nav-link m_acts"
                                                    onclick="showcatwisecuisines('','{{ $cat->id }}','{{ $package->id }}')"
                                                    href="javascript::void(0)" aria-selected="true"
                                                    id="m_sts{{ $cat->id }}">{{ $cat->category_name }}</a>
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
                            <div class="col-md-12">
                                <div id="m_responseData"></div>
                            </div>
                            <div class="col-md-12">
                                <h6 class="pl-3 pb-0" style="font-family: 'lato', 'sans-serif'">Select any <span
                                        id="m_qtyVal"></span>
                                    <span id="m_cat_name"></span>:
                                </h6>
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex flex-row">
                                    <div class="col-sm-6">
                                        <h4 id="cus_name" class="text-uppercase"></h4>
                                        <h6 id="food_type_span1">Veg.</h6>
                                    </div>
                                    <div class="col-sm-6 text-right">
                                        <button id="button">
                                            <span id="food_type_span">Veg</span>
                                            <label class="switch">
                                                <input type="checkbox" value="Veg" name="food_type" id="food_type" />
                                                <div class="slider" onclick="getswitchval()"></div>
                                            </label>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div id="m_itemsRenderdata"></div>

                            {{-- <div class="col-sm-6">
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
                </div> --}}
                        </div>
                    </div>
                </div>

                <div class="row bg-danger" id="navigation_field">
                    <div class="col-md-12 py-3">
                        <div class="d-flex flex-row">
                            <div class="col-md-6">
                                <a href="#" class="bg-transparent border-none" id="backward"><i
                                        class="fa fa-arrow-left"></i> Back</a href="#">
                            </div>
                            <div class="col-md-6 text-right pt-1">
                                <a href="#" id="forward" class="bg-white text-danger"><i
                                        class="fa fa-arrow-right"></i></a>
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

            // <!-------------------- FOR MOBILE VIEW  ---------------------->
            var m_hdn_cat_id = $('#m_hdn_cat_id').val();
            var m_hdn_package_id = $('#m_hdn_package_id').val();
            var ftype = $('#food_type').val();
            common('', hdn_cat_id, hdn_package_id);
            m_common(ftype, m_hdn_cat_id, m_hdn_package_id);

            // <!--------------------  MOBILE VIEW  ---------------------->
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
                    // console.log(data);
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



    // <!-------------------- FOR MOBILE VIEW  ---------------------->
        function showcatwisecuisines(ftype, cat_id, package_id) {
            if (ftype == '') {
                ftype = $('#change_ftype').val();
            } else {
                ftype = $('#food_type').val();
            }
            m_common(ftype, cat_id, package_id);
            $('#m_hdn_cat_id').val(cat_id);
        }

        function m_common(ftype, cat_id, package_id) {
            $.ajax({
                type: "post",
                url: "/banquet/show_catwise_cuisines",
                data: {
                    _token: "{{ csrf_token() }}",
                    ftype: ftype,
                    cat_id: cat_id,
                    package_id: package_id
                },
                cache: false,
                success: function(data) {
                    // console.log(data);
                    $("#loading-image").hide();
                    if (data) {
                        $('#m_responseData').html(data.m_renderData);
                        $('#m_mealcourse').html(data.category_data.category_name);
                        $(".m_act").removeClass("active");
                        $('#m_sts' + data.category_data.id).addClass("active");
                        var firstValue = Object.values(data.category_data.cuisines_id)[0];
                        var cuisine_keys = Object.keys(data.category_data.cuisines_id);
                        var fstCus = cuisine_keys[0];
                        var ftype = $('#food_type').val();
                        show_cuisines_wise_itemes(ftype, fstCus, cat_id, package_id);
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

        function show_cuisines_wise_itemes(ftype, cuisn_id, cat_id, package_id) {
            // console.log(ftype, cuisn_id, cat_id,package_id);
            if (ftype == '') {
                ftype = $('#change_ftype').val();
            } else {
                ftype = $('#food_type').val();
            }
            if (cat_id == '') {
                var cat_id = $('#category_id').val();
            } else {
                var cat_id = cat_id;
            }
            if (cuisn_id) {
                // $('#change_cuisn_id').val(cuisn_id);
            }
            $('#change_cuisn_id').val(cuisn_id);
            $.ajax({
                type: "POST",
                url: "/banquet/show_cusineswise_items",
                data: {
                    _token: "{{ csrf_token() }}",
                    cat_id: cat_id,
                    ftype: ftype,
                    cuisines_id: cuisn_id,
                    package_id: package_id
                },
                cache: false,
                success: function(data) {
                    console.log(data);
                    // return false;
                    if (data) {
                        $('#m_cat_name').html(data.cat_name);
                        $('#m_qtyVal').html(data.m_qtyVal);
                        $('#m_catlimit').val(data.m_catlimit);
                        $('#m_mealcourses').html(data.m_mealcourses);
                        $('#cus_name').html(data.cus_name.cuisine_name);
                        // $(".m_act").removeClass("active");
                        // $('#m_sts' + cat_id).addClass("active");
                        $('#m_itemsRenderdata').html(data.m_itemsRenderData);
                        $(".c_act").removeClass("active");
                        $('#c_sts' + cuisn_id).addClass("active");
                    }
                }
            });
        }

        function getswitchval() {
            var ftype = $('#food_type').val();
            var cuisn_id = $('#change_cuisn_id').val();
            var cat_id = $('#category_id').val();
            var package_id = $('#m_package_id').val();
            if (ftype == "Veg") {
                $('#food_type').val('Non-veg');
                $('#change_ftype').val('Non-veg');
                $('#food_type_span').text('');
                $('#food_type_span1').text('');
                $('#food_type_span').html('Non-veg');
                $('#food_type_span1').html('Non-veg');
            } else {
                $('#food_type').val('Veg');
                $('#change_ftype').val('Non-veg');
                $('#food_type_span').text('');
                $('#food_type_span1').text('');
                $('#food_type_span').html('Veg');
                $('#food_type_span1').html('Veg');
            }
            show_cuisines_wise_itemes(ftype, cuisn_id, cat_id, package_id);

        }

    // <!-------------------- FOR MOBILE VIEW  ---------------------->

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
                                var exd = 'Continue to ' + data.nextcat.category_name;
                                var url = 'Preview Items';
                                var moretext = 'You have have reached the items limit';
                                var showcancelbtn = true;
                                var showconfirmbtn = true;
                            } else {

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
                                    showcatwiseitems('', data.nextcat.id, package_id);
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
                                        var moremsg = "You have selected " + data.category_item_count + " " +
                                            data.currentcat.category_name + "  Would you like to select more " +
                                            data.currentcat.category_name + " or continue to " + data.nextcat
                                            .category_name + " .";
                                        var selectmore = 'Select more ' + data.currentcat.category_name;
                                        var continueto = 'Continue to ' + data.nextcat.category_name;
                                        var showcancelbtn = true;
                                    } else {
                                        var moremsg = "You have selected " + data.category_item_count + " " +
                                            data.currentcat.category_name +
                                            ",  Would you like to select more " + data.currentcat
                                            .category_name + " .";
                                        var selectmore = 'Select more ' + data.currentcat.category_name;
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
                                            showcatwiseitems('', data.nextcat.id, package_id);
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
        
        $("#fliterbtn").click(function() {
            $('#fil1, #fil2').toggleClass('d-none');
        });

        $('#filter, #filter1').on('change', function() {
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
