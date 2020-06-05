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
                        <tr class="heading-row">
                           <th colspan="2" style="background: transparent;border-radius: 0;color: #565656;padding: .75rem;font-size: 20px;">Business Information</th>
                        </tr>
                        <tr>
                           <td>Business Name</td>
                           <td>{{$users->business_name}}</td>
                        </tr>
                        <tr>
                           <td>Street Address</td>
                           <td>{{$users->address}}</td>
                        </tr>
                        <tr>
                           <td>City</td>
                           <td>{{$users->city}}</td>
                        </tr>
                        <tr>
                           <td>State</td>
                           <td>{{$users->state}}</td>
                        </tr>
                        <tr>
                           <td>Zip Code</td>
                           <td>{{$users->pincode}}</td>
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
                           <td>Industry</td>
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
                           <td>Tell us a little about your business</td>
                           <td>{{$users->about_business}}</td>
                        </tr>
                        <?php if(empty($users->connected_stripe_account_id)){ ?>
                        <tr>
                           <td>Payment Option</td>
                           <td><a href="https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write" class="btn btn-primary" id="connect-stripe"><span> <span class="icon-gear s7-icon"></span>&nbsp; Connect with stripe</span></a></td>
                        </tr>
                        <?php }else{ ?>
                        <tr>
                           <td>Payment Option</td>
                           <td><a href="javascript:void(0);" class="btn btn-danger" id="disconnect-stripe"><span class="icon-key s7-icon"></span>&nbsp;Disconnect stripe account</a></td>
                        </tr>
                        <?php } ?>

                        <tr style="display: none">
                           <td>Bank Name</td>
                           <td>{{$users->bank_name}}</td>
                        </tr>
                        <tr style="display: none">
                           <td>Bank Account Number</td>
                           <td>{{$users->bank_account_number}}</td>
                        </tr>
                        <tr style="display: none">
                           <td>Bank Routing Number</td>
                           <td>{{$users->bank_routing_number}}</td>
                        </tr>
                     </tbody>
                  </table>
                  <div class="w-100 px-4 pb-5">
                     <div class="profile-img-wrap">
                        <div class="profile-img">
                           <img src="{{ asset('public/avatar/'.Auth::user()->avatar) }}">
                        </div>
                     </div>
                  </div>
               </div>
               <div class="consumer-info edit-profile-info">
                  <div class="consumer-head">
                     Profile
                  </div>
                  <form class="flex-grow-1 py-5" method="POST" id="userProfile" action="{{ url('/user/store-manage-profile') }}" enctype="multipart/form-data">
                    @csrf
                     <div class="col-lg-8">
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"><label class="mb-0 label-1">Business Name <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"> <input type="text" name="business_name" class="form-control" placeholder="Business Name" value="{{$users->business_name}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Street Address <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="text" name="address" class="form-control" placeholder="Business Address" value="{{$users->address}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">City <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="text" name="city" class="form-control" placeholder="City" value="{{$users->city}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">State <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7">
                              <select class="form-control" name="state" id="state">
                                <option value="">Select State</option>
                                @foreach($States as $state)
                                <option @if( $state['state_name'] == $users->state) selected="selected" @endif value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                                @endforeach
                              </select>
                           </div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Zip Code <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="text" name="pincode" class="form-control" placeholder="Zip Code" value="{{$users->pincode}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business Phone Number <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="tel" id="phone_number" name="phone_number" class="form-control" placeholder="Phone Number" value="{{$users->phone_number}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"><label class="mb-0 label-1">Business Email <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="email" name="business_email" class="form-control" placeholder="Business Email" value="{{$users->business_email}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business URL</label></div>
                           <div class="col-lg-7"><input type="text" name="url" class="form-control" placeholder="Business URL" value="{{$users->url}}"></div>
                        </div>
                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Business Industry <span style="color: red;">*</span></label></div>
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
                           <div class="col-lg-5"> <label class="mb-0 label-1">Type of Business <span style="color: red;">*</span></label></div>
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
                           <div class="col-lg-5"> <label class="mb-0 label-1">Tax ID number <span style="color: red;">*</span></label></div>
                           <div class="col-lg-7"><input type="tel" name="tax_id_number" class="form-control" placeholder="Tax ID" id="tax_id_number" value="{{$users->tax_id_number}}"></div>
                        </div>

                        <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Tell us a little about your business</label></div>
                           <div class="col-lg-7"><textarea class="form-control" id="about_business" name="about_business" rows="4" placeholder="About Your Business">{{$users->about_business}}</textarea></div>
                        </div>

                        <!-- <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Name</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_name" class="form-control" placeholder="Enter Bank Name" value="{{$users->bank_name}}"></div>
                        </div> -->

                        <!-- <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Account Number</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_account_number" class="form-control" placeholder="Bank Account Number" value="{{$users->bank_account_number}}"></div>
                        </div> -->

                        <!-- <div class="form-group profile-form-group d-flex align-items-center">
                           <div class="col-lg-5"> <label class="mb-0 label-1">Bank Routing Number</label></div>
                           <div class="col-lg-7"><input type="text" name="bank_routing_number" class="form-control" placeholder="Enter Bank Routing Number" value="{{$users->bank_routing_number}}"></div>
                        </div> -->

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
<script type="text/javascript">
  $(document).ready(function(){
    $("#businessIndustryText").text($("#business_industry option:selected" ).text());
    $("#businessTypeText").text($("#business_type option:selected" ).text());

    $("#disconnect-stripe").click(function(){
      var result = confirm("Are you sure want to disconnect? All the data will be lost");
      if (result) {
        window.location.href ="{{ url('/user/stripe-deauthorization') }}";
      }
    });
    
  });

  $(".signin-btn").click(function(e){
     $('#userProfile').validate({ // initialize the plugin
         rules: {
             business_name: {
                 required: true
             },
             address: {
                 required: true
             },
             city: {
                 required: true
             },
             state: {
                 required: true
             },
             pincode: {
                 required: true
             },
             phone_number: {
                 required: true,
                 minlength : 8
             },
             business_email: {
                 required: true,
                 email: true
             },
             business_industry: {
                 required: true,
             },
             business_type: {
                 required: true
             },
             tax_id_number: {
                 required: true
             }
         }
     });
 });
</script>
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

   var phones = [{ "mask": "(###) ###-####"}];
   $('#phone_number').inputmask({ 
      mask: phones, 
      greedy: false, 
      definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
   });

   var tax = [{ "mask": "##-#######"}];
   $('#tax_id_number').inputmask({ 
      mask: tax, 
      greedy: false, 
      definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
   });

</script>
@endsection


