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
                    <form role="form" method="POST" action="{{ url('/comments/store') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="comments_posts_id" value="{{ $comments_posts_id }}">

                        <div class="box-body">
                            <div class="form-group">
                                <label for="comments_title">Title</label>
                                <input type="text" class="form-control" name="comments_title" id="comments_title" required>
                            </div>                
                        </div>

                        <div class="box-body">
                            <div class="form-group">
                                <label for="comments_body">Details</label>
                                <textarea name="comments_body" id="comments_body" required style="width: 100%; height: 100px;"></textarea>
                            </div>                
                        </div>      

                        <div class="box-body">
                            <div class="form-group">
                                <label for="comments_picture">Picture</label>
                                <input type="file" class="form-control" name="comments_picture" id="comments_picture"  >
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