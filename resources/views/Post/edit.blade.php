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
            <form role="form" method="POST" action="{{ url('/posts/update') }}" enctype="multipart/form-data">
              {{ csrf_field() }}
              <input type="hidden" name="posts_track_id" value="{{ $posts_track_id }}">

              <div class="box-body">
                <div class="form-group">
                  <label for="topics_track_id">Topic Name</label>
                  <select class="form-control" name="topics_track_id" style="width: 100%;" required>
                    <option value=""> -- </option>
                    @if(!empty($topicList)) 
                    @foreach($topicList as $topic)    
                    <option value="{{ $topic->topics_track_id }}"@if($topic->topics_track_id == $dataList->topics_track_id) selected="selected" @endif>{{ $topic->topics_name }} </option> 
                    @endforeach
                    @endif
                  </select>
                </div>
                
              </div>

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_title">Title</label>
                    <input type="text" class="form-control" name="posts_title" id="posts_title" value="{{ $dataList->posts_title }}" required>
                </div>                
              </div>

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_body">Details</label>
                    <textarea name="posts_body" id="posts_body" required style="width: 100%; height: 100px;">{!!  $dataList->posts_body  !!}</textarea>
                </div>                
              </div>      

              <div class="box-body">
                <div class="form-group">
                  <label for="posts_picture">Picture</label>
                    <input type="file" class="form-control" name="posts_picture" id="posts_picture"  >
                </div>    
                <div>
                    @if($dataList->posts_picture != '')
                    <img id="destinationThumb" style="height: 100px;width: 100px;margin-top: 15px;" class="thumbnail img-responsive" src="{{ asset('upload/posts_picture/'.$dataList->posts_picture ) }}"/>
                    @else
                    <br><span class="label label-danger">No image provided</span><br>
                    @endif
                </div>            
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" class="btn btn-primary"><span class="fa fa-edit"></span> Update</button>
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