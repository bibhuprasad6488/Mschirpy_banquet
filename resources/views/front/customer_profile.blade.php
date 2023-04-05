@extends('front.front_layout')
@section('title', 'Customer Profile')
@section('content')
 @stack('style')
    <style>
    #card-body::-webkit-scrollbar {
        display: none;
        /* overflow: hidden; */
    }
    </style>
{{-- <!doctype html>
<html lang="en">

<head>
    <title>
        Ms Chirpy Banquet Booking | Customers Profile
    </title>
    <meta charset="utf-8">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('front/assets/img/favicon.ico') }}">
   
</head>

<body class="body-color"> --}}

    <section class="p-top">
        @if (!empty($customer))
        <div class="container p-5">
            <div class="row mt-5">
                <div class="col-lg-4">
                    <div class="card card-b">
                        <div class="card-title text-dark">Profile</div>
                        <div class="card-body text-center">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-block" style="background-color: green;">
                                <button type="button" class="close text-white" data-dismiss="alert">×</button>
                                <span style="color: #fff;"><i class="fa fa-check" aria-hidden="true"></i>
                                    {{ $message }}</span>
                            </div>
                            @endif
                            @if ($message = Session::get('error'))
                            <div class="alert  alert-block" style="background-color: #ff5a60;">
                                <button type="button" class="close text-white" data-dismiss="alert">×</button>
                                <span style="color: #fff;"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                    {{ $message }}</span>
                            </div>
                            @endif

                            <div class="img_card">
                                <img src="{{ asset('front/assets/img/profile.jpg') }}" height="100px" width="100px"
                                    alt="Profile" class="img-fluid" alt="profile">
                            </div>
                            <h5 class="my-3">{{ $customer->customer_name }}</h5>
                            <p class="text-muted mb-1">{{ $customer->mobile }}</p>
                            <p class="text-muted mb-4">{{ $customer->email_id }}</p>
                            <div class=" mt-3 p-1">
                                <button class="button button-large btn-sm btn-p " data-toggle="modal"
                                    data-target="#exampleModal">Edit Profile</button>
                                    {{-- <a href="javascript:void(0)" class="button button-small btn-sm btn-p">Update Password</a> --}}
                            </div>
                            <div class="mt-1">
                                <button class="button button-large btn-sm btn-p " data-toggle="modal"
                                    data-target="#exampleModal_pass">Change Password</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card card-b" style="height: 380px !important;">
                        <div class="card-title text-dark">Booking History</div>
                        <div class="card-body text-center " id="card-body" style="overflow-y: scroll;">

                            <div class="container">
                                <div class="row">
                                    @if (!empty($bookings))
                                    @foreach ($bookings as $val)
                                    <div class="col-md-6 mb-4">
                                        <div class="card" id="card2">
                                            <div class="ribbon">#{{ $val->booking_no }}</div>
                                            <img src="{{ asset('front/assets/img/p-food.png') }}" alt=""
                                                class="img-w img-fluid  my-auto align-self-center">
                                            <div class="card-body pb-2 mt-2">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        @if ($val->status == 'pending')
                                                        <div class="status bg-warning">Pending</div>
                                                        @else
                                                        <div class="status bg-success">Completed</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="price text-auto">
                                                            &#8377;{{ number_format($val->total_amount, 2) }}/-
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @else
                                    <div class="col-md-10 mb-4">
                                        <div class="card" id="card2">
                                            <div class="ribbon">#00123456</div>
                                            <img src="{{ asset('front/assets/img/p-food.png') }}" alt=""
                                                class="img-w img-fluid  my-auto align-self-center">
                                            <div class="card-body mt-2">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="status">Canclled</div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="price text-auto">3000/-</div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Update Profile</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">

                            <form action="/banquet/update_profile" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">Name</label>
                                    <input type="text" name="customer_name" class="form-control"
                                        value="{{ $customer->customer_name }}" id="customer_name"
                                        placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mobile</label>
                                    <input type="number" name="mobile" id="mobile" class="form-control input_user"
                                        value="{{ $customer->mobile }}" pattern="/^-?\d+\.?\d*$/"
                                        onKeyPress="if(this.value.length==10) return false;"
                                        placeholder="Please Enter Number" required>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Email</label>
                                    <input type="email" class="form-control" value="{{ $customer->email_id }}"
                                        name="email_id" id="email_id" placeholder="Enter Email">
                                </div>
                                {{-- <div class="form-group">
                                    <label for="exampleInputPassword1">Password</label>
                                    <input type="password" class="form-control" value="{{ $customer->password }}"
                                        name="password" id="password" placeholder="Enter Password">
                                </div> --}}
                                <div class="text-center">
                                    <input type="submit" id="btnn" class="btnn pr-color btn-p" name="submit"
                                        value="Update">
                                    <input type="hidden" value="{{ $customer->id }}" name="id">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="exampleModal_pass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body ">

                            <form action="/banquet/update_password" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputName1">New Password</label>
                                    <input type="text" name="password" class="form-control"
                                        value="" id="password myInput" placeholder="New password">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Confirm Password</label>
                                    <input type="text" name="cpassword" id="cpassword" class="form-control"
                                        value="" placeholder="Confirm password"  >
                                        <span class="text-danger" id="alert"></span>
                                        <span class="text-success" id="alert1"></span>
                                </div>
                                <div class="text-center">
                                    <input type="submit" id="btnn" class="btnn pr-color btn-p" name="update"
                                        value="Update" >
                                    <input type="hidden" value="{{ $customer->id }}" name="id">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
    </section>
@endsection