<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
    @yield('slider')
    <title>@yield('titulo')</title>
</head>
<body>
    @yield('regSection')
    <div id="menuContriner">
        <a href="{{ Route('home')}}"><img src="{{ asset('img/logo.png') }}" alt="" srcset="" id="logo"></a>
    </div>
    @yield('content')
    <div id="footer">
        <img src="{{ asset('img/social/instaFooter.svg') }}" alt="" srcset="" class="footerIcon">
        <img src="{{ asset('img/social/facebookFooter.svg') }}" alt="" srcset="" class="footerIcon">
        <p class="roboto-black-italic">© 2024 La FourchetteSAS - Todos los derechos reservados</p>
        <p style="margin-bottom: 0%" class="roboto-light-italic">Las ofertas promocionales están sujetas a las condiciones que figuran en la página del restaurante. Las ofertas en bebidas alcohólicas están dirigidas únicamente a adultos. El consumo excesivo de alcohol es perjudicial para la salud. Bebe con moderación.</p>
    </div>
</body>
</html>