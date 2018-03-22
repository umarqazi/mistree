<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    <h3>{{$subject}}</h3>
    <br>
    <br>
    <p>{{$msg}}</p>
    <br>
    <br>
    <p>From:</p><br>
    <p>{{$customer->name}}</p><br>
    <p>{{$customer->email}},</p><br>
    <p>{{$customer->con_number}}.</p>
</div>

</body>
</html>