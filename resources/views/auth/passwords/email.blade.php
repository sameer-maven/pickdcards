<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="http://www.pickdcards.com/public/front/assets/images/Favicon.png" />
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('public/front/assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/front/assets/css/custom-style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
  <title>{{ config('app.name', 'Pickd Cards') }}</title>
</head>
<body>
  <!-- header -->
  <header>
     <nav id="mainNav" class="navbar navbar-expand-xl cstm-navbar">
        <div class="container">
           <a class="navbar-brand" href="{{ url('/') }}"><img src="{{ asset('public/front/assets/images/logo.svg') }}" class="img-fluid"></a>
           <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
           <span class="navbar-toggler-icon"></span>
           </button>
           <div class="navbar-collapse collapse navbar-wrap align-items-center" id="navbarCollapse" style="">
              <ul class="navbar-nav flex-grow-1 justify-content-center">
                 <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">
                       Home <!-- <span class="sr-only">(current)</span> -->
                    </a>
                 </li>
                 <li class="nav-item active">
                    <a class="nav-link" href="{{ url('page/about-us') }}">About Us</a>
                  </li>
                 <li class="nav-item">
                    <a class="nav-link" href="{{ url('/search') }}">Buy a Gift Card</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('page/how-it-works') }}">How it Works </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('page/faq') }}">FAQs</a>
                </li>
                <!-- <li class="nav-item">
                  <a class="nav-link" href="{{ url('page/legal') }}">Legal</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('page/contact-us') }}">Contact Us</a>
                </li>
                  
              </ul>
              <ul class="navbar-nav nav-btn-wrap">
              @guest
                  @if (Route::has('register'))
                  <li class="nav-item px-2">
                    <a class="nav-link nav-btn" href="{{ route('register') }}">{{ __('Register') }}</a>
                  </li>
                  @endif
                  <li class="nav-item px-2">
                    <a class="nav-link nav-btn" href="{{ route('login') }}">{{ __('Login') }}</a>
                  </li>
                @else
                  <li class="nav-item px-2">
                    <a class="nav-link nav-btn" href="{{ url('/') }}">{{ Auth::user()->name }}</a>
                  </li>
                  <li class="nav-item px-2">
                    <a class="nav-link nav-btn" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                  </form>
                  </li>
                @endguest
              
              </ul>
           </div>
        </div>
     </nav>
  </header>
  <!-- header -->
<!-- sign-in -->
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
      <div class="wrap-contact">
         <h2 class="contact-title">{{ __('Reset Password') }}</h2>
         <p class="contact-subtitle">Please add your registered email id for to get password reset link.</p>
         @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif
        <form class="mt-4" method="POST" action="{{ route('password.email') }}" id="reset-form">
            @csrf
            <div class="form-group">
               <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <button type="submit" class="btn btn-primary reset-btn">{{ __('Send Password Reset Link') }}</button>
         </form>
      </div>
   </div>
</div>
<!-- footer-main -->
<footer class="footer-main pt-5">
   <div class="container">
      <div class="row">
         <div class="col-lg-3">
            <div class="footer-col">
               <h3 class="footer-title">About Us</h3>
               <p>Pickd Cards is a platform dedicated to assisting small businesses. Our team is passionate about helping small businesses thrive.</p>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="footer-col">
               <h3 class="footer-title">Important</h3>
               <ul class="footer-list list-unstyled">
                  <li><a href="{{ url('/') }}">Home</a></li>
                  <li><a href="{{ url('page/about-us') }}">About Us</a></li>
                  <li><a href="{{ url('page/how-it-works') }}">How it Works</a></li>
                  <li><a href="{{ url('page/faq') }}">FAQs</a></li>
                  <li><a href="{{ url('page/legal') }}">Legal</a></li>
                  <li><a href="{{ url('page/contact-us') }}">Contact US</a></li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="footer-col">
               <h3 class="footer-title">Support</h3>
               <ul class="footer-list list-unstyled">
                  <li><a href="{{ url('page/contact-us') }}">support@pickdcards.com</a></li>
                  <li><span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=kgHwdN6X4oCHNXxZxVSaQBL2o5Ffp4MitktIxjJgqQ6XyQSqSPBsAbIkPSJR"></script></span></li>
                  <!-- <li><a href="JavaScript:(void)">media@pickdcars.com</a></li> -->
                  <!-- <li><a href="JavaScript:(void)">partnerships@pickdcars.com</a></li> -->
               </ul>
            </div>
         </div>
         @include('includes.newsletter')
      </div>
      <div class="footer-btm text-center py-4 mt-4" style="color:#919191;">
         <p class="mb-0">© 2020 Pickd Cards, All Rights Reserved. <a href="{{ url('/page/legal') }}" class="text-white">Terms of Use</a>  &#124;  <a href="{{ url('/page/legal') }}" class="text-white">Privacy Policy</a></p>
      </div>
   </div>
</footer>
<!-- Optional JavaScript -->

<script src="{{ asset('public/front/assets/js/jquery-3.4.1.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.all.min.js"></script>
<script src="{{ asset('public/front/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/app.js') }}"></script>
<script src="{{ asset('public/front/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/daterangepicker.js') }}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script>
    $(document).ready(function(){
        $(".reset-btn").click(function(e){

            $('#reset-form').validate({ // initialize the plugin
                rules: {
                    email: {
                        required: true,
                        email: true
                    }
                },
                messages: {
                    email: {
                        required: "Please enter email Id"
                    }
                }
            });
        });
    });
</script>
@yield('javascript')
</body>
</html>
