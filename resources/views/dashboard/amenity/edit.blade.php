@extends('dashboard.mainlayouts')
@section('title', 'Edit Amenity')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Amenity</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Amenity</li>
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
                            <form action="{{ route('amenity.update', $amenity->id) }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Amenity Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="amenity_name" name="amenity_name" class="form-control"
                                                placeholder="Amenity Name" value="{{ $amenity->amenity_name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-10">
                                                <div class="form-group">
                                                    <label for="">Amenity icon</label>
                                                    <span class="text-danger">*</span>
                                                    <input type="text" class="form-control" name="icon" id="icon"
                                                        placeholder="Eg:-fa fa-power-off" required
                                                        value="{{ $amenity->icon }}">
                                                </div>
                                            </div>
                                            <div class="col-md-2 mt-4">
                                                <a class="btn mt-1 btn-sm" style="font-size: 20px;">{!! $amenity->icon !!}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $amenity->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="2" {{ $amenity->status == 2 ? 'selected' : '' }}>
                                                    Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="{{ route('amenity.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
