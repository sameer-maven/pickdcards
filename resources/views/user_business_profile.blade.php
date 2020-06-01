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
         <form class="mt-4" id="profileFrm" method="POST" action="{{ url('/user/add') }}">
            @csrf
            <div class="row">
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="address" name="address" placeholder="Street Address">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="city" name="city" placeholder="City">
               </div>
               <div class="col-lg-12 form-group">
                  <select class="cstm-select" name="state" id="state">
                    <option value="">Select State</option>
                    @foreach($States as $state)
                    <option value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                    @endforeach
                  </select>
               </div>
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="pincode" name="pincode" placeholder="Zip Code">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="tel" class="form-control" id="phone_number" name="phone_number" placeholder="Phone No (XXX) XXX-XXXX" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Business Email">
               </div>
               <div class="col-lg-12 form-group">
                  <input type="text" class="form-control" id="business_url" name="business_url" placeholder="Business URL">
               </div>
               <div class="col-lg-12 form-group">
                  <select class="cstm-select" name="business_industry" id="business_industry">
                    <option value="">Select Industry</option>
                    @foreach($Industries as $industry)
                    <option value="{{ $industry['id'] }}">{{ $industry['industry'] }}</option>
                    @endforeach
                  </select>
               </div>
               <div class="col-lg-12 form-group">
                  <select class="cstm-select" name="business_type" id="business_type">
                    <option value="">Select Type</option>
                    @foreach($Types as $type)
                    <option value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                    @endforeach
                  </select>
               </div>
               <div class="col-lg-12 form-group">
                  <input type="tel" class="form-control" id="tax_id_number" name="tax_id_number" placeholder="Tax ID XX-XXXXXXX" pattern="[0-9]{2}-[0-9]{7}">
               </div>
               <div class="col-lg-12 form-group">
                  <textarea class="form-control" id="about_business" name="about_business" rows="4" placeholder="About Your Business"></textarea>
               </div>
            </div>
            <div class="mt-4 text-center">
              <button type="submit" class="btn btn-primary bus-profile-btn">Confirm</button>
            </div>
         </form>
      </div>
   </div>
</div>
@endsection
