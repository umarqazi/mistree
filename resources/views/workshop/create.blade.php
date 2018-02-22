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
                        {{-- @if ($errors->any())
                          <div class="row text-center alert alert-danger">
                            @foreach($errors->all() as $error)
                              <div><span class="manadatory">{{ $error }}</span></div>
                            @endforeach                        
                          </div>
                        @endif --}}
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
                                <input type="text" class="form-control border-input" name="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="owner_name">
                                @if ($errors->has('owner_name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                <input type="email" class="form-control border-input" name="email">
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
                                <label class="control-label">Card Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="card_number">
                                @if ($errors->has('card_number'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Contact Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="con_number">
                                @if ($errors->has('con_number'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('con_number') }}</strong>
                                    </span>
                                @endif
                              </div>                          
                            </div>

                            <div class="col-md-6">

                              <div class="form-group">
                                <label class="control-label">Type</label>
                                <select name="type" class="form-control border-input">
                                  <option value="">Please Select</option>
                                  <option value="authorized">Authorized</option>
                                  <option value="unauthorized">UnAuthorized</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Team Slot</label>
                                <select name="team_slot" class="form-control border-input">
                                  <option value="">Please Select</option>
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                 </select>
                              </div>

                            </div>

                            <div class="col-md-6">

                              

                              <div class="form-group">                              
                                <label class="control-label">Opening <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="open_time">
                                @if ($errors->has('open_time'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">                              
                                <label class="control-label">Closing <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="close_time">
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
                                    <label class="control-label">City <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_city">
                                    @if ($errors->has('address_city'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_city') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Block <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_block">
                                    @if ($errors->has('address_block'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_block') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Town <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_town">
                                    @if ($errors->has('address_town'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_town') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Area <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_area">
                                    @if ($errors->has('address_area'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_area') }}</strong>
                                      </span>
                                    @endif
                                  </div>
                                </div>

                                <div class="col-md-6">

                                  <div class="form-group">                              
                                    <label class="control-label">Address Type <span class="manadatory">*</span></label>
                                    <select class="form-control border-input" name="address_type"> 
                                      <option value="Authorized"> Authorized </option>
                                      <option value="UnAuthorized"> UnAuthorized </option>
                                    </select>
                                    @if ($errors->has('address_type'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_type') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Shop No <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_house_no">
                                    @if ($errors->has('address_house_no'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_house_no') }}</strong>
                                      </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Street No <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_street_no">
                                    @if ($errors->has('address_street_no'))
                                      <span class="help-block">
                                          <strong class="manadatory">{{ $errors->first('address_street_no') }}</strong>
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
    $(".services-row").append('<div class="col-sm-4"><div class="child-box-wrap"><div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label">Select Service</label><select class="form-control border-input" name="service_id[]"><option value="" selected disabled selected>Select Service</option>@foreach ($services as $service)<option value="{{$service->id}}">{{ $service->name }}</option>@endforeach</select></div></div></div><div class="row"><div class="col-md-6"><label class="control-label">Service Rate</label><input type="text" class="form-control border-input" name="service_rate[]"></div><div class="col-md-6"><label class="control-label">Enter Time</label><input type="text" class="form-control border-input" name="service_time[]"></div></div></div></div>');
  }
</script>
@include('partials.footer')
@endsection