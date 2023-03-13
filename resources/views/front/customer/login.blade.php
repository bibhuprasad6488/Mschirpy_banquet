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
   padding-top: 15px;
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
   .contact-title {
   font-size: 27px;
   font-weight: 600;
   margin-bottom: 20px;
   text-align: center;
   }
</style>
@endpush
<main>
   <section class="blogs-area section-padding30">
      <section class="contact-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                  <h2 class="contact-title">MsChirpy Login</h2>
               </div>
               <div class="col-lg-8 fl float-right">

                  <form class="form-contact contact_form" action="/customer/login" method="post">
                    @csrf
                     <div class="row">
                        <div class="col-sm-4">
                        </div>
                        <div class="col-sm-8">
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
                           <div class="form-group">
                              <input class="form-control valid" name="mobile" id="mobile" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Mobile No'" placeholder="Enter Mobile No" required>
                           </div>
                           <div class="form-group mt-3">
                              <button type="submit" class="button button-contactForm boxed-btn btn-sm">SIGNIN</button>
                           </div>
                        </div>
                     </div>
                      <div class="row">
                        <div class="col-sm-4">
                        </div>
                             <div class="col-sm-8">
                                    Don't have an account ? <a href="/customer/register" style="color: #ff5600 !important">Click Here To Register</a>
                             </div>
                      </div>
                  </form>
               </div>
               <div class="col-lg-3 offset-lg-1">
                  <div class="media contact-info">
                     <img src="https://mschirpy.com/img/new_mascot.png" alt="">
                  </div>
               </div>
            </div>
         </div>
      </section>
   </section>
</main>
@endsection