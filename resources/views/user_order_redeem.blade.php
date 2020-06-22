@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
      <ol class="breadcrumb mb-0">
         <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
         <li class="breadcrumb-item active" aria-current="page">Redeem Amount</li>
      </ol>
   </div>
</nav>
<!-- order-detail -->
<div class="py-5">
   <div class="container">
      <div class="check-code">
         <h3>Enter Gift Card Code</h3>
            <div class="row">

               <div class="form-group col-lg-3">
                  <input type="text" class="form-control" id="gift_code" name="gift_code" value="" style="min-height: 42px;">
               </div>
               <div class="col-lg-9">
                  <button type="button" class="btn pickd-btn text-white" id="check-code">Check Code</button>
               </div>
               <div class="col-lg-6 code-table mt-4" style="display: none" id="detailsShow">
                  <div class="table-responsive">
                     <h3>Order Details</h3>
                     <table class="table">
                        <tbody>
                           <tr>
                              <th>Customer Name</th>
                              <td id="customer_name"></td>
                           </tr>
                           <tr>
                              <th>Customer Email</th>
                              <td id="customer_email"></td>
                           </tr>
                           <tr>
                              <th>Recipient  Name</th>
                              <td id="recipient_name"></td>
                           </tr>
                           <tr>
                              <th>Recipient  Email</th>
                              <td id="recipient_email"></td>
                           </tr>
                           <tr>
                              <th>Total</th>
                              <td id="total"></td>
                           </tr>
                           <tr>
                              <th>Used</th>
                              <td id="used"></td>
                           </tr>
                           <tr>
                              <th>Remaing</th>
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
   </div>
</div>
<!-- order-detail -->
@endsection

<!-- Javascript section -->
@section('javascript')
<script type="text/javascript">

  var redeemUrl          = "{{url('/user/redeem-amount')}}";
  var user_id            = "{{Auth::user()->id}}";
  var ajaxUrl            = "{{url('/user/redeem-order-ajax')}}";
  var transactionAjaxUrl = "{{url('/user/transaction-order-ajax')}}";
  var orderID;

  var gift_code = [{ "mask": "####-####"}];
  $('#gift_code').inputmask({ 
     mask: gift_code, 
     greedy: false, 
     definitions: { '#': { validator: "^[a-zA-Z0-9_.-]*$", cardinality: 1}} 
  });

   $(document).ready(function(){
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
                    orderID   = response.order_id;

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
                  location.reload();
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
