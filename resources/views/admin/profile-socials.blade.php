@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Social Profiles Links</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Social Profiles</li>
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
    <div class="row">
      <!-- left column -->
      <div class="col-md-8">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Social Profiles Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="adminChangeSocialFrm" method="POST" action="{{ url('/admin/profile-socials/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Faceebook</label>
                <input type="text" class="form-control" id="facebook" name="facebook"  value="{{$settings->facebook}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Twitter</label>
                <input type="text" class="form-control" id="twitter" name="twitter"  value="{{$settings->twitter}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Linkedin</label>
                <input type="text" class="form-control" id="linkedin" name="linkedin"  value="{{$settings->linkedin}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Instagram</label>
                <input type="text" class="form-control" id="instagram" name="instagram" value="{{$settings->instagram}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Youtube</label>
                <input type="text" class="form-control" id="youtube" name="youtube" value="{{$settings->youtube}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Pinterest</label>
                <input type="text" class="form-control" id="pinterest" name="pinterest" value="{{$settings->pinterest}}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-success adminChangeSocialFrmbtn">Save</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <!--/.col (left) -->
      <!-- right column -->
      
      <!--/.col (right) -->
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection

<!-- @section('javascript') 
<script type="text/javascript">
  //Add order form    
    $(".adminChangeSocialFrmbtn").click(function(e){
        $('#adminChangeSocialFrm').validate({ // initialize the plugin
            rules: {
                facebook: {
                    required: true
                },
                twitter: {
                    required: true
                },
                linkedin: {
                    required: true
                },
                instagram: {
                    required: true
                },
                youtube: {
                    required: true
                }
            }
        });
    });
</script>
@endsection -->