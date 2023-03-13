@extends('dashboard.mainlayouts')
@section('title', 'GST Details')
@section('content')
<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">GST Details</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">GST Details</li>
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
								<form action="/save_business_gst" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf
								<div class="form-group">
										<label>GST Number</label>
										<span class="text-danger">*</span>
										<input type="number" id="gst_no" name="gst_no" class="form-control" placeholder="GST Number" required value="{{$data['gst_info']['gst_no'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Business Name</label>
										<span class="text-danger">*</span>
										<input type="text" id="business_name" name="business_name" class="form-control" placeholder="Business Name" required value="{{$data['gst_info']['business_name'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Address</label>
										<span class="text-danger">*</span>
										<textarea name="address" placeholder="Address" required class="form-control" rows="5" cols="5">{{$data['gst_info']['address'] ?? ''}}</textarea>
								</div>

								<div class="form-group">
										<label>State</label>
										<span class="text-danger">*</span>
										<select class="form-control" name="state" id="state">
											<option value="">Selct State</option>
											@if(!empty($states))
											@php
											if(!empty($data['gst_info']['state']))
											{
												$select_state = $data['gst_info']['state'];
											}else{
												$select_state = 0;
											}

											@endphp
												@foreach($states as $state)
												<option value="{{$state->id}}" {{$state->id == $select_state ? 'selected' : ''}}>{{$state->name}}</option>
												@endforeach
											@endif
										</select>
								</div>

								<div class="form-group">
										<label>PIN Code</label>
										<span class="text-danger">*</span>
										<input type="number" id="pin_code" name="pin_code" class="form-control" placeholder="PIN Code" required value="{{$data['gst_info']['pin_code'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>PAN No.</label>
										<span class="text-danger">*</span>
										<input type="text" id="pan_no" name="pan_no" class="form-control" placeholder="PAN No." required value="{{$data['gst_info']['pan_no'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Name</label>
										<span class="text-danger">*</span>
										<input type="text" id="name" name="name" class="form-control" placeholder="Name" required value="{{$data['gst_info']['name'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Date Of Incorporation</label>
										<span class="text-danger">*</span>
										<div class="cal-icon">
											<input class="form-control datetimepicker" id="incorporation_date" name="incorporation_date" required type="text" placeholder="Date Of Incorporation" data-date-format="DD-MM-YYYY" value="{{$data['gst_info']['incorporation_date'] ?? ''}}">
										</div>
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