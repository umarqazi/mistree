
<div class="wrapper">
<div class="sidebar" data-background-color="white" data-active-color="danger">

    	<div class="sidebar-wrapper">
            <div class="logo">
                <a href="{{url('admin/home')}}" class="simple-text">
                    <img src="{{asset('img/car-logo.png')}}" class="img-responsive center-block">
                </a>
            </div>

            <ul class="nav">
                <li {{{ (Request::is('admin/home') ? 'class=active' : '') }}}>
                    <a href="{{url('admin/home')}}">
                        <i class="ti-dashboard"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li  @if(Request::is('admin/customers/*') || Request::is('admin/customers')) class="active" @endif >
                    <a href="{{url('admin/customers')}}">
                        <i class="ti-user"></i>
                        <p>Customers</p>
                    </a>
                </li>
                <li  @if(Request::is('admin/cars/*') || Request::is('admin/cars') || Request::is('admin/inactive-cars')) class="active" @endif >
                    <a href="{{url('admin/cars')}}">
                        <i class="ti-car"></i>
                        <p>Cars</p>
                    </a>
                </li>
                <li @if(Request::is('admin/workshops/*') || Request::is('admin/workshops')) class="active" @endif>
                    <a href="{{url('admin/workshops')}}">
                        <i class="ti-view-list-alt"></i>
                        <p>Workshops</p>
                    </a>
                </li>
                <li  @if(Request::is('admin/services/*') || Request::is('admin/services')) class="active" @endif >
                    <a href="{{url('admin/services')}}">
                        <i class="ti-panel"></i>
                        <p>Services</p>
                    </a>
                </li>
                <li  @if(Request::is('admin/top-up/*') || Request::is('admin/top-up')) class="active" @endif >
                    <a href="{{url('admin/top-up')}}">
                        <i class="ti-panel"></i>
                        <p>Top UP</p>
                    </a>
                </li>
                <li @if(Request::is('admin/notifications') || Request::is('admin/notifications/')) class="active" @endif >
                    <a href="{{url('admin/notifications/')}}">
                        <i class="ti-comment-alt"></i>
                        <p>Notifications</p>
                    </a>
                </li>
                <li  @if(Request::is('admin/customer-queries') || Request::is('admin/customer-queries/*') || Request::is('admin/workshop-queries/*') || Request::is('admin/workshop-queries') )   class="active" @endif >
                    <a href="" class="query_links">
                        <i class="ti-help-alt"></i>
                        <p>Requests</p>
                        <i class="ti-angle-down"></i>
                     </a>
                    <ul class="subnav @if(Request::is('admin/customer-queries') || Request::is('admin/customer-queries/*') || Request::is('admin/workshop-queries/*') || Request::is('admin/workshop-queries') ) show_ul @endif">
                        <li @if(Request::is('admin/customer-queries') || Request::is('admin/customer-queries/*'))   class="active" @endif ><a href="/admin/customer-queries/">Customer Queries</a></li>
                        <li @if(Request::is('admin/workshop-queries/*') || Request::is('admin/workshop-queries') )   class="active" @endif ><a href="/admin/workshop-queries/">Workshop Queries</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('/admin/logout') }}"
                        onclick="event.preventDefault();
                                 document.getElementById('logout-form').submit();">
                        <i class="ti-power-off"></i><p>Logout</p>
                    </a>

                    <form id="logout-form" action="{{ url('/admin/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </li>
            </ul>
    	</div>
    </div>
