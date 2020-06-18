@extends('layouts.home')

@section('content')
<style>
  .hide {
      display: none!important;
  }
  /*paymenttable-css*/
  .payment-table tr:nth-child(odd) {
    background: #f8f8f8;
}
.payment-table td span.amount {
    float: right;
    font-weight: 700;
}
</style>
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
    <div class="wrap-contact" style="width: 500px;margin-top: 50px">
      <h2 class="contact-title">Make Payment</h2>
      <p class="contact-subtitle">Please fill following info to complete payment.</p>
        <div class='form-row'>
          <div class='col-lg-12 form-group'>
            <label class='control-label font-weight-bold'>Card Holder Name</label>
            <input class='form-control' size='4' type='text' name="card_holder" id="card_holder">
          </div>
        </div>
        <div class='form-row'>
          <div class='col-lg-12 form-group'>
            <label class='control-label font-weight-bold'>Card Details</label>
            <div id="card-element"></div>
          </div>
        </div>
        <br>
        <!-- <div class='form-row'>
          <div class='col-lg-12'>
            <div class='form-control total btn pickd-btn text-white rounded'>
              Card Amount:
              <span class='amount'>$ {{$balance}}</span>
            </div>
          </div>
        </div>
        <br>
        <div class='form-row'>
          <div class='col-lg-12'>
            <div class='form-control total btn pickd-btn text-white rounded'>
              Service Fee:
              <span class='amount'>$ {{$fee_amount}}</span>
            </div>
          </div>
        </div>
        <br>
        <div class='form-row'>
          <div class='col-lg-12'>
            <div class='form-control total btn pickd-btn text-white rounded'>
              Total:
              <span class='amount'>$ {{$amount}}</span>
            </div>
          </div>
        </div> -->
        <div class="table-responsive">
          <table class="table payment-table">
            <tbody>
              <tr>
                <td>Card Amount:
              <span class='amount'>$ {{$balance}}</span></td>
              </tr>
              <tr>
                <td>Service Fee:
              <span class='amount'>$ {{$fee_amount}}</span></td>
              </tr>
              <tr>
                <td>Total:
              <span class='amount'>$ {{$amount}}</span></td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="form-group">
           <div class="form-check">
             <input class="form-check-input" type="checkbox" id="gridCheck1" value="yes" name="agree_terms">
             <p class="sign-small-txt"><label class="form-check-label" for="gridCheck1">I confirm that I have read, consent and agree to Pickd LLC’s <a href="{{ url('/page/terms-of-use-consumer') }}" class="txt-green" target="_blank">Terms of Use</a> and <a href="{{ url('/page/privacy-policy-consumer') }}" class="txt-green" target="_blank">Privacy Policy</a></label></p>
           </div>
        </div>
        <div id="card-errors" role="alert"></div>
        <button id="card-button" class="btn btn-primary signin-btn mt-3">Pay</button> 
    </div>
    </div>
  </div>
@endsection

@section('javascript')
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">

  var STRIPE_KEY          = "{{env('STRIPE_KEY')}}";
  var clientSecret        = "{{$payment_intent}}";
  var stripeAccountDetail = "{{$stripeAccount}}";
  var orderID             = "{{$id}}";

  var stripe     = Stripe(STRIPE_KEY, {stripeAccount: stripeAccountDetail});
  var elements   = stripe.elements();

  var style = {
    base: {
      color: "#32325d",
    }
  };
  var card = elements.create("card", { style: style });
  card.mount("#card-element");

  card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
    if (event.error) {
      displayError.textContent = event.error.message;
    } else {
      displayError.textContent = '';
    }
  });

  $(document).on("click","#card-button",function(){
    var cardHolder = $("#card_holder").val();

    if(cardHolder==""){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "Please enter card holder name"
      });
      return false;
    }

    if($("#gridCheck1").prop('checked') == false){
      Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: "Please read and agree to the terms"
      });
      return false;
    }

    Swal.fire({
        title: 'Please Wait!',
        html: 'Payment processing...',
        onBeforeOpen: () => {
          Swal.showLoading() 
        }
      });
    stripe.confirmCardPayment(clientSecret, {
      payment_method: {
        card: card,
        billing_details: {
          name: cardHolder
        }
      }
    }).then(function(result) {
      
      if (result.error) {
        console.log(result.error.message);
        Swal.fire({
          icon: 'error',
          title: 'Oops...',
          text: result.error.message
        })
      } else {
        // The payment has been processed!
        if (result.paymentIntent.status === 'succeeded') {
          $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
          var paid = 1;
          $.ajax({
              url: "{{url('order/add-payment')}}",
              type: 'POST',
              data: {paid : paid,order_id : orderID},
              dataType: 'json',
              success: function( data ) {
                Swal.fire({
                  icon: 'success',
                  title: 'Done!',
                  text: 'Payment Completed',
                  showConfirmButton: false
                });

                setTimeout(function(){ window.location = data.url; }, 1000);
              }       
          });
          // Show a success message to your customer
          // There's a risk of the customer closing the window before callback
          // execution. Set up a webhook or plugin to listen for the
          // payment_intent.succeeded event that handles any business critical
          // post-payment actions.
        }
      }
    });
  });

</script>
@endsection