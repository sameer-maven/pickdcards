@extends('layouts.app')

@section('content')
<style type="text/css">
  a{
    text-decoration: none;
  }
   a:hover{
    text-decoration: none;
  }
   .card-new {
   background: #fff;
   min-height: 152px;
   padding: 2rem 1.5rem;
   display: flex;
   align-items: center;
   justify-content: space-between;
   box-shadow: 0px 0px 8px 2px #dedede;
   /*height: 100%;*/
   /* margin-right: 15px; */
   margin-bottom: 30px;
   }
   .card-header-new {
   font-size: 30px;
   font-weight: 600;
   color: #2f3b49;
   }
   .dash-icon-wrap {
   background: #59455f;
   width: 95px;
   height: 95px;
   border-radius: 50%;
   display: flex;
   justify-content: center;
   align-items: center;
   font-size: 40px;
   color: #fff;
   }
   span.title-lite {
    font-size: 20px;
    display: block;
    font-weight: 400;
}
</style>
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
      <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item"><a href="{{url('/user')}}">Home</a></li>
         <li class="breadcrumb-item active"><a href="javascript:void(0);">Dashboard</a></li>
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
      @if($user->is_verify==0 && $user->connected_stripe_account_id=="")
      <div class="alert alert-danger btn-sm alert-fonts" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        Your account is unverified, Please connect your stripe account to verify. Please visit the <a href="https://dashboard.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write">link</a>.
      </div>
      @endif
      <div class="columns-wrap">
         <div class="row">
            <div class="col-sm-6 col-lg-4">
               <a href="{{url('/user/manage-profile')}}">
                  <div class="card-new card-1">
                     <div class="card-header-new">
                        <span class="title-lite">Manage Profile</span>
                     </div>
                     <div class="card-body-new">
                        <div class="dash-icon-wrap icon-1">
                           <span class="icon-add-user"></span>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-sm-6 col-lg-4">
               <a href="{{url('/user/orders')}}">
                  <div class="card-new card-1">
                     <div class="card-header-new">
                        {{$ordersCount}}
                        <span class="title-lite">Total Orders</span>
                     </div>
                     <div class="card-body-new">
                        <div class="dash-icon-wrap icon-1">
                           <span class="icon-shopping-bag"></span>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <div class="col-sm-6 col-lg-4">
               <a href="{{url('/user/orders')}}">
                  <div class="card-new card-1">
                     <div class="card-header-new">
                        {{$todayOrdersCount}}
                        <span class="title-lite">Today's Orders</span>
                     </div>
                     <div class="card-body-new">
                        <div class="dash-icon-wrap icon-1">
                           <span class="icon-calendar1"></span>
                        </div>
                     </div>
                  </div>
               </a>
            </div>
            <!-- <div class="col-sm-6 col-lg-4">
               <a href="javascript:(void)">
                  <div class="card-new card-1">
                     <div class="card-header-new">
                        35
                        <span class="title-lite">Total</span>
                     </div>
                     <div class="card-body-new">
                        <div class="dash-icon-wrap icon-1">
                           <span class="icon-box"></span>
                        </div>
                     </div>
                  </div>
               </a>
            </div> -->
         </div>
      </div>
   </div>
</div>
@endsection
