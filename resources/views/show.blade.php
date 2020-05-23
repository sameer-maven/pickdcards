@extends('layouts.home')

@section('content')
<style>
  .sec-padding {
    padding: 79px 19px 10px 10px;
  }
</style>
<div class="business-signup-sec sec-padding sec-bg-light">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto">
            <h2 class="sec-title" style="margin-top: 40px;">{{ $response->title }}</h2>
         </div>
      </div>
   </div>
</div>

<!-- business-industry-sec -->
<div class="industry-sec sec-padding">
   <div class="container">
      <div class="row">
         <div class="col-lg-8 text-center mx-auto">
            <?php echo html_entity_decode($response->content) ?>
         </div>
      </div>
   </div>
</div>
<!-- business-industry-sec -->
<div class="contact-info-wrap py-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="d-flex flex-wrap align-items-center">
               <a href="{{ url('/register') }}" class="btn pickd-btn picked-btn-white">Get Started</a>
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
