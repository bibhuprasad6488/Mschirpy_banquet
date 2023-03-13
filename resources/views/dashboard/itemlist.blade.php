@extends('dashboard.mainlayouts')
@section('title', 'Dashboard')
@section('content')
<style type="text/css">
	.square {
    width: 30%;
    padding-bottom: 5%;
    background-size: cover;
    background-position: center;
}
.f{
width:212px;
height:100%;}
</style>
<div class="page-wrapper">

	<div class="content container-fluid">

		<!-- Page Header -->
		<div class="page-header">
			<div class="row">
				<div class="col-sm-12">
					<h3 class="page-title"></h3>
					<ul class="breadcrumb">
						<li class="breadcrumb-item active">Item List</li>
					</ul>
				</div>
			</div>
		</div>
			<div class="container">
				@if(!empty($items))
					@foreach($items as $item)
				<div class="card" style="width:100%">
					<div class="row">
						  <div class="col-sm-3">
						    <img class="card-img f" src="{{$item->mediacollection}}" alt="Card image"/>
						  </div>
						  <div class="col-sm-9">
							    <div class="card-body-right">
							      	<h4 class="card-title">{{$item->name}}</h4>
							      	<p class="card-text">{{$item->description}}</p>
							    </div>
						     </div>
					  </div> 
				  </div>
				  	@endforeach
				  @endif
			</div>
	</div>
</div>

@endsection
