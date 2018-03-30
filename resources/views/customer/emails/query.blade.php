<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>

<div>
    <h3>{{$subject}}</h3>
    <p>{{$msg}}</p>
    <br>
    <p>From:</p>
    <p>{{$customer->name}}</p>
    <p>{{$customer->email}},</p>
    <p>{{$customer->con_number}}.</p>
</div>

</body>
</html>