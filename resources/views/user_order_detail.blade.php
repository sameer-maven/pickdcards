@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ url('user/orders') }}">Manage Account</a></li>
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
              <li>Name: </li>
              <li>Email: </li>
              <li>Phone: </li>
              <li>Amount: </li>
              <li>Used Amount: </li>
            </ul>
            <ul class="consumer-info-list list-unstyled flex-grow-1 mb-0">
              <li>{{$data->customer_full_name}}</li>
              <li>{{$data->customer_email}}</li>
              <li>{{$data->customer_phone}}</li>
              <li>${{$data->balance}}</li>
              <li>${{$data->used_amount}}</li>
            </ul>
          </div>
        </div>
        <div class="col-lg-6 pl-0">
          <div class="consumer-info d-flex">
            <ul class="consumer-info-list list-unstyled mb-0">
              <li>Recipient Name: </li>
              <li>Recipient Email: </li>
              <li>Created Date: </li>
            </ul>
            <ul class="consumer-info-list list-unstyled flex-grow-1 mb-0">
              <li>{{$data->recipient_name}}</li>
              <li>{{$data->recipient_email}}</li>
              <li><?php echo date_format($data->created_at,"Y/m/d H:i:s");?></li>
            </ul>
          </div>
        </div>
        <br>
        <div class="col-lg-12">
           <div class="form-group">
             <textarea class="form-control" id="" rows="3" placeholder="Note" style="padding: 10px 30px;background: #E6E6E6;">{{$data->recipient_notes}}</textarea>
           </div>
           <div class="my-5 text-center">
              <button type="submit" class="btn btn-primary signin-btn w-auto px-4">Resend Card</button>
           </div>
        </div>
      </div>
    </div>
    
  </div>
</div>
@endsection
