@extends('layouts.master')
@section('title', 'Login')
@section('content_login')
<div class="wrapper login-signup">

    <div class="main-panel">
        <div class="content user_forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                       <div class="logo margin-tb-20">
                          <img src="/img/car-logo.png" class="img-responsive center-block">
                        </div>
                        <div class="row">
                          <div class="col-xs-10  col-xs-offset-1">
                            <div class="card">
                                <h2 class="text-center">Login</h2>
                                <div class="content">
                                    <form method="POST" action="{{ url('/admin/login') }}">
                                    {{ csrf_field() }}
      
                                        <div class="row">
                                            <div class="col-md-12">                                      
                                             <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                 <label for="email">Email</label>

                                                     <input id="email" type="email" class="form-control border-input" name="email" value="{{ old('email') }}" autofocus>

                                                     @if ($errors->has('email'))
                                                         <span class="help-block">
                                                             <strong>{{ $errors->first('email') }}</strong>
                                                         </span>
                                                     @endif
                                             </div>
                                               
                                            </div>
                                            <div class="col-md-12">
                                              <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                  <label for="password">Password</label>

                                                      <input id="password" type="password" class="form-control border-input" name="password">

                                                      @if ($errors->has('password'))
                                                          <span class="help-block">
                                                              <strong>{{ $errors->first('password') }}</strong>
                                                          </span>
                                                      @endif
                                              </div>
                                                <a href="{{ url('/admin/password/reset') }}" class="forgot pull-right">Forgot password ? </a>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="checkbox ckhbx">
                                                    <label>
                                                        <input type="checkbox" name="remember"> Remember Me
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="text-right">
                                                    <button type="submit" class="btn btn-info btn-fill btn-wd btn-login">Sign In</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
