@extends('dashboard.mainlayouts')
@section('title', 'Add Supplier')
@section('content')
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<style>
.ui-widget-header {
    border: 1px solid #dddddd;
    background: #57c62e;
    color: #0d0d0d;
    font-weight: bold;
}

</style>
<!-- Page Wrapper -->
<div class="page-wrapper">
   <div class="content container-fluid">
      <!-- Page Header -->
      <div class="page-header">
         <div class="row">
            <div class="col-sm-12">
               <h3 class="page-title">Add Supplier</h3>
               <ul class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                  <li class="breadcrumb-item active">Add Supplier</li>
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
                  <form action="{{route('supplier.store')}}" method="post" autocomplete="off" enctype="multipart/form-data">
                     @csrf
                     
                     <div class="row">
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Supplier Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="supplier_name" name="supplier_name" class="form-control" placeholder="Supplier Name" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Contact No</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="contact_no" name="contact_no" class="form-control" placeholder="Contact No" pattern="/^-?\d+\.?\d*$/" onKeyPress="if(this.value.length==10) return false;"  required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Email</label>
                              <span class="text-danger">*</span>
                              <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
                           </div>
                        </div>
                  

                <div class="col-md-4">
                           <div class="form-group">
                              <label>Category Name</label>
                              <span class="text-danger">*</span>
                              <select class="js-example-basic-multiple js-states form-control" name="cat_id[]" id="cat_id" multiple="multiple" required>
                                    <option value="">Enter Category</option>
                                       @if(!empty($cats))
                                    @foreach($cats as $k=>$cat)
                                       <option value="{{$k}}">{{$cat}}</option>
                                    @endforeach
                                 @endif
                              </select>
                           </div>
                        </div>

                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Rate Valid From</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="valid_from" name="valid_from" class="form-control" placeholder="Valid From" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Rate Valid To</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="valid_to" name="valid_to" class="form-control" placeholder="Valid To" required>
                           </div>
                        </div>
                        <div class="col-md-12">
                           <div class="form-group">
                              <label>Address</label>
                              <span class="text-danger">*</span>
                              <textarea name="address" id="address" class="form-control" rows="4" cols="4" required></textarea>
                           </div>
                        </div>

                        <div class="col-md-12 text-center mb-3" style="font-weight: bold;">Bank Details</div>
                        
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Bank Name</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>Account No.</label>
                              <span class="text-danger">*</span>
                              <input type="number" id="account_no" name="account_no" class="form-control" placeholder="Account_no" required>
                           </div>
                        </div>
                        <div class="col-md-4">
                           <div class="form-group">
                              <label>IFSC Code</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="ifsc_code" name="ifsc_code" class="form-control" placeholder="IFSC Code" required>
                           </div>
                        </div>
                        
                        <div class="col-md-6">
                           <div class="form-group">
                              <label>GSTIN</label>
                              <span class="text-danger">*</span>
                              <input type="text" id="gstin" name="gstin" class="form-control" placeholder="GSTIN" required>
                           </div>
                        </div>

                        <div class="col-md-6">
                           <div class="form-group">
                              <label>Status</label>
                              <select class="form-control" name="status">
                                 <option value="active">Active</option>
                                 <option value="inactive">Inactive</option>
                              </select>
                           </div>
                        </div>
                     </div>


                     <div class="form-group ">
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
@push('script')
<script>
 $( function() {
       $("#valid_from" ).datepicker({ dateFormat: 'dd-mm-yy' });
       $("#valid_to" ).datepicker({ dateFormat: 'dd-mm-yy' });
 });



 $(document).ready(function() {
      $('.js-example-basic-multiple').select2({
       placeholder: "Select Category",
       allowClear: true
   });
   });
</script>
@endpush