@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
      <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item"><a href="{{url('/user')}}">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page"><a href="">Manage Profile</a></li>
      </ol>
   </div>
</nav>
<!-- consumer-detail -->
<div class="consumer-detail-sec">
   <div class="container">
      <div class="consumer-detail mb-5">
        @if (Session::has('notification'))
        <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-success btn-sm alert-fonts" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{ Session::get('notification') }}
              </div>
              
            </div>
        </div>
        @endif

        @if (Session::has('error'))
        <div class="row">
            <div class="col-lg-12">
              <div class="alert alert-danger btn-sm alert-fonts" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  {{ Session::get('error') }}
              </div>
              
            </div>
        </div>
        @endif
         <div class="row">
            <div class="col-lg-12">
               <div class="table-responsive profile-info-detail">
                  <table class="table profile-info-table">
                     <thead>
                        <tr>
                           <th colspan="2">Profile <button id="edit_profile" type="button" class="float-right"><span class="icon-pen"></span></button> </th>
                        </tr>
                     </thead>
                     <tbody>
                        <tr>
                           <td>Name</td>
                           <td>{{$users->name}}</td>
                        </tr>
                        <tr>
                           <td>Email</td>
                           <td>{{$users->email}}</td>
                        </tr>
                        <tr>
                           <td>Profile Pic</td>
                           <td>
                              <div class="profile-img" style="width:150px !important; height: auto !important;">
                                  <img src="{{ asset('public/avatar/'.Auth::user()->avatar) }}">
                              </div>
                           </td>
                        </tr>
                     </tbody>
                  </table>
               </div>
               <div class="consumer-info edit-profile-info">
                  <div class="consumer-head">
                     Profile
                  </div>
                  <form class="flex-grow-1 py-5" method="POST" id="userProfile" action="{{ url('/user/store-manage-profile') }}" enctype="multipart/form-data">
                    @csrf
                     <div class="col-lg-8">
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Profile Pic</label></div>
                           <div class="col-lg-7">
                              <div class="upload-photo">
                                 <div class="photo-wrap">
                                    <label for="file_upload_image" id="custom-file-upload" class="custom-file-upload mb-0">
                                    <span class="icon-cloud-computing upload-icon"></span>
                                    <span class="upload-text">Upload Image</span> 
                                    </label>
                                    <label class="label-uploader">
                                    <span class="form-control-wrap file-514">
                                    <input type="file" name="photo" size="40" class="wpcf7-form-control image-file input-image-preview upload-input-file" id="file_upload_image" accept="image/*">
                                    </span>
                                    </label>
                                 </div>
                                 <div class="photo-preview">
                                    <img src="" alt="Image Preview" id="img-preview" class="img-responsive" style="display: none; width: 100px; height: 100px">
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-lg-12 my-2 text-center">
                        <button type="submit" class="btn btn-primary signin-btn w-auto px-4">Save Changes</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- consumer-detail -->
@endsection

@section('javascript') 
<script>
  function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#img-preview').attr('src', e.target.result);
        $('#img-preview').show();
      }
      reader.readAsDataURL(input.files[0]); // convert to base64 string
    }
  }

  $(".input-image-preview").change(function(){
    readURL(this);
  });

</script>
@endsection


