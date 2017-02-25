@extends('layouts.dashboard')
@section('content')
<main id="main-container">
    <div class="content bg-gray-lighter" style="min-height: 50px;">
        <div class="row items-push">
            <div class="col-sm-7">
                <a href="{{ url('/topics/create') }}" class="btn btn-success"> <span class="fa fa-check"></span> Add Topic</a>
            </div>
        </div>
    </div>

    <div class="content" style="min-height: 410px;">
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
        <div class="block">
            <div class="block-header">
                <h3 class="block-title">Topic List</h3>
            </div>
            <div class="block-content">
                <table class="table table-bordered table-striped">
                    <div class="pull-right">
                        <a href="" onclick="window.print()" class="btn btn-info"><i class="icon-print icon-large"></i> Print</a>
                    </div>
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="60%">Topic Name</th>
                            <th width="30%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($dataList))
                        @foreach ($dataList as $data)
                        <tr>
                            <td class="text-center"></td>
                            <td class="font-w600">{{ $data->topics_name }}</td>
                            @if(Auth::User())
                            @if(Auth::User()->users_track_id == $data->users_track_id)
                            <td class="font-w600">
                                <a onclick="return confirm('Are you sure?')" href="{{ (!empty($data->topics_track_id)) ? URL::to('topics/edit/'.$data->topics_track_id) : '' }}"><button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i> Edit</button></a>
                                <a onclick="return confirm('Are you sure?')" href="{{ (!empty($data->topics_track_id)) ? URL::to('topics/delete/'.$data->topics_track_id) : '' }}"><button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Delete"><i class="fa fa-trash"></i> Delete</button></a>
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
@endsection
