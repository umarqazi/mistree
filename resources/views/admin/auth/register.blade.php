@extends('layouts.master')
@section('title', 'Login')
@section('content_login')
<div class="wrapper login-signup">

    <div class="main-panel">
        <div class="content user_forms">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h2>Register</h2>
                        <div class="card">
                            <div class="content">
                                <form method="POST" action="{{ url('/admin/register') }}">
                                {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-12">          
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <label for="name">Full Name</label>
                                                <input id="name" type="text" class="form-control border-input" name="name" value="{{ old('name') }}" autofocus>

                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                        </div>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                                <label for="email">E-Mail Address</label>
                                                    <input id="email" type="email" class="form-control border-input" name="email" value="{{ old('email') }}">

                                                    @if ($errors->has('email'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                        </span>
                                                    @endif                                       
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                                <label for="password">Password</label>
                                                    <input id="password" type="password" class="form-control border-input" name="password">

                                                    @if ($errors->has('password'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('password') }}</strong>
                                                        </span>
                                                    @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                           <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                               <label for="password-confirm">Confirm Password</label>
                                                   <input id="password-confirm" type="password" class="form-control border-input" name="password_confirmation">

                                                   @if ($errors->has('password_confirmation'))
                                                       <span class="help-block">
                                                           <strong>{{ $errors->first('password_confirmation') }}</strong>
                                                       </span>
                                                   @endif               
                                           </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group{{ $errors->has('con_number') ? ' has-error' : '' }}">
                                                <label for="con_number">Contact Number</label>
                                                    <input id="con_number" type="text" class="form-control border-input" name="con_number" value="{{ old('con_number') }}">

                                                    @if ($errors->has('con_number'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('con_number') }}</strong>
                                                        </span>
                                                    @endif                                       
                                            </div>
                                        </div>
                                    </div>

                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Register</button>
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
@endsection
