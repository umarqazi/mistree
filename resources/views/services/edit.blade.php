@extends('layouts.master')
@section('title', 'Edit Service')
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
                                    <h4 class="title">Workshop Management - Edit Service</h4>
                                </div>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <form method="POST" action="{{ url('admin/services/') }}{{'/'.$service->id}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Service Name</label>
                                            <input type="text" class="form-control border-input" name="name" value="{{ $service->name }}" required="required">
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Provided at doorstep?</label>
                                            <input type="checkbox" class="form-control border-input" name="is_doorstep"  value="1" @if($service->is_doorstep){{ "checked" }}@endif disabled />
                                            @if ($errors->has('is_doorstep'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('is_doorstep') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Loyalty Points</label>
                                            <input type="text" class="form-control border-input" value="{{ $service->loyalty_points }}" name="loyalty-points">
                                            <input type="hidden"  value="PUT" name="_method">
                                            @if ($errors->has('loyalty-points'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('loyalty-points') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Lead Charges</label>
                                            <input type="text" class="form-control border-input" value="{{ $service->lead_charges }}" name="lead-charges">
                                            @if ($errors->has('lead-charges'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('lead-charges') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Parent</label>
                                            <select class="form-control chosen-select border-input" name="service-parent" >
                                                <option value="0">Select Option</option>
                                                @foreach($services as $key => $value)
                                                    <option value="{{$value->id}}" @if($service->service_parent == $value->id) {{"selected"}} @endif>@if($value->parent($value->service_parent)){{$value->parent($value->service_parent)['name'].' - '}}@endif{{$value->name}}@if($value->is_doorstep){{ " at doorstep" }}@endif</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('service-parent'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('service-parent') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" value="{{ $service->image }}" name="image">
                                            <br>
                                            @if($service->image)
                                                <img src="{{ $service->image }}" width="80px" height="80px">
                                            @else
                                                <br>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-header pull-right">Save</button>
                                        </div>

                                    </div>

                                    <div class="col-md-3"></div>
                                </div> <!-- /end row -->
                            </div> <!-- /end content -->
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection