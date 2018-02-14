
<div class="wrapper">
<div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="dashboard.html" class="simple-text">
                    <img src="{{asset('img/car-logo.png')}}" class="img-responsive center-block">
                </a>
            </div>

            <ul class="nav">
                <li class="active">
                    <a href="dashboard.html">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li>
                    <a href="customers.html">
                        <i class="ti-user"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/workshops')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Workshops</p>
                    </a>
                </li>
                <li>
                    <a href="{{url('admin/services')}}">
                        <i class="ti-panel"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li>
                    <a href="notifications.html">
                        <i class="ti-comment-alt"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li>
                    <a href="balance.html">
                        <i class="ti-pencil-alt"></i>
                        <p>Balance Trail</p>
                    </a>
                </li>
                <li>
                    <a href="{{ url('/admin/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" action="{{ url('/workshop/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
    	</div>
    </div>
