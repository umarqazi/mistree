@extends('layouts.master')
@section('title', 'Update Workshop')
@section('content')

    @include('partials.header')

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <form method="POST" action="{{ url('update-profile-password/')}}">
                            <input type="hidden"  value="PATCH" name="_method">
                            <input type="hidden"  value="{{$workshop->id}}" name="workshop_id">
                            {{ csrf_field() }}
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="title">Edit Password</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="clear20"></div>

                            <div class="cn-section-1">
                                <div class="content">

                                    <div class="row">
                                        <div class="col-md-6 col-lg-offset-3">
                                            <div class="form-group">
                                                <label class="control-label">New Password</label>
                                                <input type="password" class="form-control border-input" name="password" required oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('password') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Confirm Password</label>
                                                <input type="password" class="form-control border-input" name="password_confirmation" required oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('password_confirmation'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('password_confirmation') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <input type="submit" value="Update Password" class="btn pull-right">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
    <script type="text/javascript" src="{{ url('js/workshop-profile.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/workshop-profile-edit.js') }}"></script>
    @include('partials.footer')
@endsection
