@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Orders</li>
  </ol>
</div>
</nav>
<!-- order-detail -->

<div class="order-detail-sec">
<div class="container">
<div class="result-heading-top d-flex flex-wrap align-items-center justify-content-between mb-4">
            <h4 class="result-title mb-0">Orders ({{$data->total()}})</h4>
            @if( $data->total() !=  0 )
            <div class="search-detail-col col-lg-6">
               <form role="search" autocomplete="off" action="{{ url('user/orders') }}" method="get">
                  <div class="row">
                     <div class="col-lg-6 mb-3 mb-lg-0">
                        <div class="form-group mb-0">
                           <label class="cstm-label search-label d-block">
                              <input type="text" name="datefilter" class="date-select form-control" placeholder="Date" value="" />
                                 <span class="icon-calendar label-icon"></span>
                           </label>
                        </div>
                     </div>
                     <div class="col-lg-6 mb-3 mb-lg-0">
                        <div class="form-group mb-0">
                           <label class="cstm-label search-label d-block">
                              <input type="text" name="q" class="form-control" placeholder="Customer or Recipent Name"  value="{{Request::get('q')}}" />
                              <span class="icon-search label-icon"></span>
                           </label>
                           <button type="submit" style="display: none;">Save Changes</button> 
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            @endif
         </div>
         <div class="order-detail">
            <div class="table-responsive">
               @if( $data->total() !=  0 && $data->count() != 0 )
               <table class="table order-detail-table cstm-table">
                  <thead>
                     <tr>
                        <th>Order No</th>
                        <th>Customer</th>
                        <th>Recipent</th>
                        <th>Gift Card Amount</th>
                        <th>Remaining Amount</th>
                        <th>Date</th>
                        <th>View</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                        @foreach( $data as $order )
                        <tr>
                           <td style="width: 10%;">#{{$order->id}}</td>
                           <td style="width: 15%;">{{$order->customer_full_name}}</td>
                           <td style="width: 15%;">{{$order->recipient_name}}</td>
                           <td style="width: 16%;text-align: center;">$<?php echo round($order->balance,2) ?></td>
                           <td style="width: 17%;text-align: center;">$<?php echo round($order->balance-$order->used_amount,2) ?></td>
                           <?php
                              $createDate = new DateTime($order->created_at);
                              $createDate = $createDate->format('Y-m-d'); 
                           ?>
                           <td style="width: 12%;">{{$createDate}}</td>
                           <td style="width: 20%;"><a href="{{url('user/order-detail/'.$order->id)}}" class="btn pickd-btn btn-3">Details</a></td>
                        </tr>
                        @endforeach
                     
                  </tbody>
               </table>
               @else
                  <hr />
                  <h3 class="text-center no-found">No Result Found</h3>
               @endif
            </div>
            <nav aria-label="Page navigation cstm-navigation">
               {{ $data->appends(['q' => $query])->links() }}
            </nav>
         </div>
         <br>
         <br>
   </div>
</div>
@endsection

@section('javascript') 
<script type="text/javascript">
   $(document).ready(function(){
      $('.pagination').addClass("justify-content-center mt-4 mb-5");
   });
</script>
@endsection
