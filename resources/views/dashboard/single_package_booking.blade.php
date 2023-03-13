@extends('dashboard.sub_mainlayouts')
@section('title', 'All Packages')
@section('content')
 <style>
 
input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
.card-img-top{
	height: 100%;
}
 .box{
        position: relative;
        display: inline-block; /* Make the width of box same as image */
        width: 100%;

    }
    .box .text{
        position: absolute;
        z-index: 999;
        margin: 0 auto;
        left: 41px;
        right: 34px;
        top: 70%; /* Adjust this value to move the positioned div up and down */
        color: #fff;
        text-align: center;
        background: linear-gradient(
		  to right,
		  hsl(0, 0%, 0%) 0%,
		  hsla(0, 0%, 0%, 0.964) 7.4%,
		  hsla(0, 0%, 0%, 0.918) 15.3%,
		  hsla(0, 0%, 0%, 0.862) 23.4%,
		  hsla(0, 0%, 0%, 0.799) 31.6%,
		  hsla(0, 0%, 0%, 0.73) 39.9%,
		  hsla(0, 0%, 0%, 0.655) 48.2%,
		  hsla(0, 0%, 0%, 0.577) 56.2%,
		  hsla(0, 0%, 0%, 0.497) 64%,
		  hsla(0, 0%, 0%, 0.417) 71.3%,
		  hsla(0, 0%, 0%, 0.337) 78.1%,
		  hsla(0, 0%, 0%, 0.259) 84.2%,
		  hsla(0, 0%, 0%, 0.186) 89.6%,
		  hsla(0, 0%, 0%, 0.117) 94.1%,
		  hsla(0, 0%, 0%, 0.054) 97.6%,
		  hsla(0, 0%, 0%, 0) 100%
		);
    }
  </style>
<!-- Page Wrapper -->
<div class="page-wrapper" style="margin-left: 0px;">
	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-10">
					<h3 class="page-title">{{$singlePkg->package_name}}</h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="/package-booking">All Packages</a></li>
						<li class="breadcrumb-item active">{{$singlePkg->package_name}}</li>
					</ul>
				</div>
				
				<div class="panel-heading col-md-2">
					@can('items.write')
           				 <a href="/package-booking" class="btn btn-block btn-primary btn-sm">Back</a>
           			@endcan
        		</div>
			</div>
		</div>
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-xl-3 col-sm-6 col-12">
									<h5>Price : ₹{{$singlePkg->price}}</h5> 
								</div>
								<div class="col-xl-3 col-sm-6 col-12">
									<h5>Venue :  {{$singlePkg->venuetype->venue_type}}</h5>
								</div>
								<div class="col-xl-3 col-sm-6 col-12">
									<h5>Menu :  {{$singlePkg->menuitem->title}}</h5>
								</div>
							</div>
					   	</div>
					 </div>
				</div>
			</div>

			<div class="col-sm-12">
					<div class="card">
						@if(!empty($singlePkg->subcategory))
							@foreach($singlePkg->subcategory as $val)
						<div class="card-body">
							<h6 class="text-muted" title="{{$val->id}}">{{$val->subcategory_name}}</h6>
							
							<div class="row">
								@if(!empty($val->menu))
									@foreach($val->menu as $k => $item)
							     <div class="col-md-4">
							     	<div class="box">
									    <input type="checkbox" id="myCheckbox{{$k}}" />
									    <label for="myCheckbox{{$k}}"><img class="card-img-top" src="{{$item->mediacollection}}" style="height:500px;" /></label>
									    <div class="text">
								            <h3>{{$item->name}}</h3>
								        </div>
									</div>
								 </div>
								  @endforeach
							@endif
					   		</div>
					   			
						</div>
							@endforeach
						@endif
				</div>
			</div>
	</div>
</div>
@endsection
