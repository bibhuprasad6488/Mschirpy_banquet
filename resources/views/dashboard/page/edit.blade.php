@extends('dashboard.mainlayouts')
@section('title', 'Edit Page')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Page</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Page</li>
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
                            <form action="/pages/update_page" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PATCH') --}}
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="page_name" name="page_name"
                                                value="{{ $pages->page_name }}" class="form-control" placeholder="Page Name"
                                                required>
                                        </div>
                                    </div>

                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Page Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1">Active</option>
                                                <option value="2">Inactive</option>
                                            </select>
                                        </div>
                                    </div> --}}
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="/create_page" class="btn btn-secondary">Back</a>
                                </div>
                                <input type="hidden" value="{{ $pages->id }}" name="id">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
