@extends('layouts.home')

@section('content')
<style>

/* label Design  */
.sbm-list-wrapper.label-wrapper {
    padding-top: 45px !important;
}
.bg-contact .container-contact .label-wrapper.wrap-contact {
    padding-top: 55px !important;

}
.label-wrapper.wrap-contact .ribbon-green {
   top: 20px;
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
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
      <div class="label-wrapper wrap-contact" style="max-width: 500px;margin-top: 50px;">
        <div class="ribbon-green">10% free</div>
        <img src="{{ asset('public/avatar/'.$users->avatar) }}" class="img-fluid d-block mx-auto" width="150" height="150"><br>
         <h2 class="contact-title text-center">{{ $users->business_name }}</h2>
         <p class="contact-subtitle">Purchase a gift card for any amount between $15 and $500.</p>
         <form class="mt-4" id="addOrderFrm" method="POST" action="{{ url('/order/add') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="<?php echo base64_encode($users->id);?>">
            <div class="form-group">
               <input type="text" class="form-control" id="name" name="name" aria-describedby="" placeholder="Full Name">
            </div>
            <div class="form-group">
               <input type="email" class="form-control" id="email" name="email" aria-describedby="" placeholder="Email Address">
            </div>
            <!-- <div class="form-group">
               <input type="tel" class="form-control" id="phone_number" name="phone_number"  placeholder="Enter Phone No in formate like: (123) 456-7890" pattern="(?:\(\d{3}\)|\d{3})[- ]?\d{3}[- ]?\d{4}">
            </div> -->
            <!-- <div class="form-group">
               <input type="email" class="form-control" id="business_email" name="business_email" aria-describedby="" placeholder="Business Email">
            </div> -->
            <div class="form-group">
               <input type="number" class="form-control" id="card_amount" name="card_amount" placeholder="Gift Card Amount">
            </div>
            <div class="form-group">
               <input type="text" class="form-control" id="recipient_name" name="recipient_name" aria-describedby="" placeholder="Receipt Name">
            </div>
            <div class="form-group">
               <input type="email" class="form-control" id="recipient_email" name="recipient_email" aria-describedby="" placeholder="Receipt Email">
            </div>
            <div class="form-group">
             <textarea class="form-control" rows="4" placeholder="Receipt Notes" id="recipient_note" name="recipient_note"></textarea>
            </div>
         <div class="mt-4 text-center">
           <button type="submit" class="btn btn-primary signin-btn add-order-btn">Confirm</button>
         </div>
         </form>
      </div>
   </div>
</div>
@endsection

@section('javascript') 
<script type="text/javascript">
  //Add order form  
    
    $(document).on("change","#card_amount",function(){
      this.value = parseFloat(this.value).toFixed(2);
    });
    
    $(".add-order-btn").click(function(e){
        $('#addOrderFrm').validate({ // initialize the plugin
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true
                },
                card_amount: {
                    required: true,
                    min:15,
                    max:500
                },
                recipient_name: {
                    required: true
                },
                recipient_email: {
                    required: true,
                    email: true
                },
                recipient_note: {
                    required: true
                }
            },
            messages: {
              card_amount: {
                min: "Please enter amount value between or equal to 15 and 500",
                max: "Please enter amount value between or equal to 15 and 500",
              }
            }  
        });
    });
</script>

@if (Session::has('notification'))
   <script>
     Swal.fire(
        'Done',
        "{{ Session::get('notification') }}",
        'success'
      ) 
   </script>
@endif
@endsection