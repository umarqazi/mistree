@extends('layouts.master')
@section('title', 'Login')
@section('content_login')

<div class="wrapper login-signup">
<div class="main-panel">
<div class="content user_forms">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-12">
                <h2>Login</h2>
                <div class="card">
                    <div class="content">
                        <form>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" class="form-control border-input">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="password" class="form-control border-input">
                                    </div>
                                    <a href="#" class="forgot text-uppercase">Forgot password? <span>Reset</span></a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="text-right">
                                        <button type="submit" class="btn btn-info btn-fill btn-wd">Sign In</button>
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
@endsection