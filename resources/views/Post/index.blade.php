@extends('layouts.dashboard')
@section('content')
<main id="main-container">
    <div class="content bg-gray-lighter" style="min-height: 50px;">
        <div class="row items-push">
            <div class="col-sm-7">
                <a href="{{ url('/posts/create') }}" class="btn btn-success"> <span class="fa fa-check"></span> Add Post</a>
            </div>
        </div>
    </div>

    <div class="content" style="min-height: 410px;">
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Post List</h3>
            </div>
            @if (session('success'))
            <div class="alert alert-success"  id="success">
                <strong><i class="fa fa-check"></i> {{ session('success') }}</strong>
            </div>
            @endif
            @if (session('error'))
            <div class="alert alert-danger"  id="error">
                <strong><i class="fa fa-edit"></i> {{ session('error') }}</strong>
            </div>
            @endif
            <div class="block-content">
                <table class="table table-bordered table-striped">
                    <div class="pull-right">
                        <a href="javascript:void(0);" id="advanceSearch" class="btn btn-primary btn-xs pull-right"><i class="fa fa-search-minus"></i>&nbsp;Advance Search</a></span><br>

                        <a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
                        <form method="GET" action="{{ url('posts/search') }}" class="navbar-form" role="search">
                            <div class="input-group add-on">
                                <input class="form-control" placeholder="Search" name="searchText" id="searchText" type="text">
                                <div class="input-group-btn">
                                    <button class="btn btn-default" type="submit"><span class="fa fa-search"></span></button>
                                </div>
                            </div>
                        </form>
                        <thead>
                            <tr>
                                <th width="10%">User</th>
                                <th width="10%">Topic Name</th>
                                <th width="10%">Post Title</th>
                                <th width="10%">Post Details</th>
                                <th width="20%">Picture</th>
                                <th width="10%">Created At</th>
                                <th width="10%">Updated At</th>
                                <th width="10%">View</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (isset($dataList))
                            @foreach ($dataList as $data)
                            <tr>
                                <td width="10%">{{ $data->name }}</td>
                                <td width="10%">{{ $data->topics_name }}</td>
                                <td width="10%">{{ $data->posts_title }}</td>
                                <td width="10%">
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#details{{ $data->posts_track_id }}">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-eye"></i>&nbsp;Details</button>
                                    </a>
                                    <div id="details{{ $data->posts_track_id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                    <h4 class="modal-title" style="text-transform: uppercase;">{{ $data->posts_title }} Details</h4>
                                                </div>
                                                <div class="modal-body">
                                                    {!! $data->posts_body !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td width="20%">
                                    @if($data->posts_picture != '')
                                    <img style="width: 80%;height: 80px;" class="thumbnail img-responsive" src="{{ asset('upload/posts_picture/'.$data->posts_picture ) }}"/>
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
                                <td width="10%">
                                    <a href="{{ (!empty($data->posts_track_id)) ? URL::to('posts/show/'.$data->posts_track_id) : '' }}"><button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="View"><i class="fa fa-eye"></i> View</button></a>
                                </td> 

                                @if(Auth::User())
                                @if(Auth::User()->users_track_id == $data->posts_users_id)

                                <td  width="20%">
                                    <a href="{{ (!empty($data->posts_track_id)) ? URL::to('posts/edit/'.$data->posts_track_id) : '' }}"><button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                    <a href="javascript:void(0);" data-toggle="modal" data-target="#deleteRow{{ $data->posts_track_id }}">
                                        <button class="btn btn-default btn-sm"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                    </a>
                                    <div id="deleteRow{{ $data->posts_track_id }}" class="modal fade" role="dialog">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                <form method="POST" action="{{ URL::to('posts/delete') }}">
                                                    {{ csrf_field() }}
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <h5 class="modal-title" style="color: red;">Are you sure you want to delete?</h5>
                                                        <input type="hidden" id="posts_track_id" name="posts_track_id" value="{{ $data->posts_track_id }}" />
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" id="btnDelete" name="btnDelete" class="btn btn-danger center-block"><i class="fa fa-trash"></i>&nbsp;Delete</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                @endif
                                @else
                                @endif                                                                             
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
<script type="text/javascript">
    $(document).ready(function () {
        $("#advanceSearch").click(function () {
            $("#advanceSearchDiv").toggle();
        });
    });
</script>
@endsection
