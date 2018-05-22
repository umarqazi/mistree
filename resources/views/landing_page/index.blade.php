<!doctype html>
<html class="no-js" lang="zxx">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Mystri - Car Maintenance App</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('layouts/landing-page-includes')
</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Add your site or application content here -->
<div class="wrapper">
    <header class="header-area">
        <!-- Menu Area
        ============================================ -->
        <div id="main-menu" class="sticker">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                        <div class="logo float-left navbar-header">
                            <a class="navbar-brand" href="index.html"><img src="{{asset('img/landing-page-images/logo/logo.png')}}" alt=""></a>
                            <button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#main-menu-2">
                                <i class="fa fa-bars menu-open"></i>
                                <i class="fa fa-times menu-close"></i>
                            </button>
                        </div>
                        <div class="main-menu float-right collapse navbar-collapse" id="main-menu-2">
                            <nav>
                                <ul class="menu one-page">
                                    <li class="active"><a href="#home-area">HOME</a></li>
                                    <li><a href="#about-area">About   </a></li>
                                    <li><a href="#features-area">Features</a></li>
                                    <li><a href="#download">Download </a></li>
                                    <li><a href="/login/">Workshop Signin</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- sliders area
    ============================================ -->
    <div id="home-area" class="main-slider-area bg-oapcity-40 bg-img-1 sm-height-none">
        <div class="container">
            <div class="row">
                <div class="home-sliders clearfix mid-mrg">
                    <div class="col-md-7 col-sm-8">
                        <div class="top-text pt-120">
                            <div class="slider-text">
                                <h2>Car Maintenance App</h2>
                                <p>which connects car owners with workshops listed on its platform. It assists in selecting the best available workshop in the locality and provides online service booking facility.</p>
                                <div class="button-set">
                                    <a class="button" href="#download">
                                        DOWNLOAD
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-4">
                        <div class="slider-imgj">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about area
    ============================================ -->
    <div id="about-area" class="all-about gray-bg ptb-120">
        <div class="container">
            <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div style="margin-top:20px;"><iframe width="560" height="315" src="https://www.youtube.com/embed/wmxf0Gs0jYU?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="about-bottom-left clearfix">
                        <h2>Your Car's Doctor</h2>
                        <p class="about-pb">Mystri app brings transparency by providing you the visibility of workshop’s ratings, reviews and price comparison to select the best car workshop. You can minimize your waiting time by booking your appointments in advance for car service/ repair. On every booking completed you will get loyalty points which can be redeemed at a later stage. It also offers doorstep services to avoid the hassle of visiting workshop.<br>The app maintains the service history of your car.</p>
                        <div class="about-icon">
                            <a class="button" href="#download"> DOWNLOAD </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- features area -->
    <div id="features-area" class="ptb-120 fix">
        <div class="container">
            <div class="about-bottom-left blog-mrg clearfix text-center">
                <h2>Awesome features</h2>
                <p>There are many variations of passages of Lorem Ipsum available, but the majority have <br>suffered alteration in some form, </p>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 featured-left pt-50 pr-0 xs-res">
                    <div class="single-features-list text-right">
                        <div class="feature-list-icon">
                            <i class="fa fa-files-o" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Compare Rates</h3>
                            <p>
                                You can compare services charges of different services from listed workshops.
                            </p>
                        </div>
                    </div>
                    <div class="single-features-list text-right">
                        <div class="feature-list-icon">
                            <i class="fa fa-star-half-full" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Ratings</h3>
                            <p>
                                With this application, you can view rating and reviews of any listed workshop.
                            </p>
                        </div>
                    </div>
                    <div class="single-features-list text-right">
                        <div class="feature-list-icon">
                            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Bookings</h3>
                            <p>
                                Book your appointments in advance to minimize waiting time.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4">
                    <div class="feature-img text-center">
                        <img src="{{asset('img/landing-page-images/mobile/1.png')}}" alt="" />
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 featured-right pt-50 pl-0">
                    <div class="single-features-list text-left">
                        <div class="feature-list-icon">
                            <i class="fa fa-automobile" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Doorstep Services</h3>
                            <p>
                                All registered members can request for doorstep car maintenance services.
                            </p>
                        </div>
                    </div>
                    <div class="single-features-list text-left">
                        <div class="feature-list-icon">
                            <i class="fa fa-file-text" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Vehicle History</h3>
                            <p>
                                You can view the service history and maintenance details of your car.
                            </p>
                        </div>
                    </div>
                    <div class="single-features-list text-left res-features">
                        <div class="feature-list-icon">
                            <i class="fa fa-heart" aria-hidden="true"></i>
                        </div>
                        <div class="feature-list-text">
                            <h3>Loyalty Points</h3>
                            <p>
                                Get loyalty points with every service availed through our app.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- download Area -->
    <div id="download"" class="download-area bg-2 bg-oapcity-40 pt-100 pb-120">
    <div class="container">
        <div class="about-bottom-left download-mrg clearfix text-center">
            <h2>Download The App</h2>
            <p>Get connected with your nearest workshops. </p><p>Workshop owners can also download the app to register their workshops on our platform. </p>
        </div>
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="download-button-set">
                    <a class="download" href="https://play.google.com/store/apps/details?id=com.appcell.mystri" style="margin-right:20px; margin-bottom:15px;" target="_blank">
                        <i class="fa fa-android" aria-hidden="true"></i>
                        <span>
                                        Download for
                                        <span class="large-text-2">Car Owner</span>
                                    </span>
                    </a>
                    <a class="download btn-mobile" href="https://play.google.com/store/apps/details?id=com.appcell.mystriworkshop" style="margin-right:20px;" target="_blank">
                        <i class="fa fa-android" aria-hidden="true"></i>
                        <span>
                                        Download for
                                        <span class="large-text-2">Workshops</span>
                                    </span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- footer area
