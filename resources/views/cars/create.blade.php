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
                        {{-- @if ($errors->any())
                          <div class="row text-center alert alert-danger">
                            @foreach($errors->all() as $error)
                              <div><span class="manadatory">{{ $error }}</span></div>
                            @endforeach                        
                          </div>
                        @endif --}}
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
                              <label class="control-label">Car Type <span class="manadatory">*</span></label>
                              <input type="text" class="form-control border-input" name="type">
                              @if ($errors->has('type'))
                                  <span class="help-block">
                                      <strong class="manadatory">{{ $errors->first('type') }}</strong>
                                  </span>
                              @endif
                            </div>

                            <div class="form-group">
                              <label class="control-label">Car Model <span class="manadatory">*</span></label>
                              <input type="text" class="form-control border-input" name="model">
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