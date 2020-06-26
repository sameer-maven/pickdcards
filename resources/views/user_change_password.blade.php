@extends('layouts.app')
@section('content')
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
      <div class="wrap-contact" style="width: 550px;">
         <div class="mb-3">
            <span class="icon-unlock password-icon"></span>
         </div>
         <h2 class="contact-title">Change Password</h2>
         @if (Session::has('notification'))
            <div class="alert alert-success btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                {{ Session::get('notification') }}
            </div>
        @endif
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

        @if (Session::has('incorrect_pass'))
          <div class="alert alert-danger btn-sm alert-fonts" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            {{ Session::get('incorrect_pass') }}   
          </div>
        @endif

     

        
         <form class="mt-4" id="userChangePassFrm" method="POST" action="{{ url('/user/store-change-password') }}">
            @csrf
            <div class="form-group">
               <input type="password" class="form-control" id="old_password" name="old_password" aria-describedby="" placeholder="Enter Current Password*">
            </div>
            <div class="form-group">
               <input type="password" class="form-control" id="password" name="password" aria-describedby="" placeholder="Enter New Password*">
            </div>

            <div class="form-group">
               <input type="password" class="form-control" id="con_password" name="con_password" aria-describedby="" placeholder="Confirm Password*">
            </div>
            <p class="sign-small-txt mt-3"><strong>Password must contain 8 characters (1 lowercase, 1 uppercase, 1 number)</strong></p>
            <button type="submit" class="btn btn-primary signin-btn user-change-password-btn">Apply Changes</button>
            <p class="text-center mt-4"><strong><a href="{{ url('/user') }}" style="color: #919191;font-size: 16px;">Cancel</a></strong></p>
         </form>
      </div>
   </div>
</div>
@endsection
