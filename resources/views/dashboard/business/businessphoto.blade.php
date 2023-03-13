@extends('dashboard.mainlayouts')
@section('title', 'Add Business Photos')
@section('content')
<style>
	.hide {
  display: none;
}

.photobtn {
  display: inline-block;
  padding: 4px 12px;
  margin-bottom: 0;
  font-size: 14px;
  line-height: 20px;
  color: #333333;
  text-align: center;
  vertical-align: middle;
  cursor: pointer;
  border: 1px solid #ddd;
  box-shadow: 2px 2px 10px #eee;
  border-radius: 4px;
}

.photobtn-large {
  padding: 10px 60px;
  font-size: 17.5px;
  -webkit-border-radius: 4px;
  -moz-border-radius: 4px;
  border-radius: 4px;
  background-color: #c8d9e5;
}

#imagePreview {
  margin: 15px 0 0 0;
  border: 2px solid #ddd;
}

  .img-wrap {
    position: relative;
    display: inline-block;
    border: 2px black solid;
    font-size: 0;
    width: 228px;
}
.img-wrap .close {
    position: absolute;
    top: 2px;
    right: 2px;
    z-index: 100;
    background-color: #FFF;
    padding: 5px 2px 2px;
    color: #000;
    font-weight: bold;
    cursor: pointer;
    opacity: .2;
    text-align: center;
    font-size: 22px;
    line-height: 10px;
    border-radius: 50%;
}
.img-wrap:hover .close {
    opacity: 1;
}
</style>

<!-- Page Wrapper -->
		<div class="page-wrapper">
			<div class="content container-fluid">

				<!-- Page Header -->
				<div class="page-header">
					<div class="row">
						<div class="col-sm-12">
							<h3 class="page-title">Add Business Photos</h3>
							<ul class="breadcrumb">
								<li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
								<li class="breadcrumb-item active">Add Business Photos</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- /Page Header -->
				<div class="row">
					<div class="col-sm-12">
						<div class="card">
							<div class="card-body col-md-12">
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
								<form action="/save_business_photo" method="post" autocomplete="off" enctype="multipart/form-data">
									@csrf
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
										<label>Title</label>
										<span class="text-danger">*</span>
										<input type="text" id="title" name="title" class="form-control" placeholder="Title" required>
								</div>
								</div>
										<div class="col-md-3">
											<div class="form-group">
									<label>Photo</label>
									<span class="text-danger">*</span>
									<div clas="file_input_wrap">
								    <input type="file" name="imageUpload" accept="image/*" id="imageUpload" class="hide" />
								    <label for="imageUpload" class="photobtn photobtn-large">Select file..</label>
								    </div>
									
								</div>
										</div>
										<div class="col-md-3">
											<div class="img_preview_wrap">
									    <img src="" id="imagePreview" alt="Preview Image" width="200px" height="200px" class="hide" />
									</div>
										</div>
									</div>
								
								
								<div class="form-group">
									<input type="submit" id="submit" class="btn btn-primary" name="submit" value="Submit">
									<a href="/business" class="btn btn-secondary">Back</a>
								</div>
								<input type="hidden" name="user_id" value="{{$userId}}">
							</form>
							
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="row">
								@if(!empty($allbusinessphotos))
								   @foreach($allbusinessphotos as $allbusinessphoto)
								<div class="col-md-3">
									<div class="card m-2">
										<div class="card-body">
											<div class="img-wrap">
									<span class="close fordel" data-id="{{$allbusinessphoto->id}}">&times;</span>
			                    <img class="card-img-top" src="/storage/images/business_photo/{{ $allbusinessphoto->image }}" style="width: 226px; height: 200px">
			                      </div>
			                      <p class="card-text text-center my-1" style="text-transform: capitalize;">{{$allbusinessphoto->title}}</p>
										</div>
									</div>
								</div>
									@endforeach
								@endif
							</div>
						</div>
							</div>
						</div>
						
						
					</div>
				</div>
			</div>
		</div>
@endsection
@push('script')
<script>
$('#imageUpload').change(function() {
readImgUrlAndPreview(this);

function readImgUrlAndPreview(input) {
if (input.files && input.files[0]) {
  var reader = new FileReader();
  reader.onload = function(e) {
    $('#imagePreview').removeClass('hide').attr('src', e.target.result);
  }
};
reader.readAsDataURL(input.files[0]);
}
});

$('.fordel').on('click',function(){
var photo_id = $(this).attr("data-id");
Swal.fire({
	  title: 'Are you sure?',
	  text: "You won't be able to revert this!",
	  icon: 'warning',
	  showCancelButton: true,
	  confirmButtonColor: '#3085d6',
	  cancelButtonColor: '#d33',
	  confirmButtonText: 'Yes, delete it!'
	}).then((result) => {
	  if (result.isConfirmed) {
	  		$.ajax({
	  			type:"post",
	  			url:"/delete_business_photo",
	  			data:{_token:"{{csrf_token()}}",photo_id:photo_id},
	  			success:function(data){
	  				console.log(data);
	  				if(data == 1){
	  					location.reload();
	  				}
	  			}
	  		});
	  }else{
	  	location.reload();
	  }
	})
});

</script>

@endpush