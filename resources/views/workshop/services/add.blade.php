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
                                
                                <div class="col-sm-4">
                                  <div class="child-box-wrap">
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Select Service</label>
                                          <select class="form-control border-input" name="service_id[]" required>
                                            <option value="" disabled selected>Select Service</option>
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{ $service->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label class="control-label">Service Rate</label>
                                        <input type="text" class="form-control border-input" name="service_rate[]" required>
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Enter Time</label>
                                          <input type="time" class="form-control border-input" name="service_time[]" required>
                                      </div>                                        
                                    </div>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <div class="child-box-wrap">
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Select Service</label>
                                          <select class="form-control border-input" name="service_id[]">
                                            <option value="" disabled selected>Select Service</option>
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{ $service->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label class="control-label">Service Rate</label>
                                        <input type="text" class="form-control border-input" name="service_rate[]">
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Enter Time</label>
                                          <input type="time" class="form-control border-input" name="service_time[]">
                                      </div>                                        
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-4">
                                  <div class="child-box-wrap">
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Select Service</label>
                                          <select class="form-control border-input" name="service_id[]">
                                            <option value="" disabled selected>Select Service</option>
                                            @foreach ($services as $service)
                                            <option value="{{$service->id}}">{{ $service->name }}</option>
                                            @endforeach
                                          </select>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="row">
                                      <div class="col-md-6">
                                        <label class="control-label">Service Rate</label>
                                        <input type="text" class="form-control border-input" name="service_rate[]">
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Enter Time</label>
                                          <input type="time" class="form-control border-input" name="service_time[]">
                                      </div>                                        
                                    </div>
                                  </div>
                                </div> 

                              </div>
                              <!-- End Row -->

                              <div class="row text-center">  
                                <div class="col-md-12">
                                  <div class="form-group">                                    
                                    <button type="button" class="btn btn-header" onclick="addmoreServices(event)">Add More Services</button>
                                    <input type="submit" value="Store Services" class="btn btn-header">
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
    $(".services-row").append('<div class="col-sm-4"><div class="child-box-wrap"><div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label">Select Service</label><select class="form-control border-input" name="service_id[]"><option value="" selected disabled selected>Select Service</option>@foreach ($services as $service)<option value="{{$service->id}}">{{ $service->name }}</option>@endforeach</select></div></div></div><div class="row"><div class="col-md-6"><label class="control-label">Service Rate</label><input type="text" class="form-control border-input" name="service_rate[]"></div><div class="col-md-6"><label class="control-label">Enter Time</label><input type="time" class="form-control border-input" name="service_time[]"></div></div></div></div>');
  }
</script>

@include('partials.footer')
@endsection