@extends('layouts.master')
@section('title', 'Create New Car')
@section('content')

    @include('partials.header')


    <div class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">

                        <form method="POST" action="{{ url('admin/cars') }}">
                            {!! csrf_field() !!}
                            <div class="header">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="title">Cars - Create New</h4>
                                    </div>
                                </div>
                            </div>
                            <div class="content">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Type <span class="manadatory">*</span></label>
                                            <select class="form-control border-input" name="type" required >
                                                <option value="0">Select Type</option>
                                                @foreach($types as $type)
                                                    <option value="{{$type->id}}" @if(old('type') == $type->id){{"selected"}}@endif>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('type'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('type') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Car Make <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="make" value="{{ old('make') }}" required>
                                            @if ($errors->has('make'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('make') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Car Model <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="model" value="{{ old('model') }}" required>
                                            @if ($errors->has('model'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('model') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <input type="submit" value="Add Car" class="btn btn-header">
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

    @include('partials.footer')
@endsection