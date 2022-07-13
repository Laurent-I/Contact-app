<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel App - @yield('title')</title>
</head>
<body>
    <div>
        @if(session('status'))
            <div style="background-color:red; color:white;">{{session('status')}}</div>
        @endif
        @yield('content')
    </div>
</body>
</html>
