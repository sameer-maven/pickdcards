@extends('layouts.home')
@section('content')
<style>

/* label Design  */
   .label-wrapper {
      position: relative;
      z-index: 90;
      overflow:hidden;
   }
   .label-wrapper .ribbon-green {
      transform-origin: center center;
      padding: 1px 6px 1px 10px;
      position: absolute;
      right: 0;
      top: 7px;
      width: auto;
      background-color: #86c959;
      color: #ffffff;
      text-align: left;
      display: inline-block;
      box-shadow: 5px 5px 12px #A0A0A0;
   }
   .featured-business-sec .search-result-col.label-wrapper {
       padding-top: 45px;
   }
   .label-wrapper .ribbon-green:before {
      height: 100%;
       width: 20px;
       position: absolute;
       top: 0;
       left: -19px;
       content: "";
       background: #86c959;
       z-index: 1;
       border-style: none;
       transform: scaleX(-1);
       clip-path: polygon(100% 0, 27% 50%, 100% 100%, 0 100%, 0 0);
   }

/* End Label Design  */
</style>
<!-- top-banner -->
<!-- <div class="top-banner overlay1" style="background-image: url({{ asset('public/front/assets/images/top-banner.jpg') }});"> -->
<div class="top-banner overlay1" style="background-image: url({{ asset('public/front/assets/images/home-page.png') }});">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="banner-content">
               <h1 class="banner-title">
                  Gift Cards to Support Small Business
               </h1>
               <div class="btn-wrap banner-btn mt-3">
                  <a href="{{ url('/register') }}" class="btn pickd-btn picked-btn-white mr-3 mb-3">Sign Your Business Up</a>
                  <a href="{{ url('/search') }}" class="btn pickd-btn button-outline mb-3">Search for a Business</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- top-banner -->
<!-- business-industry-sec -->
<div class="industry-sec sec-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto">
            <h2 class="sec-title">We’re in this together</h2>
            <p class="sec-subtitle">Search for businesses by industry or location to show your support. Ask your favorite small businesses to sign up and create their unique URL so you can purchase gift cards. They’ll get paid now when they need it most, and you can redeem the gift card later.</p>
         </div>
      </div>
      <!-- <div class="logos-wrap d-flex flex-wrap align-items-center text-center mt-4">
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-1.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-2.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-3.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-4.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-5.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-6.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-7.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-8.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-9.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('public/front/assets/images/brand-logo-10.png') }}" class="img-fluid">
         </div>
      </div> -->
   </div>
</div>
<!-- business-industry-sec -->
<!-- business-signup -->
<div class="business-signup-sec sec-padding sec-bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto">
            <h2 class="sec-title">Sign Up Your Business</h2>
            <!-- <p class="sec-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..</p> -->
         </div>
      </div>
      <div class="sign-detail-row d-flex flex-wrap justify-content-center mt-5">
         <div class="sign-col">
            <div class="icon-2" style="background: #86C959;"><span class="icon-enter"></span></div>
            <p>Create a free Pickd Cards account. As part of the on-boarding process you will need to connect a Stripe account so we can seamlessly transfer funds to you at no cost.</p>
         </div>
         <div class="sign-col">
            <div class="icon-2" style="background: #D9D54E;"><span class="icon-gift"></span></div>
            <!-- <p>Offer digital gift cards with a unique URL you can share with your customers. Your business will be searchable within the Pickd platform using name, location and industry.</p> -->
            <p>Offer digital gift cards that are completely contactless and POS agnostic. Your business will be part of the Pickd platform and searchable using name, location and industry.</p>
         </div>
         <div class="sign-col">
            <div class="icon-2" style="background: #C55C87;"><span class="icon-deposit"></span></div>
            <!-- <p>Get gift card sales deposited directly into your bank account within a few days. Our gift card service is <span style="font-weight: 700;">100% FREE FOR LIFE</span> for small businesses. <br> * Please see our Terms and Conditions. <br></p> -->
            <p>Get gift card sales deposited directly into your bank account within a few days. Our gift card service is <span style="font-weight: 700;">100% FREE FOR LIFE</span> for small businesses. <br> *Please see our Terms and Conditions. <br></p>
         </div>
      </div>
      <div class="btn-wrap text-center mt-5">
         <a href="{{ url('/register') }}" class="btn pickd-btn text-white">Sign Up Your Business</a>
      </div>
   </div>
