@extends('dashboard.mainlayouts')
@section('title', 'Add Venue')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Venue</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Venue</li>
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
                            <form action="{{ route('venue.store') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="venue_name" name="venue_name" class="form-control"
                                                placeholder="Venue Name" required>
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
                                                        <option value="{{ $package->id }}">{{ $package->package_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue Type</label>
                                            <select class="form-control" name="venue_type">
                                                <option value="" disabled selected>Select Venue Type</option>
                                                @if (!empty($venueTypes))
                                                    @foreach ($venueTypes as $venuetype)
                                                        <option value="{{ $venuetype->id }}">{{ $venuetype->venue_type }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Maximum No of People</label>
                                            <span class="text-danger">*</span>
                                            <input type="number" id="max_people" name="max_people" class="form-control"
                                                placeholder="Maximum No of People" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleFormControlFile1">image</label>
                                        <div class="customer_records">
                                            <div class="row" id="imageField">
                                                <div class="col-md-11">
                                                    <input type="file" name="image[]" accept=".jpg, .jpeg, .png" onchange="Filevalidation('1')" id="fileUpload1"  id="image" class="form-control">
                                                </div>
                                                <div class="col-md-1 text-center">
                                                    <button class=" btn btn-success extra-fields-customer"
                                                        type="button">+</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Setting</label>
                                            <input type="number" placeholder="Setting" class="form-control" name="setting"
                                                id="exampleFormControlFile1">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Floating</label>
                                            <input type="number" placeholder="Floating" class="form-control" name="floating"
                                                id="exampleFormControlFile1">
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
                                                        <option value="{{ $amenities->id }}">{{ $amenities->amenity_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlFile1">Address </label>
                                            <textarea class="form-control" name="address" placeholder="Address" id="exampleFormexampleFormControlFile1"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Save">
                                    <input type="reset" class="btn btn-warning" value="Reset">
                                    <a href="/venue" class="btn btn-secondary m-1">Back</a>
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
                // placeholder: "Select Packages",
                allowClear: true
            });
        });
        var imgcnt =2;
        $('.extra-fields-customer').click(function() {
            $('.customer_records').append(
                '<div class="row mt-2 mb-2"><div class="col-md-11"><input type="file" accept=".jpg, .jpeg, .png" onchange="Filevalidation('+imgcnt+')" id="fileUpload'+imgcnt+'" name="image[]" id="image" class="form-control"></div><div class="col-md-1"><button class=" btn btn-danger remove-field" type="button" >-</button></div></div>'
            );
            imgcnt++;
        });

        $("body").on("click", ".remove-field", function() {
            $(this).parents(".customer_records .row").remove();
              imgcnt = 0;
        });

        Filevalidation = (imgcnt) => {
            const fi = document.getElementById('fileUpload'+imgcnt);
            // Check if any file is selected.
            if (fi.files.length > 0) {
                for (const i = 0; i <= fi.files.length - 1; i++) {
                    const fsize = fi.files.item(i).size;
                    const file = Math.round((fsize / 1024));
                    // The size of the file.
                    if (file >= 2048) {
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
                            title: 'Your Image size is '+ file +'KB it  cannot be more than 2 MB'
                        });
                        $("#fileUpload").val('');
                    } else if (file < 100) {
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
                            icon: 'warning',
                            title: 'Your Image Size  is '+ file +'KB Please Upload (100KB-2MB) '
                        });
                        $("#fileUpload").val('');
                    } else {

                        document.getElementById('size').innerHTML = '<b>' +
                            file + '</b> KB';
                            // return false;
                    }
                }
            }
        }
    </script>
@endsection
