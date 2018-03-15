@extends('layouts.master')
@section('title', 'Workshop Details')
@section('content')

@include('partials.header')

<div class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                  <form method="POST" action="{{ url('admin/store-workshop-service') }}">
                  <input type="hidden" value="{{$workshop->id}}" name="workshop_id">
                    {!! csrf_field() !!}
                      <div class="header">
                          <div class="row">                            
                              <div class="col-md-12">
                                  <h4 class="title">{{$workshop->name}}</h4> 
                                  <p>Add Services</p>
                              </div>
                          </div>
                      </div>
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
                                          <select class="form-control chosen-select  border-input" name="service_id">
                                            <option value="" disabled selected>Select Service</option>
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{ $service->name }}@if($service->is_doorstep){{ " at doorstep" }}@endif</option>
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
                                          <label class="control-label">Enter Time</label>
                                          <select name ="service_time" class="form-control chosen-select border-input">
                                              <option value="1.0">1.0 hr</option>
                                              <option value="1.5">1.5 hr</option>
                                              <option value="2.0">2.0 hr</option>
                                              <option value="2.5">2.5 hr</option>
                                              <option value="3.0">3.0 hr</option>
                                              <option value="3.5">3.5 hr</option>
                                              <option value="4.0">4.0 hr</option>
                                              <option value="4.5">4.5 hr</option>
                                              <option value="5.0">5.0 hr</option>
                                              <option value="5.5">5.5 hr</option>
                                              <option value="6">6.0 hr</option>
                                              <option value="6.5">6.5 hr</option>
                                              <option value="7.0">7.0 hr</option>
                                              <option value="7.5">7.5 hr</option>
                                              <option value="8.0">8.0 hr</option>
                                              <option value="8.5">8.5 hr</option>
                                              <option value="9.0">9.0 hr</option>
                                              <option value="9.5">9.5 hr</option>
                                              <option value="10">10 hr</option>
                                          </select>
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
                                    <a class="btn btn-header" href="{{url('admin/workshops/'.$workshop->id)}}">Back</a>
                                    <input type="submit" value="Store Service" class="btn btn-header">
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

<script>
  function addmoreServices(event){
    event.preventDefault();
    $(".services-row").append('<div class="col-sm-4"><div class="child-box-wrap"><div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label">Select Service</label><select class="form-control border-input" name="service_id[]"><option value="" selected disabled selected>Select Service</option>@foreach ($services as $service)<option value="{{$service->id}}">{{ $service->name }}</option>@endforeach</select></div></div></div><div class="row"><div class="col-md-6"><label class="control-label">Service Rate</label><input type="text" class="form-control border-input" name="service_rate[]"></div><div class="col-md-6"><label class="control-label">Enter Time</label><input type="text" class="form-control border-input" name="service_time[]"></div></div></div></div>');
  }
</script>

@include('partials.footer')
@endsection