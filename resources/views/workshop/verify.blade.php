<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    Hi {{ $name }},
    <br>
    Thank you for creating an account with us. Don't forget to complete your registration!
    <br>
    <br>
    Please <a href="{{ url('workshop/verify', $verification_code)}}">click here </a> to confirm your email address.
    <br>
    <br>
    <br>
    Team Mystri
    <br>
</div>

</body>
</html>