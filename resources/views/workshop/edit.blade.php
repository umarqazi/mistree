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
                                    <label class="control-label">Type</label>
                                    <select name="type" class="form-control border-input" required="required">
                                        <option value="">Please Select</option>
                                        <option value="Authorized" @if($workshop->type == "Authorized") {{"selected"}} @endif >Authorized</option>
                                        <option value="Unauthorized" @if($workshop->type == "Unauthorized") {{"selected"}} @endif >UnAuthorized</option>
                                    </select>
                                </div>

                              <div class="form-group">
                                <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                <input type="email" class="form-control border-input" name="email" value="{{$workshop->email}}" readonly>
                              </div>

                              <div class="form-group">
                                <label class="control-label">CNIC Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="cnic" value="{{$workshop->cnic}}">
                                @if ($errors->has('cnic'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('cnic') }}</strong>
                                    </span>
                                @endif
                              </div>

                              <div class="form-group">
                                <label class="control-label">Mobile Number <span class="manadatory">*</span></label>
                                <input type="text" class="form-control border-input" name="mobile" value="{{$workshop->mobile}}">
                                @if ($errors->has('mobile'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('mobile') }}</strong>
                                    </span>
                                @endif
                              </div>
                              <div class="form-group">
                                <label class="control-label">Landline Number <span class="manadatory"></span></label>
                                <input type="text" class="form-control border-input" name="landline" value="{{$workshop->landline}}">
                                @if ($errors->has('landline'))
                                    <span class="help-block">
                                        <strong class="manadatory">{{ $errors->first('landline') }}</strong>
                                    </span>
                                @endif
                              </div>                           
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Team Slot</label>
                                    <select name="team_slot" class="form-control border-input">
                                        <option value="">Please Select</option>
                                        <option value="1" @if($workshop->slots == "1"){{ "selected" }}@endif>1</option>
                                        <option value="2" @if($workshop->slots == "2"){{ "selected" }}@endif>2</option>
                                        <option value="3" @if($workshop->slots == "3"){{ "selected" }}@endif>3</option>
                                        <option value="4" @if($workshop->slots == "4"){{ "selected" }}@endif>4</option>
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
                                @if($images)
                                    <div class="well">
                                        <div class="form-group">
                                            <label class="control-label">Workshop Picture 1:</label>
                                            <div class="clear"></div>
                                            <input type="file" class="form-control" name="images[]">
                                            @if(!empty($images[0]))
                                                <img src="{{ $images[0]->url }}" width="80px" height="80px">
                                            @else
                                                <br>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Workshop Picture 2:</label>
                                            <div class="clear"></div>
                                            <input type="file" class="form-control" name="images[]">
                                            @if(!empty($images[1]))
                                                <img src="{{ $images[1]->url }}" width="80px" height="80px">
                                            @else
                                                <br>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Workshop Picture 3:</label>
                                            <div class="clear"></div>
                                            <input type="file" class="form-control" name="images[]">
                                            @if(!empty($images[2]))
                                                <img src="{{ $images[2]->url }}" width="80px" height="80px">
                                            @else
                                                <br>
                                            @endif
                                        </div>
                                    </div>
                                @endif
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
                                    <label class="control-label">Shop No <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="shop" value="{{$address->shop}}">
                                    @if ($errors->has('shop'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('shop') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div class="form-group">                              
                                    <label class="control-label">Building No <span class="manadatory"></span></label>
                                    <input type="text" class="form-control border-input" name="building" value="{{$address->building}}">
                                    @if ($errors->has('building'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('building') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div class="form-group">                              
                                    <label class="control-label">Street <span class="manadatory"></span></label>
                                    <input type="text" class="form-control border-input" name="street" value="{{$address->street}}">
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
                                    <input type="text" class="form-control border-input" name="block" value="{{$address->block}}">
                                    @if ($errors->has('block'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('block') }}</strong>
                                        </span>
                                    @endif
                                  </div>
                                  <div class="form-group">                              
                                    <label class="control-label">Town <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="town" value="{{$address->town}}">
                                    @if ($errors->has('town'))
                                        <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('town') }}</strong>
                                        </span>
                                    @endif
                                  </div>                                
                                  <div class="form-group">                              
                                    <label class="control-label">City <span class="manadatory">*</span></label>
                                    <input type="text" class="form-control border-input" name="city" value="{{$address->city}}">
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
@include('partials.footer')
@endsection