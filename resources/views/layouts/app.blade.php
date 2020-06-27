<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <a class="navbar-brand mr-0" href="{{ url('/') }}"><img src="{{ asset('public/front/assets/images/logo.svg') }}" class="img-fluid"></a>
    <button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-collapse collapse navbar-wrap align-items-center" id="navbarCollapse" style="">
      <ul class="navbar-nav flex-grow-1 justify-content-center">
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('/') }}">Home <!-- <span class="sr-only">(current)</span> --></a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="{{ url('page/about-us') }}">About Us</a>
        </li>
        <li class="nav-item active">
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
          <li class="dropdown nav-item cstm-dropdown show">
                <a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown" role="button" aria-expanded="true">
                   <img src="{{ asset('public/avatar/'.Auth::user()->avatar) }}" width="44" height="44" alt="Avatar">
                   <span class="user-name">{{ Auth::user()->name }}</span>
                   <span class="angle-down s7-angle-down"></span>
                </a>
             <div class="dropdown-menu" role="menu">
                <?php if(Auth::user()->is_admin=='1'){ ?>
                <a class="dropdown-item" href="{{ url('/admin/dashboard') }}"><span class="icon-account s7-icon"></span>Admin Panel</a>
                <?php }else{?>
                <a class="dropdown-item" href="{{ url('/user') }}"><span class="icon-calendar1 s7-icon"></span>Dashboard</a>
                <a class="dropdown-item" href="{{ url('/user/redeem-order') }}"><span class="icon-shopping-bag s7-icon"></span>Redeem</a>
                <a class="dropdown-item" href="{{ url('/user/orders') }}"><span class="icon-gear s7-icon"></span>Orders</a>
                <a class="dropdown-item" href="{{ url('/user/businesses') }}"><span class="icon-vip-card s7-icon"></span>Business</a>
                <a class="dropdown-item" href="{{ url('/user/manage-profile') }}"><span class="icon-add-user s7-icon"></span>Profile</a>
                <a class="dropdown-item" href="{{ url('/user/change-password') }}"><span class="icon-key s7-icon"></span>Change Password </a>
                <?php } ?>
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();"><span class="icon-account s7-icon"></span>{{ __('Logout') }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
             </div>
          </li>
        @endguest
      </ul>
    </div>
    </div>
  </nav>
</header>
<!-- header -->
@yield('content')

<!-- <div class="contact-info-wrap py-4">
   <div class="container">
      <div class="row">
         <div class="col-lg-6">
            <div class="d-flex flex-wrap align-items-center">
               <a href="JavaScript:(void)" class="btn pickd-btn picked-btn-white">Get Started</a>
               <ul class="social-icons d-flex flex-wrap list-unstyled mb-0">
                  <li><a href="#"><span class="icon-facebook-1"></span></a></li>
                  <li><a href="#"><span class="icon-twitter-black-shape"></span></a></li>
                  <li><a href="#"><span class="icon-linkedin"></span></a></li>
                  <li><a href="#"><span class="icon-instagram"></span></a></li>
                  <li><a href="#"><span class="icon-youtube-1"></span></a></li>
               </ul>
            </div>
         </div> -->
         <!-- <div class="col-lg-6 align-self-center">
            <div class="contact-no text-right">
               <a href="tel:888-986-8263" class="contact-no-link"><span class="icon-call"></span>
               888-986-8263</a>
            </div>
         </div> -->
      <!-- </div>
   </div>
</div> -->
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
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.1.62/jquery.inputmask.bundle.js"></script>
<script src="{{ asset('public/front/assets/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/jquery-migrate-1.2.1.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/slick.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/form-validations.js') }}"></script>
<script src="{{ asset('public/front/assets/js/moment.min.js') }}"></script>
<script src="{{ asset('public/front/assets/js/daterangepicker.js') }}"></script>
<script src="{{ asset('public/front/assets/js/app.js') }}"></script>
<script type="text/javascript">
   $(document).ready(function(){
        $(".send-btn").click(function(e){
            $('#newsletterFrm').validate({ // initialize the plugin
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