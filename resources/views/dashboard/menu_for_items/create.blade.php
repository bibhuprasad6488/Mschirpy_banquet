@extends('dashboard.mainlayouts')
@section('title', 'Add Menu')
@section('content')
    @push('style')
    @endpush
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Menu</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Menu</li>
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
                            <form action="{{ route('menu_for_items.store') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Menu Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="title" name="title" class="form-control"
                                                placeholder="Menu Name" required>
                                            @if ($errors->has('title'))
                                                <span class="text-danger">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Items</label>
                                            <span class="text-danger">*</span>
                                            <select class="js-example-basic-multiple js-states form-control" name="items[]"
                                                multiple="multiple" required>
                                                @if (!empty($categories))
                                                    @foreach ($categories as $category)
                                                        <optgroup label="{{ $category->category_name }}">
                                                            @if (!empty($category->menu))
                                                                @foreach ($category->menu as $item)
                                                                    <option value="{{ $item->id }}">{{ $item->name }}
                                                                    </option>
                                                                @endforeach
                                                            @else
                                                                <option value="">No Item Found</option>
                                                            @endif
                                                        </optgroup>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                  <!--   <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Venue Type</label>
                                            <select class="form-control" name="venue_type">
                                                <option disabled selected>Select Venue Type</option>
                                                @if (!empty($venueTypes))
                                                    @foreach ($venueTypes as $venuetype)
                                                        <option value="{{ $venuetype->id }}">{{ $venuetype->venue_type }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Menu Type</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="menu_type" required>
                                                <option value="" disabled selected>Select Menu Type</option>
                                                <option>Per Person</option>
                                                <option>A La Carte</option>
                                                <option>Per Gram</option>
                                            </select>
                                            <!-- @if ($errors->has('menu_type'))
    <span class="text-danger">
                                                        <strong>{{ $errors->first('menu_type') }}</strong>
                                                        </span>
    @endif -->
                                        </div>
                                    </div>
                                    <!-- <div class="form-group">
                                                      <label>Price</label>
                                                      <span class="text-danger">*</span>
                                                      <input type="text" id="price" name="price" class="form-control" placeholder="Price" required>
                                                      </div> -->

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
                                    <a href="/menu_for_items" class="btn btn-secondary m-1">Back</a>
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
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "Select Items",
                minimumResultsForSearch: -1,
                width: 600,
                allowClear: true
            });
        });
    </script>
@endpush
