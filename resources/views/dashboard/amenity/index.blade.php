@extends('dashboard.mainlayouts')
@section('title', 'Manage Amenities')
@section('content')

    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Amenities</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Amenities</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">

                        <a href="{{ route('amenity.create') }}" class="btn btn-block btn-primary">Add Amenity</a>

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
                                        <tr class="">
                                            <th>#</th>
                                            <th>Amenity Name</th>
                                            <th>Icon</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($amenities))
                                            @foreach ($amenities as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->amenity_name }}</td>
                                                    <td>
                                                        {{-- @if (!empty($val->mediacollection))
                                                            <a href="{{ $val->mediacollection }}" target="_blank">
                                                                <img class="avatar-img rounded-circle"
                                                                    src="{{ $val->mediacollection }}"
                                                                    alt="{{ $val->name }}" height="50px"
                                                                    title="{{ $val->name }}"></a>
                                                        @endif --}}
                                                        <span style="font-size: 20px;">{!! $val->icon !!}</span>
                                                    </td>
                                                    <td>
                                                        @if ($val->status == 1)
                                                            <a href="#" class="badge badge-success"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Active</a>
                                                        @else
                                                            <a href="#" class="badge badge-danger"
                                                                onclick="changestatus_chk('{{ $val->id }}','{{ $val->status }}')">Inactive</a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="actions">
                                                            <a href="{{ route('amenity.edit', $val->id) }}"
                                                                class="btn btn-sm bg-success-light mr-2">
                                                                <i class="fa fa-pencil-square-o text-success"></i>
                                                            </a>
                                                            <form method="post"
                                                                action="{{ route('amenity.destroy', $val->id) }}"
                                                                style="display: inline-block;">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="button" name="del" id="del"
                                                                    class="btn btn-sm bg-danger-light dele"><i
                                                                        class="fe fe-trash"></i></button>
                                                            </form>
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
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "POST",
                        url: "/amenity_change_status",
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
