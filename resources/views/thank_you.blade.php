@extends('layouts.home')

@section('content')
<div class="bg-contact thank-you-wrap" style="background-color: #EAECEC;margin-top: 50px;">
   <div class="container-contact" style="background-color: #EAECEC;">
      <div class="wrap-contact p-0 overflow-hidden" style="width: 550px;">
         <div class="qr-wrap">
            <img src="{{asset('public/qrcode/'.$qrimage)}}" class="img-fluid d-block mx-auto">
         </div>
         <div class="thnk-content">
          <h2 class="thnk-title">Thank you</h2>
          <p class="thnk-subtitle">
          Thank you for purchasing a Pickd Card. You should receive a confirmation email with your order details shortly. {{ $orderInfo->recipient_name }} will receive an email with this QR code for ${{ round($orderInfo->amount, 2) }} to use at {{ $businessinfo->business_name }}.</p>
         </div>
      </div>
   </div>
</div>
@endsection