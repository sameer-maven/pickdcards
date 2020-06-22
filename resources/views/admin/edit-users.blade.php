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
                <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{$users->name}}" readonly>
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email" value="{{$users->email}}" readonly>
              </div>
              <div class="form-group">
                <label>Status</label>
                <select class="custom-select" name="status">
                  <option @if( $users->status == '1' ) selected="selected" @endif value="1">ACTIVE</option>
                  <option @if( $users->status == '0' ) selected="selected" @endif value="0">INACTIVE</option>
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