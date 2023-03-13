@extends('dashboard.mainlayouts')
@section('title', 'Edit Staff')
@section('content')
    <!-- Page Wrapper -->
    <div class="page-wrapper">
        <div class="content container-fluid">
            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Edit Staff</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Staff</li>
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
                            <form action="/update_staff" method="post" autocomplete="off" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Staff Name</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="staff_name" name="staff_name" class="form-control"
                                                placeholder="Staff Name" value="{{ $user->name }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <span class="text-danger">*</span>
                                            <input type="text" id="email" name="email" class="form-control"
                                                placeholder="Email" value="{{ $user->email }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <span class="text-danger">*</span>
                                            <input id="mobile" type="number"
                                                class="form-control @error('mobile') is-invalid @enderror" name="mobile"
                                                value="{{ $user->mobile }}" pattern="/^-?\d+\.?\d*$/"
                                                onKeyPress="if(this.value.length==10) return false;" required
                                                placeholder="Mobile">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Role</label>
                                            <span class="text-danger">*</span>
                                            <select class="form-control" name="role" required id="role">
                                                <option value="">Select Roles</option>
                                                @if (!empty($roles))
                                                    @foreach ($roles as $role)
                                                        <option value="{{ $role->id }}"
                                                            @if ($userRole == $role->id) selected @endif>
                                                            {{ $role->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Department (<span class="text-danger">Optional</span>)</label>
                                            <select class="form-control" name="department" id="department">
                                                <option disabled selected>Select Department</option>
                                                @if (!empty($departments))
                                                    @foreach ($departments as $k => $v)
                                                        <option value="{{ $k }}"
                                                            {{ $k == $user->department_id ? 'selected' : '' }}>
                                                            {{ $v }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>

                                </div>
                                <div class="form-group">
                                    <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                        value="Update">
                                    <a href="/staff_list" class="btn btn-secondary">Back</a>
                                </div>
                                <input type="hidden" value="{{ $user->id }}" name="user_id">
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
        $('#role').on('change', function() {
            var val = $(this).val();
            if (val == 10) {
                $('#dep').css('display', 'block');
            } else {
                $('#dep').css('display', 'none');
            }
        });
    </script>
@endpush
