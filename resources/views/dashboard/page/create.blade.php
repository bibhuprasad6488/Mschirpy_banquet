@extends('dashboard.mainlayouts')
@section('title', 'Create Page')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Add Page</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Add Page</li>
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
                            <form action="/store_pages" method="post" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="table-responsive">
                                    <table class="datatable table" id="customFields">

                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="text" id="page_name" name="page_name[]"
                                                        class="form-control" placeholder="Page Name" required>
                                                </td>
                                                <td>
                                                    <button type="button" name="add" id="add"
                                                        class="addCF btn btn-success">+</button>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>


                                {{-- <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Page Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="page_name" name="page_name" class="form-control"
                                                placeholder="Page Name" required>
                                        </div>
                                    </div>


                                </div> --}}
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Save">
                                    <input type="reset" class="btn btn-warning" value="Reset">
                                    <a href="/create_page" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script></script>
@endsection
@push('script')
    <script>
        $(".addCF").click(function() {
            $("#customFields").append(
                '<tr><td><input type="text" id="page_name" name="page_name[]" class="form-control" placeholder="Page Name" required></td><td><button type="button" name="remove" id="remove" class="remCF btn btn-danger">-</button></td></tr>'
            );
        });
        $("#customFields").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
    </script>
@endpush
