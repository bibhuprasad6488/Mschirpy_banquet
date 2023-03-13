@extends('dashboard.mainlayouts')
@section('title', 'Add Package')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
    <div class="content container-fluid">

        <!-- Page Header -->
        <div class="page-header">
            <div class="row">
                <div class="col-sm-12">
                    <h3 class="page-title">Add Package</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                        <li class="breadcrumb-item active">Add Package</li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- /Page Header -->
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body col-md-12">
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
                        @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            @foreach ($errors->all() as $error)
                            <strong>{{ $error }}</strong>
                            @endforeach
                        </div>
                        @endif
                        <form action="{{ route('package.store') }}" method="post" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Package Name</label>
                            <span class="text-danger">*</span>
                            <input type="text" id="package_name" name="package_name" class="form-control"
                            placeholder="Package Name" required>
                        </div>

                        <div class="form-group">
                            <label>Menu</label>
                            @if (!empty($allmenus))
                            <div class="col-md-12">
                                <div class="row">
                                    @foreach ($allmenus as $allmenu)
                                    <div class="col-md-6">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input checkmenu"
                                            id="customControlValidation{{ $allmenu->id }}"
                                            name="menu_id" required value="{{ $allmenu->id }}">
                                            <label class="custom-control-label"
                                            for="customControlValidation{{ $allmenu->id }}">{{ $allmenu->title }}</label>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                        </div>

                        <div id="catwise"></div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Venue Type</label>
                                    <select class="form-control" name="venue_type">
                                        <option value="">Select Venue Type</option>
                                        @if (!empty($venueTypes))
                                        @foreach ($venueTypes as $venuetype)
                                        <option value="{{ $venuetype->id }}">{{ $venuetype->venue_type }}
                                        </option>
                                        @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Price</label>
                                    <span class="text-danger">*</span>
                                    
                                    <input type="number" id="price" name="price"
                                    class="form-control rupees-text" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="col-md-4">
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
                            <a href="/package" class="btn btn-secondary">Back</a>
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
    $('.checkmenu').on('change', function() {
        var id = $(this).val();
        $.ajax({
            type: "post",
            url: "/menuwisecategory",
            data: {
                _token: "{{ csrf_token() }}",
                id: id
            },
            success: function(data) {
                $('#catwise').html(data);
            }
        });
    });
</script>
@endpush
