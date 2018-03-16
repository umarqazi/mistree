<nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar bar1"></span>
                    <span class="icon-bar bar2"></span>
                    <span class="icon-bar bar3"></span>
                </button>
                <a class="navbar-brand" href="#">Dashboard</a>
            </div>
            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown notification_dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p>Notifications</p>
                                @if(Auth::guard('admin')->check() && count(Auth::guard('admin')->user()->unreadNotifications))
                                    <span class="badge notification_badge">{{count(Auth::guard('admin')->user()->unreadNotifications)}}</span>
                                @elseif(Auth::guard('workshop')->check() && count(Auth::guard('workshop')->user()->unreadNotifications))
                                    <span class="badge notification_badge">{{count(Auth::guard('workshop')->user()->unreadNotifications)}}</span>
                                @endif
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu notifications">
                                @if(Auth::guard('admin')->check())
                                    @if( count(Auth::guard('admin')->user()->unreadNotifications) )
                                        @foreach(Auth::guard('admin')->user()->unreadNotifications as $key => $notification)
                                            <li>
                                              <a class="notification_links clearfix" notif-id="{{$notification->id}}" >
                                                <div class="notification_image">
                                                    @if(snake_case(class_basename($notification->type )) == 'new_workshop')
                                                        <img src="{{URL::to('/img/workshop-icon.png')}}">
                                                    @else
                                                        <img src="{{URL::to('/img/Dummy-image.jpg')}}">
                                                    @endif
                                                </div>
                                                <div class="notification_text">
                                                    <div class="notification_msg">
                                                        {{$notification -> data['msg']}}
                                                    </div>
                                                    <div class="text-left notification_date">
                                                        {{$notification->created_at->format('d-m-Y h:i')}}
                                                    </div>
                                                </div>
                                            </a>
                                          </li>
                                        @endforeach
                                        <li><a href="#">Other Notifications</a></li>
                                    @endif
                                @elseif(Auth::guard('workshop')->check())
                                    @if( count(Auth::guard('workshop')->user()->unreadNotifications) )
                                        @foreach(Auth::guard('workshop')->user()->unreadNotifications as $key => $notification)
                                            <li>
                                              <a class="notification_links clearfix" notif-id="{{$notification->id}}" >
                                                <div class="notification_image">
                                                    @if(snake_case(class_basename($notification->type )) == 'new_workshop')
                                                        <img src="{{URL::to('/img/workshop-icon.png')}}">

                                                    @elseif(snake_case(class_basename($notification->type )) == 'minimum_balance')
                                                        <img src="{{URL::to('/img/warning.png')}}">

                                                    @else
                                                        <img src="{{URL::to('/img/Dummy-image.jpg')}}">
                                                    @endif
                                                </div>
                                                <div class="notification_text">
                                                    <div class="notification_msg">
                                                        {{$notification -> data['msg']}}
                                                    </div>
                                                    <div class="text-left notification_date">
                                                        {{$notification->created_at->format('d-m-Y h:i')}}
                                                    </div>
                                                </div>
                                            </a>
                                          </li>
                                        @endforeach
                                        <li><a href="#">Other Notifications</a></li>
                                    @endif
                                @endif
                            </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>