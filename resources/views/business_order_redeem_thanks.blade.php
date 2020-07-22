@extends('layouts.app')

@section('content')
<!-- 17-07-20 -->
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
   width: 50%;
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
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=PT+Serif:wght@400;700&display=swap');

.sbm-table-bordered {
   margin-bottom:0px;
}
.border-radius-5 {
   border-radius:5px;
}
.verify-form .border-radius-5 {
   border-radius:5px !important;
}
.input-group.verify-form .input-group-append {
    margin-left: 15px;
}

.input-group.verify-form .form-control {
    height: auto;
    border-radius: 5px;
    box-shadow: none;
}
.sbm-table-2 thead {
    background: #6FB8AC;
}

.sbm-table-2 thead td {
   color: #fff;
   padding: 20px;
   font-weight: 700;
}
.fw-600 {
   font-weight:600;
}
.mb-30 {
   margin-bottom:30px;
}
.sbm-table-2 {
    
}
.input-group.verify-form .sbm-btn {
    padding-left: 40px;
    padding-right: 40px;
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
.sbm-table-2 tbody tr {
    background: #f9fafa;
}
.sbm-list-wrapper {
   background: #fff;
    box-shadow: 0 2px 5px 0px rgb(0 0 0 / 0.2); 
    -webkit-box-shadow: 0 2px 5px 0px rgb(0 0 0 / 0.2); 
    padding: 20px;
}
.thankyou-sec {
   text-align:center;
}
.thankyou-sec h2 {
   font-size:100px;
   color:#6fb8ac;
   font-family: 'PT Serif', serif;
   font-weight: 700;
}
.thankyou-sec i {
   font-size:140px;
   color:#6fb8ac;
}
.thankyou-sec p { 
   font-size:25px;
   line-height: 1.5;
   font-weight:600;
    color: #58465d;
   font-family: 'PT Serif', serif;
}


@media(min-width:768px) {
   .sbm-table-2 thead td,
   .sbm-table-2 tbody td {
      padding-left: 50px;
   }
   .sbm-table-2 td:first-child {
      width: 30%;
   }
}
@media(max-width:991px) {
   .thankyou-sec i {
    font-size: 100px;
   }
   .thankyou-sec h2 {
    font-size: 80px;
   }
   .thankyou-sec p {
    font-size: 22px;
   }
}
@media(max-width:991px) {
   .thankyou-sec h2 {
      font-size: 60px;
   }
   .thankyou-sec p {
    font-size: 20px;
   }
}
</style>
<div class="support-sec sec-padding overlay1 business-support default-banner" style="background-image: url({{ asset('public/front/assets/images/search-page.png') }});padding: 50px 0;">
   <div class="container">
      <div class="row">
         <div class="col-lg-12">
            <div class="banner-content text-center">
               <h1 class="sec-title text-white mb-3">
                  {{$business->business_name}}
               </h1>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- support-sec -->
<!-- product-detail -->
<section class="product-detail-sec sec-padding sec-bg-light py-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-4 col-lg-4">
            <div class="sbm-logo-holder">
               <img src="{{ asset('public/avatar/'.$business->avatar) }}" alt="">
            </div>
         </div>
         <div class="col-md-6 col-lg-5">
            <div class="sbm-list-wrapper label-wrapper">
                @if($business->get_free_percentage != 0)
                <div class="ribbon-green">Get {{number_format($business->get_free_percentage)}}% Free</div>
                @endif
               <ul class="sbm-icon-list-1">
                  <li><i class="fa fa-map-marker"></i> {{$business->address}}</li>
                  <li><i class="fa fa-phone"></i> <a href="tel:{{$business->phone_number}}">{{$business->phone_number}}</a></li>
                  <li><i class="fa fa-globe"></i> <a href="{{$business->url}}" target="_blank">{{$business->url}}</a></li>
               </ul>
               <div class="text-center mt-4"> <a href="{{ url('/fill-order-details') }}<?php echo "/".base64_encode($business->id); ?>" class="btn sbm-btn">Purchase Gift Card</a></div>
            </div>
         </div>
      </div>
   </div>
</section>
<!-- order-detail -->
<section class="sec-padding thankyou-sec">
   <div class="container">
         <i class="fa fa-handshake-o" aria-hidden="true"></i>
         <h2>Thank You!</h2>
         <p>You have successfully redeemed {{$lastTransaction->tranx_amount}}$ using [{{$order->card_code}}]</p>
   </div>
</section>
<section class="product-detail-sec sec-padding pt-0 pb-5">
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-10 mb-30">
            <div class="table-responsive">
               <table class="table table-bordered table-hover sbm-table-2">
                  <thead>
                     <tr>
                        <td colspan="2">Gift Card Transaction: </td>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td class="fw-600">Date: </td>
                        <td class="fw-600">Amount</td>
                     </tr>
                     @foreach($allTransactions as $transaction)
                     <tr>
                        <td>{{$transaction->created_at}}</td>
                        <td>{{$transaction->tranx_amount}}</td>
                     </tr>
                    @endforeach
                  </tbody>
               </table>
            </div>
         </div>
         
      </div>
   </div>
</section>
<!-- order-detail -->
@endsection

<!-- Javascript section -->
@section('javascript')
<script type="text/javascript">
</script>
@endsection
