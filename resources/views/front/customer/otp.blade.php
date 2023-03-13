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
                  <form class="form-contact contact_form" action="/banquet/authenticate_otp" method="post">
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
                              <input class="form-control valid" name="otp" id="otp" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter OTP'" placeholder="Enter OTP" required>
                              <input type="hidden" name="mobile" value="{{session()->get('mobile') ?? ''}}">
                              <span style="color:#b2b6bf;font-size: 13px;">Time Left : </span>
                              <span id="timer" style="color:#b2b6bf;font-size: 13px;"></span>
                           </div>

                           <div class="form-group mt-3">
                              <button type="submit" class="button button-contactForm boxed-btn btn-sm submit_btn">Submit</button>
                               <a href="/customer/resend" id="resend_btn" style="color: #ff5600 !important; display: none;">Resend OTP</a>
                           </div>
                        </div>
                     </div>
                      <div class="row">
                        <div class="col-sm-4">
                        </div>
                             <div class="col-sm-8">
                                   
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
@push('script')
<script>
let timerOn = true;
function timer(remaining) {
  var m = Math.floor(remaining / 60);
  var s = remaining % 60;
  
  m = m < 10 ? '0' + m : m;
  s = s < 10 ? '0' + s : s;
  document.getElementById('timer').innerHTML = m + ':' + s;
  remaining -= 1;
  
  if(remaining >= 0 && timerOn) {
    setTimeout(function() {
        timer(remaining);
    }, 1000);
    return;
  }
  if(!timerOn) {
    return;
  }
  $('#resend_btn').css("display","block");
  $('.submit_btn').css("display","none");
}
timer(240);
</script>
@endpush