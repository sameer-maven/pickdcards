@extends('layouts.home')

@section('content')
<!-- support-sec -->
<div class="support-sec sec-padding overlay1 business-support topbanner-padd default-banner" style="background-image: url({{ asset('public/front/assets/images/page-banner.jpg') }});padding: 50px 0;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="banner-content text-center">
               <h1 class="sec-title text-white mb-3">{{ $users->business_name }}</h1>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- support-sec -->
<!-- product-detail -->
<section class="product-detail-sec sec-padding py-5">
   <div class="container">
      <div class="product-detail-wrap text-center"> 
         <div class="product-img-2 mb-4">
            <img src="{{ asset('public/avatar/'.$users->avatar) }}" class="img-fluid" alt="" width="180" height="180">
         </div>
         <div class="product-txt" style="text-align: justify;">{{ $users->about_business }}</div><br>
         <div class="product-txt"><a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($users->id); ?>" class="btn pickd-btn text-white btn-green">Purchase Gift Card</a></div>
         
      </div>
   </div>
</section>

<div class="contact-info-wrap py-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="d-flex flex-wrap align-items-center">
               <a href="{{ url('/register') }}" class="btn pickd-btn picked-btn-white">Sign Your Business Up</a>
               <ul class="social-icons d-flex flex-wrap list-unstyled mb-0">
                  <li><a href="https://www.facebook.com/pickdcards" target="__blank"><span class="icon-facebook-1"></span></a></li>
                  <li><a href="https://twitter.com/pickdcards" target="__blank"><span class="icon-twitter-black-shape"></span></a></li>
                  <li><a href="https://www.linkedin.com/company/pickd-cards" target="__blank"><span class="icon-linkedin"></span></a></li>
                  <li><a href="https://www.instagram.com/pickdcards" target="__blank"><span class="icon-instagram"></span></a></li>
                  <li><a href="https://www.pinterest.com/pickdcards" target="__blank"><span class="icon-pinterest"></span></a></li>
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