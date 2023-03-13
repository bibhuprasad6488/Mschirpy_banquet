@extends('dashboard.mainlayouts')
@section('title', 'Edit content')
@section('content')
    <!-- Page Wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Content</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Content</li>
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
                            <form action="/content/update" method="post" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                {{-- @method('PATCH') --}}
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <span class="text-danger"></span>
                                            <input type="hidden" class="form-control" name="page_id"
                                                value="{{ $contents->page_id }}">
                                            {{-- <span>{{ $contents->page->page_name }}</span> --}}
                                            <input type="text" readonly="true" class="form-control"
                                                value="{{ $contents->page->page_name }}">



                                        </div>
                                        <div class="form-group mt-4">
                                            <label>Banner Image</label>
                                            <input class="form-control" accept="image/*" id="imageUpload" type="file"
                                                name="image_file">
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <label for="">Preview</label>
                                        @if (!empty($contents))
                                            <a href="/storage/images/content_images/{{ $contents->image }}" target="_blank">
                                                <img class="avatar-img" id="imagePreview"
                                                    src="/storage/images/content_images/{{ $contents->image }}" alt="{{ $contents->name }}"
                                                    height="170px" width="100%">
                                            </a>

                                            {{-- <a href="#" class="p-2 delImg " data-id="{{ $contents->id }}"><i
                                                    class="fa fa-times-circle text-secondary"
                                                    aria-hidden="true"></i>
                                            </a> --}}
                                        @endif
                                    </div>
                                    <div class="col-md-6">

                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Content</label>
                                            <span class="text-danger">*</span>
                                            <textarea class="form-control" name="content" id="summernote">"{{ $contents->content }}"</textarea>

                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="/content" class="btn btn-secondary">Back</a>
                                </div>
                                <input type="hidden" value="{{ $contents->id }}" name="id">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var page_id = document.getElementById('#page_id').val();
            if (!empty(page_id)) {
                $("#page_id").attr('readonly', true);
            }
        });
        $('#summernote').summernote({
            height: 200,
            placeholder: "Write Content......",
            required: true
        });

        $('#imageUpload').change(function() {
            readImgUrlAndPreview(this);

            function readImgUrlAndPreview(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').removeClass('hide').attr('src', e.target.result);
                    }
                };
                reader.readAsDataURL(input.files[0]);
            }
        });
    </script>
@endsection
