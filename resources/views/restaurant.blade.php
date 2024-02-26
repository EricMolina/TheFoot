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
<a href=""><img src="{{asset("img/icons/home_icon.svg")}}" id="homeIconRes"><p> <span>></span> Barcelona <span>></span> <strong>Restaurantes en Barcelona</strong></a><span> > </span><strong class="roboto-bold">Bar Paco</strong></p>
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
                <h1 class="roboto-bold">Bar Paco</h1>
                <img src="{{asset('img/icons/location.svg')}}" alt="" srcset="" id="dirIcon" class="iconsBg">
                <p id="dirTxt">Dirección 123</p>
                <br>
                <img src="{{asset('img/icons/money.svg')}}" alt="" srcset="" id="moneyIcon" class="iconsBg">
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
    {{-- formulario para poner comentarios --}}
    <button id="addBtn" class="roboto-bold comBtn">Comentar</button>
    <div id="opForm">
        <div class="stars-container scoreOp">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
        </div>
        <img src="{{asset('img/carousel2.jpg')}}" class="profilePic">
        <p class="roboto-bold userOp">Usuario</p>
        <form action="" method="post">
            <textarea name="comment" id="comment" class="commentBox"></textarea>
            <button type="submit" class="roboto-bold comBtn" style="margin-left: 0.15%">Enviar</button>
        </form>
    </div>
    <div id="opinionContainer">
        <h1 class="roboto-bold">Opiniones</h1>
        <hr class="hrMain">
        {{-- Contenido del comentario --}}
            <div class="stars-container-Fixed scoreOp">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
                <img src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter star-empty starFilter">
            </div>
            <img src="{{asset('img/carousel2.jpg')}}" class="profilePic">
            <p class="roboto-bold userOp">Usuario</p>
            <p class="roboto-light-italic dateOp">20/02/2024</p>
            <br>
            <p class="op roboto-medium-italic">Restaurante con mucho encanto, muy bien situado y muy bien decorado. El atún buenísimo. Para repetir y recomendar. Lo único que los vinos muy caros.</p>
        <hr class="hrMain">
        {{-- Fin del comentario --}}
                
    </div>
    <script src="{{asset('js/restaurant.js')}}"></script>
    <script>
        var splide = new Splide( '.splide', {
        type    : 'loop',
        perPage: 3,
        rewind : true,
        autoplay: true,
        } );
        splide.mount();
    </script>
    <script>
        // Agregar el evento de clic a cada estrella
        let starsPainted = [];
            let stars = document.querySelectorAll('.stars-container img');
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    changeScoreValue(this.id);
                    changeSiblingStyle(this);
                });
                star.addEventListener('mouseover', function() {
                    star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(50%)';
                    let sibling = this.previousElementSibling;
                    while (sibling) {
                        sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(50%)';
                        sibling = sibling.previousElementSibling;
                    }
                });
    
                star.addEventListener('mouseout', function() {
                    if (starsPainted.includes(star)) {
                        star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                    } else {
                        star.style.filter = '';
                    }
                    let sibling = this.previousElementSibling;
                    while (sibling) {
                        if (starsPainted.includes(sibling)) {
                            sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                        } else {
                            sibling.style.filter = '';
                        }
                        sibling = sibling.previousElementSibling;
                    }
                    sibling = this.nextElementSibling;
                    while (sibling) {
                        if (starsPainted.includes(sibling)) {
                            sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                        } else {
                            sibling.style.filter = '';
                        }
                        sibling = sibling.nextElementSibling;
                    }
                });
            });
    
            // Función para cambiar el valor del input "score" al hacer clic en una estrella
            function changeScoreValue(starId) {
                //et scoreInput = document.getElementById('score');
                //scoreInput.value = starId.split('-')[1];
            }
    
            // Función para cambiar el estilo de los elementos hermanos de la estrella seleccionada
            function changeSiblingStyle(star) {
                starsPainted = [];
                starsPainted.push(star);
                star.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                let sibling = star.previousElementSibling;
                while (sibling) {
                    starsPainted.push(sibling);
                    sibling.style.filter = 'sepia(100%) hue-rotate(340deg) saturate(99999%)';
                    sibling = sibling.previousElementSibling;
                }
            }
    </script>
@endsection
