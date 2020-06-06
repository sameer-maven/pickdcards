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
          <p class="thnk-subtitle"><b style="font-weight: none !important;">GIFT CARD CODE: {{$orderInfo->card_code}}</b></p>
          <p class="thnk-subtitle">
          Thank you for purchasing a <b>Pickd Card</b>. You should receive a confirmation email with your order details shortly. <b>{{ $orderInfo->recipient_name }}</b> will receive an email with this QR code for <b>$ <?php echo number_format($orderInfo->balance,2); ?></b> to use at <b>{{ $businessinfo->business_name }}</b>.</p>
         </div>
      </div>
   </div>
</div>
@endsection