@extends('layouts.master')
@section('title', 'Update Workshop')
@section('content')

@include('partials.header')


<div class="content">
    
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                  <form method="POST" action="{{ url('admin/workshops/'.$workshop->id) }}">
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
                                <label class="control-label">Workshop Name</label>
                                <input type="text" class="form-control border-input" value="{{$workshop->name}}" name="name" required>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Owner Name</label>
                                <input type="text" class="form-control border-input" name="owner_name" value="{{$workshop->owner_name}}" required>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Enter Email</label>
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
                                <label class="control-label">Card Number</label>
                                <input type="text" class="form-control border-input" name="card_number" value="{{$workshop->card_number}}" required>
                              </div>

                              <div class="form-group">
                                <label class="control-label">Contact Number</label>
                                <input type="text" class="form-control border-input" name="con_number" value="{{$workshop->con_number}}" required>
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
                                <label class="control-label">Opening</label>
                                <input type="time" class="form-control border-input" name="open_time" value="{{$workshop->open_time}}" required="required">                                        
                              </div>

                              <div class="form-group">                              
                                <label class="control-label">Closing</label>
                                <input type="time" class="form-control border-input" name="close_time" value="{{$workshop->close_time}}" required="required">                                        
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
                                    <label class="control-label">City</label>
                                    <input type="text" class="form-control border-input" name="address_city" value="{{$address->city}}">
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Block</label>
                                    <input type="text" class="form-control border-input" name="address_block" value="{{$address->block}}">
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Town</label>
                                    <input type="text" class="form-control border-input" name="address_town" value="{{$address->town}}">
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Area</label>
                                    <input type="text" class="form-control border-input" name="address_area" value="{{$address->area}}">
                                  </div>
                                  
                                </div>

                                <div class="col-md-6">

                                  <div class="form-group">                              
                                    <label class="control-label">Address Type</label>
                                    <input type="text" class="form-control border-input" name="address_type" value="{{$address->type}}">
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">House No</label>
                                    <input type="text" class="form-control border-input" name="address_house_no" value="{{$address->house_no}}">
                                  </div>

                                  <div class="form-group">                              
                                    <label class="control-label">Street No</label>
                                    <input type="text" class="form-control border-input" name="address_street_no" value="{{$address->street_no}}">
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