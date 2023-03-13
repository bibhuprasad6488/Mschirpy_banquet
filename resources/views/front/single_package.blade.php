@extends('front.front_layout')
@section('title', 'Package')
@section('content')
    <main style="background-color: #f6fbf1;" @if (session()->has('cid'))  @endif>
        <div class="slider-area">
            <div class="slider-height2 d-flex align-items-center"
                style="background-image:url(''); background-position: center; background-repeat: no-repeat; background-size:cover ;   width:100%; ">
                <div class="container-fluid m-4">
                    <div class="row" id="venues2">
                        <div class="col-xl-12">
                            <div class="hero-cap hero-cap2">
                                <h2 class="banner text-center"><span class="pt-4">{{ $package->package_name }}</span>
                                    <span class="h6 ml-4 pb-4">
                                        Meal Course:
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
                        <h5 class="pl-4">Select any <span id="itmmxqty"></span><span id="appit"></span> :</h5>
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
                        title: 'You have exceeded the items.'
                    });

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
