@extends('site::layouts.app')
<style>
    .login-form{
        animation-duration: 1s;
        animation-delay:0.1s;
    }
            	
</style>
@section('content')
<div class="container login-form animated ZoomIn">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                         <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> Remember Me
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button href="#" class="btn btn-primary btn-block mb-2 btn-lg">
                                      Login
                                </button>                           
                                <a class="btn btn-primary btn-block" href="{{ url('site/login/facebook') }}" >
                                    <span class="fa fa-facebook"></span> Sign in with Facebook
                                </a>
                                <a href="{{ url('site/login/google') }}" class="btn btn-danger btn-block">
                                    <span class="fa fa-google "></span> Sign in with Google
                               </a>                                     
                               <a class="btn btn-link " href="{{url('site/password/reset')}}">
                                    Forgot Your Password?
                                </a>
                            </div>
                        </div>                      
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection