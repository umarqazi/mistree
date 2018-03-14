@extends('layouts.master')
@section('title', 'Workshop Service')
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
                                  <h4 class="title">{{$workshop->name}}</h4> 
                                  <p>Add Services</p>
                              </div>
                          </div>
                  </div>                  
                  <form method="POST" action="{{ url('profile/store-profile-service/') }}">
                    <input type="hidden" value="{{$workshop->id}}" name="workshop_id">
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                      <div class="clear20"></div>
                            <div class="content">                                            
                              <div class="row services-row">
                                <div class="col-md-3">
                                </div>                      
                                <div class="col-md-6">
                                  <div class="child-box-wrap">
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Select Service <span class="manadatory">*</span></label>
                                          <select class="form-control select-search border-input" name="service_id">
                                            <option value="" disabled selected>Select Service</option>
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{ $service->name }}</option>
                                            @endforeach
                                          </select>
                                          @if ($errors->has('service_id'))
                                              <span class="help-block">
                                                  <strong class="manadatory">{{ $errors->first('service_id') }}</strong>
                                              </span>
                                          @endif
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                        <input type="text" class="form-control border-input" name="service_rate" >
                                        @if ($errors->has('service_rate'))
                                            <span class="help-block">
                                                <strong class="manadatory">{{ $errors->first('service_rate') }}</strong>
                                            </span>
                                        @endif
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Enter Time <span class="manadatory">*</span></label>
                                          <input type="text" class="form-control border-input" name="service_time">
                                          
                                      </div>                                        
                                    </div>
                                  </div>
                                </div> 
                                <div class="col-md-3">
                                </div>              

                              </div>
                              <!-- End Row -->

                              <div class="row text-center">  
                                <div class="col-md-12">
                                  <div class="form-group">                                    
                                    <input type="submit" class="btn btn-header">
                                    <!-- <a href="" class="btn btn-header btn-export">Add Services</a> -->
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