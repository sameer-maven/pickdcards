@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ url('user') }}">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">Manage Businesses</li>
  </ol>
</div>
</nav>
<!-- order-detail -->

<div class="order-detail-sec">
<div class="container">
@if (Session::has('notification'))
   <div class="alert alert-success btn-sm alert-fonts" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      {{ Session::get('notification') }}
   </div>
@endif

<?php if($data2['stripeNotConnected']->count() > 0){?>
<div class="alert alert-danger btn-sm alert-fonts" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  @foreach( $data2['stripeNotConnected'] as $buss )
    *For <b>{{$buss->business_name}}</b>, you are almost ready to start offering gift cards. Please <a href="https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write&state=<?php echo base64_encode($buss->id); ?>">click here</a> to connect a Stripe account. <br>
  @endforeach
</div>
<?php } ?>
<div class="result-heading-top d-flex flex-wrap align-items-center justify-content-between mb-4">
            <h4 class="result-title mb-0">Businesses ({{$data->total()}})</h4>
            @if( $data->total() !=  0 )
            <div class="search-detail-col col-lg-6">
               <form role="search" autocomplete="off" action="{{ url('user/businesses') }}" method="get">
                  <div class="row">
                     <div class="col-lg-6 mb-3 mb-lg-0">
                        <a href="{{url('user/add-business')}}" style="background: #86c959;float: right;margin-top: 8px;border-radius:5px;" class="btn pickd-btn btn-3">Add Business</a>
                     </div>
                     <div class="col-lg-6 mb-3 mb-lg-0">
                        <div class="form-group mb-0">
                           <label class="cstm-label search-label d-block">
                              <input type="text" name="q" class="form-control" placeholder="Business Name"  value="{{Request::get('q')}}" />
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
                        <!-- <th>No</th> -->
                        <th>Business Name</th>
                        <th>Address</th>
                        <th>Status</th>
                        <th>Approval</th>
                        <th>Stripe</th>
                        <th>View</th>
                     </tr>
                  </thead>
                  <tbody>
                     
                        @foreach( $data as $business )
                        <tr>
                           <!-- <td style="width: 10%;">#{{$business->id}}</td> -->
                           <td style="width: 25%;">{{$business->business_name}}</td>
                           <td style="width: 50%;"><?php echo $business->address.", ".$business->city.", ".$business->state.", ".$business->pincode; ?></td>
                           <?php 
                             if( $business->status == '1' ) {
                                 $mode    = 'success';
                                 $_status = "ACTIVE";
                               }else{
                                 $mode = 'danger';
                                 $_status = "INACTIVE";
                               }     
                           ?>
                           <td><span class="badge bg-{{$mode}}" style="color: white !important;">{{ $_status }}</span></td>
                           <?php 
                           if( $business->is_verify == '1' ) {
                              $mode    = 'success';
                              $_status = "VERIFIED";
                            }else{
                              $mode = 'danger';
                              $_status = "UNVERIFIED";
                            }     
                           ?> 
                           <td><span class="badge bg-{{$mode}}" style="color: white !important;">{{ $_status }}</span></td>
                           <?php 
                           if( $business->connected_stripe_account_id != '' && $business->connected_stripe_account_id != NULL ) {
                              $mode    = 'success';
                              $_status = "CONNECTED";
                            }else{
                              $mode = 'danger';
                              $_status = "NOT CONNECTED";
                            }     
                           ?> 
                           <td><span class="badge bg-{{$mode}}" style="color: white !important;">{{ $_status }}</span></td>
                           <td style="width: 20%;"><a href="{{url('user/edit-business/'.$business->id)}}" class="btn pickd-btn btn-3">Details</a></td>
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
