@extends('dashboard.mainlayouts')
@section('title', 'Policy')
@section('content')
<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Policy</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">Policy</li>
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
								<form action="/save_business_policy" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf
								<div class="form-group">
										<label>Business Policy</label>
										<span class="text-danger">*</span>
										<textarea name="business_policy" placeholder="Business Policy" required class="form-control" rows="5" cols="5">{{$data['policy']['business_policy'] ?? ''}}</textarea>
								</div>

								<div class="form-group">
										<label>Standard Cancellation Policy</label>
										<span class="text-danger">*</span>
										<textarea name="cancellation_policy" placeholder="Standard Cancellation Policy" required class="form-control" rows="5" cols="5">{{$data['policy']['cancellation_policy'] ?? ''}}</textarea>
								</div>

								<div class="form-group">
										<label>Property Services</label>
										<span class="text-danger">*</span>
										<textarea name="property_service" placeholder="Property Services" required class="form-control" rows="5" cols="5">{{$data['policy']['property_service'] ?? ''}}</textarea>
								</div>
								
								<div class="form-group">
									<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit">
									<a href="{{ route('business.edit',$businessid) }}" class="btn btn-secondary">Back</a>
								</div>
								<input type="hidden" name="hdn_businessId" value="{{$businessid}}">
							</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
@endsection