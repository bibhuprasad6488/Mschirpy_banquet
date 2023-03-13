@extends('dashboard.mainlayouts')
@section('title', 'View Pages')
@section('content')


    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Pages</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage Pages</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">
                        {{-- @can('venues.write') --}}
                        <a href="/page_create" class="btn btn-block btn-primary">Add Page</a>
                        {{-- @endcan --}}
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
                                <table class="datatable table table-stripped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Name</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($pages))
                                            @foreach ($pages as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $val->page_name }}</td>
                                                    <td class="text-center">
                                                        <div class="actions">
                                                            {{-- @can('pages.write') --}}
                                                            <a href="/edit_pages/{{ $val->id }}"
                                                                class="btn btn-sm bg-success-light mr-2 ">
                                                             <i class="fa fa-pencil-square-o text-success"></i>
                                                            </a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('pages.delete') --}}
                                                            <form method="post" action="/page/delete_page"
                                                                style="display: inline-block;">
                                                                @csrf
                                                                {{-- @method('DELETE') --}}
                                                                {{-- <button type="button" name="dele" id="del"
                                                                    class="btn btn-sm bg-danger-light dele"><i
                                                                        class="fe fe-trash"></i> 
                                                                </button>
                                                                <input type="hidden" name="id"
                                                                    value="{{ $val->id }}"> --}}
                                                            </form>
                                                            {{-- @endcan --}}
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
    </script>
@endsection
