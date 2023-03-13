@extends('dashboard.mainlayouts')
@section('title', 'Add Category')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Category</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Category</li>
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
                            <form action="{{ route('category.store') }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="category_name" name="category_name"
                                                class="form-control" placeholder="Category Name" required>
                                              @if($errors->has('category_name'))
                                              <span class="text-danger">
                                              <strong>{{ $errors->first('category_name') }}</strong>
                                              </span>
                                              @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Cuisine</label>
                                            <span class="text-danger">*</span>
                                            <select class="js-example-basic-multiple form-control" name="cuisines_id[]"
                                                multiple="multiple" required>
                                                @if (!empty($cuisines))
                                                    @foreach ($cuisines as $cuisine)
                                                        <option value="{{ $cuisine->id }}">{{ $cuisine->cuisine_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Type</label>
                                            <div class="custom-control custom-radio">
                                                <div class="row">
                                                    <div class="col-sm-3">
                                                        <input type="radio" class="custom-control-input"
                                                            id="customControlValidation2" name="type" required
                                                            value="food">
                                                        <label class="custom-control-label"
                                                            for="customControlValidation2">Food</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="radio" class="custom-control-input"
                                                            id="customControlValidation3" name="type" required
                                                            value="alcoholic">
                                                        <label class="custom-control-label"
                                                            for="customControlValidation3">Alcoholic</label>
                                                    </div>
                                                    <div class="col-sm-3">
                                                        <input type="radio" class="custom-control-input"
                                                            id="customControlValidation4" name="type" required
                                                            value="nonalcoholic">
                                                        <label class="custom-control-label"
                                                            for="customControlValidation4">Non
                                                            Alcoholic</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                {{-- <input type="radio" class="custom-control-input" id="customControlValidation3" name="type" required value="alcoholic">
                                 <label class="custom-control-label" for="customControlValidation3">Alcoholic</label> --}}
                                            </div>
                                            <div class="custom-control custom-radio">
                                                {{-- <input type="radio" class="custom-control-input" id="customControlValidation4" name="type" required value="nonalcoholic">
                                 <label class="custom-control-label" for="customControlValidation4">Non Alcoholic</label> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tax Type</label>
                                            <span class="text-danger">*</span>
                                            <select name="tax_type" class="form-control taxtype">
                                                <option selected disabled>Select Tax Type</option>
                                                @if(!empty($taxsubcat))
                                                @foreach($taxsubcat as $k => $v)
                                                <option value="{{$v->id}}">{{$v->category_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tax Percent</label>
                                            <span class="text-danger">*</span>
                                            <select name="tax_percent" class="form-control taxpercent">
                                                <option value="">Select Tax Percentage</option>
                                            </select>
                                        </div>
                                    </div> --}}
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
                                    <a href="/category" class="btn btn-secondary m-1">Back</a>

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
                placeholder: "Select Cuisines",
                allowClear: true
            });
        });
        $('.taxtype').on('change', function() {
            var type = $('.taxtype').val();
            if (type == 'gst') {
                $('.taxpercent').empty().append('<option value="">Select Tax Percentage</option>');
                $('.taxpercent').append(
                    '<option value="18"> 18%</option><option value="5"> 5%</option><option value="12"> 12%</option>'
                );
            } else {
                $('.taxpercent').empty().append('<option value="">Select Tax Percentage</option>');
                $('.taxpercent').append('<option value="12"> 12%</option>');
            }
        });
    </script>
@endpush
