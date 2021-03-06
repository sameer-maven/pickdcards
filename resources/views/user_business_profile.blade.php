@extends('layouts.app')
@section('content')
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
      <div class="wrap-contact">
        <h2 class="contact-title text-center">Business Information</h2>
        @if (Session::has('notification'))
            <div class="alert alert-success btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('notification') }}
            </div>
        @endif 
        @if ($errors->any())
            <div class="alert alert-danger btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
         <form class="mt-4" id="profileFrm" method="POST" action="{{ url('/user/add') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" class="form-control" id="city" name="city">
            <input type="hidden" class="form-control" id="state" name="state">
            <input type="hidden" class="form-control" id="pincode" name="pincode">
            <div class="row">
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="address" name="address" placeholder="Address">
               </div>
               <!-- <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City">
               </div> -->
               <!-- <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="state" name="state" placeholder="State">
                  <select class="cstm-select" name="state" id="state">
                    <option value="">Select State</option>
                    @foreach($States as $state)
                    <option value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                    @endforeach
                  </select>
               </div> -->
               <!-- <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Zip Code">
               </div> -->
               <div class="col-lg-12 form-group">
                  <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone Number">
               </div>
               <!-- <div class="col-lg-12 form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Business Email">
               </div> -->
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="business_url" name="business_url" placeholder="Business Website">
               </div>
               <div class="col-lg-12 form-group">
                  <select class="cstm-select" name="business_industry" id="business_industry">
                    <option value="">Select Industry</option>
                    @foreach($Industries as $industry)
                    <option value="{{ $industry['id'] }}">{{ $industry['industry'] }}</option>
                    @endforeach
                  </select>
               </div>
               <!-- <div class="col-lg-12 form-group">
                  <select class="cstm-select" name="business_type" id="business_type">
                    <option value="">Select Type</option>
                    @foreach($Types as $type)
                    <option value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                    @endforeach
                  </select>
               </div> -->
               <!-- <div class="col-lg-12 form-group">
                  <input type="tel" class="form-control" id="tax_id_number" name="tax_id_number" placeholder="Tax ID">
               </div> -->
               <div class="col-lg-12 form-group">
                  <textarea class="form-control" id="about_business" name="about_business" rows="4" placeholder="Tell us a little about your business"></textarea>
               </div>
                <div class="form-group profile-form-group d-flex align-items-center">
                          <div class="col-lg-5">
                            <label class="mb-0 label-1">Business Logo</label><br>
                            <span style="color: red;">(* Only PNG image allowed)</span>
                          </div>
                           <div class="col-lg-8">
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
            <div class="mt-4 text-center">
              <button type="submit" class="btn btn-primary bus-profile-btn">Add Business</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('javascript')
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCQ2dYr4UDXo--NFstm8vBB31ax_2qWaME&libraries=places"></script> 
<script>
    $(window).keydown(function(event){
      if(event.keyCode == 13) {
        event.preventDefault();
        return false;
      }
    });

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
    clearIncomplete: true, 
    definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
  });

   // var tax = [{ "mask": "##-#######"}];
   // $('#tax_id_number').inputmask({ 
   //    mask: tax, 
   //    greedy: false,
   //    clearIncomplete: true,
   //    definitions: { '#': { validator: "[0-9]", cardinality: 1}} 
   // });

</script>
<script type="text/javascript">
  var address;
  function initialize() {
    var input        = document.getElementById('business_name');
    //var input        = document.getElementById('address');
    var autocomplete = new google.maps.places.Autocomplete(input);

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
      var place = autocomplete.getPlace();
      //console.log(place);
      var city,state,pincode;

      if(place.address_components[2] && place.address_components[2]['types'][0]=='locality'){
         city    = place.address_components[2]['long_name'];
      }

      if(place.address_components[3] && place.address_components[3]['types'][0]=='locality'){
         city    = place.address_components[3]['long_name'];
      }

      //State Placement
      if(place.address_components[4] && place.address_components[4]['types'][0]=='administrative_area_level_1'){
         state    = place.address_components[4]['long_name'];
      }

      if(place.address_components[5] && place.address_components[5]['types'][0]=='administrative_area_level_1'){
         state    = place.address_components[5]['long_name'];
      }

      if(place.address_components[6] && place.address_components[6]['types'][0]=='administrative_area_level_1'){
         state    = place.address_components[6]['long_name'];
      }

      //Pincode Placement
      if(place.address_components[6] && place.address_components[6]['types'][0]=='postal_code'){
         pincode    = place.address_components[6]['long_name'];
      }

      if(place.address_components[7] && place.address_components[7]['types'][0]=='postal_code'){
         pincode    = place.address_components[7]['long_name'];
      }

      if(place.address_components[8] && place.address_components[8]['types'][0]=='postal_code'){
         pincode    = place.address_components[8]['long_name'];
      }

      if(city){
        document.getElementById('city').value = city;
      }

      if(state){
        document.getElementById('state').value = state;
      }

      if(pincode){
        document.getElementById('pincode').value = pincode;
      }

      if(place.formatted_address){
        document.getElementById('address').value = place.formatted_address;
      }
      if(place.formatted_phone_number){
        document.getElementById('phone_number').value = place.formatted_phone_number;
      }
      if(place.name){
        document.getElementById('business_name').value = place.name;
      }
      if(place.website){
        document.getElementById('business_url').value = place.website;
      }
    });
  }
  google.maps.event.addDomListener(window, 'load', initialize);
</script>
@endsection