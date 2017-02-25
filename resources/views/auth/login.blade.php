@extends('layouts.dashboard')

@section('content')
<section id="login">
    <div class="container">
        <div class="row" style="min-height:333px;">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>
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
                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/authenticate') }}">
                            {{ csrf_field() }}

                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <label for="email" class="col-md-4 control-label">E-Mail/Username</label>

                                <div class="col-md-6">
                                    <input id="email" type="text" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-8 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
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
