<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invitation</title>
</head>
<body>
        <h1 style="text-align: center; color: #0095FF;">Sked</h1>
        <p>Your sked <strong>{{$event->name}}</strong> is over</p>
        <p>The date(s) recommended are/is:</p>
        <ul>
        @foreach($dates as $date)
            <li>{{ Carbon\Carbon::parse($date->date)->format('F jS') }} at {{$date->time}}</li>
            @endforeach
        </ul>
</body>
</html>