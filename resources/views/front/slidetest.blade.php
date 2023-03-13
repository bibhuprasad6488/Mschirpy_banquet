@extends('front.front_layout')
@section('title', 'All Packages')
@section('content')
@push('styles')
<style>
   .carousel-inner img {
   width: 100%;
   height: 100%;
   }
   #custCarousel .carousel-indicators {
   position: static;
   margin-top:20px;
   }
   #custCarousel .carousel-indicators > li {
   width:100px;
   }
   #custCarousel .carousel-indicators li img {
   display: block;
   opacity: 0.5;
   }
   #custCarousel .carousel-indicators li.active img {
   opacity: 1;
   }
   #custCarousel .carousel-indicators li:hover img {
   opacity: 0.75;
   }
   .carousel-item img{
   width:80%;
   }
   .carousel-control-next-icon {
   background-color: #FF5600;
   background-image: url(data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M2.75 0l-1.5 1.5 2.5 2.5-2.5 2.5 1.5 1.5 4-4-4-4z'/%3E%3C/svg%3E);
   }
   .carousel-control-prev-icon {
   background-color: #FF5600;
   background-image: url(data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='%23fff' viewBox='0 0 8 8'%3E%3Cpath d='M5.25 0l-4 4 4 4 1.5-1.5-2.5-2.5 2.5-2.5-1.5-1.5z'/%3E%3C/svg%3E);
   }
   #text {
   z-index: 100;
   position: absolute;
   color: white;
   font-size: 24px;
   font-weight: bold;
   left: 150px;
   top: 350px;
   width: 70%;
   }
   #image {
   position: absolute;
   left: 0;
   top: 0;
   }
   .g-caption h4 {
   color: #fff;
   font-size: 50px;
   font-weight: 700;
   line-height: 1;
   margin-bottom: 12px;
   -webkit-transition: all .4s ease-out 0s;
   -moz-transition: all .4s ease-out 0s;
   -ms-transition: all .4s ease-out 0s;
   -o-transition: all .4s ease-out 0s;
   transition: all .4s ease-out 0s;
   }
   .g-caption span {
   color: #ff5600;
   font-size: 30px;
   font-weight: 500;
   margin-bottom: 7px;
   display: block;
   -webkit-transition: all .4s ease-out 0s;
   -moz-transition: all .4s ease-out 0s;
   -ms-transition: all .4s ease-out 0s;
   -o-transition: all .4s ease-out 0s;
   transition: all .4s ease-out 0s;
   }
   .itemtext{
   	color:#fff;
   }
   @media only screen and (max-width: 600px) {
   #text {
   z-index: 100;
   position: absolute;
   color: white;
   font-size: 24px;
   font-weight: bold;
   left: 150px;
   top: 350px;
   width: 70%;
   }
   #image {
   position: absolute;
   left: 0;
   top: 0;
   }
   }
</style>
@endpush
<main>
   <section class="blogs-area section-padding30">
      <div class="container">
         <div class="row">
            <div class="col-md-12">
               <!-- <div id="custCarousel" class="carousel slide" data-ride="carousel" align="center"> -->
               <div id="custCarousel" class="carousel slide" data-interval="false" align="center">
                  <!-- slides -->
                  <div class="carousel-inner">
                  	@foreach($menus as $menu)
                  	@php  $i=0; @endphp
                     <div class="carousel-item {{$i == 0 ? 'active' : ''}}">
                        <img src="https://i.imgur.com/weXVL8M.jpg" alt="Hills">
                         <div class="g-caption" id="text">
	                        <span>$25</span>
	                        <h4>Delicious Food</h4>
	                        <p class="itemtext">simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
	                        <a href="#" class="btn order-btn">Order Now</a>
                     	</div>
                     </div>
                     @php  $i++; @endphp
                    @endforeach
                    
                     
                  </div>
                  <!-- Left right -->
                  <a class="carousel-control-prev" href="#custCarousel" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                  </a>
                  <a class="carousel-control-next" href="#custCarousel" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                  </a>
                  <!-- Thumbnails -->
                  <ol class="carousel-indicators list-inline">
                  	@foreach($menus as $menu)
                  	@php  $i=0; @endphp
                     <li class="list-inline-item {{$i == 0 ? 'active' : ''}}">
                        <a id="carousel-selector-{{$i}}" class="selected" data-slide-to="{{$i}}" data-target="#custCarousel">
                        <img src="https://i.imgur.com/weXVL8M.jpg" class="img-fluid">
                        </a>
                     </li>
                     @php  $i++; @endphp
                    @endforeach
                  </ol>
               </div>
            </div>
         </div>
      </div>
   </section>
</main>
@endsection