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
            <form role="form" method="POST" action="{{ url('/posts/store') }}" enctype="multipart/form-data">
              {{ csrf_field() }}

              <div class="box-body">
                <div class="form-group">
                  <label for="topics_track_id">Topic Name</label>
                  <select class="form-control" name="topics_track_id" style="width: 100%;" required>
                    <option value=""> -- </option>
                    @if(!empty($topicList)) 
                    @foreach($topicList as $topic)    
                    <option value="{{ $topic->topics_track_id }}">{{ $topic->topics_name }} </option> 
                    @endforeach
                    @endif
                  </select>
                </div>
                
              </div>

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_title">Title</label>
                    <input type="text" class="form-control" name="posts_title" id="posts_title" required>
                </div>                
              </div>

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_body">Details</label>
                    <textarea name="posts_body" id="posts_body" required style="width: 100%; height: 100px;"></textarea>
                </div>                
              </div>      

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_picture">Picture</label>
                    <input type="file" class="form-control" name="posts_picture" id="posts_picture"  >
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