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
                      <strong>Admin, Inc.</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      San Francisco, CA 94107<br>
                      Phone: (804) 123-5432<br>
                      Email: info@almasaeedstudio.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <span style="color: #007bff">Customer Details</span>
                    <address>
                      <strong>John Doe</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      San Francisco, CA 94107<br>
                      Phone: (555) 539-1037<br>
                      Email: john.doe@example.com
                    </address>
                  </div>
                  <div class="col-sm-3">
                    <span style="color: #007bff">Recipent Details</span>
                    <address>
                      <strong>John Doe</strong><br>
                      795 Folsom Ave, Suite 600<br>
                      San Francisco, CA 94107<br>
                      Phone: (555) 539-1037<br>
                      Email: john.doe@example.com
                    </address>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-3">
                    <b>Order ID: #007612</b><br>
                    <br>
                    <b>Date:</b> 2/22/2014<br>
                    <b>Paid Amount: $</b> 100.00<br> 
                    <b>Gift Amount: $</b> 100.00<br>
                    <b>Used Amount: $</b> 100.00<br>
                  </div>
                  <!-- /.col -->
                </div>

                <div class="row">
                  <!-- accepted payments column -->
                  <div class="col-sm-6">
                    <p class="lead">QR Code:</p>
                    <img class="img-responsive img-thumbnail" src="http://pickd.mavens.work/public/qrcode/qrcode_order_8_user_Walmart_1589808035988cui1mAZ.png">
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                    <p class="lead">Total</p>

                    <div class="table-responsive">
                      <table class="table">
                        <tbody><tr>
                          <th style="width:50%">Customer Paid:</th>
                          <td>$106.00</td>
                        </tr>
                        <tr>
                          <th>Stripe Fee</th>
                          <td>$4.00</td>
                        </tr>
                        <tr>
                          <th>Admin Profit:</th>
                          <td>$6.00</td>
                        </tr>
                        <tr>
                          <th>Business User Profit:</th>
                          <td>$96.00</td>
                        </tr>
                      </tbody></table>
                    </div>
                  </div>
                  <!-- /.col -->
                </div>
                <br>
                <div class="row">
                  <div class="col-sm-8">
                    <button type="button" class="btn btn-success pull-right"><i class="fa fa-qrcode"></i> Re Generate QR Code
                    </button>
                    <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                      <i class="fa fa-envelope"></i> Send Email
                    </button>
                  </div>
                  <div class="col-sm-4">
                    <a href="{{ url('admin/orders-list') }}" type="button" class="btn btn-danger" style="float: right">
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