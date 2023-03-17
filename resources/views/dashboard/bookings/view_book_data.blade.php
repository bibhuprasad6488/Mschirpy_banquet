@extends('dashboard.mainlayouts')
@section('title', 'View Bookings')
@section('content')


    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">View Booking Data</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active"><a href="/booking-report " class="text-secondary">View Booking Data</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body p-3">
                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-block">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif
                            @php
                                $count = 1;
                                $cntr = 1;
                            @endphp
                            {{-- @php dd($data); @endphp --}}
                            @if (!empty($data))
                                @foreach ($data as $k => $item)
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h3 class="">{{ $count++ }}.{{ $k }}</h3>
                                        </div>
                                        <div class="col-md-7 text-right">
                                            
                                            <form method="post" class="float-right" action="/addMoreItems" enctype="multipart/form-data">
                                                @csrf
                                                        <div class="input-group">
                                                            <input type="hidden" name="booking_id" id="booking_id"
                                                                value="{{ $item['others']['booking_id'] }}">
                                                            <input type="hidden" name="cat_id" id="cat_id"
                                                                value="{{ $item['others']['cat_id'] }}">
                                                            <select class="js-example-basic-multiple js-states form-control"
                                                                name="items[]" multiple="multiple" id="items" required>
                                                                @if (!empty($item['all_items']))
                                                                    @foreach ($item['all_items'] as $k => $val)
                                                                        <option value="{{ $k }}">
                                                                            {{ $val }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                            <div class="input-group-append">
                                                            <button type="submit" name="submit"
                                                                class="btn btn-primary">Add</button>
                                                        </div>
                                                        </div>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="row pb-4">
                                        @if (!empty($item['allmenus']))
                                       
                                            @foreach ($item['allmenus'] as $key => $items)
                                                @php
                                                    $imgUrl = '/storage/images/items/' . $items->image;
                                                @endphp
                                                <input type="hidden" name="booking_id" id="booking_id{{$cntr}}"
                                                value="{{ $item['others']['booking_id'] }}">
                                                <input type="hidden" name="cat_id" id="cat_id{{$cntr}}"
                                                value="{{ $item['others']['cat_id'] }}">
                                                <div class="col-md-3">
                                                    <div class="row ">
                                                        <div class="col-md-12 mt-2">
                                                            <div class="card c-cart">
                                                                <span class="text-right" id="dele"
                                                                    onclick="deleteItem('{{ $items->id }}',{{ $key }},{{$cntr}})"><i
                                                                        class="fa-solid fa-xmark pt-2 pr-2 fa-1x"></i>
                                                                </span>
                                                                <div class="card-body p-2">
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <a href="{{ $imgUrl }}" target="_blank">
                                                                                <img src="{{ $imgUrl }}"
                                                                                    style="height: 190px;"
                                                                                    class="img-responsive img-fluid"
                                                                                    height="" width="250px">
                                                                            </a>
                                                                        </div>
                                                                        <div class="col-md-12 text-center">
                                                                            <h5 class="txt-dark  pt-2">
                                                                                {{ $items->name }}
                                                                                <input type="hidden" name=""
                                                                                    id="itemName"
                                                                                    value="{{ $items->name }}">
                                                                            </h5>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                                @php $cntr++;  @endphp
                                            @endforeach
                                        @endif
                                    </div>
                                    {{-- @if (!empty($item['extra_menu']))
                                        <h5>Extra Items</h5>
                                        <div class="row border-bottom pb-2">
                                            @foreach ($item['extra_menu'] as $key => $items)
                                                @php
                                                    $imgUrl = '/storage/images/items/' . $items->image;
                                                @endphp
                                                <div class="col-md-4  mt-2">
                                                    <div class="row ">
                                                        <div class="col-md-12">
                                                            <div class="card c-cart">
                                                                <span class="text-right" id="dele"
                                                                    onclick="deleteItem('{{ $items->id }}')"><i
                                                                        class="fa fa-times-circle text-secondary"
                                                                        aria-hidden="true"></i>
                                                                </span>
                                                                <div class="card-body text-center"
                                                                    style="background-image: url({{ $imgUrl }});
                                                                           background-position:center;
                                                                           height:150px;
                                                                           background-repeat:no-repeat;
                                                                           background-size:cover;
                                                                           border-radius:5px;">
                                                                </div>
                                                                <h6 class="text-dark text-center mt-2 ">
                                                                    {{ $items->name }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif --}}
                                @endforeach
                            @endif
                            @if(count($categoryPending) > 0)
                            <form method="post" action="/add_category_to_booked_items" enctype="multipart form-data">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{$booking->id}}">
                                <div class="input-group mb-3 col-md-4">
                                    <select name="pendingcat" class="form-control" aria-describedby="basic-addon2">
                                        <option selected disabled>Select One More Category</option>
                                        @foreach($categoryPending as $v)
                                        <option value="{{$v->id}}">{{$v->category_name}}</option>
                                        @endforeach
                                    </select>
                                    <div class="input-group-append">
                                    <button class="btn btn-primary"  type="submit">ADD</button>
                                    </div>
                                </div>
                            </form>
                            @endif


                            <a href="/report/booking-report" class="btn btn-secondary">Back</a>
                            <div class="form-div float-right">
                                <form action="/final_price_update" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="input-group">
                                        <label for="" class="pt-2 mx-1">Final Price :</label>
                                        @if (!empty($booking))
                                            <input type="hidden" name="id" value="{{ $booking->id }}">
                                            <input type="text" name="amount" placeholder="Total amount"
                                                value="{{ $booking->total_amount }}" class="form-control"
                                                id="">
                                        @endif
                                        <div class="input-group-append">
                                            <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


    <script>
       
        function deleteItem(item_id, key_id, cntr) {
            var cat_id = $('#cat_id'+cntr).val();
            var booking_id = $('#booking_id'+cntr).val();
            var itemName = $('#itemName').val();
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this !",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/remove_item_cart",
                        data: {
                            _token: "{{ csrf_token() }}",
                            key_id: key_id,
                            cat_id: cat_id,
                            booking_id: booking_id,
                            item_id: item_id
                        },  
                        success: function(data) {
                            console.log(data);
                            // return false;
                            if (data = 'success') {
                                location.reload();
                            }
                        }
                    });
                } else {
                    window.location.reload(true);
                }
            })
        }

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select more Items",
                minimumResultsForSearch: -1,
                width: 250,
                allowClear: true
            });
        });
    </script>

@endsection
