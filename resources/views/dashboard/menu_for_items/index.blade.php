@extends('dashboard.mainlayouts')
@section('title', 'Manage Menus')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Menus</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Menus</li>
                        </ul>
                    </div>
                    <div class="panel-heading col-md-2">
                        @can('menu.write')
                            <a href="{{ route('menu_for_items.create') }}" class="btn btn-block btn-primary">Add Menu</a>
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
                                            <th>Menu Name</th>
                                            <th>Menu Type</th>
                                            <th>Items</th>
                                            <!-- <th>Venue Type</th> -->
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($menus))
                                            @foreach ($menus as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->title }}</td>
                                                    <td>{{ $val->menu_type }}</td>
                                                    <td><a href="#" class="viewItem"
                                                            data-id="{{ $val->id }}"><span
                                                                class="badge badge-danger">View Items</span></a>
                                                        <input type="hidden" name=""
                                                            class="valArr{{ $val->id }}"
                                                            value="{{ json_encode($val->items) }}">
                                                    </td>
                                                    <!-- <td> {{ !empty($val->venuetype->venue_type) ? $val->venuetype->venue_type : '' }}
                                                    </td> -->
                                                    <!-- <td>&#x20b9; {{ $val->price }}</td> -->
                                                    <td>
                                                        @if ($val->status == '1')
                                                            <a href="#" class="badge badge-success"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
                                                        @else
                                                            <a href="#" class="badge badge-danger"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
                                                        @endif
                                                    </td>

                                                    <td class="text-center">
                                                        <div class="actions">
                                                            @can('menu.write')
                                                                <a href="{{ route('menu_for_items.edit', $val->id) }}"
                                                                    class="btn btn-sm bg-success-light mr-2">
                                                                <i class="fa fa-pencil-square-o text-success"></i>
                                                                </a>
                                                            @endcan
                                                            @can('menu.delete')
                                                                <form method="post"
                                                                    action="{{ route('menu_for_items.destroy', $val->id) }}"
                                                                    style="display: inline-block;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="button" name="del" id="del"
                                                                        class="btn btn-sm bg-danger-light dele"><i
                                                                            class="fe fe-trash"></i></button>
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

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-body">
                    <div id="modalBody" class="row">

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('script')
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

        $('.viewItem').on('click', function() {
            var dataId = $(this).attr("data-id");
            var valArr = $('.valArr' + dataId).val();
            $.ajax({
                type: "post",
                url: "/showallitems",
                data: {
                    _token: "{{ csrf_token() }}",
                    dataId: dataId,
                    valArr: valArr
                },
                success: function(data) {
                    $('#modalBody').html("");
                    $.each(data, function(key, val) {
                        $('#modalBody').append(
                            '<div class="col-xl-4 col-sm-6 col-12"><div class="product"><div class="product-inner"><img alt="alt" src="/storage/images/items/' +
                            val +
                            '" style="height:120px"/><div class="cart-btns"><a href="#" class="btn btn-primary addcart-btn">' +
                            key + '</a></div></div></div>');

                    });
                    $('#myModal').modal('show');
                }
            });
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
                            url: "/menu_items_status",
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
@endpush
