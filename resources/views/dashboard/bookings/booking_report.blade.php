@extends('dashboard.mainlayouts')
@section('title', 'Bookings Report')
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
                            <h3 class="page-title">Bookings Reports</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                                <li class="breadcrumb-item active">Bookings Reports</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if(!empty($booking))
                        <form method="post" class="text-right" action="/report/export_booking_report">
                            @csrf
                            <div class="form-group mb-4">
                                <button type="submit" class="btn btn-primary">Export to Excel</button>
                            </div>
                        </form>
                        @endif
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
                            <table class="datatable table  table-stripped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Customer Name</th>
                                        <th>Booking No.</th>
                                        <th>Package Name</th>
                                        <th>Venue Name</th>
                                        <th>Booking Date</th>
                                        <th>Booked Data</th>
                                        <th>Booked Status</th>

                                    </tr>
                                </thead>
                                @if (!empty ($booking))
                                @foreach ($booking as $k => $val)
                                <tr>
                                    <td>{{$k + 1}}</td>
                                    <td>{{ $val->customer->customer_name }}</td>
                                    <td>{{ $val->booking_no }}</td>
                                    <td>{{ $val->package->package_name }}</td>
                                    <td>{{ $val->venue->venue_name }}</td>
                                    <td>{{date('d-m-Y',strtotime($val->booking_datetime))}}</td>

                                    <td>
                                        <a href="/report/view_book_data/{{ $val->id }}" class="badge badge-success">
                                            View
                                        </a>
                                    <td>
                                        @if ($val->status == 'pending')
                                        <a href="#" class="badge badge-warning" onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Pending</a>
                                        @elseif($val->status = 'completed')
                                        <a href="#" class="badge badge-success" onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Ordered</a>
                                        @endif
                                    </td>

                                </tr>
                                @endforeach
                                @else
                                <tr class="text-center">
                                    <td colspan="13">No Record Found</td>
                                </tr>
                                @endif
                                </tbody>
                            </table>
                        </div>

                        <!--      <div class="modal fade" id="view_report" tabindex="-1" role="dialog" aria-labelledby="report" aria-hidden="true">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="report"></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                     </div>
                                      <table class="table table-bordered table-striped">
                                            <thead>
                                               <tr>
                                                  <th>Category Name</th>
                                                  <th>Item</th>                                
                                               </tr>
                                            </thead>
                                            <tbody id="report">
                                            </tbody>
                                        </table>
                                              <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                          </div>
                                        </div>
                                    </div>  -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    function changestatus_chk(id, sts) {
        var sts = sts;
        Swal.fire({
            title: 'Are you sure ?',
            text: 'Want to change the booking status !',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, change it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: "POST",
                    url: "/booking_change_status",
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: id,
                        sts: sts
                    },
                    success: function(data) {
                        location.reload();
                    }
                });
            }
        })
    }



    // function viewData(id)  {
    // $('#view_report').modal('show');
    //        $.ajax({
    //               type:"POST",
    //               url:'/banquet/view_book_data',
    //               data:{_token:"{{csrf_token()}}",id:id},
    //               success:function(data){
    //                console.log(data);
    //              $('#report').empty();             
    //              if(data != ''){
    //              $.each(data, function (key, val) {
    //                console.log(val);
    //                        $('#report').append(
    //                      "<tr>\
    //                            <td>"+val.category_name+"</td>\
    //                            <td>""</td>\
    //                            </tr>"
    //                      );
    //                    });
    //             }else{
    //                    $('#report').append("<tr>\
    //                        <td colspan='2'>No records found</td>\
    //                        </tr>");

    //                 }

    //                } 
    //           });

    //        }
</script>
@endsection