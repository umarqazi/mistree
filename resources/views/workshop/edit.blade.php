@extends('layouts.master')
@section('title', 'Update Workshop')
@section('content')

@include('partials.header')


<div class="content">
    
    <div class="container-fluid">                
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <form method="POST" action="{{ url('admin/workshops/'.$workshop->id) }}" enctype="multipart/form-data">
                    <input type="hidden"  value="PATCH" name="_method">
                    {{ csrf_field() }}
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
                                  <h4 class="title">Workshop Management - Update Workshop</h4> 
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
                                <input type="text" class="form-control border-input" value="{{$workshop->name}}" name="name">
                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="owner_name" value="{{$workshop->owner_name}}">
                                @if ($errors->has('owner_name'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                <input type="email" class="form-control border-input" name="email" value="{{$workshop->email}}" readonly>
                              </div>

                              <!-- <div class="form-group">
                                <label class="control-label">Enter Passowrd</label>
                                <input type="password" class="form-control border-input" name="password" value="" required>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Confirm Passowrd</label>
                                <input type="password" class="form-control border-input" name="password_confirmation" required>
                              </div>   -->

                              <div class="form-group">
                                <label class="control-label">Card Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="card_number" value="{{$workshop->card_number}}">
                                @if ($errors->has('card_number'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Contact Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="con_number" value="{{$workshop->con_number}}">
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
                                <select name="type" class="form-control border-input" required="required">
                                  <option value="">Please Select</option>
                                  <option value="authorized" @if($workshop->type == "authorized") selected @endif >Authorized</option>
                                  <option value="unauthorized" @if($workshop->type == "unauthorized") selected @endif >UnAuthorized</option>
                                </select>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Team Slot</label>
                                <select name="team_slot" class="form-control border-input" required="required">
                                  <option value="">Please Select</option>
                                  <option value="1" @if($workshop->team_slot == "1") selected @endif>1</option>
                                  <option value="2" @if($workshop->team_slot == "2") selected @endif>2</option>
                                  <option value="3" @if($workshop->team_slot == "3") selected @endif>3</option>
                                  <option value="4" @if($workshop->team_slot == "4") selected @endif>4</option>
                                 </select>
                              </div>

                              <div class="form-group">                              
                                <label class="control-label">Opening <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="open_time" value="{{$workshop->open_time}}"> 
                                @if ($errors->has('open_time'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                    </span>
                                @endif                                       
                              </div>

                              <div class="form-group">                              
                                <label class="control-label">Closing <span class="manadatory">*</span></label>
                                <input type="time" class="form-control border-input" name="close_time" value="{{$workshop->close_time}}">
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
                                <br>
                                @if($workshop->profile_pic)
                                <img src="{{ $workshop->profile_pic }}" width="80px" height="80px">
                                @else
                                        <br>
                                @endif
                              </div>

                              <div class="form-group">      
                                <label class="control-label">CNIC Picture</label> 
                                <div class="clear"></div>                   
                                <input type="file" id="cnic_picture" class="form-control" name="cnic_image">
                                @if($workshop->cnic_image)
                                <img src="{{ $workshop->cnic_image }}" width="80px" height="80px">
                                @else
                                        <br>
                                @endif
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
                                  @php $address = $workshop->address;  @endphp
                                  <div class="form-group">                              
                                    <label class="control-label">City <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_city" value="{{$address->city}}">
                                    @if ($errors->has('address_city'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('address_city') }}</strong>
                                        </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Block <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_block" value="{{$address->block}}">
                                    @if ($errors->has('address_block'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('address_block') }}</strong>
                                        </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Town <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_town" value="{{$address->town}}">
                                    @if ($errors->has('address_town'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('address_town') }}</strong>
                                        </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Area <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_area" value="{{$address->area}}">
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
                                    <input type="text" class="form-control border-input" name="address_type" value="{{$address->type}}">
                                    @if ($errors->has('address_type'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('address_type') }}</strong>
                                        </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">House No <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_house_no" value="{{$address->house_no}}">
                                    @if ($errors->has('address_house_no'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('address_house_no') }}</strong>
                                        </span>
                                    @endif
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Street No <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="address_street_no" value="{{$address->street_no}}">
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
                                    <button type="button" class="btn btn-header">Cancel</button>
                                    <button class="btn btn-header btn-back-1">Back</button>
                                    <input type="submit" value="Update" class="btn btn-header">
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
  function addmoreServices(event){
    event.preventDefault();
    $(".services-row").append('<div class="col-sm-4"><div class="child-box-wrap"><div class="row"><div class="col-md-12"><div class="form-group"><label class="control-label">Select Service</label><select class="form-control border-input" name="service_id[]"><option value="" selected disabled selected>Select Service</option>@foreach ($services as $service)<option value="{{$service->id}}">{{ $service->name }}</option>@endforeach</select></div></div></div><div class="row"><div class="col-md-6"><label class="control-label">Service Rate</label><input type="text" class="form-control border-input" name="service_rate[]"></div><div class="col-md-6"><label class="control-label">Enter Time</label><input type="time" class="form-control border-input" name="service_time[]"></div></div></div></div>');
  }
</script>
@include('partials.footer')
@endsection