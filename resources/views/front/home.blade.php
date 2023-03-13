@extends('front.front_layout')
@section('title', 'Home')
@section('content')

    <main>
        <!--? slider Area Start-->
        @if (!empty($contents))
            @if ($contents->others == 'home')
                <div class="slider-area">
                    <div class="slider-height2 d-flex align-items-center"
                        style="background-image:url('/storage/images/content_images/{{ $contents->image }}'); background-position: center; background-repeat: no-repeat; background-size:cover ;  height:500px; width:100%; ">

                    </div>
                </div>

                <div class="container">
                    <div class="row mt-4">
                        <div class="col-11 m-auto">
                            <p class="text-justify">{!! $contents->content !!}</p>
                        </div>
                    </div>
                </div>
            @endif
        @endif
        <!-- slider Area End-->

        <!-- Modal Popup  -->
        {{-- <div class="modal fade" id="global-modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <!--Modal Content-->
                <div class="modal-content modal-c">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true" class="text-white">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-title">Thank You For Choosing The Altius!</div>
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-11 m-auto">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label class="">Name</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="text" class="form-control" name="name"
                                                                id="name" minlength="3" placeholder="Your Name">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Event Date</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="date" class="form-control" name="event_date"
                                                                id="date" minlength="3" aria-describedby="helpId"
                                                                placeholder="DD/MM/YYYY">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Email</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="email" class="form-control" name="email"
                                                                id="email" aria-describedby="helpId"
                                                                placeholder="Your Email">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Timing</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="time" class="form-control" name="event_time"
                                                                id="time" aria-describedby="helpId"
                                                                placeholder="00:00 AM/PM">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Phone</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="number" class="form-control" name="mobile"
                                                                id="mobile" pattern="/^-?\d+\.?\d*$/"
                                                                onKeyPress="if(this.value.length==10) return false;"
                                                                aria-describedby="helpId" placeholder="Your Number">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Number Of Gathering</label>
                                                            <span class="text-danger">*</span>
                                                            <input type="number" pattern="/^-?\d+\.?\d*$/"
                                                                onKeyPress="if(this.value.length==5) return false;"
                                                                class="form-control" name="amount_of_gathering"
                                                                id="people" aria-describedby="helpId"
                                                                placeholder="Number of Peoples">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">What's the Occasion?</label>
                                                            <span class="text-danger">*</span>
                                                            <select class="" name="type" id="party_id"
                                                                aria-placeholder="Select Occasion" required>
                                                                <option value="">Select Occasion</option>
                                                                @if (!empty($parties))
                                                                    @foreach ($parties as $k => $party)
                                                                        <option value="{{ $k }}">
                                                                            {{ $party }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 m-auto">
                                                        <div class="button-group text-center">
                                                            <button name="Savebtn" id="Savebtn" class="button">Let's
                                                                Get You
                                                                Booked</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <!-- Modal Popup End -->
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
        @php
            if (session()->has('cid')) {
                $chk = 1;
            } else {
                $chk = 0;
            }
        @endphp
        <script>
            $(document).ready(function() {
                var chk = {{ $chk }};
                if (chk == 0) {
                    $('#global-modal').modal('show');
                }

                $('.close').on('click', function() {
                    $('#global-modal').modal('hide');

                });
                $('#global-modal').on('hide', function() {
                    window.location.reload();
                });
            });


            $('#Savebtn').click(function(e) {
                e.preventDefault();
                var name = $('#name').val();
                var date = $('#date').val();
                var email = $('#email').val();
                var time = $('#time').val();
                var mobile = $('#mobile').val();
                var amount_of_gathering = $('#people').val();
                var party_id = $('#party_id').val();
                if (name == '' || date == '' || email == '' || time == '' || mobile == '' || amount_of_gathering ==
                    '' || party_id == '') {
                    Toastify({
                        text: "These fields are required.",
                        duration: 2000,
                        icon: 'error',
                        newWindow: true,
                        close: true,
                        gravity: "top",
                        position: "center",
                        stopOnFocus: true,
                        style: {
                            color: "White",
                            background: "linear-gradient(to right, #e9121a, #e9121a)",
                        }
                    }).showToast();
                    return false;

                } else {

                    $.ajax({
                        data: {
                            _token: "{{ csrf_token() }}",
                            name: name,
                            date: date,
                            email: email,
                            time: time,
                            mobile: mobile,
                            amount_of_gathering: amount_of_gathering,
                            party_id: party_id,
                        },
                        url: "/banquet/register",
                        type: "post",
                        // dataType: 'json',
                        success: function(data) {
                            // console.log(data);
                            if (data == "success") {
                                swal('Thank You', 'We will Get back to You Very Soon', 'success');
                            } else {
                                swal("error", "Registration failed. Please try again", "warning");
                            }
                            $('#global-modal').modal('hide');
                            // window.location.reload();
                            // $('#global-modal').close();



                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $('#saveBtn').html('Save Changes');
                        }
                    });
                }
            });


            new TomSelect("#party_id", {
                create: false,
                sortField: {
                    field: "text",
                    direction: "asc"
                }
            });


            $("#form").validate({
                rules: {
                    name: {
                        required: true,
                        string: true,
                        minlength: 3
                    },
                    mobile: {
                        required: true,
                        number: true,
                        min: 10
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    amount_of_gathering: {
                        required: true,
                        number: true,
                        min: 1
                    },
                    event_date: {
                        required: true,
                        minlength: 3
                    },
                    event_time: {
                        required: true,
                        minlength: 3
                    },
                    type: {
                        required: true,
                    }
                },

                messages: {
                    name: {
                        minlength: "Name should be at least 3 characters"
                    },
                    mobile: {
                        required: "Please enter your Number",
                        number: "Please enter your number as a numerical value",
                        min: "You must be at least 10"
                    },
                    email: {
                        email: "The email should be in the format: abc@domain.tld"
                    },
                    amount_of_gathering: {
                        required: "Please enter amount of gathering",
                        number: "Please enter your number as a numerical value",
                        min: "It must be at least 1"
                    },
                    event_date: {
                        minlength: "date should be at least 3 characters"
                    },
                    event_time: {
                        minlength: "time should be at least 3 characters"
                    },
                    type: {
                        type: "Please enter your occasion "
                    }
                }
            });
        </script>
    </main>



@endsection
