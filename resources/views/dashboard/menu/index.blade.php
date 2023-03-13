@extends('dashboard.mainlayouts')
@section('title', 'Manage Items')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Items</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Items</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">
                        @can('items.write')
                            <a href="{{ route('menu.create') }}" class="btn btn-block btn-primary">Add Item</a>
                        @endcan
                    </div>

                </div>
            </div>
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
                            <div class="table-responsive">
                                <table class="datatable table table-stripped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item Name</th>
                                            <th>Item Type</th>
                                            <th>Category</th>
                                            <th>Cuisine</th>
                                            <th>Image</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($datas))
                                            @foreach ($datas as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->name }}</td>
                                                    <td>
                                                        @if ($val->menu_type == 'Veg')
                                                            <span class="badge badge-success">Veg</span>
                                                        @else
                                                            <span class="badge badge-danger"
                                                                style="border-radius: 100px;">Non-veg</span>
                                                        @endif
                                                    </td>
                                                    <td>{{ $val->category->category_name }}</td>
                                                    <td>
                                                    	@if($val->cuisine_id !='')
                                                    		{{$val->category->cuisines_id[$val->cuisine_id]}}
                                                    	@endif
                                                    </td>
                                                    <td>
                                                        @if (!empty($val->image))
                                                            <a href="/storage/images/items/{{ $val->image }}"
                                                                target="_blank">
                                                                <img class="avatar-img "
                                                                    src="/storage/images/items/{{ $val->image }}"
                                                                    alt="{{ $val->name }}" height="50px" width="50%" 
                                                                    title="{{ $val->name }}"></a>
                                                        @endif
                                                    </td>
                                                    <td>&#x20b9; {{ $val->price }}</td>
                                                    <td>
                                                        @if ($val->status == 1)
                                                            <a href="#" class="badge badge-success"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
                                                        @else
                                                            <a href="#" class="badge badge-danger"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="actions">
                                                            @can('items.write')
                                                                <a href="{{ route('menu.edit', $val->id) }}"
                                                                    class="btn btn-sm bg-success-light mr-2 text-left">
                                                                  <i class="fa fa-pencil-square-o text-success"></i>
                                                                </a>
                                                            @endcan
                                                            @can('items.delete')
                                                                <form method="post"
                                                                    action="{{ route('menu.destroy', $val->id) }}"
                                                                    style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <a type="button" name="del" id="del"
                                                                        class="btn btn-sm bg-danger-light dele text-right"><i
                                                                            class="fe fe-trash"></i></a>
                                                                </form>
                                                            @endcan
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td>-- No Records Found --</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $('.dele').on('click', function() {
            var form = $(this).closest("form");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            })
        });


        function changestatus_chk(id, sts) {
            Swal.fire({
                    title: 'Are you sure to change the status !',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, change it!'
                })

                .then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "POST",
                            url: "/item_category_status",
                            data: {
                                _token: "{{ csrf_token() }}",
                                id: id,
                                sts: sts
                            },
                            success: function(data) {
                                location.reload();
                            }
                        });
                    }
                })
        }
    </script>

@endsection
