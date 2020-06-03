@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Orders List ({{$data->total()}})</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Orders List</li>
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
                <h3 class="card-title">Orders</h3>
                 @if( $data->total() !=  0 ) 
                <div class="card-tools">
                  <form role="search" autocomplete="off" action="{{ url('admin/orders-list') }}" method="get">
                  <div class="input-group input-group-sm" style="width: 250px;">
                    <input type="text" name="q" class="form-control float-right" placeholder="Search customer name or email" value="{{ Request::get('q') }}">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form><!-- form -->
                </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#ID</th>
                      <th>Business User</th>
                      <th>Customer Name</th>
                      <th>Customer Email</th>
                      <th>Paid Amount</th>
                      <th>Gift Amount</th>
                      <th>Used Amount</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if( $data->total() !=  0 && $data->count() != 0 )
                     @foreach( $data as $order )
                      <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->customer_full_name }}</td>
                        <td>{{ $order->customer_email }}</td>
                        <td>${{ $order->amount }}</td>
                        <td>${{ $order->balance }}</td>
                        <td>${{ $order->used_amount }}</td>
                        <td>{{$order->created_at}}</td>
                        <?php 
                          if( $order->status == '1' ) {
                              $mode    = 'success';
                              $_status = "PAID";
                            }else{
                              $mode = 'danger';
                              $_status = "UNPAID";
                            }     
                        ?> 
                        <td><span class="badge bg-{{$mode}}">{{ $_status }}</span></td>


                        <td>
                          <a href="{{url('admin/order-detail/'.$order->id)}}" class="btn btn-info btn-xs padding-btn"> <i class="nav-icon fas fa-eye"></i> View</a>
                          <a href="{{url('admin/order-transactions/'.$order->id)}}" class="btn btn-warning btn-xs padding-btn"> <i class="nav-icon fas fa-eye"></i> Redeem Transactions</a>
                        </td>
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
                {{ $data->appends(['q' => $query])->links() }}
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