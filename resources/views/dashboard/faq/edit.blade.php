 @extends('dashboard.mainlayouts')
 @section('title', 'Edit content')
 @section('content')
     <!-- Page Wrapper -->
     <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
     <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

     <div class="page-wrapper">
         <div class="content container-fluid">
             <!-- Page Header -->
             <div class="page-header">
                 <div class="row">
                     <div class="col-sm-12">
                         <h3 class="page-title">Edit FaQs</h3>
                         <ul class="breadcrumb">
                             <li class="breadcrumb-item"><a href="/home">Dashboard</a></li>
                             <li class="breadcrumb-item active">Edit FaQs</li>
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
                             <form action="/faq_update" method="post" autocomplete="off" enctype="multipart/form-data">
                                 @csrf
                                 <div class="row">

                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label>Title</label>
                                             <span class="text-danger">*</span>
                                             <input type="text" class="form-control" value="{{ $faqs->title }}" name="title" id=""
                                                 placeholder="Enter title .."  >

                                         </div>
                                     </div>
                                     <div class="col-md-12">
                                         <div class="form-group">
                                             <label>Content</label>
                                             <span class="text-danger">*</span>
                                             <textarea class="form-control" name="content" id="summernote">"{{ $faqs->content }}"</textarea>

                                         </div>
                                     </div>
                                 </div>
                                 <div class="form-group">
                                     <input type="submit" id="submit" class="btn btn-primary" name="submit"
                                         value="Update">
                                     <a href="/faq" class="btn ml-1 btn-secondary">Back</a>
                                 </div>
                                 <input type="hidden" value="{{ $faqs->id }}" name="id">
                             </form>
                         </div>
                     </div>
                 </div>
             </div>
         </div>
     </div>
     <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
     <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
     <script type="text/javascript">
         $('#summernote').summernote({
             height: 200,
             placeholder: "Write Content.....",
             required: true
         });
     </script>
 @endsection
