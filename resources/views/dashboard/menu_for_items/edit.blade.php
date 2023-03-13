@extends('dashboard.mainlayouts')
@section('title', 'Edit Menu')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Menu</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Menu</li>
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
                            <form action="{{ route('menu_for_items.update', $menu->id) }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Menu Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="title" name="title" class="form-control"
                                                placeholder="Menu Name" required value="{{ $menu->title }}">
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
                                                                    <option value="{{ $item->id }}"
                                                                        @if (in_array($item->id, $menu->items)) selected @endif>
                                                                        {{ $item->name }}
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
                                                <option value="">Select Venue Type</option>
                                                @if (!empty($venueTypes))
                                                    @foreach ($venueTypes as $venuetype)
                                                        <option value="{{ $venuetype->id }}"
                                                            {{ $venuetype->id == $menu->venue_type ? 'selected' : '' }}>
                                                            {{ $venuetype->venue_type }}</option>
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
                                                <option value="">Select Menu Type</option>
                                                <option {{ $menu->menu_type == 'Per Person' ? 'selected' : '' }}>Per Person
                                                </option>
                                                <option {{ $menu->menu_type == 'A La Carte' ? 'selected' : '' }}>A La Carte
                                                </option>
                                                <option {{ $menu->menu_type == 'Per Gram' ? 'selected' : '' }}>Per Gram
                                                </option>
                                            </select>
                                        </div>
                                        <!-- <div class="form-group">
                                  <label>Price</label>
                                  <span class="text-danger">*</span>
                                  <input type="text" id="price" name="price" class="form-control" placeholder="Price" required value="{{ $menu->price }}">
                                  </div> -->
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $menu->status == 1 ? 'selected' : '' }}>Active
                                                </option>
                                                <option value="2" {{ $menu->status == 2 ? 'selected' : '' }}>Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="{{ route('menu_for_items.index') }}" class="btn btn-secondary">Back</a>
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
                allowClear: true
            });
        });
    </script>
@endpush
