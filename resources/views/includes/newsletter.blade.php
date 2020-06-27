<div class="col-lg-3">
   <div class="footer-col">
      <h3 class="footer-title">Newsletter</h3>
      <p>Connect below for our latest updates and offers</p>
      <form method="POST" id="newsletterFrm" action="{{ url('/user/newsletter-email') }}" enctype="multipart/form-data">
         @csrf
         <div class="form-group mb-3">
            <div class="custom-file" style="min-height: 46px;">
               <input type="text" class="form-control" placeholder="Enter Email Address" id="email" name="email" style="padding-right: 45px">
               <div class="input-group-prepend">
                  <button class="input-group-text send-btn" type="submit"><span class="icon-paper-plane"></span></button>
               </div>
            </div>
         </div>
      </form>
   </div>
</div>

@section('javascript')
@if (Session::has('newsSuccess'))
<script type="text/javascript">
   Swal.fire({
    icon: 'success',
    title: "Success",
    text: "{{ Session::get('newsSuccess') }}",
    showConfirmButton: false,
    timer: 2000
  });
</script>
@endif

@endsection   