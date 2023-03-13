@extends('dashboard.mainlayouts')
@section('title', 'Add Item')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Item</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add</li>
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
                            <form action="{{ route('menu.store') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Item Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Item Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Item type</label>
                                            <span class="text-danger">*</span>
                                            <select name="menu_type" class="form-control" id="type" required>
                                                <option selected disabled>Select item type</option>
                                                <option value="Veg">Veg</option>
                                                <option value="Non-veg">Non-veg</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="category_id" id="category_id">
                                                <option value="">Select Category</option>
                                                @if (!empty($categories))
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            @if ($errors->has('category_id'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('category_id') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cuisine</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="cuisine_id" id="cuisine_id">
                                                <option value="">Select Cuisine</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Sub Category</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="subcategory_id" id="subcategory_id" required>
                                                <option value="">Select Sub Category</option>
                                            </select>
                                        </div>
                                        @if ($errors->has('subcategory_id'))
                                            <span class="text-danger">
                                                <strong>{{ $errors->first('subcategory_id') }}</strong>
                                            </span>
                                        @endif
                                        
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price</label>
                                            <span class="text-danger">*</span>
                                            <input type="number" id="price" name="price" class="form-control"
                                                placeholder="Price" required>
                                        </div>
                                    </div>
                                   <!--  <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input class="form-control" type="file" name="image" id="fileUpload">
                                            <span id="imgValid"></span>
                                        </div>
                                    </div> -->
                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for=""> Image</label>
                                            <small class="text-danger text-sm ml-1">Only Image Supported Max (100KB-2MB)</small>
                                            <input type="file" class="form-control" name="image"
                                                accept=".jpg, .jpeg, .png" onchange="Filevalidation()" id="fileUpload"
                                                placeholder="" aria-describedby="fileHelpId">
                                            <span class="text-danger" id="imgValid"></span>
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
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea rows="5" cols="5" class="form-control" name="description" placeholder="Description"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Save">
                                    <input type="reset" class="btn btn-warning" value="Reset">
                                    <a href="/menu" class="btn btn-secondary m-1">Back</a>
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
    <script type="text/javascript">
        $('#category_id').on('change', function() {
            var catId = $(this).val();
            $.ajax({
                type: "post",
                url: "/cat",
                data: {
                    _token: "{{ csrf_token() }}",
                    catId: catId
                },
                success: function(data) {
                    if (data) {
                        $('#cuisine_id').empty();
                        $('#cuisine_id').append('<option value="">Select Cuisine</option>');
                        $.each(data, function(key, val) {
                            $('#cuisine_id').append('<option value="' + key + '">' + val +
                                '</option>');
                        });
                    } else {
                        $("#cuisine_id").empty();
                    }
                }
            })
        });
            // The image size Validation function
        Filevalidation = () => {
            const fi = document.getElementById('fileUpload');
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
@endpush
