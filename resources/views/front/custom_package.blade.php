<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Ms Chirpy - Custom Package</title>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('admin/assets/logos/fav.png')}}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/bootstrap.min.css')}}">

    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/font-awesome.min.css')}}">

    <!-- Main CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css')}}">

    <!--[if lt IE 9]>
            <script src="assets/js/html5shiv.min.js"></script>
            <script src="assets/js/respond.min.js"></script>
        <![endif]-->
</head>

<body>

    <!-- Main Wrapper -->
   <div class="page-wrapper">
			<div class="content container">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col">
							<h3 class="page-title">All Package</h3>
							
						</div>
					</div>
				</div>
				<!-- /Page Header -->

				<div class="row">
					@if(!empty($allpackages))
						@foreach($allpackages as $package)
					<div class="col-xl-3 col-sm-6 col-12">
						<a href="/single-package/{{$package->slug}}">
						<div class="product">
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
    <!-- /Main Wrapper -->

    <!-- jQuery -->
    <script src="{{ asset('admin/assets/js/jquery-3.2.1.min.js')}}"></script>

    <!-- Bootstrap Core JS -->
    <script src="{{ asset('admin/assets/js/popper.min.js')}}"></script>
    <script src="{{ asset('admin/assets/js/bootstrap.min.js')}}"></script>

    <!-- Custom JS -->
    <script src="{{ asset('admin/assets/js/script.js')}}"></script>

</body>

</html>