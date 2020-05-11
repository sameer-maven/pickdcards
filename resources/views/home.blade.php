@extends('layouts.home')

@section('content')
<!-- top-banner -->
<div class="top-banner overlay1" style="background-image: url({{ asset('front/assets/images/top-banner.jpg') }});">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="banner-content">
               <h1 class="banner-title">
                  Gift Cards to 
                  support small 
                  businesses
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
            <p class="sec-subtitle">Search for businesses by industry or location to show your support. You can also ask your favorite small
               businesses to sign up and create their unique URL so you can purchase gift certificates. They’ll get paid now 
               when they need it most, and you can redeem the gift certificate later.
            </p>
         </div>
      </div>
      <div class="logos-wrap d-flex flex-wrap align-items-center text-center mt-4">
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-1.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-2.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-3.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-4.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-5.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-6.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-7.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-8.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-9.png') }}" class="img-fluid">
         </div>
         <div class="logos-col">
            <img src="{{ asset('front/assets/images/brand-logo-10.pn') }}g" class="img-fluid">
         </div>
      </div>
   </div>
</div>
<!-- business-industry-sec -->
<!-- business-signup -->
<div class="business-signup-sec sec-padding sec-bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto">
            <h2 class="sec-title">Here’s how to sign your
               business up
            </h2>
            <p class="sec-subtitle">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..</p>
         </div>
      </div>
      <div class="sign-detail-row d-flex flex-wrap justify-content-center mt-5">
         <div class="sign-col">
            <div class="icon-2" style="background: #86C959;"><span class="icon-enter"></span></div>
            <p>Create a free account through pickd cards Payments 
               Enter your business information and connect the 
               account where you’d like revenue deposited.
            </p>
         </div>
         <div class="sign-col">
            <div class="icon-2" style="background: #D9D54E;"><span class="icon-gift"></span></div>
            <p>Offer online gift certificates You’ll get a unique URL you
               can share with consumers, and they can find you by 
               location and industry to buy gift certificates of any 
               amount from $15 to $500.
            </p>
         </div>
         <div class="sign-col">
            <div class="icon-2" style="background: #C55C87;"><span class="icon-deposit"></span></div>
            <p>Access earnings now Your revenue will be deposited 
               as early as the business day after customers buy gift 
               certificates online.
            </p>
         </div>
      </div>
      <div class="btn-wrap text-center mt-5">
         <a href="{{ url('/register') }}" class="btn pickd-btn text-white">Sign Your Business Up</a>
      </div>
   </div>
</div>
<!-- business-signup -->

<!-- support-sec -->
<!-- <div class="support-sec sec-padding overlay1" style="background-image: url({{ asset('front/assets/images/support-bg.jpg') }});">
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
<!-- <div class="testimonial-sec sec-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="testimonial-slider">
               <div class="item">
                  <div class="client-info">
                     <div class="client-img"><img src="{{ asset('front/assets/images/client-img.jpg') }}"></div>
                     <h4 class="client-title">Cody Marchant</h4>
                     <p>Company Client</p>
                  </div>
                  <div class="client-review-txt">
                     “I am at an age where I just want to be fit and healthy our bodies 
                     are our responsibility! So start caring for your body and it will care for you. 
                     Eat clean it will care for you and workout hard.”
                  </div>
               </div>
               <div class="item">
                  <div class="client-info">
                     <div class="client-img"><img src="{{ asset('front/assets/images/client-img.jpg') }}"></div>
                     <h4 class="client-title">Cody Marchant</h4>
                     <p>Company Client</p>
                  </div>
                  <div class="client-review-txt">
                     “I am at an age where I just want to be fit and healthy our bodies 
                     are our responsibility! So start caring for your body and it will care for you. 
                     Eat clean it will care for you and workout hard.”
                  </div>
               </div>
               <div class="item">
                  <div class="client-info">
                     <div class="client-img"><img src="{{ asset('front/assets/images/client-img.jpg') }}"></div>
                     <h4 class="client-title">Cody Marchant</h4>
                     <p>Company Client</p>
                  </div>
                  <div class="client-review-txt">
                     “I am at an age where I just want to be fit and healthy our bodies 
                     are our responsibility! So start caring for your body and it will care for you. 
                     Eat clean it will care for you and workout hard.”
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div> -->
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
