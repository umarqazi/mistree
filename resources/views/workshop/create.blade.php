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
                                                <label class="control-label">Type  <span class="manadatory">*</span></label>
                                                <select name="type" class="form-control border-input">
                                                    <option value="">Please Select</option>
                                                    <option value="Authorized" @if(old('type') == "Authorized"){{ "selected" }}@endif>Authorized</option>
                                                    <option value="Unauthorized" @if(old('type') == "Unuthorized"){{ "selected" }}@endif>UnAuthorized</option>
                                                </select>
                                                @if ($errors->has('type'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('type') }}</strong>
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
                                                <label class="control-label">CNIC Number <span class="manadatory">*</span></label>
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
                                                <label class="control-label">Landline Number</label>
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
                                                <label class="control-label">Team Slot</label>
                                                <select name="team_slot" class="form-control border-input">
                                                    <option value="">Please Select</option>
                                                    <option value="1" @if(old('team_slot') == "1"){{ "selected" }}@endif>1</option>
                                                    <option value="2" @if(old('team_slot') == "2"){{ "selected" }}@endif>2</option>
                                                    <option value="3" @if(old('team_slot') == "3"){{ "selected" }}@endif>3</option>
                                                    <option value="4" @if(old('team_slot') == "4"){{ "selected" }}@endif>4</option>
                                                </select>
                                            </div>

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
                                        <div class="col-md-12">

                                            <div id="services-box-1">
                                                <div id="services-container" class="child-box-wrap">
                                                    <br>

                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <label class="control-label">Select Services <span class="manadatory">*</span></label>
                                                                <select id="services" class="form-control border-input chosen-select" name="services[]" multiple>
                                                                    @foreach ($services as $service)
                                                                        <option value="{{$service->id}}" @if(!empty(old('services')) && in_array($service->id,old('services'))){{"selected"}}@endif>{{ $service->name }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('services'))
                                                                    <span class="help-block">
                                                                        <strong class="manadatory">{{ $errors->first('services') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @if(!empty(old('service-rates')))
                                                        @foreach(old('service-rates') as $key => $value)
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <h5></h5>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Service Rate <span class="manadatory">*</span></label>
                                                                            <input type="text" class="form-control border-input" name="service-rates[{{ $key }}]" value="{{ old('service-rates.'.$key) }}">
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <label class="control-label">Service Time <span class="manadatory">*</span></label>
                                                                            <input type="text" class="form-control border-input" name="service-times[{{ $key }}]" value="{{ old('service-times.'.$key) }}">
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

    <script type="text/javascript" src="{{ url('js/workshop-profile.js') }}"></script>
    @include('partials.footer')
@endsection