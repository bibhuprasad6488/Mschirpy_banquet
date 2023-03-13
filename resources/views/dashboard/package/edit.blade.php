@extends('dashboard.mainlayouts')
@section('title', 'Edit Package')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Package</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Package</li>
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
                            <form action="{{ route('package.update', $package->id) }}" method="post" autocomplete="off"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PATCH')
                                <div class="form-group">
                                    <label>Package Name</label>
                                    <span class="text-danger">*</span>
                                    <input type="text" id="package_name" name="package_name" class="form-control"
                                        placeholder="package Name" value="{{ $package->package_name }}" required>
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
                                                                name="menu_id" required value="{{ $allmenu->id }}"
                                                                @if ($package->menu_id == $allmenu->id) checked @endif>
                                                            <label class="custom-control-label"
                                                                for="customControlValidation{{ $allmenu->id }}">{{ $allmenu->title }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                <div class="form-group" id="catwise">
                                    <label>Category</label>

                                    @if (!empty($menuItems->avaragemenu))
                                        <table class="table">
                                            @foreach ($menuItems->avaragemenu as $key => $category)
                                                @if ($category->menu->count() > 0)
                                                    @php
                                                        if (!empty($package->custom_fields[$category->id])) {
                                                            $qty = $package->custom_fields[$category->id]['qty'];
                                                            $price = $package->custom_fields[$category->id]['price'];
                                                        } else {
                                                            $qty = 0;
                                                            $price = 0;
                                                        }
                                                    @endphp
                                                    <tbody>
                                                        <tr>
                                                            <td>
                                                                <input type="checkbox" class="catbox"
                                                                    value="{{ $category->id }}" id="category"
                                                                    name="category[]"
                                                                    @if (in_array($category->id, array_keys($package->no_of_items))) checked @endif>
                                                                &nbsp;{{ $category->category_name }}
                                                            </td>
                                                            <td>
                                                                Max <span
                                                                    class="badge badge-success">{{ $category->menu->count() }}</span>
                                                                Item(s)
                                                                <input type="hidden" name="itemCount"
                                                                    id="itemCount{{ $category->id }}"
                                                                    value="{{ $category->menu->count() }}">
                                                            </td>
                                                            <td style="padding-top:  0px;">
                                                                <span class="text-danger"
                                                                    style="font-size: 13px; padding-top: 0px;">No of
                                                                    Items</span>
                                                                <input type="text" id="no_of_items{{ $category->id }}"
                                                                    name="no_of_items[]" class="noofItems form-control"
                                                                    placeholder="No of Items"
                                                                    @if (in_array($category->id, array_keys($package->no_of_items))) value = "{{ $package->no_of_items[$category->id] }}"
                                            @else
                                                disabled @endif>
                                                            </td>
                                                            @if ($qty < 1)
                                                                <td class="extratd{{ $category->id }}">
                                                                    <span class="btn btn-sm mt-3  btn-danger"
                                                                        id="extraItm{{ $category->id }}"
                                                                        onclick="addextra('{{ $category->id }}')"
                                                                        style="cursor: pointer;"> Add Extra Item </span>
                                                                </td>
                                                            @else
                                                                <td class="extratd{{ $category->id }}"
                                                                    style="display: none;">
                                                                    <span class="btn btn-sm mt-3  btn-danger"
                                                                        id="extraItm{{ $category->id }}"
                                                                        onclick="addextra('{{ $category->id }}')"
                                                                        style="cursor: pointer;"> Add Extra Item </span>
                                                                </td>
                                                            @endif
                                                            <td style="padding: 0px 0px;">
                                                                <span class="text-danger"
                                                                    style="font-size: 13px; padding-top:0px;"
                                                                    id="extraitmqty{{ $category->id }}">Extra Item
                                                                    Quantity</span>
                                                                <input type="text" name="extraitmQty[]"
                                                                    id="extraitmQty{{ $category->id }}"
                                                                    placeholder="Item Quantity" class="form-control"
                                                                    @if ($qty > 0) value="{{ $qty }}" @else style="display:none; @endif">
                                                                <input type="hidden" name="catId[]"
                                                                    value="{{ $category->id }}">
                                                            </td>
                                                            <td style="padding: 0px 10px;" class="ml-2">
                                                                <span class="text-danger"
                                                                    style="font-size: 13px; padding-top:0px;"
                                                                    id="extraitmprice{{ $category->id }}">Extra Per Item
                                                                    Price</span>
                                                                <input type="text" name="extraitmPrice[]"
                                                                    id="extraitmPrice{{ $category->id }}"
                                                                    placeholder="Per Item Price"
                                                                    class="form-control rupees-text"
                                                                    @if ($price > 0) value="{{ $price }}" @else style="display:none; @endif">
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                @endif
                                            @endforeach
                                        </table>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Venue Type</label>
                                            <select class="form-control" name="venue_type">
                                                <option value="">Select Venue Type</option>
                                                @if (!empty($venueTypes))
                                                    @foreach ($venueTypes as $venuetype)
                                                        <option value="{{ $venuetype->id }}"
                                                            {{ $venuetype->id == $package->venue_type ? 'selected' : '' }}>
                                                            {{ $venuetype->venue_type }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Price <span class="text-danger">*</span></label>
                                           {{--  <div class="input-group-prepend">
                                                <span class="input-group-text">&#x20b9</span>
                                            </div> --}}
                                            <input type="number" id="price" name="price"
                                                class="form-control rupees-text" placeholder="Price" required
                                                value="{{ $package->price }}">

                                            <style>


                                            </style>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select class="form-control" name="status">
                                                <option value="1" {{ $package->status == 1 ? 'selected' : '' }}>
                                                    Active
                                                </option>
                                                <option value="2" {{ $package->status == 2 ? 'selected' : '' }}>
                                                    Inactive
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="{{ route('package.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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

        $('.catbox').on('click', function() {
            var id = $(this).val();
            if ($(this).is(':checked')) {
                $('#no_of_items' + id).prop('disabled', false);
                $('#extraItm' + id).css('display', 'block');
                $('.extratd' + id).css('display', 'block');

            } else {
                $('#no_of_items' + id).prop('disabled', true);
                $('#no_of_items' + id).val('');
                $('#extraItm' + id).css('display', 'none');
                $('#extraitmQty' + id).val('');
                $('#extraitmQty' + id).css('display', 'none');
                $('#extraitmPrice' + id).val('');
                $('#extraitmPrice' + id).css('display', 'none');
                $('#extraitmqty' + id).css('display', 'none');
                $('#extraitmprice' + id).css('display', 'none');
            }
        });

        $('.noofItems').on('keyup', function() {
            var catId = $(this).closest('tr').find('.catbox').val();
            var noOfItems = $(this).val();
            var maxItems = $('#itemCount' + catId).val();
            if (noOfItems > maxItems) {
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
                    title: 'Cannot add more than ' + maxItems + 'items'
                })
                $('#no_of_items' + catId).val('');
            }
        });

        function addextra(id) {
            $('#extraitmQty' + id).css('display', 'block');
            $('#extraitmPrice' + id).css('display', 'block');
            $('#extraitmqty' + id).css('display', 'block');
            $('#extraitmprice' + id).css('display', 'block');
            $('#extraItm' + id).css('display', 'none');
            $('.extratd' + id).css('display', 'none');
        }
    </script>
@endsection
