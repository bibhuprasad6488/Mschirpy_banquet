@extends('dashboard.mainlayouts')
@section('title', 'Edit Vendor')
@section('content')
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Edit Vendor</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Edit Vendor</li>
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
                  <form action="/update_vendor" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     <div class="row">
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Vendor Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="vendor_name" name="vendor_name" class="form-control" placeholder="Vendor Name" value="{{$user->name}}" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Email</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="email" name="email" class="form-control" placeholder="Email" value="{{$user->email}}" required>
                           </div>
                        </div>
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Mobile</label>
                              <span class="text-danger">*</span>
                              <input id="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" name="mobile" value="{{$user->mobile}}" required placeholder="Mobile" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;">
                           </div>
                        </div>
                     </div>
                     <div class="form-group">
                        <input type="submit" id="submit" class="btn btn-primary" name="submit" value="Update">
                        <a href="/vendor_list" class="btn btn-secondary">Back</a>
                     </div>
                     <input type="hidden" value="{{$user->id}}" name="user_id">
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection