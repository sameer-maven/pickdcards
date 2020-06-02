@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Orders Detail </h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Orders Detail</li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  @if ($errors->any())
    <div class="alert alert-danger btn-sm alert-fonts" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif
  <div class="container-fluid">
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Details</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <span style="color: #007bff">Business User Details</span>
                    <address>
                      <strong>{{$user->business_name}}</strong><br>
                      {{$user->address}}, {{$user->city}}, {{$user->state}} {{$user->pincode}}<br>
                      Phone: {{$user->phone_number}}<br>
                      Email: {{$user->business_email}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <span style="color: #007bff">Customer Details</span>
                    <address>
                      <strong>{{$order->customer_full_name}}</strong><br>
                      Email: {{$order->customer_email}}
                    </address>
                  </div>
                  <div class="col-sm-3">
                    <span style="color: #007bff">Recipent Details</span>
                    <address>
                      <strong>{{$order->recipient_name}}</strong><br>
                      Email: {{$order->recipient_email}}
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <b>Order ID: #{{$order->id}}</b><br>
                    <br>
                    <b>Date:</b> {{$order->created_at}}<br>
                    <?php
                      $gift_card_amount = round($order->balance,2);
                      $remaining = round($order->balance-$order->used_amount,2); 
                    ?>
                    <b>Gift Card Amount: $</b> {{$gift_card_amount}}<br><br>
                    <b>Used Amount: $</b> {{$order->used_amount}}<br>
                    <b>Remaining Amount: $</b> {{$remaining}}<br>
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-sm-6">
                    <p class="lead">QR Code:</p>
                    <img class="img-responsive img-thumbnail" src="{{asset('public/qrcode/'.$order->qrcode)}}">
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <p class="lead">Purchase Details</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                        <tr>
                          <th>Business User Profit:</th>
                          <td>$ {{$order->business_user_amount}}</td>
                        </tr>
                        <tr>
                          <th>Stripe Fee:</th>
                          <td>$ {{$order->stripe_fees}}</td>
                        </tr>
                        <tr>
                          <th>Admin Profit:</th>
                          <td>$ {{$order->admin_fee_amount}}</td>
                        </tr>
                        <tr>
                          <th style="width:50%">Total:</th>
                          <td>$ {{$order->amount}}</td>
                        </tr>
                      </tbody></table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-8">
                    <a href="{{ url('admin/generate-qrcode/'.$order->id) }}" class="btn btn-success pull-right"><i class="fa fa-qrcode"></i> Re Send QR Code</a>
                  </div>
                  <div class="col-sm-4">
                    <a href="{{ url('admin/orders-list') }}" class="btn btn-danger" style="float: right">
                      <i class="fas fa-arrow-alt-circle-left"></i> Back
                    </a>
                  </div>
                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection