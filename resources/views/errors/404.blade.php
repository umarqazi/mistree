<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404</title>
    <link href='https://fonts.googleapis.com/css?family=Anton|Passion+One|PT+Sans+Caption' rel='stylesheet' type='text/css'>
    <link href='{{URL::asset('css/404.css')}}' rel='stylesheet' type='text/css'>
</head>
<body>

<div class="error">
    <div class="container-floud">
        <div class="col-xs-12 ground-color text-center">
            <div class="container-error-404">
                <div class="clip"><div class="shadow"><span class="digit thirdDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit secondDigit"></span></div></div>
                <div class="clip"><div class="shadow"><span class="digit firstDigit"></span></div></div>
                <div class="msg">OH!<span class="triangle"></span></div>
            </div>
            @if($NotFound == true)
                <h2 class="h1">Sorry! The Page Couldn't be Found.</h2>
            @elseif($MethodNotFound == true)
                <h2 class="h1">Sorry! The Page Couldn't be Found.</h2>
            @elseif($ModelNotFound == true)
                <h2 class="h1">Sorry! Record Couldn't be Found.</h2>
            @else($ModelNotFound == true)
                <h2 class="h1">Sorry! Record Couldn't be Found.</h2>
            @endif
        </div>
    </div>
</div>
</body>
<script type="text/javascript" src="{{'/js/404.js'}}"></script>
</html>