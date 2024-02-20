@extends('layouts.layout_login')
@section('slider')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
@endsection
@section('titulo','The Foot - Login')
@section('regSection')
    <a href="" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    <br>
@endsection
@section('content')
    <img src="{{asset("img/icons/home_icon.svg")}}" id="homeIconRes"><p> <span>></span> Barcelona <span>></span> <strong>Restaurantes en Barcelona</strong><span> > </span><strong class="roboto-bold">Bar Paco</strong></p>
    {{-- CARROUSEL --}}
    <div class="splide" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
              <ul class="splide__list">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel1.jpg')}}" alt="" srcset="" class="splide__slide">
                <img src="{{asset('img/carousel2.jpg')}}" alt="" srcset="" class="splide__slide">
              </ul>
        </div>
      </div>
    {{-- fin carrousel --}}
    <div id="viewResContainer">
        <div class="row">
            <div class="colInfoRes">
                <h1>Bar Paco</h1>
                <img src="{{asset('img/location.png')}}" alt="" srcset="" id="dirIcon" class="iconsBg">
                <p id="dirTxt">Dirección 123</p>
                <br>
                <img src="{{asset('img/icons/money.svg')}}" alt="" srcset="" id="moneyIcon" class="iconsBg2">
                <p id="moneyTxt" class="roboto-regular-italic">Precio medio: <span>50€</span></p>
            </div>
            <div class="colLikes">
                <h1 class="scoreTextView">9.3 <span id="totalScore" class="roboto-regular-italic">/10</span></h1>
                <br>
                <img src="{{asset('img/icons/comm.svg')}}" class="commIcon">
                <p class="commTextView">254</p>
            </div>
        </div>
    </div>
    <div id="opinionContainer">
        <h1>Opiniones</h1>
        <hr class="hrMain">
    
        <hr class="hrMain">
    </div>
    <script>
        var splide = new Splide( '.splide', {
        type    : 'loop',
        perPage: 3,
        rewind : true,
        autoplay: true,
        } );
        splide.mount();
    </script>
@endsection
