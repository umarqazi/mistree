@extends('layouts.master')
@section('title', 'Register New Workshop')
@section('content_login')
    <div class="wrapper login-signup">
        <div class="main-panel">
            <div class="content user_forms register-form">
                <div class="container-fluid">
                    <div class="logo reg-logo">
                        <img src="/img/car-logo.png" class="img-responsive center-block">
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                                    {!! csrf_field() !!}
                                    <div class="header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h4 class="title">Register Your Workshop</h4>
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
                                                        <input type="text" class="form-control border-input" name="name" id="wf_name" value="{{ old('name') }}" required pattern="^[a-zA-Z\s\d]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('name'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                                        <input type="text" class="form-control border-input" name="owner_name" value="{{ old('owner_name') }}" required pattern="^[a-zA-Z\s]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('owner_name'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Type  <span class="manadatory">*</span></label>
                                                        <select name="type" class="form-control border-input" required  oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                            <option value="">Please Select</option>
                                                            <option value="Authorized" @if(old('type') == "Authorized"){{ "selected" }}@endif>Authorized</option>
                                                            <option value="Unauthorized" @if(old('type') == "Unuthorized"){{ "selected" }}@endif>UnAuthorized</option>
                                                        </select>
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('type'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('type') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                                        <input type="email" class="form-control border-input" required="required" name="email" value="{{ old('email') }}" oninvalid="this.setCustomValidity('Enter valid email address.')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('email') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Enter Password <span class="manadatory">*</span></label>
                                                        <input type="password" id="password" required min="6" max="16"  class="form-control border-input" name="password" oninvalid="this.setCustomValidity('6 characters minimum ')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('password'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('password') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Confirm Password <span class="manadatory">*</span></label>
                                                        <input type="password" id="confirm_password" minlength="6"  class="form-control border-input" name="password_confirmation" required>
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('password_confirmation'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('password_confirmation') }}</strong>
                                                </span>
                                                        @endif
                                                        <span id='message'></span>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">CNIC Number <span class="manadatory">*</span></label>
                                                        <input type="text" data-inputmask="'mask': '99999-9999999-9'" pattern="^\d{5}-\d{7}-\d{1}$"  class="form-control border-input" title="13 Digits required" name="cnic" placeholder="XXXXX-XXXXXXX-X" value="{{ old('cnic') }}" required oninvalid="this.setCustomValidity('13 Digits required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('cnic'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('cnic') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Mobile Number <span class="manadatory">*</span></label>
                                                        <input type="text" data-inputmask="'mask': '0399-9999999'" pattern="^03\d{2}-\d{7}$" class="form-control border-input" required title="11 Digit number required" name="mobile" placeholder="0399-99999999" value="{{ old('mobile') }}" oninvalid="this.setCustomValidity('11 Digits requried')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);"  >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('mobile'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('mobile') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Landline Number</label>
                                                        <input type="text" class="form-control border-input" pattern="(^$|\d{10,11})" title="10 or 11 Digit number required"  name="landline" value="{{ old('landline') }}" oninvalid="this.setCustomValidity('10 or 11 Digit number required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                        <p class="validity-message"></p>
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
                                                        <select name="team_slot" class="form-control border-input" required oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                            <option value="0" @if(old('team_slot') == "0"){{ "selected" }}@endif>Please Select</option>
                                                            <option value="1" @if(old('team_slot') == "1"){{ "selected" }}@endif>1</option>
                                                            <option value="2" @if(old('team_slot') == "2"){{ "selected" }}@endif>2</option>
                                                            <option value="3" @if(old('team_slot') == "3"){{ "selected" }}@endif>3</option>
                                                            <option value="4" @if(old('team_slot') == "4"){{ "selected" }}@endif>4</option>
                                                            <option value="5" @if(old('team_slot') == "5"){{ "selected" }}@endif>5</option>
                                                            <option value="6" @if(old('team_slot') == "6"){{ "selected" }}@endif>6</option>
                                                            <option value="7" @if(old('team_slot') == "7"){{ "selected" }}@endif>7</option>
                                                            <option value="8" @if(old('team_slot') == "8"){{ "selected" }}@endif>8</option>
                                                            <option value="9" @if(old('team_slot') == "9"){{ "selected" }}@endif>9</option>
                                                        </select>
                                                        <p class="validity-message"></p>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Opening <span class="manadatory">*</span></label>
                                                        <input type="time" class="form-control border-input" name="open_time" value="{{ old('open_time') }}" required oninvalid="this.setCustomValidity('Required Format: (example) 12:00 PM')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('open_time'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Closing <span class="manadatory">*</span></label>
                                                        <input type="time" class="form-control border-input" name="close_time" required value="{{ old('close_time') }}" oninvalid="this.setCustomValidity('Required Format: (example) 12:00 PM')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
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
                                                        <input type="file" id="cnic_picture" class="form-control" name="cnic_image" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                        <p class="validity-message"></p>
                                                    </div>
                                                    <div class="well">
                                                        <div class="form-group">
                                                            <label class="control-label">Workshop Picture 1:</label>
                                                            <div class="clear"></div>
                                                            <input type="file" class="form-control" name="images[]">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">Workshop Picture 2:</label>
                                                            <div class="clear"></div>
                                                            <input type="file" class="form-control" name="images[]">
                                                        </div>

                                                        <div class="form-group">
                                                            <label class="control-label">Workshop Picture 3:</label>
                                                            <div class="clear"></div>
                                                            <input type="file" class="form-control" name="images[]">
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
                                                        <input type="text" class="form-control border-input" required name="shop" value="{{ old('shop') }}" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('shop'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('shop') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label">Building <span class="manadatory"></span></label>
                                                        <input type="text" class="form-control border-input" name="building"  pattern="[a-zA-Z0-9 ]+" value="{{ old('building') }}" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('building'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('building') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Street <span class="manadatory"></span></label>
                                                        <input type="text" class="form-control border-input" name="street" value="{{ old('street') }}">
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('street'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('street') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>


                                                </div>
                                                <div class="col-md-6">

                                                    <div class="form-group">
                                                        <label class="control-label">Block</label>
                                                        <input type="text" class="form-control border-input" name="block" value="{{ old('block') }}">
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('block'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('block') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">Town <span class="manadatory">*</span></label>
                                                        <input type="text" class="form-control border-input" required name="town" required  value="{{ old('town') }}"  oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" >
                                                        <p class="validity-message"></p>
                                                        @if ($errors->has('town'))
                                                            <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('town') }}</strong>
                                                </span>
                                                        @endif
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="control-label">City <span class="manadatory">*</span></label>
                                                        <input type="text" class="form-control border-input" name="city" required oninvalid="this.setCustomValidity('Invalid Characters')" pattern="[a-zA-Z0-9 ]+" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);" value="{{ old('city') }}">
                                                        <p class="validity-message"></p>
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
                                                <div class="col-md-12">
                                                    <div id="services-box-1">
                                                        <div id="services-container" class="child-box-wrap">
                                                            <br>

                                                            <div class="row category-hatchback">
                                                                <div class="col-md-12">
                                                                    <div class="heading-category">
                                                                        <h3>Hatchback Services</h3>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select Services <span class="manadatory">*</span></label>
                                                                        <select id="hatchback" class="form-control
                                                                border-input chosen-select" name="hatchback[]" multiple>
                                                                            @foreach ($hatchback as $row)
                                                                                <option value="{{$row->id}}" @if(!empty(old
                                                                        ('hatchback')) && in_array($row->id,old
                                                                        ('hatchback'))){{"selected"}}@endif>{{ $row->name }}@if($row->is_doorstep){{ " at doorstep" }}@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('hatchback'))
                                                                            <span class="help-block">
                                                                        <strong class="manadatory">{{ $errors->first
                                                                        ('hatchback') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if(!empty(old('hatchback-rates')))
                                                                @foreach(old('hatchback-rates') as $key => $value)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5></h5>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                                                                    <input type="text" class="form-control
                                                                            border-input" name="hatchback-rates[{{ $key
                                                                            }}]" value="{{ old('hatchback-rates.'.$key)
                                                                            }}" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Time <span class="manadatory">*</span></label>
                                                                                    <select name ="hatchback-times[{{ $key }}]"
                                                                                            class="form-control chosen-select border-input" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                        <option @if(old('hatchback-times.'.$key) == "1.0"){{"selected"}}@endif value="1.0">1.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "1.5"){{"selected"}}@endif value="1.5">1.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "2.0"){{"selected"}}@endif value="2.0">2.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "2.5"){{"selected"}}@endif value="2.5">2.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "3.0"){{"selected"}}@endif value="3.0">3.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "3.5"){{"selected"}}@endif value="3.5">3.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "4.0"){{"selected"}}@endif value="4.0">4.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "4.5"){{"selected"}}@endif value="4.5">4.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "5.0"){{"selected"}}@endif value="5.0">5.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "5.5"){{"selected"}}@endif value="5.5">5.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "6.0"){{"selected"}}@endif value="6.0">6.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "6.5"){{"selected"}}@endif value="6.5">6.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "7.0"){{"selected"}}@endif value="7.0">7.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "7.5"){{"selected"}}@endif value="7.5">7.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "8.5"){{"selected"}}@endif value="8.5">8.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "8.0"){{"selected"}}@endif value="8.0">8.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "9.0"){{"selected"}}@endif value="9.0">9.0 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "9.5"){{"selected"}}@endif value="9.5">9.5 hr</option>
                                                                                        <option @if(old('hatchback-times.'.$key) == "10.0"){{"selected"}}@endif value="10">10 hr</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <div class="row category-sedan">
                                                                <div class="col-md-12">
                                                                    <div class="heading-category">
                                                                        <h3>Sedan/Saloon Services</h3>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select Services <span class="manadatory">*</span></label>
                                                                        <select id="sedan" class="form-control
                                                                border-input chosen-select" name="sedan[]" multiple>
                                                                            @foreach ($sedan as $row)
                                                                                <option value="{{$row->id}}" @if(!empty(old
                                                                        ('sedan')) && in_array($row->id,old
                                                                        ('sedan'))){{"selected"}}@endif>{{
                                                                        $row->name }}@if($row->is_doorstep){{ " at
                                                                        doorstep" }}@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('sedan'))
                                                                            <span class="help-block">
                                                                        <strong class="manadatory">{{ $errors->first
                                                                        ('sedan') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if(!empty(old('sedan-rates')))
                                                                @foreach(old('sedan-rates') as $key => $value)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5></h5>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                                                                    <input type="text" class="form-control
                                                                            border-input" name="sedan-rates[{{ $key
                                                                            }}]" value="{{ old('sedan-rates.'.$key)
                                                                            }}" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Time <span class="manadatory">*</span></label>
                                                                                    <select name ="sedan-times[{{ $key }}]"
                                                                                            class="form-control chosen-select border-input" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                        <option @if(old('sedan-times.'.$key) == "1.0"){{"selected"}}@endif value="1.0">1.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "1.5"){{"selected"}}@endif value="1.5">1.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "2.0"){{"selected"}}@endif value="2.0">2.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "2.5"){{"selected"}}@endif value="2.5">2.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "3.0"){{"selected"}}@endif value="3.0">3.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "3.5"){{"selected"}}@endif value="3.5">3.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "4.0"){{"selected"}}@endif value="4.0">4.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "4.5"){{"selected"}}@endif value="4.5">4.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "5.0"){{"selected"}}@endif value="5.0">5.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "5.5"){{"selected"}}@endif value="5.5">5.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "6.0"){{"selected"}}@endif value="6.0">6.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "6.5"){{"selected"}}@endif value="6.5">6.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "7.0"){{"selected"}}@endif value="7.0">7.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "7.5"){{"selected"}}@endif value="7.5">7.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "8.5"){{"selected"}}@endif value="8.5">8.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "8.0"){{"selected"}}@endif value="8.0">8.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "9.0"){{"selected"}}@endif value="9.0">9.0 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "9.5"){{"selected"}}@endif value="9.5">9.5 hr</option>
                                                                                        <option @if(old('sedan-times.'.$key) == "10.0"){{"selected"}}@endif value="10">10 hr</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <div class="row category-luxury">
                                                                <div class="col-md-12">
                                                                    <div class="heading-category">
                                                                        <h3>Luxury Services</h3>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select Services <span class="manadatory">*</span></label>
                                                                        <select id="luxury" class="form-control
                                                                border-input chosen-select" name="luxury[]" multiple>
                                                                            @foreach ($luxury as $row)
                                                                                <option value="{{$row->id}}" @if(!empty(old
                                                                        ('luxury')) && in_array($row->id,old
                                                                        ('luxury'))){{"selected"}}@endif>{{
                                                                        $row->name
                                                                         }}@if($row->is_doorstep){{ " at doorstep"
                                                                         }}@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('luxury'))
                                                                            <span class="help-block">
                                                                        <strong class="manadatory">{{ $errors->first
                                                                        ('luxury') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            @if(!empty(old('luxury-rates')))
                                                                @foreach(old('luxury-rates') as $key => $value)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5></h5>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                                                                    <input type="text" class="form-control
                                                                            border-input" name="luxury-rates[{{ $key
                                                                            }}]" value="{{ old('luxury-rates.'.$key)
                                                                            }}" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Time <span class="manadatory">*</span></label>
                                                                                    <select name ="luxury-times[{{ $key }}]"
                                                                                            class="form-control chosen-select border-input" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                        <option @if(old('luxury-times.'.$key) == "1.0"){{"selected"}}@endif value="1.0">1.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "1.5"){{"selected"}}@endif value="1.5">1.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "2.0"){{"selected"}}@endif value="2.0">2.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "2.5"){{"selected"}}@endif value="2.5">2.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "3.0"){{"selected"}}@endif value="3.0">3.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "3.5"){{"selected"}}@endif value="3.5">3.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "4.0"){{"selected"}}@endif value="4.0">4.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "4.5"){{"selected"}}@endif value="4.5">4.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "5.0"){{"selected"}}@endif value="5.0">5.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "5.5"){{"selected"}}@endif value="5.5">5.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "6.0"){{"selected"}}@endif value="6.0">6.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "6.5"){{"selected"}}@endif value="6.5">6.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "7.0"){{"selected"}}@endif value="7.0">7.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "7.5"){{"selected"}}@endif value="7.5">7.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "8.5"){{"selected"}}@endif value="8.5">8.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "8.0"){{"selected"}}@endif value="8.0">8.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "9.0"){{"selected"}}@endif value="9.0">9.0 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "9.5"){{"selected"}}@endif value="9.5">9.5 hr</option>
                                                                                        <option @if(old('luxury-times.'.$key) == "10.0"){{"selected"}}@endif value="10">10 hr</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif

                                                            <div class="row category-suv">
                                                                <div class="col-md-12">
                                                                    <div class="heading-category">
                                                                        <h3>SUV/4 &#215 4 Services</h3>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Select Services <span class="manadatory">*</span></label>
                                                                        <select id="suv" class="form-control
                                                                border-input chosen-select" name="suv[]" multiple>
                                                                            @foreach ($suv as $row)
                                                                                <option value="{{$row->id}}" @if(!empty(old
                                                                        ('suv')) && in_array($row->id,old
                                                                        ('suv'))){{"selected"}}@endif>{{ $row->name
                                                                         }}@if($row->is_doorstep){{ " at doorstep"
                                                                         }}@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @if ($errors->has('suv'))
                                                                            <span class="help-block">
                                                                        <strong class="manadatory">{{ $errors->first
                                                                        ('suv') }}</strong>
                                                                    </span>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if(!empty(old('suv-rates')))
                                                                @foreach(old('suv-rates') as $key => $value)
                                                                    <div class="row">
                                                                        <div class="col-md-12">
                                                                            <h5></h5>
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                                                                    <input type="text" class="form-control border-input" name="suv-rates[{{ $key }}]" value="{{ old('suv-rates.'.$key) }}" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="control-label">Service Time <span class="manadatory">*</span></label>
                                                                                    <select name ="suv-times[{{ $key }}]" class="form-control chosen-select border-input" oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="workshopCustomValidation(this);">
                                                                                        <option @if(old('suv-times.'.$key) == "1.0"){{"selected"}}@endif value="1.0">1.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "1.5"){{"selected"}}@endif value="1.5">1.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "2.0"){{"selected"}}@endif value="2.0">2.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "2.5"){{"selected"}}@endif value="2.5">2.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "3.0"){{"selected"}}@endif value="3.0">3.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "3.5"){{"selected"}}@endif value="3.5">3.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "4.0"){{"selected"}}@endif value="4.0">4.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "4.5"){{"selected"}}@endif value="4.5">4.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "5.0"){{"selected"}}@endif value="5.0">5.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "5.5"){{"selected"}}@endif value="5.5">5.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "6.0"){{"selected"}}@endif value="6.0">6.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "6.5"){{"selected"}}@endif value="6.5">6.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "7.0"){{"selected"}}@endif value="7.0">7.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "7.5"){{"selected"}}@endif value="7.5">7.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "8.0"){{"selected"}}@endif value="8.0">8.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "8.5"){{"selected"}}@endif value="8.5">8.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "9.0"){{"selected"}}@endif value="9.0">9.0 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "9.5"){{"selected"}}@endif value="9.5">9.5 hr</option>
                                                                                        <option @if(old('suv-times.'.$key) == "10.0"){{"selected"}}@endif value="10">10 hr</option>
                                                                                    </select>
                                                                                    <p class="validity-message"></p>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- End Row -->

                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <input type="checkbox" value="terms" required>
                                                        <span>I have read and agree to the<a href="/terms"> Terms & Conditions</a></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <a href="{{ url('/login') }}" class="btn btn-header">Cancel</a>
                                                        <button type="button" class="btn btn-header btn-back-2">Back</button>
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
        </div>
    </div>

    <script type="text/javascript" src="{{ url('js/workshop-profile.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/workshop-profile-validation.js') }}"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
 
@endsection