@extends('dashboard.mainlayouts')
@section('title', 'Add Roles')
@section('content')

<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Add Roles</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">Add Roles</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body col-md-8">
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
								<form action="/add_roles" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf
									<div class="form-group">
										<label>Role Name</label>
										<span class="text-danger">*</span>
										<input type="text" id="name" name="name" class="form-control" placeholder="Role Name" required>
									</div>
									@error('name') <span class="text-danger error">{{ $message }}</span>@enderror
									
									
									<div class="form-group">
										<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
										<input type="reset" class="btn btn-secondary" value="Reset">
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
	$("#allchk").click(function(){
	$('input:checkbox').not(this).prop('checked', this.checked);
});
</script>

@endpush