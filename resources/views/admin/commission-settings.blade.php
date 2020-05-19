@extends('layouts.admin')

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Commission Settings</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
          <li class="breadcrumb-item active">Commission Settings</li>
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
            <h3 class="card-title">Settings Details</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" id="adminChangeChargeFrm" method="POST" action="{{ url('/admin/commission-settings/update') }}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <div class="form-group">
                <label for="exampleInputEmail1">Customer user will charge (%)</label>
                <input type="number" class="form-control" id="customer_charge" name="customer_charge" placeholder="Enter charge" value="{{$settings->customer_charge}}">
              </div>
              <div class="form-group">
                <label for="exampleInputPassword1">Business user will charge (%)</label>
                <input type="number" class="form-control" id="business_charge" name="business_charge" placeholder="Enter charge" value="{{$settings->business_charge}}">
              </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
              <button type="submit" class="btn btn-success adminChangeChargeFrmbtn">Update</button>
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

@section('javascript') 
<script type="text/javascript">
  //Add order form    
    $(".adminChangeChargeFrmbtn").click(function(e){
        $('#adminChangeChargeFrm').validate({ // initialize the plugin
            rules: {
                customer_charge: {
                    required: true
                },
                business_charge: {
                    required: true
                }
            }
        });
    });
</script>
@endsection