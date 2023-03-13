@extends('dashboard.mainlayouts')
@section('title', 'Add Venue Type')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
<div class="content container-fluid">
<!-- Page Header -->
<div class="page-header">
   <div class="row">
      <div class="col-sm-12">
         <h3 class="page-title">Add Venue Type</h3>
         <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
            <li class="breadcrumb-item active">Add Venue Type</li>
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
            <form action="{{route('venuetype.update',$venuetype->id)}}" method="post" autocomplete="off" enctype="multipart/form-data">
               @csrf
               @method('PATCH')
               <div class="row">
                  <div class="col-md-6">
                     <div class="form-group">
                        <label>Venue Type</label>
                        <span class="text-danger">*</span>
                        <input type="text" id="venue_type" name="venue_type" class="form-control" placeholder="Venue Type" required value="{{$venuetype->venue_type}}">
                     </div>
                 </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                              <option value="1" {{$venuetype->status == 1 ? "selected" : ""}}>Active</option>
                              <option value="2" {{$venuetype->status == 2 ? "selected" : ""}}>Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
                        <a href="{{route('venuetype.index')}}" class="btn btn-secondary">Back</a>
                     </div>
            </form>
            </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script type="text/javascript">
   $(document).ready(function() {
       $('.js-example-basic-multiple').select2({
   	    placeholder: "Select Packages",
   	    allowClear: true
   	});
   });
</script>
@endsection