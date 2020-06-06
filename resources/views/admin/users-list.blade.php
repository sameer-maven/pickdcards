@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Business Users List ({{$data->total()}})</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Users List</li>
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
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Business Users</h3>
                 @if( $data->total() !=  0 ) 
                <div class="card-tools">
                  <form role="search" autocomplete="off" action="{{ url('admin/users-list') }}" method="get">
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
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Approval</th>
                      <th>Stripe Connect</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @if( $data->total() !=  0 && $data->count() != 0 )
                     @foreach( $data as $user )
                      <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at }}</td>
                        <?php 
                          if( $user->status == '1' ) {
                              $mode    = 'success';
                              $_status = "ACTIVE";
                            }else{
                              $mode = 'danger';
                              $_status = "INACTIVE";
                            }     
                        ?> 
                        <td><span class="badge bg-{{$mode}}">{{ $_status }}</span></td>

                        <?php 
                          if( $user->is_verify == '1' ) {
                              $mode    = 'success';
                              $_status = "VERIFIED";
                              $_stripe = "CONNECTED";
                            }else{
                              $mode = 'danger';
                              $_status = "UNVERIFIED";
                              $_stripe = "NOT CONNECTED";
                            }     
                        ?> 
                        <td><span class="badge bg-{{$mode}}">{{ $_status }}</span></td>
                        <td><span class="badge bg-{{$mode}}">{{ $_stripe }}</span></td>

                        <td>
                          @if( $user->id <> Auth::user()->id && $user->is_admin <> 1 )
                          <a href="{{url('admin/users-list/edit/'.$user->id)}}" class="btn btn-success btn-xs padding-btn"> <i class="nav-icon fas fa-edit"></i> Edit</a>
                          <a href="javascript:void(0);" data-uid="{{$user->id}}" data-url="{{url('admin/users-list/delete/'.$user->id)}}" class="btn btn-danger btn-xs padding-btn deleteUser"> <i class="nav-icon fas fa-trash-alt"></i> Delete</a>
                          @else
                            (Admin User)
                          @endif
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