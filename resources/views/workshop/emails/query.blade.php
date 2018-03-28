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
    <p>{{$workshop->name}}</p>
    <p>{{$workshop->email}},</p>
    @if($workshop->landline)
        <p>{{$workshop->landline}},</p>
    @endif
    <p>{{$workshop->mobile}}.</p>
</div>

</body>
</html>