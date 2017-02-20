@extends('layouts.dashboard')
@section('content')

<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <!-- Main content -->
    <section class="content">
      
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
        @if (session('error'))
        <div class="alert alert-danger"  id="error">
            <strong><i class="fa fa-warning"></i> {{ session('error') }}</strong>
        </div>
        @endif
        @if (session('success'))
        <div class="alert alert-success"  id="success">
            <strong><i class="fa fa-check"></i> {{ session('success') }}</strong>
        </div>
        @endif
          <!-- general form elements -->
          <div class="box box-primary">
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" method="POST" action="{{ url('/topics/store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="topics_name">Topic Name</label>
                    <input type="text" class="form-control" name="topics_name" id="topics_name" placeholder="Enter Topic Name">
                </div>                
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-check"></span> Submit</button>
              </div>
            </form>
          </div>
          <!-- /.box -->

        </div>
        <!--/.col (left) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection