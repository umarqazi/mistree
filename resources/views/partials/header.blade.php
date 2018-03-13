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
                    <li>
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="ti-panel"></i>
                            <p>Stats</p>
                        </a>
                    </li>
                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="ti-bell"></i>
                                <p>Notifications</p>
                                @if(Auth::guard('admin')->check())
                                    <span class="badge notification_badge">{{count(Auth::guard('admin')->user()->unreadNotifications)}}</span>
                                @elseif(Auth::guard('workshop')->check())
                                    <span class="badge notification_badge">{{count(Auth::guard('workshop')->user()->unreadNotifications)}}</span>
                                @endif
                                <b class="caret"></b>
                            </a>
                            <ul class="dropdown-menu">
                                @foreach(Auth::guard('admin')->user()->unreadNotifications as $key => $notification)
                                    <li><a href="#">{{$notification -> type}}</a></li>
                                @endforeach
                                <li><a href="#">Other Notifications</a></li>
                            </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="ti-settings"></i>
                            <p>Settings</p>
                        </a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>