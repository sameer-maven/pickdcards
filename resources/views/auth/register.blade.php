<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="shortcut icon" type="image/png" href="{{ asset('public/front/assets/images/Favicon.png') }}" />
  <!-- CSS -->
  <link rel="stylesheet" href="{{ asset('public/front/assets/css/style.min.css') }}">
  <link rel="stylesheet" href="{{ asset('public/front/assets/css/custom-style.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.12/dist/sweetalert2.min.css">
  <title>Pickd Cards</title>
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
           <div class="navbar-collapse collapse justify-content-end navbar-wrap" id="navbarCollapse" style="">
              <ul class="navbar-nav">
                 <li class="nav-item active">
                    <a class="nav-link" href="{{ url('/') }}">
                       Home <!-- <span class="sr-only">(current)</span> -->
                    </a>
                 </li>
                <li class="nav-item">
                  <a class="nav-link" href="{{ url('/search') }}">Buy a Gift Card</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="{{ url('page/about-us') }}">About Us</a>
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
<div class="bg-contact overlay-2" style="background-image: url({{ asset('public/front/assets/images/sign-in-bg.jpg') }});">
   <div class="container-contact">
      <div class="wrap-contact">
         <h2 class="contact-title">Create a Pickd Cards Account</h2>
         <p class="contact-subtitle">Create an account to setup and manage your small business profile.</p>
         <form class="mt-4" id="reg-form" method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
               <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}" required autocomplete="name" autofocus>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
               <input id="email" type="email" placeholder="{{ __('E-Mail Address') }}" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
               <input id="password" type="password" placeholder="{{ __('Password') }}" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="new-password">
               <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="showPass();"></span>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group">
               <input id="password-confirm" type="password" placeholder="{{ __('Confirm Password') }}" class="form-control" name="password_confirmation" id="password_confirmation" required autocomplete="new-password">
               <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password" onclick="showConPass();"></span>
               @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
               <p class="sign-small-txt mt-3">8 characters, 1 upper case, 1 lowercase and 1 number</p>
            </div>
            <div class="form-group">
               <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck1" value="yes" name="agree_terms">
                 <p class="sign-small-txt"><label class="form-check-label" for="gridCheck1">I confirm that I have read, consent and agree to Pickd LLC’s <a href="{{ url('/page/terms-of-use-business') }}" class="txt-green">Terms of Use</a> and <a href="{{ url('/page/privacy-policy-business') }}" class="txt-green">Privacy Policy</a></label></p>
               </div>
            </div>
            <div class="form-group">
               <div class="form-check">
                 <input class="form-check-input" type="checkbox" id="gridCheck2" value="yes" name="agree_terms2">
                 <p class="sign-small-txt"><label class="form-check-label" for="gridCheck1">I confirm that I have read, consent and agree to Pickd LLC’s <a href="{{ url('/page/terms-of-sale-business') }}" class="txt-green">Terms of Sale</a></label></p>
               </div>
            </div>
            <!-- <div class="form-group">
               <a href="#" class="forgotpass-link">Forgot Password?</a>
            </div> -->
            <button type="submit" class="btn btn-primary signin-btn">Create Account</button>
            <p class="mt-4 text-center sign-small-txt">Already have a Pickd Cards account? <strong><a href="{{ route('login') }}" class="txt-green"> Sign In</a></strong></p>
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
                  <li><a href="{{ url('page/contact-us') }}">Contact Us</a></li>
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="footer-col">
               <h3 class="footer-title">Support</h3>
               <ul class="footer-list list-unstyled">
                  <li><a href="{{ url('page/contact-us') }}">support@pickdcards.com</a></li>
                  <li><span id="siteseal"><script async type="text/javascript" src="https://seal.godaddy.com/getSeal?sealID=kgHwdN6X4oCHNXxZxVSaQBL2o5Ffp4MitktIxjJgqQ6XyQSqSPBsAbIkPSJR"></script></span></li>
                  <!-- <li><a href="JavaScript:(void)">media@pickdcars.com</a></li>
                  <li><a href="JavaScript:(void)">partnerships@pickdcars.com</a></li> -->
               </ul>
            </div>
         </div>
         <div class="col-lg-3">
            <div class="footer-col">
               <h3 class="footer-title">Newsletter</h3>
               <p>Connect below for our latest updates and offers</p>
               <form class="">
                  <div class="form-group mb-3">
                     <div class="custom-file" style="min-height: 46px;">
                        <input type="text" class="form-control" placeholder="Enter Email Address" id="" style="padding-right: 45px">
                        <div class="input-group-prepend">
                           <button class="input-group-text send-btn" type="submit"><span class="icon-paper-plane"></span></button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
         </div>
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
        $(".signin-btn").click(function(e){

            $.validator.addMethod("pwcheck", function (value) {

                return /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/.test(value)
            });

            $('#reg-form').validate({ // initialize the plugin
                rules: {
                    name: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength : 8,
                        pwcheck :true
                    },
                    password_confirmation: {
                        required: true,
                        minlength : 8,
                        equalTo : "#password"
                    },
                    agree_terms: {
                        required: true
                    },
                    agree_terms2: {
                        required: true
                    }
                },
                messages: {
                    name: {
                        required: "Please enter name"
                    },
                    email: {
                        required: "Please enter email Id"
                    },
                    password: {
                        required: "Please enter a valid password.",
                        // minlength :"Password must be contains atleast 8 Letters, 1 upper case, 1 special character & 1 number",
                        pwcheck :"Password must be contains atleast 8 Letters, 1 upper case & 1 number"
                    },
                    password_confirmation: {
                        required: "Please enter a valid password.",
                        equalTo: "Passwords do not match"
                    },
                    agree_terms: {
                        required: "You must agree Terms & Conditions."
                    },
                    agree_terms2: {
                        required: "You must agree Terms & Conditions."
                    }
                }
            });
        });
    });

    function showPass() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }

    function showConPass() {
      var x = document.getElementById("password-confirm");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
</script>
</body>
</html>
