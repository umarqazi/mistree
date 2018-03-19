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
                                            <input type="text" class="form-control border-input" name="name" value="{{ old('name') }}" required pattern="^[a-zA-Z\s]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('name'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Owner Name <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="owner_name" value="{{ old('owner_name') }}"required pattern="^[a-zA-Z\s]+$" oninvalid="this.setCustomValidity('Invalid Characters')" oninput="setCustomValidity('')" onfocusout="myCustomValidation(this);">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('owner_name'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('owner_name') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Type  <span class="manadatory">*</span></label>
                                            <select name="type" class="form-control border-input" required>
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
                                            <input type="email" class="form-control border-input" required="required" name="email" value="{{ old('email') }}">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Enter Password <span class="manadatory">*</span></label>
                                            <input type="password" id="password" required class="form-control border-input" name="password">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('password'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Confirm Password <span class="manadatory">*</span></label>
                                            <input type="password" id="confirm_password" required class="form-control border-input" name="password_confirmation">
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
                                            <input type="text" class="form-control border-input" pattern=".{13,}" title="13 Digits required" name="cnic" value="{{ old('cnic') }}">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('cnic'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('cnic') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Mobile Number <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" name="mobile" pattern=".{11,}"   required title="Number should be of 11 digits" value="{{ old('mobile') }}">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('mobile'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('mobile') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Landline Number</label>
                                            <input type="text" class="form-control border-input" name="landline" value="{{ old('landline') }}"  pattern=".{11,}" title="Number should be of 11 digits">
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
                                                <option value="0" @if(old('team_slot') == "0"){{ "selected" }}@endif>0</option>
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
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Opening <span class="manadatory">*</span></label>
                                            <input type="time" class="form-control border-input" name="open_time" value="{{ old('open_time') }}" required>
                                            <p class="validity-message"></p>
                                            @if ($errors->has('open_time'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('open_time') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Closing <span class="manadatory">*</span></label>
                                            <input type="time" class="form-control border-input" name="close_time" value="{{ old('close_time') }}" required>
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
                                            <input type="text" class="form-control border-input" name="shop" required value="{{ old('shop') }}">
                                            @if ($errors->has('shop'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('shop') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Building <span class="manadatory"></span></label>
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
                                            <input type="text" class="form-control border-input" required name="block" value="{{ old('block') }}">
                                            <p class="validity-message"></p>
                                            @if ($errors->has('block'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('block') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">Town <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" required name="town" value="{{ old('town') }}" >
                                            <p class="validity-message"></p>
                                            @if ($errors->has('town'))
                                                <span class="help-block">
                                                    <strong class="manadatory">{{ $errors->first('town') }}</strong>
                                                </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label">City <span class="manadatory">*</span></label>
                                            <input type="text" class="form-control border-input" required name="city" value="{{ old('city') }}">
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
                                                                        <select name ="service-times[{{ $key }}]" class="form-control chosen-select border-input">
                                                                            <option @if(old('service-times.'.$key) == "1.0"){{"selected"}}@endif value="1.0">1.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "1.5"){{"selected"}}@endif value="1.5">1.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "2.0"){{"selected"}}@endif value="2.0">2.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "2.5"){{"selected"}}@endif value="2.5">2.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "3.0"){{"selected"}}@endif value="3.0">3.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "3.5"){{"selected"}}@endif value="3.5">3.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "4.0"){{"selected"}}@endif value="4.0">4.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "4.5"){{"selected"}}@endif value="4.5">4.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "5.0"){{"selected"}}@endif value="5.0">5.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "5.5"){{"selected"}}@endif value="5.5">5.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "6.0"){{"selected"}}@endif value="6.0">6.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "6.5"){{"selected"}}@endif value="6.5">6.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "7.0"){{"selected"}}@endif value="7.0">7.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "7.5"){{"selected"}}@endif value="7.5">7.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "8.0"){{"selected"}}@endif value="8.0">8.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "8.5"){{"selected"}}@endif value="8.5">8.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "9.0"){{"selected"}}@endif value="9.0">9.0 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "9.5"){{"selected"}}@endif value="9.5">9.5 hr</option>
                                                                            <option @if(old('service-times.'.$key) == "10.0"){{"selected"}}@endif value="10">10 hr</option>
                                                                        </select>
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
                                            <span>I have read and agree to the<a data-toggle="modal" data-target="#myModal"> Terms & Conditions</a></span>
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
@endsection


  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Terms & Conditions</h4>
        </div>
        <div class="modal-body">
            <p>The Service Provider (including workshop, car service workshop that deals with car servicing, repairing and/or provides related facilities) shall be bound by the following terms and conditions contained herein;</p>
            <ul>
                <li>The Service Provider must facilitate the User on the services requested through the Mystri Network. The Service Provider is under a duty to provide the services on the represented time. </li>
                <li>Service Providers within the Mystri Network must respond to appointments (“<b>leads</b>”) within 30 minutes during standard working hours. The failure to do so will allow the car owner (herein after ‘<b>User</b>’) to choose another Service _Provider unless the lead has been effectively accepted.</li>
                <li>Continuous failure to respond to the leads will give Mystri the discretion to remove the Service Provider’s account from the Network.</li>
                <li>Inactivity of the Service Provider on their account for a continuous period of 60 days will allow the Mystri Network to terminate and remove such an account. </li>
                <li>The Service Providers are prohibited from contacting the Users directly without scheduling leads through the Mystri Network.</li>
                <li>The Service Provider is under a duty to provide fair and reasonable rates for their services on the Mystri Network. Reasonableness to be determined according to the practices of other Service Providers in the market. Moreover, the Service Provider must ensure that the services being offered to the User are of the highest quality.</li>
                <li>The Service Provider in under a duty to abide by and honor the prices and services represented by them on the Mystri Network.</li>
                <li>The Service provider is required to maintain a minimum balance of PKR 150/- in their account to effectively receive leads from the Users. Failure to maintain sufficient balance will result in the service provider becoming inaccessible to the User for bookings and will not appear in the search results on Mystri Network, until such failure is cured. </li>
                <li>If the Mystri Network providers any discount offers on services to the User, the Service providers shall receive compensation for the offers accordingly. The mode of such compensation will be decided depending on the particular circumstances.   </li>
                <li>The Service Provider’s visibility on Mystri Network is based solely on the services offered, location of the Service Provider as well as the reviews and ratings by the Users. It is the Users choice to choose any Service Provider they want. Mystri will in no way be responsible and/or liable for the reviews and ratings provided.</li>
                <li>The Service Providers are responsible for collecting and remitting all applicable taxes based on the tax requirements of Pakistan. </li>
                <li>New Service Providers, not reviewed or rated, shall be exclusively visible on the Network as the features of the Mystri Network allow as per their discretion. The Mystri Networks shall not be liable for direct, indirect, incidental, special, consequential or exemplary damages, resulting from any aspect of the use of the Mystri Network, whether the damages arise from use or misuse of the Mystri Network or the service, from inability to use the Mystri Network, or the interruption, suspension, modification, alteration, or termination of the Mystri Network</li>
                <li>The Mystri Network is only a facilitator between the User and the Service Provider. Any contract for services between the User and the Service Provider shall strictly be a bipartite contract and the Mystri Network shall not be a party to the same. The Mystri Network is not required to mediate or resolve any dispute or disagreement between the User and the Service Providers.</li>
                <li>The Service Providers further acknowledge and agree that Mystri may, in its sole discretion, preserve or disclose the content on the Network, as well as the information, such as email addresses, IP addresses, timestamps, and other user information, if required to do so by law or in the good faith belief that such preservation or disclosure is reasonably necessary to: comply with legal process; enforce these terms; respond to claims that any content violates the rights of third-parties; respond to claims that contact information (e.g. phone number, street address) of a third-party has been posted or transmitted without their consent or as a form of harassment; protect the rights, property, or personal safety of Mystri Network, its users or the general public.</li>
                <li>The Service Provider agrees to not post any content on the Network;
                    <ul>
                        <li>that includes personal or identifying information about another person without that person's explicit consent;</li>
                        <li>that is false, deceptive, misleading, deceitful, misinformative, or constitutes "bait and switch"</li>
                        <li>that infringes any patent, trademark, trade secret, copyright or other proprietary rights of any party, or content that the Service Provider does not have a right to make available under any law or under contractual or fiduciary relationships;</li>
                        <li>that constitutes or contains any form of advertising or solicitation if: posted in areas of the Mystri Network which are not designated for such purposes; or emailed to Users who have not indicated in writing their consent to be contacted about other services, products or commercial interests.</li>
                        <li>that employs misleading email addresses, or forged headers or otherwise manipulated identifiers in order to disguise the origin of content transmitted through the service.</li>
                        <li>collect personal data about other users for commercial or unlawful purposes;</li>
                        <li>attempt to gain unauthorized access to Mystri’s server systems or engage in any activity that disrupts, diminishes the quality of, interferes with the performance of, or impairs the functionality of, the service or the Mystri Network;</li>
                    </ul>
                </li>
                <li>Mystri reserves the right, at its sole discretion, to change, modify or otherwise alter these terms and conditions at any time. Such modifications shall become effective immediately upon the posting thereof. The Service Provider must review this agreement on a regular basis to keep themselves apprised of any changes.</li>
                <li>The Mystri Network shall not be required to notify the User of any changes made to the Terms of Use. The revised Terms of Use shall be made available on the Platform. You are requested to regularly visit the platform to view the most current Terms of Use. It shall be the User’s responsibility to check these Terms of Use periodically for changes. The continued use of the Network, following changes to the Terms of Use, will constitute acceptance of those changes. Use of the Network and the Platform Services is subject to the most current version of the Terms of Use made available on the Platform at the time of such use.</li>                
            </ul>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>