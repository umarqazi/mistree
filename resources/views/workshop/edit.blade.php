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
                                                <input type="text" class="form-control border-input" value="{{$workshop->name}}" name="name" required pattern="^[a-zA-Z\s]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                                <input type="text" class="form-control border-input" name="owner_name" value="{{$workshop->owner_name}}" required pattern="^[a-zA-Z\s]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('owner_name'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Type</label>
                                                <select name="type" class="form-control border-input" required="required"  oninvalid="this.setCustomValidity('Required')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                    <option value="">Please Select</option>
                                                    <option value="Authorized" @if($workshop->type == "Authorized") {{"selected"}} @endif >Authorized</option>
                                                    <option value="Unauthorized" @if($workshop->type == "Unauthorized") {{"selected"}} @endif >Unauthorized</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Enter Email <span class="manadatory">*</span></label>
                                                <input type="email" class="form-control border-input" name="email" value="{{$workshop->email}}" readonly>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">CNIC Number <span class="manadatory">*</span></label>
                                                <input type="text" data-inputmask="'mask': '99999-9999999-9'" placeholder="XXXXX-XXXXXXX-X" class="form-control border-input" name="cnic" pattern="^\d{13}$" title="13 Digits required" value="{{$workshop->cnic}}">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('cnic'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('cnic') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="control-label">Team Slot</label>
                                                <select name="team_slot" class="form-control border-input">
                                                    <option value="">Please Select</option>
                                                    <option value="0" @if($workshop->slots == "0"){{ "selected" }}@endif>0</option>
                                                    <option value="1" @if($workshop->slots == "1"){{ "selected" }}@endif>1</option>
                                                    <option value="2" @if($workshop->slots == "2"){{ "selected" }}@endif>2</option>
                                                    <option value="3" @if($workshop->slots == "3"){{ "selected" }}@endif>3</option>
                                                    <option value="4" @if($workshop->slots == "4"){{ "selected" }}@endif>4</option>
                                                    <option value="5" @if($workshop->slots == "5"){{ "selected" }}@endif>5</option>
                                                    <option value="6" @if($workshop->slots == "6"){{ "selected" }}@endif>6</option>
                                                    <option value="7" @if($workshop->slots == "7"){{ "selected" }}@endif>7</option>
                                                    <option value="8" @if($workshop->slots == "8"){{ "selected" }}@endif>8</option>
                                                    <option value="9" @if($workshop->slots == "9"){{ "selected" }}@endif>9</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Opening <span class="manadatory">*</span></label>
                                                <input type="time" class="form-control border-input" name="open_time" value="{{$workshop->open_time}}" required oninvalid="this.setCustomValidity('Required Format: (example) 12:00 PM')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                @if ($errors->has('open_time'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Closing <span class="manadatory">*</span></label>
                                                <input type="time" class="form-control border-input" name="close_time" value="{{$workshop->close_time}}" required oninvalid="this.setCustomValidity('Required Format: (example) 12:00 PM')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                @if ($errors->has('close_time'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('close_time') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Mobile Number <span class="manadatory">*</span></label>
                                                <input type="text" data-inputmask="'mask': '0399-9999999'" class="form-control border-input" name="mobile" value="{{$workshop->mobile}}" placeholder="0399-9999999" pattern="^\d{11}$" title="11 Digit number required" name="mobile" value="{{ old('mobile') }}" oninvalid="this.setCustomValidity('11 Digits requried')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                @if ($errors->has('mobile'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('mobile') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Landline Number <span class="manadatory"></span></label>
                                                <input type="text" class="form-control border-input" name="landline" pattern="(^$|\d{10,11})" value="{{$workshop->landline}}" oninvalid="this.setCustomValidity('10 or 11 Digit number required')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                                @if ($errors->has('landline'))
                                                    <span class="help-block">
                                                        <strong class="manadatory">{{ $errors->first('landline') }}</strong>
                                                    </span>
                                                @endif
                                            </div>

                                        </div>

                                        <div class="col-md-12">

                                            <ul class="profile-edit-listing">
                                                <li>
                                                    <div class="form-group">
                                                        @if($workshop->profile_pic)
                                                            <img src="{{ $workshop->profile_pic }}" width="100px" height="80px">
                                                        @else
                                                            <br>
                                                        @endif
                                                        <label class="control-label">Profile Picture</label>
                                                        <input type="file" id="profile_picture" class="form-control" name="profile_pic">
                                                        <br>

                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-group">
                                                        @if($workshop->cnic_image)
                                                            <img src="{{ $workshop->cnic_image }}" width="100px" height="80px">
                                                        @else
                                                            <br>
                                                        @endif
                                                        <label class="control-label">CNIC Picture</label>
                                                        <div class="clear"></div>
                                                        <input type="file" id="cnic_picture" class="form-control" name="cnic_image">
                                                    </div>
                                                </li>
                                                @if($images)
                                                    @for($i = 0; $i < 3; $i++)
                                                        <li>
                                                            <div class="form-group">
                                                                @if(!empty($images[$i]))
                                                                    <img src="{{ $images[$i]->url }}" width="100px" height="80px">
                                                                @else
                                                                    <br>
                                                                @endif
                                                                <label class="control-label">Workshop Picture {{ $i + 1 }}:</label>
                                                                <div class="clear"></div>
                                                                <input type="file" class="form-control" name="images[]">
                                                            </div>
                                                        </li>
                                                    @endfor
                                                @endif
                                            </ul>

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
                                                <input type="text" class="form-control border-input" required
                                                       name="shop" value="@if(!empty($address->shop)){{$address->shop}}@endif">
                                                @if ($errors->has('shop'))
                                                    <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('shop') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Building</label>
                                                <input type="text" class="form-control border-input" name="building"
                                                       pattern="[a-zA-Z0-9 ]+" value="@if(!empty($address->building))
                                                {{$address->building}}@endif">
                                                @if ($errors->has('building'))
                                                    <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('building') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Street </label>
                                                <input type="text" class="form-control border-input" name="street" value="@if(!empty($address->street)){{$address->street}}@endif">
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
                                                <input type="text" required class="form-control border-input"
                                                       name="block" value="@if(!empty($address->block)){{$address->block}}@endif">
                                                @if ($errors->has('block'))
                                                    <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('block') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Town <span class="manadatory">*</span></label>
                                                <input type="text" class="form-control border-input" required
                                                       name="town" value="@if(!empty($address->town)){{$address->town}}@endif">
                                                <p class="validity-message"></p>
                                                @if ($errors->has('town'))
                                                    <span class="help-block">
                                            <strong class="manadatory">{{ $errors->first('town') }}</strong>
                                        </span>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">City <span class="manadatory">*</span></label>
                                                <input type="text" class="form-control border-input" name="city" required value="@if(!empty($address->city)){{$address->city}}@endif"
                                                       pattern="/^[\pL\s\-]+$/u" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
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
                                                <a href="{{ url('admin/workshops') }}" class="btn btn-header">Cancel</a>
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
    <script type="text/javascript" src="{{ url('js/workshop-profile.js') }}"></script>
    @include('partials.footer')
@endsection