============================================ -->
<footer class="footer-area pt-100">
    <div class="container">
        <div class="col-md-12 text-center">
            <div class="footer-all">
                <div class="footer-logo logo">
                    <a href="#"><img src="{{asset('img/landing-page-images/logo/2.png')}}" alt=""></a>
                </div>
                <div class="footer-icon">
                    <p>Follow us on Facebook and Youtube to get latest information on our services and promotional details</p>
                    <ul>
                        <li><a href="https://fb.me/mystri.pk/"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="https://www.youtube.com/channel/UChzGiMx6fRT016irjE8cZwQ"><i class="fa fa-youtube" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
                <div class="footer-text">
                                <span>
                                    Copyright©
                                    Mystri.pk
                                    2018. All right reserved.
                                </span>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- start scrollUp
============================================ -->
<div id="toTop">
    <i class="fa fa-chevron-up"></i>
</div>
</div>


<!-- jquery
============================================ -->
<script src="{{asset('js/jquery-1.10.2.js')}}"></script>
<!-- bootstrap JS
============================================ -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- ajax mails JS
============================================ -->
<script src="{{asset('js/ajax-mail.js')}}"></script>
<!-- plugins JS
============================================ -->
<script src="{{asset('js/plugins.js')}}"></script>
<!-- google map api -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD_qDiT4MyM7IxaGPbQyLnMjVUsJck02N0"></script>
<script>
    var myCenter=new google.maps.LatLng(30.249796, -97.754667);
    function initialize()
    {
        var mapProp = {
            center:myCenter,
            scrollwheel: false,
            zoom:15,
            mapTypeId:google.maps.MapTypeId.ROADMAP
        };
        var map=new google.maps.Map(document.getElementById("hastech"),mapProp);
        var marker=new google.maps.Marker({
            position:myCenter,
            animation:google.maps.Animation.BOUNCE,
            icon:'{{asset('img/map-marker.png')}}',
            map: map,
        });
        var styles = [
            {
                stylers: [
                    { hue: "#c5c5c5" },
                    { saturation: -100 }
                ]
            },
        ];
        map.setOptions({styles: styles});
        marker.setMap(map);
    }
    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- main JS
============================================ -->
<script src="{{asset('js/main.js')}}"></script>
</body>
</html>

