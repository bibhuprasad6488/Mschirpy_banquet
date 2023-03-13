@extends('dashboard.mainlayouts')
@section('title', 'Manage Venues')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Venues</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Venues</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">
                        @can('venues.write')
                            <a href="{{ route('venue.create') }}" class="btn btn-block btn-primary">Add Venue</a>
                        @endcan
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
                                            <th>Venue Name</th>
                                            <th>Venue Type</th>
                                            <th>No of People</th>
                                            <th>Image</th>
                                            <th>Setting</th>
                                            <th>Floating</th>
                                            <th>Amenities</th>
                                            <th>Address</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($venues))
                                            @foreach ($venues as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->venue_name }}</td>
                                                    <td>{{ $val->venuetype->venue_type }}</td>
                                                    <td>{{ $val->max_people }}</td>
                                                    <td>
                                                        <a href="#" class="viewItem"
                                                            data-id="{{ $val->id }}"><span
                                                                class="badge badge-danger">View Images</span></a>

                                                    </td>
                                                    <td>{{ $val->custom_fields['setting'] ?? '' }}</td>
                                                    <td>{{ $val->custom_fields['floating'] ?? '' }}</td>
                                                    <td>
                                                        <a href="#" class="viewAmenity"
                                                            data-id="{{ $val->id }}"><span
                                                                class="badge badge-dark">View Amenities</span></a>
                                                    </td>
                                                    <td>{{ $val->custom_fields['address'] ?? '' }}</td>
                                                    <td>
                                                        @if ($val->status == 1)
                                                            <a href="#" class="badge badge-success"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
                                                        @else
                                                            <a href="#" class="badge badge-danger"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="actions">
                                                            @can('venues.write')
                                                                <a href="{{ route('venue.edit', $val->id) }}"
                                                                    class="btn btn-sm bg-success-light">
                                                                    <i class="fa fa-pencil-square-o pt-1"></i> 
                                                                </a>
                                                            @endcan
                                                            @can('venues.delete')
                                                                <form method="post"
                                                                    action="{{ route('venue.destroy', $val->id) }}"
                                                                    style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" name="del" id="del"
                                                                        class="btn btn-sm bg-danger-light dele"><i
                                                                            class="fe fe-trash"></i>  </button>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-- No Records Found --</td>
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
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="modalBody" class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <div id="myModal2" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="modalItem" class="row ">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
    <script>
        $('.dele').on('click', function() {
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });

        $('.viewItem').on('click', function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            $.ajax({
                type: "post",
                url: "/showallimages",
                data: {
                    _token: "{{ csrf_token() }}",
                    dataId: dataId,
                },
                success: function(data) {
                    $('#modalBody').html("");
                    $.each(data, function(key, val) {
                        $('#modalBody').append(
                            '<div class="col-xl-4 col-sm-6 col-12"><div class="product"><div class="product-inner"><img alt="alt" src="/storage/images/venues/' + val + '" style="height:100px"/>');
                    });
                    $('#myModal').modal('show');
                }
            });

        });

        $('.viewAmenity').on('click', function(e) {
            e.preventDefault();
            var dataId = $(this).attr("data-id");
            // alert(dataId);
            $.ajax({
                type: "post",
                url: "/showallamenity",
                data: {
                    _token: "{{ csrf_token() }}",
                    dataId: dataId,
                },
                success: function(data) {
                    console.log(data);
                    // return false;
                    $('#modalItem').html("");
                    $.each(data, function(key, val) {
                        console.log(val);
                        var icon = val.icon;
                        var name = val.amenity_name;
                        $('#modalItem').append(
                            '<div class="col-xl-4 col-sm-8 col-12 m-auto"><div class="product text-center"><div class="product-inner">' +
                            icon + '</div><div class="product-inner">' +
                            name + '</div></div></div>'
                        );
                    });
                    $('#myModal2').modal('show');
                }
            });

        });

        function changestatus_chk(id, sts) {
            Swal.fire({
                    title: 'Are you sure to change the status !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                })

                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/venue_sts",
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
    </script>
@endpush
