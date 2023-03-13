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
   .gj-datepicker-md [role="right-icon"] {
    position: absolute;
    left: 519px;
    top: 14px;
    font-size: 24px;
    color: #9d9d9d;
}

.form-contact .form-control {
    border: 1px solid #e5e6e9;
    border-radius: 0px;
    height: 48px;
    padding-left: 26px;
    font-size: 13px;
    background: transparent;
}
.gj-timepicker-md [role="right-icon"] {
    cursor: pointer;
    position: absolute;
    left: 510px;
    top: 13px;
    font-size: 24px;
    color: #979695;
}

.checkitems {
   position: absolute;
   left: 498px;
   width: 1.85rem;
   height: 1.85rem;
}
</style>
@endpush
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script> -->
<main>
   <section class="blogs-area section-padding30">
      <section class="contact-section">
         <div class="container">
            <div class="row">
               <div class="col-12">
                        <h2 class="contact-title text-left">Event Details</h2>
                    </div>
                    <div class="col-lg-12">
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
                     
                        <form class="form-contact" action="/customer/save_event_details" method="post">
                            @csrf
                            <div class="row">
                            
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="event_name" id="event_name" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Event Name'" placeholder="Enter Event Name" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="date" id="date" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Date'" placeholder="Enter Date" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="time" id="time" type="time" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Enter Time'" placeholder="Enter Time" required autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <input class="form-control" name="no_of_people" id="no_of_people" type="text" onfocus="this.placeholder = ''" onblur="this.placeholder = 'No of Guests'" placeholder="No of Guests" required autocomplete="off">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <select class="form-control h-100 w-100" name="venue_type" id="venue_type">
                                          <option value="">Select Venue Type</option>
                                          @if(!empty($venuetypes))
                                          @foreach($venuetypes as $venuetype)
                                          <option value="{{$venuetype->id}}">{{$venuetype->venue_type}}</option>
                                          @endforeach
                                          @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                              <span id="allvenuerview"></span>
                              <span id="catwiseitemsview"></span>
                            <div class="form-group mt-3">
                                <button type="submit" class="button button-contactForm boxed-btn">Add Event</button>
                            </div>
                        </form>
                  </div>
            </div>
         </div>

        <div class="modal" id="myModal">
          <div class="modal-dialog">
            <div class="modal-content">
              <input type="hidden" id="searchType">
              <input type="hidden" id="venue_id">
              <div class="modal-body  p-5" >
                  <button type="button" id="package" class="button btn-primary button-contactForm boxed-btn searchtype" value="package">PACKAGE</button>
                  <button type="button" id="alacarte" class="button btn-success button-contactForm boxed-btn searchtype" value="alacarte">ALA CARTE</button>
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
$( function() {
    $( "#date" ).datepicker({
      dateFormat: 'dd-mm-yy'
    });
    
  } );

$('#venue_type').on('change',function(){
  var val = $('#venue_type').val();
  $.ajax({
        type:'POST',
        url:'/customer/allvenues',
        data:{_token:"{{csrf_token()}}",val:val},
        success:function(data){
            $('#allvenuerview').html(data);
            $('#catwiseitemsview').html("");
        }
  });
});

function select_venue(val)
{
 $('#myModal').modal('show');
 $('#venue_id').val(val);
 $('#searchType').val("");
}

$('.searchtype').on('click',function(){
    var type = $(this).val();
    $('#searchType').val(type);
    $('#myModal').modal('hide');
    var searchType = $('#searchType').val();
    var venue_id = $('#venue_id').val();
    $.ajax({
        type:'POST',
        url:'/customer/package_alacarte',
        data:{_token:"{{csrf_token()}}",searchType:searchType,venue_id:venue_id},
        success:function(data){
            console.log(data);
            $('#allvenuerview').html('');
            $('#catwiseitemsview').html(data);
        }
  });

});
</script>
@endpush 