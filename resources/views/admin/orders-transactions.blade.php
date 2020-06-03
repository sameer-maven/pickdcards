@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Order's Transactions ({{$transactions->count()}})</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Order Transactions</li>
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
                <h3 class="card-title">All Transactions of Order No: {{$order_id}} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Redeem Amount</th>
                      <th>Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if($transactions->count() != 0 )
                     @foreach( $transactions as $transaction )
                      <tr>
                        <td>{{ $transaction->id }}</td>
                        <td>{{ $transaction->tranx_amount }}</td>
                        <td>{{ $transaction->created_at }}</td>
                      </tr>
                      @endforeach
                      @else
                      <hr />
                      <h3 class="text-center no-found">No Result Found</h3>
                      @endif
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              <div class="card-footer clearfix">
                <a href="{{url('admin/orders-list')}}" class="btn btn-danger"><i class="fas fa-arrow-alt-circle-left"></i> Back to Orders List</a>
              </div>
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