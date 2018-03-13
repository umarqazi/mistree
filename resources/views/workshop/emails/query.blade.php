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
    <p>{{$workshop->name}}</p><br>
    <p>{{$workshop->email}},</p><br>
    @if($workshop->landline)
        <p>{{$workshop->landline}},</p><br>
    @endif
    <p>{{$workshop->mobile}}.</p>
</div>

</body>
</html>