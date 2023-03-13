@extends('dashboard.mainlayouts')
@section('title', 'Event Bookings')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="col-md-9">
                                <h3 class="page-title">Event Bookings</h3>
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                                    <li class="breadcrumb-item active">Event Bookings</li>
                                </ul>
                            </div>
                            <div class="col-md-3 text-right">
                                <a href="/export_event_bookings" class="btn btn-warning">Export</a>
                                <a href="/create-event" class="btn btn-primary">Create Query</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="table-responsive">
                                <table class="datatable table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Day</th>
                                            <th>MG</th>
                                            <th>Rate</th>
                                            <th>Time</th>
                                            <th>Venue/ Hall</th>
                                            <th>Type</th>
                                            <th>Guest Name</th>
                                            <th>Contact No</th>
                                            <th colspan="3" class="text-center">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($eventbooks) && $eventbooks->count() > 0)
                                            @foreach ($eventbooks as $k => $event)
                                                <tr>
                                                    <td>{{ $k + 1 }}</td>
                                                    <td>{{ date('d-m-Y', strtotime($event->event_date)) }}</td>
                                                    <td>{{ strtoupper(date('D', strtotime($event->event_date))) }}</td>
                                                    <td>{{ $event->amount_of_gathering }}</td>
                                                    <td>{{ $event->price }}</td>
                                                    <td>{{ $event->event_time }}</td>
                                                    <td>{{ $event->venue_or_hall }}</td>
                                                    <td>{{ $event->type }}</td>
                                                    <td>{{ $event->customer->customer_name }}</td>
                                                    <td>{{ $event->customer->mobile }}</td>
                                                    <td class="d-flex">

                                                        <button type="button" class="btn btn-danger btn-sm mr-2"
                                                            onclick="payment_details('{{ $event->id }}')"
                                                            title="Payment Details"
                                                            style="font-weight: bold; font-size:10px;">Payment
                                                            Details</button>

                                                        <button type="button" class="btn btn-warning btn-sm mr-2"
                                                            onclick="follwup_details('{{ $event->id }}')"
                                                            title="Follow UP"
                                                            style="font-weight: bold;font-size:10px;">Follow UP</button>

                                                        <a href="#" style="font-weight: bold;font-size:10px;"
                                                            class="mr-2">
                                                            <i class="fa fa-edit" style="font-size:20px"></i>
                                                        </a>

                                                        @if ($event->event_status == 'confirmed')
                                                            <button type="button" class="btn btn-success btn-sm"
                                                                style="font-weight: bold;font-size:10px; cursor: none;">Confirmed</button>
                                                        @elseif($event->event_status == 'cancel')
                                                            <button type="button" class="btn btn-danger btn-sm"
                                                                style="font-weight: bold;font-size:10px; cursor: none;">Cancelled</button>
                                                        @else
                                                            <button type="button" class="btn btn-secondary btn-sm"
                                                                style="font-weight: bold;font-size:10px; cursor: none;">Pending</button>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr class="text-center text-bold">
                                                <td colspan="13">No Record Found</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="add_new_event">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Payment Details</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Amount (Advance)</th>
                            <th>Payment Type</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody id="exampleid">
                    </tbody>
                </table>
                <div class="modal-body">
                    <form action="/save_payment" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="event_id" id="event_id" value="">
                        <div class="form-group">
                            <input class="form-control form-white" placeholder="Advance Payment" name="adv_payment"
                                id="adv_payment" type="number" required />
                        </div>
                        <div class="form-group mb-0">
                            <input class="form-control form-white" placeholder="Payment Type" name="payment_type"
                                id="payment_type" type="text" required />
                        </div>
                        <div class="form-group mt-4">
                            <div class="cal-icon">
                                <input class="form-control datetimepicker" id="payment_date" name="payment_date"
                                    type="text" placeholder="Payment Date" required>
                            </div>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary">Save Payment</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!---Follow up Modal Start--->
    <div class="modal fade" id="add_followup">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Follow Up Booking</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="/save_followup" method="post" autocomplete="off" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="eventfoll_id" id="eventfoll_id" value="">
                        <div class="form-group">
                            <input class="form-control datetimepicker" id="followup_date" name="followup_date"
                                type="text" placeholder="Follow Up Date" required>
                        </div>
                        <div class="form-group mb-0">
                            <textarea name="remark" id="remark" class="form-control" rows="5" cols="8" placeholder="Remarks"
                                required></textarea>
                        </div>
                        <div class="submit-section">
                            <button type="submit" class="btn btn-primary">Save Follow Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        function payment_details(id) {
            $('#add_new_event').modal('show');
            $('#event_id').val(id);
            $.ajax({
                type: "post",
                url: '/payment_details',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    $("#exampleid").empty();
                    if (data.paymet_dtls != null) {
                        $.each(data.paymet_dtls, function(key, value) {
                            $('#exampleid').append("<tr>\
                     				<td>" + value.adv_payment + "</td>\
                     				<td>" + value.pay_type + "</td>\
                     				<td>" + value.payment_date + "</td>\
                     				</tr>");
                        });
                    } else {
                        $('#exampleid').append("<tr>\
               				<td colspan='3' style='text-align:center;'>No Payments Found</td>\
               				</tr>");
                    }


                }
            });
        }

        function follwup_details(id) {
            $('#add_followup').modal('show');
            $('#eventfoll_id').val(id);
            $.ajax({
                type: "post",
                url: '/payment_details',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    console.log(data.followup_dtls);
                    if (data.followup_dtls != null) {
                        $('#followup_date').val(data.followup_dtls.followed_date);
                        $('#remark').text(data.followup_dtls.remarks);
                    } else {
                        $('#followup_date').val('');
                        $('#remark').text('');
                    }
                }
            });
        }

        function status_change(event_id, val) {
            Swal.fire({
                title: 'Are you sure to change status',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, change it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "post",
                        url: '/event_status_change',
                        data: {
                            _token: "{{ csrf_token() }}",
                            event_id: event_id,
                            val: val
                        },
                        success: function(data) {
                            location.reload();
                        }
                    });
                }
            })
        }
    </script>
@endsection
