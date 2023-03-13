@extends('dashboard.mainlayouts')
@section('title', 'Add Cuisine')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Cuisine</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Cuisine</li>
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
                  <form action="{{route('cuisine.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
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
                              <label>Cuisine Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="cuisine_name" name="cuisine_name" class="form-control" placeholder="Cuisine Name" required>
                              @if($errors->has('cuisine_name'))
                              <span class="text-danger">
                              <strong>{{ $errors->first('cuisine_name') }}</strong>
                              </span>
                              @endif
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
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Save">
                        <input type="reset" class="btn btn-secondary" value="Reset">
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection