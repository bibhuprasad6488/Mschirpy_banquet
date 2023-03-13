@extends('front.front_layout')
@section('title', 'All Packages')
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

.section-padding30 {
    padding-top: 25px;
    padding-bottom: 140px;
}
.packagename{
    top: 35px;
    position: relative;
}
.packageTitle{
    font-weight: bold;
    color:#fff;
}
</style>
@endpush
<main>
    <section class="blogs-area section-padding30">
    	  <div class="gallery-top section-bg pt-90 pb-40" data-background="assets/img/gallery/section_bg01.png">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="cl-xl-7 col-lg-8 col-md-10">
                            <!-- Section Tittle -->
                            <div class="section-tittle text-center mb-70">
                                <span>Wel Come</span>
                                <h2>All Packages</h2>
                            </div> 
                        </div>
                    </div>
                    <div class="row">
                        @if(!empty($packages))
                            @foreach($packages as $package)
                        <a href="/package-items/{{$package->slug}}">
                        <div class=" col-lg-4 col-md-6 col-sm-6">
                            <div class="single-services text-center mb-50 btn select-btn">
                                <div class="services-ion mb-25">
                                    <span class="flaticon-tools-and-utensils-1" style="font-size:40px;"></span>
                                </div>
                                <div class="color1">₹ {{number_format($package->price,2)}}</div>
                                <div class="services-cap packagename">
                                    <h5 class="packageTitle"><a href="/package-items/{{$package->slug}}">{{$package->package_name}}</a></h5>
                                </div>
                            </div>
                        </div>
                        </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
    </section>
</main>
@endsection