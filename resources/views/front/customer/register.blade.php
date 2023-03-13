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
</style>
@endpush
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<main>
    <section class="blogs-area section-padding30">
           <section class="contact-section">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Customer Registeration</h2>
                    </div>
                    <div class="col-lg-8">
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
                     
                        <form class="form-contact" action="/customer/register" method="post">
                            @csrf
                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="name" id="name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your name'" placeholder="Enter your name" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="email" id="email" type="email" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter email address'" placeholder="Email" required>
                                    </div>
                                </div>

                                     <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="password" id="password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter your password'" placeholder="Enter your password" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="confirm_password" id="confirm_password" type="password" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter confirm Password'" placeholder="Confirm Password" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <input class="form-control" name="mobile" id="mobile" type="number" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter mobile'" placeholder="Enter mobile" required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Register</button>
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
$("#confirm_password").blur(function(){
  var password = $('#password').val();
  var con_pass = $(this).val();
  if(password != con_pass){
    swal("Confirm password should same");
    $('#confirm_password').val('');
    return false;
  }
});
</script>
@endpush

