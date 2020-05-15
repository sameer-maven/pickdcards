@extends('layouts.home')

@section('content')
<div class="bg-contact thank-you-wrap" style="background-color: #EAECEC;margin-top: 50px;">
   <div class="container-contact" style="background-color: #EAECEC;">
      <div class="wrap-contact p-0 overflow-hidden" style="width: 550px;">
         <div class="qr-wrap">
            <img src="{{ asset('front/assets/images/qr.svg') }}" class="img-fluid d-block mx-auto">
         </div>
         <div class="thnk-content">
          <h2 class="thnk-title">Thank you</h2>
          <p class="thnk-subtitle">Thank you for purchasing the gift card, Hope you enjoy the Pickd  Gift Card</p>
         </div>
      </div>
   </div>
</div>
@endsection