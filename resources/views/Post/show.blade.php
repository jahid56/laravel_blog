@extends('layouts.dashboard')
@section('content')
<section id="blog" class="container">
    <div class="content bg-gray-lighter" style="min-height: 50px;">
        <div class="row items-push">
            <div class="col-sm-7">
                <a href="{{ url('/posts') }}" class="btn btn-default"> <span class="fa fa-hand-o-left"></span>Back</a>
            </div>
        </div>
    </div>

    <div class="blog" style="min-height: 410px;">
        <div class="row">
            <div class="col-md-12">
                <div class="blog-item">
                    <div class="row">      
                        <div class="col-xs-12 col-sm-4 blog-content">
                            @if($dataList->posts_picture != '')
                            <img style="width: 200px;height: 200px;" class="thumbnail img-responsive" src="{{ asset('upload/posts_picture/'.$dataList->posts_picture ) }}"/>
                            @else
                            <span class="label label-danger">No Image Provided</span>
                            @endif
                        </div>

                        <div class="col-xs-12 col-sm-6 blog-content">
                            <h2>Title : {{ $dataList->posts_title }}</h2>
                            <p>Body : {{ $dataList->posts_body }}</p> 
                            <h4>User : {{ $dataList->name }}</h4>
                            @php
                            $created_at = $dataList->created_at;
                            $updated_at = $dataList->updated_at;
                            $createdList = $created_at->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $created_at->format('j M Y , g:ia') : $created_at->diffForHumans();
                            $updatedList = $updated_at->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $updated_at->format('j M Y , g:ia') : $updated_at->diffForHumans();
                            @endphp
                            <p>Created at : {{ $createdList }}</p> 
                            <p>Updated at : {{ $updatedList }}</p> 

                        </div>
                    </div>
                    <div class="block-content">
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
                        <table class="table table-bordered table-striped">
                            <div class="pull-right">
                                <a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
                                <form method="GET" action="{{ url('comments/search/'.$dataList->posts_track_id) }}" class="navbar-form" role="search">
                                    <div class="input-group add-on">
                                        <input class="form-control" placeholder="Search" name="searchText" id="searchText" type="text">
                                        <div class="input-group-btn">
                                            <button class="btn btn-default" type="submit"><span class="fa fa-search"></span></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <thead>
                                <tr>
                                    <th width="20%">Commenters Name</th>
                                    <th width="20%">Comments Title</th>
                                    <th width="10%">Details</th>
                                    <th width="20%">Picture</th>
                                    <th width="10%">Created At</th>
                                    <th width="10%">Updated At</th>
                                    <th width="10%">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (isset($commentList))
                                @foreach ($commentList as $data)
                                <tr>
                                    <td width="20%">{{ $data->name }}</td>
                                    <td width="20%">{{ $data->comments_title }}</td>
                                    <td width="10%">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#details{{ $data->comments_track_id }}">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-eye"></i>&nbsp;Details</button>
                                        </a>
                                        <div id="details{{ $data->comments_track_id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h4 class="modal-title" style="text-transform: uppercase;">{{ $data->comments_title }} Details</h4>
                                                    </div>
                                                    <div class="modal-body">
                                                        {!! $data->comments_body !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td width="20%">
                                        @if($data->comments_picture != '')
                                        <img style="width: 80%;height: 80px;" class="thumbnail img-responsive" src="{{ asset('upload/comments_picture/'.$data->comments_picture ) }}"/>
                                        @else
                                        <span class="label label-danger">No Image Provided</span>
                                        @endif
                                    </td>
                                    @php
                                    $created_at = $data->created_at;
                                    $updated_at = $data->updated_at;
                                    $createdList = $created_at->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $created_at->format('j M Y , g:ia') : $created_at->diffForHumans();
                                    $updatedList = $updated_at->diffInWeeks(\Carbon\Carbon::now()) >= 1 ? $updated_at->format('j M Y , g:ia') : $updated_at->diffForHumans();
                                    @endphp
                                    <td width="10%">{{ $createdList }}</td>
                                    <td width="10%">{{ $updatedList }}</td>

                                    <td  width="10%">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#edit{{ $data->comments_track_id }}">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-edit"></i>&nbsp;Edit</button>
                                        </a>

                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#deleteRow{{ $data->comments_track_id }}">
                                            <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                        </a>
                                        <!-- Modal for Edit Comment -->
                                        <div id="edit{{ $data->comments_track_id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                        <h4 class="modal-title" id="">Edit Comment</h4>
                                                    </div>
                                                    <form role="form" method="POST" action="{{ url('/comments/update') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="comments_track_id" value="{{ $data->comments_track_id }}">
                                                        <input type="hidden" name="comments_posts_id" value="{{ $data->comments_posts_id }}">

                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="comments_title">Title</label>
                                                                <input type="text" class="form-control" name="comments_title" id="comments_title" value="{{ $data->comments_title }}" required>
                                                            </div>                
                                                        </div>

                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="comments_body">Details</label>
                                                                <textarea name="comments_body" id="comments_body" required style="width: 100%; height: 100px;">{!!  $data->comments_body  !!}</textarea>
                                                            </div>                
                                                        </div>      

                                                        <div class="box-body">
                                                            <div class="form-group">
                                                                <label for="comments_picture">Picture</label>
                                                                <input type="file" class="form-control" name="comments_picture" id="comments_picture"  >
                                                            </div>    
                                                            <div>
                                                                @if($data->comments_picture != '')
                                                                <img id="destinationThumb" style="height: 100px;width: 100px;margin-top: 15px;" class="thumbnail img-responsive" src="{{ asset('upload/comments_picture/'.$data->comments_picture ) }}"/>
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
                                            </div>
                                        </div>
                                        <div id="deleteRow{{ $data->comments_track_id }}" class="modal fade" role="dialog">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <form method="POST" action="{{ URL::to('comments/delete') }}">
                                                        {{ csrf_field() }}
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            <h5 class="modal-title" style="color: red;">Are you sure you want to delete?</h5>
                                                            <input type="hidden" id="comments_track_id" name="comments_track_id" value="{{ $data->comments_track_id }}" />
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>                                        
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td class="text-left" colspan="1">
                                        <a href="{{ URL::to('comments/create/'. $dataList->posts_track_id) }}">
                                            <button class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add New</button>
                                        </a>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                </div><!--/.blog-item-->
            </div><!--/.col-md-8-->

        </div><!--/.row-->
    </div>
</section><!--/#blog-->
@endsection