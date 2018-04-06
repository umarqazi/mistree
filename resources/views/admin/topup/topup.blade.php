@extends('layouts.master')
@section('title', 'Topup')
@section('content')
@include('partials.header')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="title">Workshop Management - Top Up</h4>
                            </div>
                        </div>
                    </div>
                    <div class="clear40"></div>
                    <div class="content">
                        <div class="workshop-content">

                            <form method="POST" action="{{ url('admin/update-balance') }}" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="header">
                                    @if ($errors->any())
                                        <div class="row text-center alert alert-danger">
                                            @foreach($errors->all() as $error)
                                                <div><span class="manadatory">{{ $error }}</span></div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if (session('message'))
                                        <div class="alert alert-success">
                                            {{ session('message') }}
                                        </div>
                                    @endif
                                </div>
                                <div class="clear20"></div>

                                <div class="row">
                                    <div class="col-md-3">
                                    </div>
                                    <div class="col-md-6 top-up-form">
                                        <div class="form-group">
                                            <label class="control-label">Workshop <span class="manadatory">*</span></label>
                                            <select name="workshop_id" class="form-control chosen-select  border-input">
                                                <option value="">Select Workshop</option>
                                                @foreach($workshops as $workshop)
                                                    <option value="{{$workshop->id}}">{{$workshop->name}}@if(!is_null($workshop->workshopId)) {{" - ". $workshop->workshopId }}@endif</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('workshop_id'))
                                                <span class="help-block">
                                  <strong class="manadatory">{{ $errors->first('workshop_id') }}</strong>
                              </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Amount <span class="manadatory">*</span></label>
                                            <input type="number"  max="9999" class="form-control border-input" name="amount">
                                            @if ($errors->has('amount'))
                                                <span class="help-block">
                                  <strong class="manadatory">{{ $errors->first('amount') }}</strong>
                              </span>
                                            @endif
                                        </div>
                                        <div class="clear20"></div>

                                        <div class="form-group text-center">
                                            <input type="submit" value="Submit" class="btn btn-header">
                                        </div>



                                    </div>

                                    <div class="col-md-3">
                                    </div>
                                </div>

                            </form>

                        </div>
                    </div>
                    <div class="clear40"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('partials.footer')
@endsection
