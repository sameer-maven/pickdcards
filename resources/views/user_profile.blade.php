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
                        <tr class="heading-row">
                           <th colspan="2" style="background: transparent;border-radius: 0;color: #565656;padding: .75rem;font-size: 20px;">Business Information</th>
                        </tr>
                        <tr>
                           <td>Business Name</td>
                           <td>{{$users->business_name}}</td>
                        </tr>
                        <tr>
                           <td>Business Address</td>
                           <td>{{$users->address}}</td>
                        </tr>
                        <tr>
                           <td>Business Phone Number</td>
                           <td>{{$users->phone_number}}</td>
                        </tr>
                        <tr>
                           <td>Business Email</td>
                           <td>{{$users->business_email}}</td>
                        </tr>
                        <tr>
                           <td>Business URL</td>
                           <td>{{$users->url}}</td>
                        </tr>
                        <tr>
                           <td>Business Industry</td>
                           <td id="businessIndustryText">Business Industry</td>
                        </tr>
                        <tr>
                           <td>Type of Business</td>
                           <td id="businessTypeText">Type of Business</td>
                        </tr>
                        <tr>
                           <td>Tax ID number</td>
                           <td>{{$users->tax_id_number}}</td>
                        </tr>
                        <tr>
                           <td>Bank Name</td>
                           <td>{{$users->bank_name}}</td>
                        </tr>
                        <tr>
                           <td>Bank Account Number</td>
                           <td>{{$users->bank_account_number}}</td>
                        </tr>
                        <tr>
                           <td>Bank Routing Number</td>
                           <td>{{$users->bank_routing_number}}</td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="w-100 px-4 pb-5">
                     <div class="profile-img-wrap">
                        <div class="profile-img">
                           <img src="{{ asset('avatar/'.Auth::user()->avatar) }}">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="consumer-info edit-profile-info">
                  <div class="consumer-head">
                     Profile
                  </div>
                  <form class="flex-grow-1 py-5" method="POST" action="{{ url('/user/store-manage-profile') }}" enctype="multipart/form-data">
                    @csrf
                     <div class="col-lg-8">
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"><label class="mb-0 label-1">Business Name</label></div>
                           <div class="col-lg-7"> <input type="text" name="business_name" class="form-control" placeholder="Business Name" value="{{$users->business_name}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business Address</label></div>
                           <div class="col-lg-7"><input type="text" name="address" class="form-control" placeholder="Business Address" value="{{$users->address}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business Phone Number</label></div>
                           <div class="col-lg-7"><input type="number" name="phone_number" class="form-control" placeholder="Business Phone Number" value="{{$users->phone_number}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"><label class="mb-0 label-1">Business Email</label></div>
                           <div class="col-lg-7"><input type="email" name="business_email" class="form-control" placeholder="Business Email" value="{{$users->business_email}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business URL</label></div>
                           <div class="col-lg-7"><input type="text" name="url" class="form-control" placeholder="Business URL" value="{{$users->url}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business Industry</label></div>
                           <div class="col-lg-7">
                            <select name="business_industry" id="business_industry" class="form-control">
                              <option value="">Business Industry</option>
                              @foreach($Industries as $industry)
                              <option @if( $industry['id'] == $users->industry_id) selected="selected" @endif value="{{ $industry['id'] }}">{{ $industry['industry'] }}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Type of Business</label></div>
                           <div class="col-lg-7">
                             <select name="business_type" id="business_type" class="form-control">
                              <option value="">Type of Business</option>
                              @foreach($Types as $type)
                              <option @if( $type['id'] == $users->type_id) selected="selected" @endif value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                              @endforeach
                            </select>
                           </div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Tax ID number</label></div>
                           <div class="col-lg-7"><input type="text" name="tax_id_number" class="form-control" placeholder="Tax ID number" value="{{$users->tax_id_number}}"></div>
                        </div>

                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Name</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" value="{{$users->bank_name}}"></div>
                        </div>

                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Account Number</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_account_number" class="form-control" placeholder="Bank Account Number" value="{{$users->bank_account_number}}"></div>
                        </div>

                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Routing Number</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_routing_number" class="form-control" placeholder="Enter Bank Routing Number" value="{{$users->bank_routing_number}}"></div>
                        </div>

                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Brand Identity</label></div>
                           <div class="col-lg-7">
                              <div class="upload-photo">
                                 <div class="photo-wrap">
                                    <label for="file_upload_image" id="custom-file-upload" class="custom-file-upload mb-0">
                                    <span class="icon-cloud-computing upload-icon"></span>
                                    <span class="upload-text">Upload Image</span> 
                                    </label>
                                    <label class="label-uploader">
                                    <span class="form-control-wrap file-514">
                                    <input type="file" name="photo" size="40" class="wpcf7-form-control image-file upload-input-file" id="file_upload_image" accept=".jpg,.jpeg,.png" aria-invalid="false">
                                    </span>
                                    </label>
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
<script type="text/javascript">
  $(document).ready(function(){
    $("#businessIndustryText").text($("#business_industry option:selected" ).text());
    $("#businessTypeText").text($("#business_type option:selected" ).text());
  });
</script>
@endsection
