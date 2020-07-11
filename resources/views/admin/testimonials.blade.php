@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Testimonials ({{$data->total()}})</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Testimonials List</li>
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
        <!-- /.row -->
        <div class="row">
          <div class="col-sm-4">
            
          </div>
          <div class="col-sm-4"></div>
          <div class="col-sm-4">
            <a href="{{url('admin/testimonials/create')}}" class="btn btn-success btn-sm padding-btn" style="float:right;margin-bottom: 10px"> <i class="nav-icon fas fa-plus"></i> Add Testimonial</a>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Testimonials</h3>
                 @if( $data->total() !=  0 ) 
                <div class="card-tools">
                  <form role="search" autocomplete="off" action="{{ url('admin/testimonials') }}" method="get">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="q" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                  </form><!-- form -->
                </div>
                @endif
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Title</th>
                      <th>Company Name</th>
                      <th>Pic</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if( $data->total() !=  0 && $data->count() != 0 )
                     @foreach( $data as $testimonial )
                      <tr>
                        <td>{{ $testimonial->id }}</td>
                        <td>{{ $testimonial->title }}</td>
                        <td>{{ $testimonial->company_name }}</td>
                        <td><div class="form-group"><img class="profile-user-img img-fluid img-circle" src="{{ asset('public/testimonials/'.$testimonial->photo) }}" alt="User profile picture"></div></td>
                        <td>
                          <a href="{{ route('testimonials.edit', $testimonial->id) }}" class="btn btn-success btn-xs padding-btn"> <i class="nav-icon fas fa-edit"></i> Edit</a>
                          <a href="javascript:void(0);" data-uid="{{$testimonial->id}}" data-url="{{url('admin/testimonials/delete/'.$testimonial->id)}}" class="btn btn-danger btn-xs padding-btn deleteUser"> <i class="nav-icon fas fa-trash-alt"></i> Delete</a>
                        </td>
                      </tr>
                      @endforeach
                      @else
                      <hr />
                      <h3 class="text-center no-found">No Result Found</h3>
                    @endif
                    
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
              <div class="card-footer clearfix">
                {{ $data->appends(['q' => $query])->links() }}
              </div>
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content -->
@endsection