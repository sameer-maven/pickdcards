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
            <div class="sbm-list-wrapper">
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
<section class="product-detail-sec sec-padding py-5">
   <div class="container">
   <!-- <div class="row">
      <div class="col-lg-12">
         
      </div>
   </div> -->
      <div class="row justify-content-center">
         <div class="col-md-10 mb-30">
         <div>
            <h3 class="gift-title mb-4">Steps to Redeem a Gift Card</h3>
            <ul class="gift-list list-unstyled">
               <li>Scan the QR code to reveal the Gift Card Code.</li>
               <li>Enter the 8-digit Gift Card Code below.</li>
               <li>Check if the code is valid.</li>
               <li>Click Redeem.</li>
               <li>Enter a redeem amount less than or equal to the remaining amount.</li>
            </ul>
         </div>
            <form action="">
               <div class="input-group verify-form">
                  
                  <input type="text" class="form-control" id="gift_code" name="gift_code" placeholder="Please enter the code" value="{{ Request::segment(3) }}" style="min-height: 42px;">
                  <div class="input-group-append">
                     <a href="javascript:void(0);" class="btn sbm-btn border-radius-5" id="check-code">Verify</a>
                  </div>
               </div>
            </form>
         </div>
         <div class="col-md-10 mb-30" style="display: none" id="detailsShow">
            <div class="table-responsive">
              <table class="table table-light table-striped  sbm-table-2">
                <thead>
                   <tr>
                      <td></td>
                      <td></td>
                   </tr>
                </thead>
                <tbody>
                   <tr style="display: none;">
                      <td>Customer Name</td>
                      <td id="customer_name"></td>
                   </tr>
                   <tr style="display: none;">
                      <td>Customer Email</td>
                      <td id="customer_email"></td>
                   </tr>
                   <tr style="display: none;">
                      <td>Recipient  Name</td>
                      <td id="recipient_name"></td>
                   </tr>
                   <tr style="display: none;">
                      <td>Recipient  Email</td>
                      <td id="recipient_email"></td>
                   </tr>
                   <tr>
                      <td class="fw-600">Total</td>
                      <td class="fw-600" id="total"></td>
                   </tr>
                   <tr>
                      <td>Used</td>
                      <td id="used"></td>
                   </tr>
                   <tr>
                      <td>Remaining</td>
                      <td id="remaining"></td>
                   </tr>
                </tbody>
             </table>
            </div>
            <h3>Redeem</h3>
            <div class="d-flex flex-wrap align-items-center mt-4">
               <button class="btn pickd-btn text-white mr-3" id="redeem">Redeem</button>
               <button class="btn pickd-btn text-white" id="allTransactions">View Transactions</button>
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

  var redeemUrl          = "{{url('/order/redeem-amount')}}";
  var user_id            = "{{$business->user_id}}";
  var ajaxUrl            = "{{url('/order/redeem-order-ajax')}}";
  var transactionAjaxUrl = "{{url('/order/transaction-order-ajax')}}";
  var thanksUrl          = "{{url('/business-thanks/')}}";
  var orderID;
  var used_amount;
  var remaining_amount;
  var redeem_amount;

  var gift_code = [{ "mask": "####-####"}];
  $('#gift_code').inputmask({ 
     mask: gift_code, 
     greedy: false, 
     definitions: { '#': { validator: "^[a-zA-Z0-9_.-]*$", cardinality: 1}} 
  });

   $(document).ready(function(){ 

      $(window).keydown(function(event){
        if(event.keyCode == 13) {
          event.preventDefault();
          $('#check-code').click();
          return false;
        }
      });

      $("#check-code").click(function(){

         var code = $("#gift_code").val();

         if(code==""){

          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text:"Please enter gift card code"
          });
          return false;
         }

         Swal.fire({
           title: 'Please Wait!',
           text: 'Checking...',
           showConfirmButton: false,
           onBeforeOpen: () => {
               Swal.showLoading()
            }
         });

         setTimeout(function(){
            //Ajax Call
            $.ajax({
               url: ajaxUrl,
               type: "POST",
               data: {
                  _token: "{{ csrf_token() }}",
                  user_id: user_id,
                  gift_code:code
               },
               dataType: "json",
               success: function (response) {
                  if(response.status=='ok'){
                    $("#customer_name").text(response.customer_name);
                    $("#customer_email").text(response.customer_email);
                    $("#recipient_name").text(response.recipient_name);
                    $("#recipient_email").text(response.recipient_email);
                    $("#total").text("$"+response.total_amount);
                    $("#used").text("$"+response.used_amount);
                    $("#remaining").text("$"+response.remaining_amount);
                    orderID          = response.order_id;
                    used_amount      = response.used_amount;
                    remaining_amount = response.remaining_amount;

                    if(response.used_amount==response.total_amount){
                      $("#redeem").hide();
                    }

                    Swal.fire({
                      icon: 'success',
                      title: "Success",
                      text: response.message,
                      showConfirmButton: false,
                      timer: 1000
                    });

                    setTimeout(function(){
                      $("#detailsShow").show();
                    }, 1500);

                  }

                  if(response.status=='error'){
                     Swal.fire({
                      icon: 'error',
                      title: 'Oops...',
                      text: response.message
                     });
                    $("#customer_name").text('');
                    $("#customer_email").text('')
                    $("#recipient_name").text('')
                    $("#recipient_email").text('')
                    $("#total").text('')
                    $("#used").text('')
                    $("#remaining").text('')
                    $("#detailsShow").hide();
                    $("#gift_code").val("");
                  }

               }
           });
           //Ajax Call End
         }, 1500);
      });
   });

   $(document).on("click","#redeem",function(){
          Swal.fire({
            text: 'Please add redeem amount',
            icon: 'info',
            input: 'number',
            inputAttributes: {
              autocapitalize: 'off',
              placeholder:"Amount"
            },
            showCancelButton: true,
            confirmButtonText: 'Redeem',
            confirmButtonColor: '#28a745',
            cancelButtonColor: '#d33',
            showLoaderOnConfirm: true,
            preConfirm: (Amount) => {
              redeem_amount = Amount;
              return fetch(redeemUrl+'/'+orderID+'/'+Amount)
                .then(response => {
                  if (!response.ok) {
                    throw new Error(response.statusText)
                  }
                  return response.json()
                })
                .catch(error => {
                  Swal.showValidationMessage(
                    `Request failed: ${error}`
                  )
                })
            },
            allowOutsideClick: () => !Swal.isLoading()
          }).then((result) => {

            if (result.value) {

              if(result.value.save=="yes"){

                
                
                Swal.fire({
                  title: "Done",
                  text: result.value.message,
                  icon: 'success',
                }).then((e)=>{
                  var url = thanksUrl+'/'+orderID;
                  window.location = url;
                });
              }

              if(result.value.save=="no"){
                Swal.fire({
                  icon: 'error',
                  title: 'Oops...',
                  text: result.value.message,
                });
              }

            }
          }); 

    //End document 
    });

   $(document).on("click","#allTransactions",function(){
      //Ajax Call
      $.ajax({
         url: transactionAjaxUrl,
         type: "POST",
         data: {
            _token: "{{ csrf_token() }}",
            user_id: user_id,
            order_id:orderID
         },
         dataType: "json",
         success: function (response) {
            console.log(response);
            if(response.status=='ok'){
              Swal.fire({
                title: 'All Transactions',
                html:response.table,
                focusConfirm: false,
                confirmButtonText:'Ok',
                confirmButtonAriaLabel: 'Thumbs up, great!'
              });
            }

            if(response.status=='error'){
               Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: response.message
               });
            }

         }
     });
     //Ajax Call End
   });
</script>
@endsection
