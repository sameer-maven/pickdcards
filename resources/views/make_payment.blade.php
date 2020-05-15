@extends('layouts.home')

@section('content')
<style>
  .hide {
      display: none!important;
  }
</style>
<div class="bg-contact overlay-2" style="background-image: url({{ asset('front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
    <div class="wrap-contact" style="width: 500px;margin-top: 50px">
      <h2 class="contact-title">Make Payment</h2>
      <p class="contact-subtitle">Please fill following info to complete payment.</p>
      <script src='https://js.stripe.com/v2/' type='text/javascript'></script>
          <form accept-charset="UTF-8" action="{{ url('/order/add-payment') }}" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form" method="POST">
            @csrf
            <input type="hidden" name="order_id" value="{{$id}}">
            <input type="hidden" name="amount" value="{{$amount}}">
            <div class='form-row'>
              <div class='col-lg-12 form-group required'>
                <label class='control-label font-weight-bold'>Name on Card</label>
                <input class='form-control' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-lg-12 form-group required'>
                <label class='control-label font-weight-bold'>Card Number</label>
                <input autocomplete='off' class='form-control card-number' size='20' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-lg-12 form-group cvc required'>
                <label class='control-label font-weight-bold'>CVC</label>
                <input autocomplete='off' class='form-control card-cvc' placeholder='ex. 311' size='4' type='text'>
              </div>
              <div class='col-lg-12 form-group expiration required'>
                <label class='control-label font-weight-bold'>Expiration</label>
                <input class='form-control card-expiry-month' placeholder='MM' size='2' type='text'>
              </div>
              <div class='col-lg-12 form-group expiration required'>
                <label class='control-label font-weight-bold'></label>
                <input class='form-control card-expiry-year' placeholder='YYYY' size='4' type='text'>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-lg-12'>
                <div class='form-control total btn pickd-btn text-white rounded'>
                  Total:
                  <span class='amount'>$ <?php echo round($amount); ?></span>
                </div>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 form-group'>
                <button class='btn btn-primary signin-btn submit-button mt-3' type='submit'>Pay »</button>
              </div>
            </div>
            <div class='form-row'>
              <div class='col-md-12 error form-group hide'>
                <div class='alert-danger alert'>
                  Please correct the errors and try again.
                </div>
              </div>
            </div>
          </form>
    </div>
    </div>
  </div>
@endsection

@section('javascript')
<script>
$(function() {

  $('form.require-validation').bind('submit', function(e) {
    var $form         = $(e.target).closest('form'),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;

    $errorMessage.addClass('hide');
    $('.has-error').removeClass('has-error');
    $inputs.each(function(i, el) {
      var $input = $(el);
      if ($input.val() === '') {
        $input.parent().addClass('has-error');
        $errorMessage.removeClass('hide');
        e.preventDefault(); // cancel on first error
      }
    });
  });
});

$(function() {
  var $form = $("#payment-form");

  $form.on('submit', function(e) {
    if (!$form.data('cc-on-file')) {
      e.preventDefault();
      Stripe.setPublishableKey($form.data('stripe-publishable-key'));
      Stripe.createToken({
        number: $('.card-number').val(),
        cvc: $('.card-cvc').val(),
        exp_month: $('.card-expiry-month').val(),
        exp_year: $('.card-expiry-year').val()
      }, stripeResponseHandler);
    }
  });

  function stripeResponseHandler(status, response) {
    if (response.error) {
      $('.error')
        .removeClass('hide')
        .find('.alert')
        .text(response.error.message);
    } else {
      // token contains id, last4, and card type
      var token = response['id'];
      // insert the token into the form so it gets submitted to the server
      $form.find('input[type=text]').empty();
      $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
      $form.get(0).submit();
    }
  }
})
</script>
<!-- validation-js -->
@endsection