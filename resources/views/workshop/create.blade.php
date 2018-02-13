@extends('layouts.master')
@section('title', 'Create New Workshop')
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
                                <h4 class="title">Workshop Management - Create New</h4>
                            </div>
                        </div>
                    </div>
                    <div class="clear20"></div>
                    <form method="POST" action="{{ url('admin/workshops') }}">  
                    {{ csrf_field() }}
                    <div class="content">      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="control-label col-sm-3 text-right">Workshop Name</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control border-input" name="name" required="required">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                  <div class="row">
                                      <label class="control-label col-sm-3 text-right">Owner Name</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control border-input" name="namee" required="required">
                                      </div>
                                  </div>
                              </div>
                              </div>
                        </div>
                    </div>
                    <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-sm-3 text-right">Enter Email</label>
                                    <div class="col-sm-9">
                                    <input type="email" class="form-control border-input" name="email" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <div class="row">
                                  <label class="control-label col-sm-3 text-right">Enter Password</label>
                                  <div class="col-sm-9">
                                  <input type="password" class="form-control border-input" name="password" required="required">
                                  </div>
                              </div>
                          </div>
                       	</div>
                       	<div class="col-md-6">
                          <div class="form-group">
                              <div class="row">
                                  <label class="control-label col-sm-3 text-right">Confirm Password</label>
                                  <div class="col-sm-9">
                                  <input type="password" class="form-control border-input" name="password_confirmation" required="required">
                                  </div>
                              </div>
                          </div>
                       	</div>
                    </div>
                    </div>
                    <div class="content">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <div class="row">
                                    <label class="control-label col-sm-3 text-right">Card Number</label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control border-input" name="card_number" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                              <div class="row">
                                  <label class="control-label col-sm-3 text-right">Contact Number</label>
                                  <div class="col-sm-9">
                                  <input type="text" class="form-control border-input" name="con_number" required="required">
                                  </div>
                              </div>
                          </div>
                          </div>
                    </div>
                    </div>
                    <div class="content">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="control-label col-sm-3 text-right">Type</label>
                                        <div class="col-sm-9">
                                            <select name="type" class="form-control border-input" required="required">
                                                <option value="">Please Select</option>
                                                <option value="1">Authorized</option>
                                                <option value="2">UnAuthorized</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="row">
                                        <label class="control-label col-sm-3 text-right">Team Slot</label>
                                        <div class="col-sm-9">
                                           <select name="team_slot" class="form-control border-input" required="required">
                                               <option value="">Please Select</option>
                                               <option value="1">1</option>
                                               <option value="2">2</option>
                                               <option value="3">3</option>
                                               <option value="4">4</option>
                                           </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
                        <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
						            <div class="row">
						                <div class="col-md-6">
						                    <div class="form-group">
						                        <div class="row">
						                            <label class="control-label col-sm-3 text-right">Opening</label>
						                            <div class="col-sm-9">
						                            <input type="time" class="form-control border-input" name="open_time" required="required">
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
						                  <div class="form-group">
						                      <div class="row">
						                          <label class="control-label col-sm-3 text-right">Closing</label>
						                          <div class="col-sm-9">
						                          <input type="time" class="form-control border-input" name="close_time" required="required">
						                          </div>
						                      </div>
						                  </div>
						                  </div>
						            </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
						            <div class="row">
						                <div class="col-md-6">
						                    <div class="form-group">
						                        <div class="row">
						                            <label class="control-label col-sm-3 text-right">Address Type</label>
						                            <div class="col-sm-9">
						                            <input type="text" class="form-control border-input" name="address_type" required="required">
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
						                  <div class="form-group">
						                      <div class="row">
						                          <label class="control-label col-sm-3 text-right">House No</label>
						                          <div class="col-sm-9">
						                          <input type="text" class="form-control border-input" name="address_house_no" required="required">
						                          </div>
						                      </div>
						                  </div>
						                  </div>
						            </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
						            <div class="row">
						                <div class="col-md-6">
						                    <div class="form-group">
						                        <div class="row">
						                            <label class="control-label col-sm-3 text-right">Street No</label>
						                            <div class="col-sm-9">
						                            <input type="text" class="form-control border-input" name="address_street_no" required="required">
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
						                  <div class="form-group">
						                      <div class="row">
						                          <label class="control-label col-sm-3 text-right">Block</label>
						                          <div class="col-sm-9">
						                          <input type="text" class="form-control border-input" name="address_block" required="required">
						                          </div>
						                      </div>
						                  </div>
						                  </div>
						            </div>
                                </div>
                            </div>
                        </div>
                        </div>

                        <div class="content">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
						            <div class="row">
						                <div class="col-md-6">
						                    <div class="form-group">
						                        <div class="row">
						                            <label class="control-label col-sm-3 text-right">Area</label>
						                            <div class="col-sm-9">
						                            <input type="text" class="form-control border-input" name="address_town" required="required">
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
						                    <div class="form-group">
						                        <div class="row">
						                            <label class="control-label col-sm-3 text-right">Town</label>
						                            <div class="col-sm-9">
						                            <input type="text" class="form-control border-input" name="address_area" required="required">
						                            </div>
						                        </div>
						                    </div>
						                </div>
						                <div class="col-md-6">
						                  <div class="form-group">
						                      <div class="row">
						                          <label class="control-label col-sm-3 text-right">City</label>
						                          <div class="col-sm-9">
						                          <input type="text" class="form-control border-input" name="address_city" required="required">
						                          </div>
						                      </div>
						                  </div>
						                  </div>
						            </div>
                                </div>
                            </div>
                        </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                                                                                          
                                    <div class="text-center">
                                        <button class="btn btn-header">Cancel</button>                               
                                        <input type="submit" value="Save" class="btn btn-header">
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
    </div>

</div>
@endsection