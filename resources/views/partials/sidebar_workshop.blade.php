
<div class="wrapper">
<div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
                    <img src="{{asset('img/car-logo.png')}}" class="img-responsive center-block">
                </a>
            </div>

            <ul class="nav">
                <li {{{ (Request::is('workshop/home') ? 'class=active' : '') }}}>
                    <a href="{{url('workshop/home')}}">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li {{{ (Request::is('workshop/profile') ? 'class=active' : '') }}}>
                    <a href="{{url('workshop/profile')}}">
                        <i class="ti-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li {{{ (Request::is('workshop/history') ? 'class=active' : '') }}}>
                    <a href="{{url('workshop/history')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Work History</p>
                    </a>
                </li>
                <li {{{ (Request::is('workshop/customers') ? 'class=active' : '') }}}>
                    <a href="{{url('workshop/customers')}}">
                        <i class="ti-user"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li {{{ (Request::is('workshop/requests') ? 'class=active' : '') }}}>
                    <a href="{{url('workshop/requests')}}">
                        <i class="ti-panel"></i>
                        <p>Requests</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i><p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ url('/workshop/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
    	</div>
    </div>
