@extends('dashboard.mainlayouts')
@section('title', 'Add Business')
@section('content')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Business</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Business</li>
               </ul>
            </div>
         </div>
      </div>
      <!-- /Page Header -->
      <div class="row">
         <div class="col-sm-12">
            <div class="card">
               <div class="card-body">
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
                  <form action="{{route('business.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <!-- @if (count($errors) > 0)
                        <div class="alert alert-danger">
                        	  <button type="button" class="close" data-dismiss="alert">×</button>
                                @foreach ($errors->all() as $error)
                              			 <strong>{{ $error }}</strong>
                                @endforeach
                        </div>
                        @endif -->
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Vendor</label>
                              <select class="form-control" name="vendor_id">
                                 <option value="">Selct Vendor</option>
                                 @if(!empty($vendors))
                                 @foreach($vendors as $vendor)
                                 <option value="{{$vendor->id}}">{{$vendor->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Business Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="business_name" name="business_name" class="form-control" placeholder="Business Name" required>
                              @if($errors->has('business_name'))
                              <span class="text-danger">
                              <strong>{{ $errors->first('business_name') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Primary Conatct</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="primary_contact" name="primary_contact" class="form-control" placeholder="Primary Conatct" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required>
                              @if($errors->has('primary_contact'))
                              <span class="text-danger">
                              <strong>{{ $errors->first('primary_contact') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Secondary Contact</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="secondary_contact" name="secondary_contact" class="form-control" placeholder="Secondary Contact" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;" required>
                              @if($errors->has('secondary_contact'))
                              <span class="text-danger">
                              <strong>{{ $errors->first('secondary_contact') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Admin Email</label>
                              <span class="text-danger">*</span>
                              <input type="email" id="admin_email" name="admin_email" class="form-control" placeholder="Business Admin Email" required>
                              @if($errors->has('admin_email'))
                              <span class="text-danger">
                              <strong>{{ $errors->first('admin_email') }}</strong>
                              </span>
                              @endif
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Staff Email</label>
                              <span class="text-danger">*</span>
                              <input type="email" id="staff_email" name="staff_email" class="form-control" placeholder="Business Staff Email" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>State</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="state" id="state" required>
                                 <option value="">Select State</option>
                                 @if(!empty($states))
                                 @foreach($states as $state)
                                 <option value="{{$state->id}}">{{$state->name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>City</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="city" id="city" required>
                                 <option value="">Select City</option>
                              </select>
                           </div>
                        </div>
                      
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Open Time</label>
                              <span class="text-danger">*</span>
                              <input class="timepickeropen timepicker-with-dropdown text-center form-control" name="open_time">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Close Time</label>
                              <span class="text-danger">*</span>
                              <input class="timepickerclose timepicker-with-dropdown text-center form-control" name="close_time">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Amenities</label>
                              <span class="text-danger">*</span>
                              <select class="js-example-basic-multiple js-states form-control" name="amenity[]" multiple="multiple" required>
                                 @if(!empty($amenities))
                                 @foreach($amenities as $amenity)
                                 <option value="{{$amenity->id}}">{{$amenity->amenity_name}}</option>
                                 @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Avg For</label>
                              <span class="text-danger">*</span>
                              <select class="form-control" name="avg_for">
                                 <option value="">Select Avarage For</option>
                                 @for($i=1;$i<=5;$i++)
                                 <option value="{{$i}}">{{$i}}</option>
                                 @endfor
                              </select>
                           </div>
                        </div>
                          <div class="col-md-12">
							   <div class="form-group">
							      <label>Business Address</label>
							      <span class="text-danger">*</span>
							      <textarea class="form-control" name="business_address" rows="6" cols="5"> </textarea>
							   </div>
							</div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Description</label>
                              <span class="text-danger">*</span>
                              <textarea class="form-control summernote" name="description" rows="5" cols="5"> </textarea>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Avarage Price</label>
                              <span class="text-danger">*</span>
                              <input type="number" class="form-control" name="avg_price" placeholder="Avarage price">
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                 <option value="1">Active</option>
                                 <option value="2">Inactive</option>
                              </select>
                           </div>
                        </div>
                       
                           <div class="form-group">
                              <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
                              <input type="reset" class="btn btn-warning" value="Reset">
                              <a href="/business" class="btn btn-secondary mx-1">Back</a>
                           </div>
                       
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
@push('script')
<script>
   $('#state').on('change',function(){
   	var state = $(this).val();
   	$.ajax({
   		type:"post",
   		url:'/statewisecitychange',
   		data:{_token:"{{csrf_token()}}",state:state},
   		success:function(data){
   			if(data){
   				$('#city').empty();
                  		$('#city').append('<option value="">Select City</option>');
   				$.each(data,function(key,val){
   					$('#city').append('<option value="'+val.id+'">'+val.city_name+'</option>');
   				});
   			}else{
   				 $("#city").empty();
   			}
   		}
   	});
   });
   
   $('.timepickeropen').timepicker({
     timeFormat: 'h:mm p',
     interval: 60,
     minTime: '10',
     maxTime: '11:00pm',
     defaultTime: '10.00am',
     startTime: '10:00',
     dynamic: false,
     dropdown: true,
     scrollbar: true
   });
   
   $('.timepickerclose').timepicker({
     timeFormat: 'h:mm p',
     interval: 60,
     minTime: '10',
     maxTime: '11:00pm',
     defaultTime: '6:00pm',
     startTime: '10:00',
     dynamic: false,
     dropdown: true,
     scrollbar: true
   });
   
   $(document).ready(function() {
   $('.js-example-basic-multiple').select2({
     placeholder: "Select Amenities",
     allowClear: true
   });
   });
</script>
@endpush