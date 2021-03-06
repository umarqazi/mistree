<div class="wrapper">
<div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('/home')}}" class="simple-text">
                    <img src="{{asset('img/car-logo.png')}}" class="img-responsive center-block">
                </a>
            </div>

            <ul class="nav">
                <li {{{ (Request::is('home') ? 'class=active' : '') }}}>
                    <a href="{{url('/home')}}">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>            
                <li @if(Request::is('profile/*') || Request::is('profile')) class="active" @endif >
                    <a href="{{url('/profile/')}}">
                        <i class="ti-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li @if(Request::is('leads/*') || Request::is('leads')) class="active" @endif >
                    <a href="{{url('/leads/')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Leads</p>
                    </a>
                </li>
                <li @if(Request::is('ledger/*') || Request::is('ledger')) class="active" @endif >
                    <a href="{{url('/ledger/')}}">
                        <i class="ti-panel"></i>
                        <p>Ledger</p>
                    </a>
                </li>
                <li @if(Request::is('customers/*') || Request::is('customer')) class="active" @endif >
                    <a href="{{url('/customers/')}}">
                        <i class="ti-user"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li @if(Request::is('notifications') || Request::is('notifications/')) class="active" @endif >
                    <a href="{{url('/notifications/')}}">
                        <i class="ti-comment-alt"></i>
                        <p>Notifications</p>
                    </a>
                </li>

                <li  @if(Request::is('queries') || Request::is('workshop-queries/create'))   class="active" @endif >
                    <a href="" class="query_links">
                        <i class="ti-help-alt"></i>
                        <p>Requests</p>
                        <i class="ti-angle-down"></i>
                    </a>
                    <ul class="subnav @if(Request::is('queries') || Request::is('workshop-queries/create') ) show_ul @endif">
                        <li @if(Request::is('workshop-queries/create'))   class="active" @endif ><a href="{{url('/workshop-queries/create/')}}">New Request</a></li>
                        <li @if(Request::is('queries')) class="active" @endif ><a href="{{url('/queries')}}">View Requests</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i><p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
    	</div>
    </div>
