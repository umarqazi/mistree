@extends('layouts.master')
@section('title', 'Create New Workshop')
@section('content')

@include('partials.header')


<div class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">

                  <form method="POST" action="{{ url('admin/workshops') }}" enctype="multipart/form-data">
                    {!! csrf_field() !!}
                      <div class="header">
                        @if ($errors->any())
                          <div class="row text-center alert alert-danger">
                            @foreach($errors->all() as $error)
                              <div><span class="manadatory">{{ $error }}</span></div>
                            @endforeach                        
                          </div>
                        @endif 
                          <div class="row">
                              <div class="col-md-12">
                                  <h4 class="title">Workshop Management - Create New</h4> 
                              </div>
                          </div>
                      </div>
                      <div class="clear20"></div>
                      
                      

                      <!--###############################################--> 
                      <div class="cn-section-1">                  
                        <div class="content">

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label class="control-label">Workshop Name <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="name" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="owner_name" value="{{ old('owner_name') }}">
                                @if ($errors->has('owner_name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                <input type="email" class="form-control border-input" name="email" value="{{ old('email') }}">
                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Enter Password <span class="manadatory">*</span></label>
                                <input type="password" id="password" class="form-control border-input" name="password">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Confirm Password <span class="manadatory">*</span></label>
                                <input type="password" id="confirm_password" class="form-control border-input" name="password_confirmation">
                                @if ($errors->has('password_confirmation'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('password_confirmation') }}</strong>
                                    </span>
                                @endif
                                <span id='message'></span>
                              </div>  

                              <div class="form-group">
                                <label class="control-label">Cnic Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="cnic" value="{{ old('cnic') }}">
                                @if ($errors->has('cnic'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('cnic') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label class="control-label">Mobile Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="mobile" value="{{ old('mobile') }}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                              </div>                          

                              <div class="form-group">
                                <label class="control-label">Landline Number <span class="manadatory"></span></label>
                                <input type="text" class="form-control border-input" name="landline" value="{{ old('landline') }}">
                                @if ($errors->has('landline'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('landline') }}</strong>
                                    </span>
                                @endif
                              </div>                          
                            </div>

                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="control-label">Type *</label>
                                <select name="type" class="form-control border-input">
                                  <option value="">Please Select</option>
                                  <option value="Authorized">Authorized</option>
                                  <option value="Unauthorized">UnAuthorized</option>
                                </select>
                              </div>

                      {{--    <div class="form-group">
                                <label class="control-label">Team Slot</label>
                                <select name="team_slot" class="form-control border-input">
                                  <option value="">Please Select</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                 </select>
                              </div>
                              --}} 
                            </div>

                            <div class="col-md-6">
                              <div class="form-group">                              
                                <label class="control-label">Opening <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="open_time" value="{{ old('open_time') }}">
                                @if ($errors->has('open_time'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">                              
                                <label class="control-label">Closing <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="close_time" value="{{ old('close_time') }}">
                                @if ($errors->has('close_time'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('close_time') }}</strong>
                                    </span>
                                @endif                                        
                              </div>
                              
                              <div class="form-group">      
                                <label class="control-label">Profile Picture</label> 
                                <div class="clear"></div>                   
                                <input type="file" id="profile_picture" class="form-control" name="profile_pic">
                              </div>

                              <div class="form-group">      
                                <label class="control-label">CNIC Picture</label> 
                                <div class="clear"></div>                   
                                <input type="file" id="cnic_picture" class="form-control" name="cnic_image">
                              </div>
                            <div class="well">
                              <div class="form-group">      
                                <label class="control-label">Workshop Picture 1:</label> 
                                <div class="clear"></div>                   
                                <input type="file" class="form-control" name="ws_images[]">
                              </div>

                              <div class="form-group">      
                                <label class="control-label">Workshop Picture 2:</label> 
                                <div class="clear"></div>                   
                                <input type="file" class="form-control" name="ws_images[]">
                              </div>

                              <div class="form-group">      
                                <label class="control-label">Workshop Picture 3:</label> 
                                <div class="clear"></div>                   
                                <input type="file" class="form-control" name="ws_images[]">
                              </div>
                              </div>
                            </div>
                          </div>  
                                                                                                                            
                          <div class="row">
                            <div class="col-md-12 text-center">
                              <div class="form-group">                        
                                <a class="btn btn-header btn-next-1">Next</a>
                              </div>
                            </div>
                          </div>

                        </div>                          
                      </div>
                        
                          <!--###############################################--> 
                          <div class="cn-section-2">

                            <div class="content">
                              <div class="row">                            
                                <div class="col-md-6">
                                <div class="form-group">                              
                                    <label class="control-label">Shop No. <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="shop" value="{{ old('shop') }}">
                                    @if ($errors->has('shop'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('shop') }}</strong>
                                      </span>
                                    @endif
                                </div>
                                  <div class="form-group">                              
                                    <label class="control-label">Building No. <span class="manadatory"></span></label>
                                    <input type="text" class="form-control border-input" name="building" value="{{ old('building') }}">
                                    @if ($errors->has('building'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('building') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Street <span class="manadatory"></span></label>
                                    <input type="text" class="form-control border-input" name="street" value="{{ old('street') }}">
                                    @if ($errors->has('street'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('street') }}</strong>
                                      </span>
                                    @endif
                                  </div>
                                 

                                  </div>
                                <div class="col-md-6">

                                <div class="form-group">                              
                                    <label class="control-label">Block <span class="manadatory"></span></label>
                                    <input type="text" class="form-control border-input" name="block" value="{{ old('block') }}">
                                    @if ($errors->has('block'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('block') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Town <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="town" value="{{ old('town') }}" >
                                    @if ($errors->has('town'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('town') }}</strong>
                                      </span>
                                    @endif
                                  </div> 

                                  <div class="form-group">                              
                                    <label class="control-label">City <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="city" value="{{ old('city') }}">
                                    @if ($errors->has('city'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('city') }}</strong>
                                      </span>
                                    @endif
                                  </div>
                                </div>
                              </div> 

                              <div class="row">                                                   
                                <div class="col-md-12 text-center">
                                  <div class="form-group">
                                    <button class="btn btn-header btn-back-1">Back</button>
                                    <button class="btn btn-header btn-next-2">Next</button>
                                  </div>
                                </div>
                              </div>

                            </div>                                          
                          </div>




                          <!--###############################################--> 
                          <div class="cn-section-3">

                            <div class="content">                                            
                              <div class="row services-row">                                  
                                
                                <div class="col-sm-4">
                                  <div class="child-box-wrap">
                                  <br>
                                    <div class="row">

                                      <div class="col-md-12">
                                        <div class="form-group">
                                          <label class="control-label">Select Service <span class="manadatory">*</span></label>
                                          <select class="form-control border-input" name="service_id[]">
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
                                        <input type="text" class="form-control border-input" name="service_rate[]">
                                        @if ($errors->has('service_rate'))
                                          <span class="help-block">
                                              <strong class="manadatory">{{ $errors->first('service_rate') }}</strong>
                                          </span>
                                        @endif
                                      </div>
                                      <div class="col-md-6">
                                        <label class="control-label">Enter Time <span class="manadatory">*</span></label>
                                          <input type="text" class="form-control border-input" name="service_time[]">
                                          @if ($errors->has('service_time'))
                                            <span class="help-block">
                                                <strong class="manadatory">{{ $errors->first('service_time') }}</strong>
                                            </span>
                                          @endif
                                      </div>                                        
                                    </div>
                                  </div>
                                </div>
                                

                              </div>
                              <!-- End Row -->

                              <div class="row text-center">  
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <button type="button" class="btn btn-header">Cancel</button>
                                    <button type="button" class="btn btn-header btn-back-2">Back</button>
                                    <button type="button" class="btn btn-header" onclick="addmoreServices(event)">Add More Services</button>
                                    <input type="submit" value="Save Workshop" class="btn btn-header">
                                  </div>
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
    $('#password, #confirm_password').on('keyup', function () {
      if ($('#password').val() == $('#confirm_password').val()) {
        $('#message').html('Matching').css('color', 'green');
      } else 
        $('#message').html('Not Matching').css('color', 'red');
    });
</script>

<script>
  function addmoreServices(event){
    event.preventDefault();
    $(".services-row").append('<div class="col-sm-4"> <div class="child-box-wrap"><a class="pull-right" onclick="removeService(this);"> X </a><div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label">Select Service<span class="manadatory"> *</span></label><select class="form-control border-input" name="service_id[]"><option value="" selected disabled selected>Select Service</option>@foreach ($services as $service)<option value="{{$service->id}}">{{ $service->name }}</option>@endforeach</select></div></div></div><div class="row"><div class="col-md-6"><label class="control-label">Service Rate</label><input type="text" class="form-control border-input" name="service_rate[]"></div><div class="col-md-6"><label class="control-label">Enter Time</label><input type="text" class="form-control border-input" name="service_time[]"></div></div></div></div>');
  }
  function removeService(obj)
  {
     $(obj).parent('div').parent('div').remove();
  }
</script>
@include('partials.footer')
@endsection