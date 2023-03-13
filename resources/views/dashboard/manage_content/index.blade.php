@extends('dashboard.mainlayouts')
@section('title', 'View contents')
@section('content')


    <div class="page-wrapper">
        <div class="content container-fluid">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-10">
                        <h3 class="page-title">Manage Contents</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Manage contents</li>
                        </ul>
                    </div>

                    <div class="panel-heading col-md-2">
                        {{-- @can('content.write') --}}
                        <a href="/create" class="btn btn-block btn-primary">Add Content</a>
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
                                <table class="datatable table table-stripped table-responsive table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Page Name</th>
                                            <th>Content</th>
                                            <th>Image</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (!empty($contents))
                                            @foreach ($contents as $key => $val)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ !empty($val->page->page_name) ? $val->page->page_name : '' }}
                                                    </td>
                                                    <td>{!! $val->content !!}</td>
                                                    <td>
                                                        @if (!empty($val->image))
                                                            <a href="/storage/images/content_images/{{ $val->image }}" target="_blank">
                                                            <img class="avatar-img" src="/storage/images/content_images/{{ $val->image }}"
                                                                    alt="{{ $val->name }}" height="50px" width="100%" 
                                                                    title="{{ $val->name }}"></a>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="actions">
                                                            {{-- @can('pages.write') --}}
                                                            <a href="/edit/{{ $val->id }}"
                                                                class="btn btn-sm bg-success-light mr-2 ">
                                                                <i class="fa-regular fa-pen-to-square"></i>
                                                            </a>
                                                            {{-- @endcan --}}
                                                            {{-- @can('content.delete') --}}
                                                            <form method="post" action="/delete/"
                                                                style="display: inline-block;">
                                                                @csrf

                                                                {{-- <button type="button" name="del" id="del"
                                                                    class="btn btn-sm bg-danger-light dele"><i
                                                                        class="fe fe-trash"></i> Delete </button>
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
