@extends('dashboard.mainlayouts')
@section('title', 'Create Query')
@section('content')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="page-title">Create Query</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Create Query</li>
                                </ul>
                            </div>
                            <div class="col-md-3">
                                <label>Is Existing Customer</label>
                                <div class="input-group"><input class="form-control" type="number" placeholder="Mobile"
                                        id="mobile_search"><span class="input-group-append"><button type="button"
                                            class="btn btn-success searchbtn"><i class="fa fa-search"></i>
                                            Search</button></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
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
                            <form action="/save_event" method="post" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="cus_id" id="cus_id" value="">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Customer Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="customer_name" name="customer_name"
                                                class="form-control" placeholder="Customer Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Type</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="type" id="party_id"
                                                aria-placeholder="Select Occasion" required>
                                                <option value="">Select Occasion</option>
                                                @if (!empty($parties))
                                                    @foreach ($parties as $k => $party)
                                                        <option value="{{ $party->id }}">
                                                            {{ $party->party_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <span class="text-danger">*</span>
                                            <input type="email" id="email" name="email" class="form-control"
                                                placeholder="Email" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <span class="text-danger">*</span>
                                            <input type="number" id="mobile" name="mobile" class="form-control"
                                                pattern="/^-?\d+\.?\d*$/"
                                                onkeypress="if(this.value.length==10) return false;" placeholder="Mobile"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Date</label>
                                            <span class="text-danger">*</span>
                                            <div class="cal-icon">
                                                <input class="form-control datetimepicker" id="event_date" name="event_date"
                                                    type="text">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Event Time</label>
                                            <span class="text-danger">*</span>
                                            <input class="timepickeropen timepicker-with-dropdown text-center form-control"
                                                name="event_time">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amount Of Gathering</label>
                                            <span class="text-danger">*</span>
                                            <input type="number" name="no_of_gathering" id="no_of_gathering"
                                                class="form-control" placeholder="Amount of gathering">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <input type="number" name="price" id="price" placeholder="Price"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue/ Hall</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" name="venu_or_hall" placeholder="Venue/Hall"
                                                id="venu_or_hall" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Save">
                                    <input type="reset" class="btn btn-warning m-1" value="Reset">
                                    <a href="/all-event-bookings" class="btn btn-secondary m-1">Back</a>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
@push('script')
    <script>
        $('.timepickeropen').timepicker({
            timeFormat: 'h:mm p',
            interval: 60,
            minTime: '10',
            maxTime: '11:00pm',
            defaultTime: '10.00am',
            startTime: '10:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });

        $('.searchbtn').on('click', function() {
            var mobile = $('#mobile_search').val();
            if (mobile != '') {
                $.ajax({
                    type: "post",
                    url: '/customer_mob_search',
                    data: {
                        _token: "{{ csrf_token() }}",
                        mobile: mobile
                    },
                    success: function(data) {
                        if (data != '') {
                            $('#cus_id').val(data.id);
                            $('#customer_name').val(data.customer_name);
                            $('#customer_name').attr('readonly', 'readonly');
                            $('#email').val(data.email_id);
                            $('#email').attr('readonly', 'readonly');
                            $('#mobile').val(data.mobile);
                            $('#mobile').attr('readonly', 'readonly');
                        } else {
                            $('#cus_id').val('');
                            $('#customer_name').val('');
                            $('#customer_name').attr('readonly', false);
                            $('#email').val('');
                            $('#email').attr('readonly', false);
                            $('#mobile').val('');
                            $('#mobile').attr('readonly', false);
                        }
                    }
                });
            }
        });
    </script>
@endpush
