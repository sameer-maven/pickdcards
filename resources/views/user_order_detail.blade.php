@extends('layouts.app')

@section('content')
<style>
  .hide{display: none;}
</style>
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('user/orders') }}">Manage Orders</a></li>
    <li class="breadcrumb-item active" aria-current="page">Order Details</li>
  </ol>
</div>
</nav>
<!-- consumer-detail -->
<div class="consumer-detail-sec">
  <div class="container">
    <div class="consumer-detail">
      <div class="consumer-head">
        Order Details
      </div>
      <div class="row">
        <div class="col-lg-6 pr-0">
          <div class="consumer-info d-flex">
            <ul class="consumer-info-list list-unstyled mb-0">
              <li><b>Date</b> </li>
              <li><b>Name </b></li>
              <li><b>Email </b></li>
              <li><b>Recipient Name </b></li>
              <li><b>Recipient Email </b></li>
              <li><b>Amount </b></li>
              <li><b>Used Amount</b></li>
              <li><b>Remaining Amount</b></li>
            </ul>
            <?php 
              $remainingAmount = round($data->balance-$data->used_amount,2);
              
              $balanceCode = $data->card_code; 
            ?>
            <ul class="consumer-info-list list-unstyled flex-grow-1 mb-0">
              <li><b>:</b> <?php echo date_format($data->created_at,"Y/m/d H:i:s");?></li>
              <li><b>:</b> {{$data->customer_full_name}}</li>
              <li><b>:</b> {{$data->customer_email}}</li>
              <li><b>:</b> {{$data->recipient_name}}</li>
              <li><b>:</b> {{$data->recipient_email}}</li>
              <li><b>:</b> $<?php echo round($data->balance,2);?></li>
              <li><b>:</b> $<?php echo round($data->used_amount,2);?></li>
              <li><b>:</b> $<?php echo $remainingAmount;;?></li>
            </ul>
          </div>
          <br>
          <div class="form-group">
             <textarea class="form-control" id="" rows="3" placeholder="Note" style="padding: 10px 30px;background: #E6E6E6;" readonly>{{$data->recipient_notes}}</textarea>
           </div>
           <?php if($data->balance != $data->used_amount){ ?>
            <button class="button-success pure-button" id="redeem">Redeem Amount</button>
           <?php } ?>
        </div>
        <!-- <div class="col-lg-6 pl-0">
          <div class="consumer-info d-flex">
            <ul class="consumer-info-list list-unstyled mb-0">
              <li>Recipient Name: </li>
              <li>Recipient Email: </li>
            </ul>
            <ul class="consumer-info-list list-unstyled flex-grow-1 mb-0">
              <li>{{$data->recipient_name}}</li>
              <li>{{$data->recipient_email}}</li>
            </ul>
          </div>
        </div> -->
        <?php if($data->balance != $data->used_amount){ ?>
        <div class="col-lg-6 pl-0">
          <br>
          <a href="javascript:void(0);" id="qrcodeScan" style="float: right;">Show Code</a>
          <br>
          <div style="float: right;border: 1px solid black;" id="qrcodeImgContainer">
            <img class="img-responsive img-thumbnail" src="{{asset('public/qrcode/'.$data->qrcode)}}">
          </div>
          <div class="hide" style="float: right;border: 1px solid black;padding: 60px;" id="qrcodeTexContainer">
            <p>GIFT CARD CODE: <b><?php echo $balanceCode; ?></b></p>
          </div>
        </div>
        <br>
        <div class="col-lg-12">
           <hr>
           <div class="my-5 text-center">
              <button type="submit" class="btn btn-primary signin-btn w-auto px-4" id="resendCard">Resend Card</button>
           </div>
        </div>
        <?php }else{ ?>
          <div class="my-5 text-center">
            <h3 style="margin: 55px;color: red">Card has already been used!</h3>
          </div>
        <?php } ?>  

      </div>
    </div>
    
  </div>
</div>
@endsection

@section('javascript')
   <script>
      var balanceC  = "{{$balanceCode}}";
      var orderID   = "{{$data->id}}";
      var url       = "{{url('/user/generate-qrcode')}}";
      var redeemUrl = "{{url('/user/redeem-amount')}}";

      $(document).on("click","#qrcodeScan",function(){
        $("#qrcodeImgContainer").toggleClass("hide");
        $("#qrcodeTexContainer").toggleClass("hide");

        var x = document.getElementById("qrcodeScan");
        if (x.innerHTML === "Hide Code") {
          x.innerHTML = "Show Code";
        } else {
          x.innerHTML = "Hide Code";
        }

      });

      $(document).on("click","#resendCard",function(){
        Swal.fire({
          title: 'Are you sure?',
          text: "Want to resend card.",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, send it!'
        }).then((result) => {
          if (result.value) {
            window.location = url+"/"+orderID;
          }
        });
      });


   </script>

   @if (Session::has('notification'))
    <script>
      $(document).ready(function(){
        Swal.fire(
          "Done",
          "{{ Session::get('notification') }}",
          "success"
        );
      });
    </script>
  @endif

  <script>
    $(document).on("click","#redeem",function(){

      Swal.fire({
        title: 'Please enter gift card code',
        input: 'text',
        inputAttributes: {
          autocapitalize: 'off'
        },
        showCancelButton: true,
        confirmButtonText: 'Apply',
        showLoaderOnConfirm: true,
        preConfirm: (code) => {
          if(code==""){
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: 'Please enter gift card code'
            }).then((result) => {
              $("#redeem").click();
            });
          }

          if(code == balanceC){
            return "yes";
          }else{
            return "no";
          } 
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {

        if (result.value == "yes") {
          Swal.fire({
            title: 'Code Applied!',
            text: 'Please add redeem amount',
            icon: 'success',
            input: 'text',
            inputAttributes: {
              autocapitalize: 'off'
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
        }

        if(result.value == "no"){
          Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Invalid code entered!'
          });
        }

      });

    //End Ready 
    });
    
  </script>
@endsection
