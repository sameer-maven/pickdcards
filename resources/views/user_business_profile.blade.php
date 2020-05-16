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
               <div class="col-lg-6 form-group">
                  <input type="text" class="form-control" id="business_name" name="business_name" placeholder="Business Name">
               </div>
               <div class="col-lg-6 form-group">
                  <input type="text" class="form-control" id="address" name="address" placeholder="Business Address">
               </div>
               <div class="col-lg-6 form-group">
                  <input type="number" class="form-control" id="phone_number" name="phone_number" placeholder="Business Phone Number">
               </div>
               <div class="col-lg-6 form-group">
                  <input type="email" class="form-control" id="email" name="email" placeholder="Business Email">
               </div>
               <div class="col-lg-6 form-group">
                  <input type="text" class="form-control" id="business_url" name="business_url" placeholder="Business URL">
               </div>
               <div class="col-lg-6 form-group">
                  <select class="cstm-select" name="business_industry" id="business_industry">
                    <option value="">Business Industry</option>
                    @foreach($Industries as $industry)
                    <option value="{{ $industry['id'] }}">{{ $industry['industry'] }}</option>
                    @endforeach
                  </select>
               </div>
               <div class="col-lg-6 form-group">
                  <select class="cstm-select" name="business_type" id="business_type">
                    <option value="">Type of Business</option>
                    @foreach($Types as $type)
                    <option value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                    @endforeach
                  </select>
               </div>
               <div class="col-lg-6 form-group">
                  <input type="number" class="form-control" id="tax_id_number" name="tax_id_number" placeholder="Tax ID number">
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
