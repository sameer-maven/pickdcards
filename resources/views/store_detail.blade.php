@extends('layouts.home')

@section('content')
<!-- support-sec -->
<style>
.sbm-small-title {
   font-size: 23px;
    font-weight: 700;
    color: #585858;
}
.btn.sbm-btn {
   background:#86C959;
   color:#ffffff;
   padding:10px 20px;
   border:1px solid #86C959;
   border-radius:30px;
}
.btn.sbm-btn:hover {
   background:#000000;
   border-color:#86C959;
   color:#ffffff;
}
.sbm-table-bordered.table-light tbody+tbody, .sbm-table-bordered.table-light td, .sbm-table-bordered.table-light th, .sbm-table-bordered.table-light thead th {
   border-color: #dcdcdc;
}
.sbm-table-bordered tbody td:first-child {
   font-weight: 600;
}
.sbm-logo-holder {
    width: 100%;
    height: 100%;
    display: flex;
    padding:20px;

    -ms-flex-align: center !important;
    align-items: center !important;
    text-align: center;
    -ms-flex-pack: center !important;
    justify-content: center !important;
    /*background: #fff;*/
}
.sbm-logo-holder img { 
   width: 60%;
   max-width: 355px;
   object-fit:content;
}
.sbm-table-bordered {
   margin-bottom:0px;
}
.sbm-icon-list-1 {
    list-style: none;
    padding:0px;
}
.sbm-icon-list-1 li {
   position: relative;
   padding: 8px 8px 8px 36px;
   border-bottom: 1px solid #f1f1f1;
   color:#282828;
}
.sbm-icon-list-1 li:last-child {
  border: none;
}
.sbm-icon-list-1 li a {
   color:#282828;
}
.sbm-icon-list-1 li i { 
   position: absolute;
    top: 11px;
    left: 10px;
    font-size: 20px;
    color: #86c959;
}
.sbm-icon-list-1 li:first-child {
    border-top: none;
}
/* .sbm-icon-list-1 li:last-child {
    border-bottom: none;
} */
.sbm-list-wrapper {
   background: #fff;
    box-shadow: 0 2px 5px 0px rgb(0 0 0 / 0.2); 
    -webkit-box-shadow: 0 2px 5px 0px rgb(0 0 0 / 0.2); 
    padding: 20px;
}

/* label Design  */
.sbm-list-wrapper.label-wrapper {
    padding-top: 45px;
}

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
    top: 10px;
    width: auto;
    background-color: #86c959;
    color: #ffffff;
    text-align: left;
    display: inline-block;
    box-shadow: 5px 5px 12px #A0A0A0;
    background-image: linear-gradient(to right, red , #660000);
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
    background: red;
    z-index: 1;
    border-style: none;
    transform: scaleX(-1);
    clip-path: polygon(100% 0, 27% 50%, 100% 100%, 0 100%, 0 0);
}

/* End Label Design  */
</style>
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
      <div class="row justify-content-center">
         <div class="col-md-6 col-lg-5">
            <div class="sbm-logo-holder">
               <img src="{{ asset('public/avatar/'.$users->avatar) }}" alt="">
            </div>
         </div>
         <div class="col-md-6 col-lg-5">
            <div class="sbm-list-wrapper label-wrapper">
               @if($users->get_free_percentage != 0)
               <div class="ribbon-green">Get {{number_format($users->get_free_percentage)}}% Free</div>
               @endif
               <ul class="sbm-icon-list-1">
                  <li><i class="fa fa-map-marker"></i> {{$users->address}}</li>
                  <li><i class="fa fa-phone"></i> <a href="tel:{{$users->phone_number}}">{{$users->phone_number}}</a></li>
                  <li><i class="fa fa-globe"></i> <a href="{{$users->url}}" target="_blank">{{$users->url}}</a></li>
               </ul>
               <div class="text-center mt-4"> <a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($users->id); ?>" class="btn sbm-btn">Purchase Gift Card</a></div>
            </div>
         </div>
      </div>
   </div>
</section>
<section class="product-detail-sec sec-padding py-5" style="background: #f1f1f1;">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10">
         <div class="product-detail-wrap text-center"> 
            <h3 class="sbm-small-title mb-4">About The Business</h3>
            <div class="product-txt" style="text-align: justify;">{{ $users->about_business }}</div>
            <!-- <div class="text-center mt-4">
               <a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($users->id); ?>" class="btn sbm-btn">Purchase Gift Card</a>
            </div> -->
         </div>
         </div>
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