@extends('layouts.master')
@section('title', 'Create New Service')
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
                                    <h4 class="title">Workshop Management - Create Service</h4>
                                </div>
                            </div>
                        </div>
                        <div class="clear20"></div>
                        <form method="POST" action="{{ url('admin/services') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-3"></div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Service Name <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="name" required="required" value="{{ old('name') }}" />
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Provided at doorstep?</label>
                                            <input type="checkbox" class="form-control border-input" name="is_doorstep"  value="1" @if(!empty(old('is_doorstep'))){{ "checked" }}@endif />
                                            @if ($errors->has('is_doorstep'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('is_doorstep') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Loyalty Points <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="loyalty-points" value="{{ old('loyalty-points',0) }}">
                                            @if ($errors->has('loyalty-points'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('loyalty-points') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Lead Charges <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="lead-charges" value="{{ old('lead-charges',0) }}">
                                            @if ($errors->has('lead-charges'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('lead-charges') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Parent</label>
                                            <select class="form-control select-search border-input" name="service-parent" >
                                                <option value="0">Select Parent</option>
                                                @foreach($services as $service)
                                                    <option value="{{$service->id}}" @if(old('service-parent') == $service->id){{"selected"}}@endif>@if(!is_null($service->parent)){{$service->parent->name.' - '}}@endif{{$service->name}}@if($service->is_doorstep){{ " at doorstep" }}@endif</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('service-parent'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('service-parent') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Category <span class="manadatory">*</span></label>
                                            <select class="form-control border-input" name="category" required >
                                                <option value="0">Select Category</option>
                                                @foreach($categories as $category)
                                                    <option value="{{$category->id}}" @if(old('category') == $category->id){{"selected"}}@endif>{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('category'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('category') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Image</label>
                                            <input type="file" name="image">
                                            @if ($errors->has('image'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('image') }}</strong>
                                                </span>
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