@extends('layouts.layout_login')
@section('slider')
    <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css" rel="stylesheet">
@endsection
@section('titulo', 'The Foot - Login')
@section('regSection')
    <div class="row" style="height: 20px">
        <a href="{{ Route('logout') }}" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>

        @if (Auth::User()->role == 'Manager')
            <a href="{{ Route('logout') }}" id="regBtn" class="roboto-medium">MIS RESTAURANTES</a>
        @else
            @if (Auth::User()->role == 'Administrator')
                <a href="{{ Route('crud.restaurants') }}" id="regBtn" class="roboto-medium">GESTIONAR RESTAURANTES</a>
                <a href="{{ Route('crud.users') }}" id="regBtn" class="roboto-medium">GESTIONAR USUARIOS</a>
            @endif
        @endif

        <br>
    </div>
@endsection
@section('content')
    <img src="{{ asset('img/icons/home_icon.svg') }}" id="homeIconRes">
    <p> <span>></span> Barcelona <span>></span> <strong><a href="{{ route('home') }}" style="color: black;">Restaurantes en
                Barcelona</a></strong><span> > </span><strong class="roboto-bold" id="restaurant-breadcum">Bar Paco</strong>
    </p>
    {{-- CARROUSEL --}}
    <div class="splide" role="group" aria-label="Splide Basic HTML Example">
        <div class="splide__track">
            <ul id="restaurant-images" class="splide__list">
            </ul>
        </div>
    </div>
    {{-- fin carrousel --}}
    <div id="viewResContainer">
        <div class="row">
            <div class="colInfoRes">
                <h1 id="restaurant-name" class="roboto-bold"></h1>
                <img src="{{ asset('img/icons/location.svg') }}" alt="" srcset="" id="dirIcon"
                    class="iconsBg">
                <p id="dirTxt">Dirección 123</p>
                <br>
                <img src="{{ asset('img/icons/money.svg') }}" alt="" srcset="" id="moneyIcon" class="iconsBg">
                <p id="moneyTxt" class="roboto-regular-italic">Precio medio: <span id="restaurant-price"></span></p>
            </div>
            <div class="colLikes">
                <h1 id="restaurant-score" class="scoreTextView"> <span id="totalScore" class="roboto-regular-italic"></span>
                </h1>
                <br>
                <img src="{{ asset('img/icons/comm.svg') }}" class="commIcon">
                <p id="restaurant-comments-count" class="commTextView"></p>
            </div>
        </div>
    </div>
    {{-- formulario para poner comentarios --}}
    <div id="opForm">
        <form id="valorationsForm">
            <label for="score">Puntuación:</label><br>
            <input type="hidden" name="score" id="score" value="">
            <div class="stars-container-iteractable">
                <img id="star-1" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-2" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-3" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-4" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-5" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-6" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-7" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-8" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-9" src="{{ asset('img/half_star.png') }}" alt="star">
                <img id="star-10" src="{{ asset('img/half_star.png') }}" alt="star">
            </div>
            <label for="comment">Comentario:</label><br>
            <textarea id="comment" name="comment"></textarea><br>
            <input type="hidden" id="restaurant_id" name="restaurant_id" value="">
            <input type="submit" value="Enviar">
        </form>
    </div>
    <div id="opinionContainer">
        <div style="display: flex; gap: 10px; align-items: center;">
            <h1 class="roboto-bold">Opiniones</h1>
            <button id="addBtn">Comentar</button>
        </div>
        <hr class="hrMain">
        {{-- Contenido del comentario --}}
        <div id="valorations-container">

        </div>
        <hr class="hrMain">
        {{-- Fin del comentario --}}

    </div>
    <script src="{{ asset('js/restaurant.js') }}"></script>
    <script>
        let starsPainted = [];
        let stars = document.querySelectorAll('.stars-container-iteractable img');
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
            let scoreInput = document.getElementById('score');
            scoreInput.value = starId.split('-')[1];
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


        document.getElementById('valorationsForm').addEventListener('submit', function(event) {
            event.preventDefault();

            let score = document.getElementById('score').value;
            let comment = document.getElementById('comment').value;
            let restaurant_id = document.getElementById('restaurant_id').value;

            fetch('{{ route('api.valorations.store') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        score: score,
                        comment: comment,
                        restaurant_id: restaurant_id
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'ok') {
                        getRestaurant();
                        document.getElementById("addBtn").style.display = "none";
                    } else {
                        console.log('bad');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error.message);
                });
                CerrarAbrirForm();
        });

        function displayRestaurant(restaurant) {
            let avg_score = (Math.round((restaurant.valorations_avg_score / 2) * 100) / 100).toFixed(2);

            document.getElementById('restaurant-breadcum').innerText = restaurant.name;
            document.getElementById('restaurant-name').innerText = restaurant.name;
            document.getElementById('dirTxt').innerText = restaurant.location;
            document.getElementById('restaurant-score').innerText = avg_score;
            document.getElementById('restaurant-comments-count').innerText = restaurant.valorations_count;
            document.getElementById('restaurant-price').innerText = restaurant.average_price + "€";
            document.getElementById('restaurant_id').value = restaurant.id;

            displayRestaurantImages(restaurant.images);
            displayRestaurantValorations(restaurant.valorations);
        }


        function displayRestaurantImages(images) {
            let restaurantImagesContainer = document.getElementById('restaurant-images');

            images.forEach(image => {
                restaurantImagesContainer.innerHTML +=
                    `<img src="{{ asset('images/restaurants/') }}/${image.image_url}" alt="" srcset="" class="splide__slide">`;
            });

            var splide = new Splide('.splide', {
                type: 'loop',
                perPage: 3,
                rewind: true,
                autoplay: true,
            });
            splide.mount();
        }


        function displayRestaurantValorations(valorations) {
            let valorationsContainer = document.getElementById('valorations-container');
            valorationsContainer.innerHTML = "";

            valorations.forEach(valoration => {
                let valorationElement = "";
                let dateObject = new Date(valoration.created_at);
                let valorationDate = dateObject.getUTCDate() + "/" + dateObject.getUTCMonth() + "/" + dateObject
                    .getUTCFullYear();
                let stars = valoration.score;

                valorationElement += `<div><div class="stars-container scoreOp">`;


                for (let i = 1; i <= 10; i++) {
                    if (stars == 0) {
                        valorationElement +=
                            `<img src="{{ asset('img/half_star.png') }}" alt="" srcset="" class="starFilter star-empty starFilter">`;
                    } else {
                        valorationElement +=
                            `<img src="{{ asset('img/half_star.png') }}" alt="" srcset="" class="starFilter star-filled starFilter">`;
                        stars--;
                    }
                }

                valorationElement +=
                    `   </div>
                        <img src="{{ asset('images/profiles') }}/${valoration.user.profile_image ? valoration.user.profile_image : "default.png" }" class="profilePic">
                        <p class="roboto-bold userOp">${valoration.user.name}</p>
                        <p class="roboto-light-italic dateOp">${valorationDate}</p>
                        <br>
                        <p class="op roboto-medium-italic">${valoration.comment}</p>
                    </div><br>`;

                valorationsContainer.innerHTML += valorationElement;
            });
        }


        function getRestaurant() {
            const urlParams = new URLSearchParams(window.location.search);
            const restaurant_id = urlParams.get('r');

            fetch(`{{ route('api.restaurants.show') }}?id=${restaurant_id}`)
                .then((res) => res.text())
                .then((responseText) => {
                    let restaurant = JSON.parse(responseText);
                    displayRestaurant(restaurant);
                })
        }

        getRestaurant();
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
