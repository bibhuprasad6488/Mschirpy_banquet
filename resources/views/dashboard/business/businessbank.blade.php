@extends('dashboard.mainlayouts')
@section('title', 'Add Bank Details')
@section('content')
<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Add Bank Details</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">Add Bank Details</li>
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
								<form action="/save_business_bank" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf

								<div class="form-group">
									<label>Bank</label>
									<span class="text-danger">*</span>
									<select class="form-control" name="bank">
										<option value="">Select Bank</option>
										@php
											if(!empty($data['bank']['id'])){
												$bankId = $data['bank']['id'];
											}else{
												$bankId = 0;
												}
											
										@endphp
										@foreach($banks as $bank)
										<option value="{{$bank->id}}" {{$bankId == $bank->id ? 'selected' : ''}}>{{$bank->bank}}</option>
										@endforeach
									</select>
								</div>

								<div class="form-group">
										<label>Account No</label>
										<span class="text-danger">*</span>
										<input type="text" id="account_no" name="account_no" class="form-control" placeholder="Account No" required value="{{$data['bank']['account_no'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>Account Holder</label>
										<span class="text-danger">*</span>
										<input type="text" id="account_holder" name="account_holder" class="form-control" placeholder="Account Holder" required value="{{$data['bank']['account_holder'] ?? ''}}">
								</div>

								<div class="form-group">
										<label>IFSC Code</label>
										<span class="text-danger">*</span>
										<input type="text" id="ifsc" name="ifsc" class="form-control" placeholder="IFSC Code" required value="{{$data['bank']['ifsc'] ?? ''}}">
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