</div>
<!-- business-signup -->

<!-- Featured business -->
<div class="featured-business-sec sec-padding oh-hidden">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto mb-4">
            <h2 class="sec-title">Featured Businesses</h2>
            <!-- <p class="sec-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..</p> -->
         </div>
         <div class="col-12">
            <div class="slide-4">
               @foreach ($featuredBusses as $featuredBus)
               <div class="slide">
                  <div class="search-result-col label-wrapper">
                        <div class="ribbon-green">50% Free</div>
                        <h5 class="result-col-title"><a href="{{ url('/store') }}<?php echo "/".$featuredBus->slug; ?>" style="color: #3e3e3e;font-size: 17px;font-weight: 700;">{{ $featuredBus->business_name }}</a></h5>
                        <!-- <p class="result-col-subtitle">{{ $featuredBus->address }}, {{ $featuredBus->city }}, {{ $featuredBus->state }}</p> -->
                        <p class="result-col-subtitle">{{ $featuredBus->address }}</p>
                        <a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($featuredBus->id); ?>" class="btn pickd-btn1 text-white btn-green">Purchase Gift Card</a>
                  </div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Featured business -->
<!-- support-sec -->
<!-- <div class="support-sec sec-padding overlay1" style="background-image: url({{ asset('public/front/assets/images/support-bg.jpg') }});">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="banner-content">
               <h1 class="sec-title text-white mb-3">
                  Ready to Support Small
                  Businesses?
               </h1>
               <p class="sec-subtitle text-white mb-3">Search for businesses by industry or location to show your support. 
                  You can also ask your favorite small businesses to sign up and create 
                  their unique URL so you can purchase gift certificates. 
               </p>
               <div class="btn-wrap banner-btn mt-3">
                  <a href="JavaScript:(void)" class="btn pickd-btn picked-btn-white mr-3">Get Started</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->
<!-- support-sec -->

<!-- testimonial-sec -->
<div class="testimonial-sec sec-padding sec-bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="testimonial-slider">
               @foreach ($testimonials as $testimonial)
               <div class="item">
                  <div class="client-info">
                     <div class="client-img"><img style="border-radius: 50%;" src="{{ asset('public/testimonials/'.$testimonial->photo) }}"></div>
                     <h4 class="client-title">{{$testimonial->title}}</h4>
                     <p>{{$testimonial->company_name}}</p>
                  </div>
                  <div class="client-review-txt">{{$testimonial->content}}</div>
               </div>
               @endforeach
            </div>
         </div>
      </div>
   </div>
</div>
<div class="contact-info-wrap py-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="d-flex flex-wrap align-items-center">
               <a href="{{ url('/register') }}" class="btn pickd-btn picked-btn-white">Get Started</a>
               <ul class="social-icons d-flex flex-wrap list-unstyled mb-0">
                  <li><a href="{{$socials->facebook}}" target="__blank"><span class="icon-facebook-1"></span></a></li>
                  <li><a href="{{$socials->twitter}}" target="__blank"><span class="icon-twitter-black-shape"></span></a></li>
                  <li><a href="{{$socials->linkedin}}" target="__blank"><span class="icon-linkedin"></span></a></li>
                  <li><a href="{{$socials->instagram}}" target="__blank"><span class="icon-instagram"></span></a></li>
                  <li><a href="{{$socials->pinterest}}" target="__blank"><span class="icon-pinterest"></span></a></li>
                  <!-- <li><a href="#"><span class="icon-youtube-1"></span></a></li> -->
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
