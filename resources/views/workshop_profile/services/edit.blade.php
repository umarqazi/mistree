@extends('layouts.master')
@section('title', 'Workshop Details')
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
                                <h4 class="title">Edit Workshop Service</h4>                                
                            </div>
                            <div class="clear10"></div><div class="clear5"></div>
                            <div class="clear10"></div><div class="clear5"></div>                            
                            <div class="col-md-12">
                                @if ($errors->any())
                                  <div class="row text-center alert alert-danger">
                                    @foreach($errors->all() as $error)
                                      <div><span class="manadatory">{{ $error }}</span></div>
                                    @endforeach                        
                                  </div>
                                @endif
                                <div class="row">
                                    <form method="POST" action="{{ url('profile/updateProfileService/')}}">
                                    <input type="hidden" value="PATCH" name="_method">
                                    <input type="hidden" value="{{$workshop_service->workshop_id}}" name="workshop_id">
                                    <input type="hidden" value="{{$workshop_service->service_id}}" name="service_id">
                                    <input type="hidden" value="{{$workshop_service->id}}" name="workshop_service_id">
                                    {{ csrf_field() }}
                                        <div class="col-sm-4">
                                            <div class="child-box-wrap">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                          <label class="control-label">Select Service</label>
                                                          <select class="form-control border-input" disabled>
                                                            <option value="" disabled selected>Select Service</option>
                                                            @foreach ($services as $service)
                                                            <option value="{{$service->id}}" @if($service->id == $workshop_service->service_id ) selected @endif>{{ $service->name }}</option>
                                                            @endforeach
                                                          </select>
                                                        </div>
                                                      </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="control-label">Service Rate</label>
                                                        <input type="text" class="form-control border-input" name="service_rate" value="{{$workshop_service->service_rate}}">
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="control-label">Enter Time</label>
                                                        <input type="text" class="form-control border-input" name="service_time" value="{{$workshop_service->service_time}}">
                                                    </div>                                        
                                                </div>
                                            </div>

                                            <div class="clear10"></div><div class="clear5"></div>
                                            <div class="text-center">
                                                <input type="submit" class="btn btn-header btn-export" value="Update Workshop Service">
                                            </div>
                                        </div>
                                    </form>
                                                                 
                                </div>
                            </div>                           
                        </div>
                        <div class="clear20"></div>
                        <div class="row">
                         
                            <div class="col-sm-6 col-sm-offset-6 balance-info">
                              
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@include('partials.footer')
@endsection