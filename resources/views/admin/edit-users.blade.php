@extends('layouts.admin')

@section('content')

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Edit User</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Edit User</li>
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
      <div class="col-md-9">
        <!-- general form elements -->
        <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">User Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="adminProfileFrm" method="POST" action="{{ url('/admin/users-list/update') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{$users->id}}">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Name</label>
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$users->name}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$users->email}}">
              </div>
              <h5 class="mt-4 mb-2">Business Information</h5>
              <hr>
              <div class="form-group">
                <label for="exampleInputEmail1">Business Name</label>
                <input type="text" class="form-control" name="business_name" placeholder="Enter Business Name" value="{{$users->business_name}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter Address" value="{{$users->address}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Phone Number</label>
                <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" value="{{$users->phone_number}}">
              </div>
              <div class="form-group">
                <label>Business Industry</label>
                <select class="custom-select" name="business_industry">
                  <option value="">Please Select</option>
                  @foreach($Industries as $industry)
                  <option @if( $industry['id'] == $users->industry_id) selected="selected" @endif value="{{ $industry['id'] }}">{{ $industry['industry'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label>Type of Business</label>
                <select class="custom-select" name="business_type">
                  <option value="">Please Select</option>
                  @foreach($Types as $type)
                  <option @if( $type['id'] == $users->type_id) selected="selected" @endif value="{{ $type['id'] }}">{{ $type['type'] }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Business Email</label>
                <input type="text" class="form-control" name="business_email" placeholder="Enter Business Email" value="{{$users->business_email}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Website Url</label>
                <input type="text" class="form-control" name="url" placeholder="Enter Website Url" value="{{$users->url}}">
              </div>
              <h5 class="mt-4 mb-2">Account Information</h5>
              <hr>
              
              <div class="form-group">
                <label for="exampleInputEmail1">Tax Id Number</label>
                <input type="text" class="form-control" name="tax_id_number" placeholder="Enter tax id number" value="{{$users->tax_id_number}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Customer user will charge (%)</label>
                <input type="number" class="form-control" id="customer_charge" name="customer_charge" placeholder="Enter charge" value="{{$users->customer_charge}}">
              </div>
              <div class="form-group">
                <label for="exampleInputEmail1">Business user will charge (%)</label>
                <input type="number" class="form-control" id="business_charge" name="business_charge" placeholder="Enter charge" value="{{$users->business_charge}}">
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="custom-select" name="status">
                  <option @if( $users->status == '1' ) selected="selected" @endif value="1">ACTIVE</option>
                  <option @if( $users->status == '0' ) selected="selected" @endif value="0">INACTIVE</option>
                </select>
              </div>

              <div class="form-group">
                <label>Approval</label>
                <select class="custom-select" name="is_verify">
                  <option @if( $users->is_verify == '1' ) selected="selected" @endif value="1">VERIFIED</option>
                  <option @if( $users->is_verify == '0' ) selected="selected" @endif value="0">UNVERIFIED</option>
                </select>
              </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary adminProfileFrmbtn">Submit</button>
            </div>
          </form>
        </div>
        <!-- /.card -->
      </div>
      <div class="col-md-3">
        <div class="form-group block-block text-center">
            <img class="profile-user-img img-fluid img-circle" src="{{ asset('public/avatar/'.$users->avatar) }}" alt="User profile picture">
        </div>
        <!-- <a href="http://localhost/gostock/sameer" target="_blank" class="btn btn-lg btn-success btn-block margin-bottom-10">View <i class="fa fa-external-link-square"></i> </a> -->
        <ol class="list-group">
          <li class="list-group-item"> Registered: <span class="pull-right color-strong">{{$users->created_at}}</span></li>
          <li class="list-group-item"> Total Orders: <strong class="pull-right color-strong"> 0 </strong></li>
        </ol>
        <br>
        <!-- <div class="block-block text-center">
          <form method="POST" action="http://localhost/gostock/panel/admin/members/2" accept-charset="UTF-8" class="displayInline"><input name="_method" type="hidden" value="DELETE"><input name="_token" type="hidden" value="lRQPeyuuZBX8JnHWnSYaZO5MxSDBJsYE6zPfDlw0">
            <input data-url="2" class="btn btn-lg btn-danger btn-block margin-bottom-10 actionDelete" type="submit" value="Delete">
          </form>
        </div> -->
        <br>
        <br>
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