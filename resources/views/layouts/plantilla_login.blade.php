<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{ URL::to('css/styles.css') }}">
    <title>@yield('titulo')</title>
</head>
<body>
    <div id="menuContriner"></div>
    @yield('content')
</body>
</html>