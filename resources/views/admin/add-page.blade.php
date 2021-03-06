@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Add Page</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Add Page</li>
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
            <h3 class="card-title">Add Page</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="adminPageFrm" method="POST" action="{{ url('admin/pages') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="">
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Title</label>
                <input type="text" class="form-control" name="title" placeholder="Enter Title" value="">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Slug / URL</label>
                <input type="text" class="form-control" name="slug" placeholder="Enter Slug / URL" value="">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Content</label>
                <textarea class="textarea" rows="10" cols="40" placeholder="Place some text here" name="content"></textarea>
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-primary adminPageFrmbtn">Save</button>
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
