@extends('layouts.dashboard')

@section('content')
<section id="register">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    @if (session('errorArray'))
                    <div class="alert alert-danger">
                        @foreach($errors->all() AS $key => $value)
                        <strong><i class="fa fa-warning"></i> {{ $value }}</strong><br>
                        @endforeach
                    </div>
                    @endif
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
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/register/store') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="name" class="col-md-4 control-label">Name</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="username" class="col-md-4 control-label">Username</label>

                                <div class="col-md-6">
                                    <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required>
                                </div>
                            </div>

                            <div class="form-group"">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="re_password" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="re_password" type="password" class="form-control" name="re_password" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Register
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
