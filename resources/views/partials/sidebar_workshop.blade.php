
<div class="wrapper">
<div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
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
                <li {{{ (Request::is('profile') ? 'class=active' : '') }}}>
                    <a href="{{url('/profile')}}">
                        <i class="ti-user"></i>
                        <p>Profile</p>
                    </a>
                </li>
                <li {{{ (Request::is('leads') ? 'class=active' : '') }}}>
                    <a href="{{url('/leads')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Leads</p>
                    </a>
                </li>
                <li {{{ (Request::is('ledger') ? 'class=active' : '') }}}>
                    <a href="{{url('/ledger')}}">
                        <i class="ti-panel"></i>
                        <p>Ledger</p>
                    </a>
                </li>
                <li {{{ (Request::is('customers') ? 'class=active' : '') }}}>
                    <a href="{{url('/customers')}}">
                        <i class="ti-user"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li {{{ (Request::is('requests') ? 'class=active' : '') }}}>
                    <a href="{{url('/requests')}}">
                        <i class="ti-panel"></i>
                        <p>Requests</p>
                    </a>
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
