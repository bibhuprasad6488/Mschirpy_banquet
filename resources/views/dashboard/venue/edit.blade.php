@extends('dashboard.mainlayouts')
@section('title', 'Edit Venue')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Venue</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Venue</li>
                        </ul>
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
                            <form action="{{ route('venue.update', $venue->id) }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="venue_name" name="venue_name" class="form-control"
                                                placeholder="Venue Name" value="{{ $venue->venue_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Package</label>
                                            <span class="text-danger">*</span>
                                            <select class="js-example-basic-multiple form-control" name="package_id[]"
                                                multiple="multiple" required>
                                                @if (!empty($packages))
                                                    @foreach ($packages as $package)
                                                        <option value="{{ $package->id }}"
                                                            @if (in_array($package->id, $venue->package_id)) selected @endif>
                                                            {{ $package->package_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue Type</label>
                                            <select class="form-control" name="venue_type">
                                                <option value="">Select Venue Type</option>
                                                @if (!empty($venueTypes))
                                                    @foreach ($venueTypes as $venuetype)
                                                        <option value="{{ $venuetype->id }}"
                                                            {{ $venuetype->id == $venue->venue_type ? 'selected' : '' }}>
                                                            {{ $venuetype->venue_type }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maximum No of People</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="max_people" name="max_people" class="form-control"
                                                placeholder="Maximum No of People" required
                                                value="{{ $venue->max_people }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlFile1">image</label>

                                        <div class="customer_records">
                                            <div class="row" id="imageField">

                                                <div class="col-md-11">

                                                    <input type="file" name="venue_image[]" class="form-control">

                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <button class=" btn btn-success extra-fields-customer"
                                                        type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">

                                            @if (!empty($venue->venueimage))
                                                @foreach ($venue->venueimage as $venueImage)
                                                    <div class="col-sm-2 p-4">
                                                        <a href="/storage/images/venues/{{ $venueImage->image }}" target="_blank">
                                                            <img class="avatar-img rounded-circle"
                                                                src=" /storage/images/venues/{{ $venueImage->image }}"
                                                                alt="{{ $venueImage->name }}" height="50px" width="100%">
                                                        </a>
                                                    </div>
                                                    <a href="#" class="p-2 delImg "
                                                        data-id="{{ $venueImage->id }}"><i
                                                            class="fa fa-times-circle text-secondary"
                                                            aria-hidden="true"></i>
                                                    </a>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Setting</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="setting" name="setting" class="form-control"
                                                placeholder="setting" value="{{ $venue->custom_fields['setting'] ?? '' }}"
                                                required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Floating</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="floating" name="floating" class="form-control"
                                                placeholder="floating"
                                                value="{{ $venue->custom_fields['floating'] ?? '' }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Amenities</label>
                                            <span class="text-danger">*</span>
                                            <select class="js-example-basic-multiple form-control" name="amenity_id[]"
                                                multiple="multiple" required>
                                                @if (!empty($amenities))
                                                    @foreach ($amenities as $amenities)
                                                        <option value="{{ $amenities->id }}"
                                                            @if (in_array($amenities->id, $venue->custom_fields['amenity'] ?? '')) selected @endif>
                                                            {{ $amenities->amenity_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <span class="text-danger">*</span>
                                            <textarea name="address" id="address" rows="2" class="form-control" placeholder="Address" required>{{ $venue->custom_fields['address'] ?? '' }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $venue->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="2" {{ $venue->status == 2 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="{{ route('venue.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select Packages",
                allowClear: true
            });
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                // placeholder: "Select Packages",
                allowClear: true
            });
        });
        $('.extra-fields-customer').click(function() {
            $('.customer_records').append(
                '<div class="row mt-2 mb-2"><div class="col-md-11"><input name="venue_image[]" type="file" class="form-control"></div><div class="col-md-1"><button class=" btn btn-danger remove-field" type="button" >-</button></div></div>'
            );

        });

        $("body").on("click", ".remove-field", function() {
            $(this).parents(".customer_records .row").remove();
        });
        $('.delImg').on('click', function() {
            var dataId = $(this).attr("data-id");
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
                    $.ajax({
                        type: "post",
                        url: "/deleteImage",
                        data: {
                            _token: "{{ csrf_token() }}",
                            dataId: dataId,
                        },
                        success: function(data) {
                            window.location.reload();
                        }
                    });

                }
            })
        });
    </script>
@endsection
