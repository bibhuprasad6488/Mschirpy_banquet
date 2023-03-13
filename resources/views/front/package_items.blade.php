@extends('front.front_layout')
@section('title', 'All Items')
@section('content')
@push('styles')
<style>
.section-tittle h2 {
    font-size: 25px;
    display: block;
    color: #212025;
    font-weight: 600;
    margin-bottom: 17px;
    line-height: 1.3;
}

.genric-btn.warning {
    float: right;
    text-align: right;
    color: #fff;
    background: #FF5600;
    border: 1px solid transparent;
}
.genric-btn.warning:hover {
    color: #FF5600;
    border: 1px solid #FF5600;
    background: #fff;
}
.section-padding30 {
    padding-top: 94px;
    padding-bottom: 140px;
}
.blogs-area .single-blogs .blog-img img {
    width: 100%;
    height: 600px;
}
.categoryName{
	color:#ff5600;
	font-weight: bold;
}
</style>
@endpush
<main>
    <section class="blogs-area section-padding30">
    	 @if(!empty($singlePkg->subcategory))
			@foreach($singlePkg->subcategory as $val)
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <!-- Section Tittle -->
                    <div class="section-tittle text-center mb-70">
                        <h2 class="categoryName" style="color:#ff5600;font-weight: bold;">{{$val->subcategory_name}}</h2>
                    </div>
                </div>
            </div>
            <div class="row">
            @if(!empty($val->menu))
				@foreach($val->menu as $k => $item)
                <div class="col-lg-6 col-md-6">
                    <div class="single-blogs mb-100">
                        <div class="blog-img">
                            <img src="{{$item->mediacollection}}" alt="">
                        </div>
                       <div class="blog-cap">
                            <span class="color1 price">&#x20b9; {{number_format($item->price,2)}}</span>
                            <button class="genric-btn warning circle arrow text-right btn-sm" type="button">ORDER NOW</button>
                            <h4><a href="blog_details.html">{{$item->name}}</a></h4>
                            <span class="color1"> simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.</span>
                        </div>
                    </div>
                </div>
                @endforeach
            @endif
            </div>
        </div>
         	@endforeach
      	 @endif
    </section>
    <!-- Blog Area End -->
</main>
@endsection