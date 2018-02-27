<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('img/apple-icon.png')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('img/favicon.png')}}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    <title>@yield('title')</title>

    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

    <!-- Bootstrap core CSS     -->

    <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />

    <!-- Animation library for notifications   -->

    <link href="{{asset('css/animate.min.css')}}" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="{{asset('css/paper-dashboard.css')}}" rel="stylesheet" />

    <!-- Chosen -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.css">

    <!--  Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">    

    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="{{asset('css/themify-icons.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('css/responsive.css')}}" rel="stylesheet">
    <!-- <link href="{{asset('css/responsive.css')}}" rel="stylesheet"> -->

    <!-- Datatables -->
    <link href="{{asset('css/dataTables.min.css')}}" rel="stylesheet" />

    <script src="{{asset('js/jquery-1.10.2.js')}}" type="text/javascript"></script>

</head>
<body>

    <div class="wrapper-container">

        @if (Auth::guard('admin')->check())
        
            @include('partials.sidebar')
            <div class="main-panel">
                @yield('content')
            </div>
        @elseif (Auth::guard('workshop')->check())
        
            @include('partials.sidebar_workshop')
            <div class="main-panel">
                @yield('content')
            </div>
        @else         
            @yield('content_login')      
        @endif

    </div> <!-- /Wrapper-container -->
    </div>  <!-- /wrapper  -->


    
    <script src="{{asset('js/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/bootstrap-checkbox-radio.js')}}"></script>
    <script src="{{asset('js/chartist.min.js')}}"></script>
    <script src="{{asset('js/bootstrap-notify.js')}}"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
    <script src="{{asset('js/paper-dashboard.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.3/chosen.jquery.min.js"></script>
    <script src="{{asset('js/custom.js')}}"></script>
    <script src="{{asset('js/dataTables.min.js')}}"></script>

	<!-- <script type="text/javascript">
    	$(document).ready(function(){

        	demo.initChartist();

        	$.notify({
            	icon: 'ti-gift',
            	message: "Welcome to <b> My Mistri</b> - some welcome message goes here."

            },{
                type: 'success',
                timer: 4000
            });

    	});
	</script> -->
</body>
</html>
