@extends('layouts.home')

@section('content')
<!-- support-sec -->
<div class="support-sec sec-padding overlay1 business-support topbanner-padd default-banner" style="background-image: url({{ asset('public/front/assets/images/page-banner.jpg') }});">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="banner-content">
               <h1 class="sec-title text-white mb-3">Search for Small Businesses to Support</h1>
               <p class="sec-subtitle text-white mb-3">Purchase gift cards for any amount between $15 to $500 </p>
               <!-- <div class="btn-wrap banner-btn mt-3">
                  <a href="JavaScript:(void)" class="btn pickd-btn picked-btn-white mr-3">Get Started</a>
                  </div> -->
            </div>
         </div>
      </div>
   </div>
</div>
<!-- support-sec -->
<!-- search-tab -->
<div class="search-tabs sec-padding">
   <div class="container">
      <nav>
         <div class="nav nav-tabs cstm-nav-tabs" id="nav-tab" role="tablist">
            <a class="nav-item nav-link @if(empty(Request::get('name'))) active @endif" id="search-city-tab" data-toggle="tab" href="#search-city" role="tab" aria-controls="nav-home" aria-selected="true">Search by Business Industry, Type, Zip Code</a>
            <a class="nav-item nav-link @if(!empty(Request::get('name'))) active @endif" id="search-business-tab" data-toggle="tab" href="#search-business" role="tab" aria-controls="nav-profile" aria-selected="false">Search by Business Name</a>
         </div>
      </nav>
      <div class="tab-content" id="nav-tabContent">
         <div class="tab-pane fade @if(empty(Request::get('name'))) active show @endif cstm-tab" id="search-city" role="tabpanel" aria-labelledby="search-city-tab">
            <form role="search" autocomplete="off" action="{{ url('search') }}" method="get">
               <div class="form-row align-items-center">
                  <div class="col-lg-3 form-group search-select-group">
                     <input type="text" class="form-control flex-grow-1" id="" name="city" placeholder="City" style="margin-left: 10px;" value="{{ Request::get('city') }}">
                  </div>
                  <div class="col-lg-3 form-group search-select-group">
                     <select class="cstm-select search-select" name="state">
                        <option value="">Select State</option>
                        @foreach($States as $state)
                        <option @if( $state['state_name'] == Request::get('state')) selected="selected" @endif value="{{ $state['state_name'] }}">{{ $state['state_name'] }}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="col-lg-4 form-group d-flex align-items-center">
                     <span style="color: #3e3e3e; font-size: 16px; font-weight: 700;">OR</span>
                     <input type="text" class="form-control flex-grow-1" id="" name="zipcode" placeholder="Zip Code" style="margin-left: 10px;" value="{{ Request::get('zipcode') }}">
                  </div>
                  <div class="col-lg-2 form-group">
                     <button type="submit" class="btn btn-primary w-100 btn-2" style="min-height: 55px;">Search</button>
                  </div>
               </div>
            </form>
         </div>
         <div class="tab-pane fade cstm-tab @if(!empty(Request::get('name'))) active show @endif" id="search-business" role="tabpanel" aria-labelledby="search-business-tab">
            <form role="search" autocomplete="off" action="{{ url('search') }}" method="get">
               <div class="form-row align-items-center">
                  <div class="col-lg-10 form-group d-flex align-items-center">
                     <input type="text" class="form-control flex-grow-1" id="" name="name" placeholder="Business Name" value="{{ Request::get('name') }}">
                  </div>
                  <div class="col-lg-2 form-group">
                     <button type="submit" class="btn btn-primary w-100 btn-2" style="min-height: 55px;">Search</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
      <div class="search-result-wrap mt-5">
         <div class="result-heading-top d-flex flex-wrap align-items-center justify-content-between mb-4">
            <h4 class="result-title">{{$data->total()}} Results</h4>
            @if(!empty(Request::get('name')) || !empty(Request::get('city')) || !empty(Request::get('state')) || !empty(Request::get('zipcode')) || !empty(Request::get('page')) )
            <a href="{{ url('/search') }}" class="btn btn-danger" >Reset</a>
            @endif
            
            <!-- <div class="search-result-select">
               <form>
                  <div class="form-group search-select-group mb-0">
                     <select class="cstm-select search-select" name="state">
                        <option>Filter By Industry</option>
                        <option>Wyoming</option>
                        <option>option 1</option>
                        <option>option 2</option>
                     </select>
                  </div>
               </form>
            </div> -->
         </div>
         <div>
         <div class="search-col-wrap row d-flex flex-wrap">
            @if( $data->total() !=  0 && $data->count() != 0 )
            @foreach( $data as $user )
            <div class="col-md-6 col-lg-4 col-xl-3">
               <div class="search-result-col">
                  <h5 class="result-col-title">{{ $user->business_name }}</h5>
                  <p class="result-col-subtitle">{{ $user->address }}</p>
                  <a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($user->id); ?>" class="btn pickd-btn text-white btn-green">Purchase Gift Card</a>
               </div>
            </div>
            @endforeach
            @else
               <p>No result Found.</p>
            @endif
         </div>
         <nav aria-label="Page navigation cstm-navigation">
           {{ $data->links() }}
         </nav>
      </div>
      </div>
   </div>
</div>
<div class="contact-info-wrap py-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="d-flex flex-wrap align-items-center">
               <a href="JavaScript:(void)" class="btn pickd-btn picked-btn-white">Get Started</a>
               <ul class="social-icons d-flex flex-wrap list-unstyled mb-0">
                  <li><a href="#"><span class="icon-facebook-1"></span></a></li>
                  <li><a href="#"><span class="icon-twitter-black-shape"></span></a></li>
                  <li><a href="#"><span class="icon-linkedin"></span></a></li>
                  <li><a href="#"><span class="icon-instagram"></span></a></li>
                  <li><a href="#"><span class="icon-youtube-1"></span></a></li>
               </ul>
            </div>
         </div>
         <!-- <div class="col-lg-6 align-self-center">
            <div class="contact-no text-right">
               <a href="tel:888-986-8263" class="contact-no-link"><span class="icon-call"></span>
               888-986-8263</a>
            </div>
         </div> -->
      </div>
   </div>
</div>
@endsection