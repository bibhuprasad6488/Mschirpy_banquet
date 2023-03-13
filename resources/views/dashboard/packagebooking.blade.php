@extends('dashboard.sub_mainlayouts')
@section('title', 'All Packages')
@section('content')

<!-- Page Wrapper -->
<div class="page-wrapper" style="margin-left: 0px;">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">All Packages</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item active">All Packages</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
					@can('items.write')
           				 <a href="/home" class="btn btn-block btn-primary btn-sm">Back</a>
           			@endcan
        		</div>
			</div>
		</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								@if(!empty($allpackages))
									@foreach($allpackages as $package)
								<div class="col-xl-3 col-sm-6 col-12">
									<a href="/package_details/{{$package->slug}}">
									<div class="product" style="background-color:#ffe6e6;">
										<div class="pro-desc">
											<h5>{{$package->package_name}}</h5>
											<div class="price">₹{{$package->price}}</div>
										</div>
									</div>
									</a>
								</div>
									@endforeach
								@endif
							</div>
					   	</div>
					 </div>
				</div>
			</div>
	</div>
</div>
@endsection
