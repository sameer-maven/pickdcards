@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="page-breadcrumb">
   <div class="container">
      <ol class="breadcrumb mb-4">
         <li class="breadcrumb-item"><a href="{{url('/user')}}">Home</a></li>
         <li class="breadcrumb-item active"><a href="javascript:void(0);">Dashboard</a></li>
      </ol>
   </div>
</nav>

<!-- consumer-detail -->
<div class="consumer-detail-sec">
   <div class="container">
      @if (Session::has('notification'))
          <div class="alert alert-success btn-sm alert-fonts" role="alert">
          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              {{ Session::get('notification') }}
          </div>
      @endif
      <div class="consumer-detail mb-5">
         <div class="consumer-head">
            User Dashboard 
         </div>
         <br>
         <div class="row">
            <div class="col-lg-12">
               <div class="alert alert-success btn-sm alert-fonts" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  Dashboad Functionality is in progress......
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- consumer-detail -->
@endsection
