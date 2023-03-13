@extends('dashboard.mainlayouts')
@section('title', 'Terms & Conditions')
@section('content')
<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Terms & Conditions</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">Terms & Conditions</li>
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
								<form action="/save_business_trm_cnd" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf
								<div class="form-group">
										<label>Terms Title</label>
										<span class="text-danger">*</span>
										<input type="text" id="terms_title" name="terms_title" class="form-control" placeholder="Terms Title" required value="{{$data['terms']['title'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Terms & Condition Details</label>
										<span class="text-danger">*</span>
										<textarea name="terms_details" placeholder="Terms & Condition Details" required class="form-control" rows="5" cols="5">{{$data['terms']['details'] ?? ''}}</textarea>
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