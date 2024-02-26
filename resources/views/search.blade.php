@extends('layouts.layout_search')
@section('titulo','The Foot - Restaurantes')
@section('regSection')
    
    <div class="row" style="height: 20px">
        <a href="{{ Route('logout')}}" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    
        @if(Auth::User()->role == 'Manager')         
            <a href="{{ Route('myrestaurants')}}" id="regBtn" class="roboto-medium">MIS RESTAURANTES</a>
        @else
            @if(Auth::User()->role == 'Administrator')         
                <a href="{{ Route('crud.restaurants')}}" id="regBtn" class="roboto-medium">GESTIONAR RESTAURANTES</a>            
                <a href="{{ Route('crud.users')}}" id="regBtn" class="roboto-medium">GESTIONAR USUARIOS</a>            
            @endif
        @endif
    
        <br>
    </div>
@endsection
    <style>
        .stars-container img {
            filter: sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(100%);
        }
        .stars-container img:hover~img {
            filter: sepia(100%) hue-rotate(340deg) saturate(99999%) grayscale(100%) !important;
        }
    </style>
@section('filtro')
    {{-- <p style="float: left;">hola</p> --}}
    <div class="searchContainer">
        <img src="{{ asset('img/srcIcon.svg') }}" alt="" srcset="" id="srcIcon">
        <input id="search-name" oninput="getRestaurants()" class="srcInput roboto-medium-italic" type="text" name="name" id="src" placeholder="Tipo de cocina, nombre del restaurante">
    </div>
    <div class="paisContainer">
        <img src="{{ asset('img/location.png') }}" alt="" srcset="" id="locationIcon">
        <p class="roboto-bold">Barcelona</p>
    </div>
    <form class="priceFilter" style="width:16%;padding-right:1%;">
        <input oninput="getRestaurants()" type="number" name="min_price" id="min_price" class="inputNumFilter border-right roboto-medium" placeholder="Precio min." style="float: right;">
        <input oninput="getRestaurants()" type="number" name="max_price" id="max_price" class="inputNumFilter roboto-medium" placeholder="Precio max.">
    </form>
    <div class="dropdown-container">
        <label class="dropdown" for="foodtypes-check">Tipos de comida</label>
        <input id="foodtypes-check" class="dropdown-check" type="checkbox">
        <div class="dropdown-list" name="food_types" id="food-types">
            <span value=""></span>
        </div>
    </div>
    {{-- <input type="number" name="" class="priceFilter" id="valoration" placeholder="nota min."> --}}
    <div class="stars-container priceFilter" id="valoration">
        <img id="star-1" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-2" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-3" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-4" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-5" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-6" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-7" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-8" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-9" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <img id="star-10" src="{{asset('img/half_star.png')}}" alt="" srcset="" class="starFilter starFilter">
        <input type="hidden" id="valoration" value="">
    </div>
    <form class="priceFilter roboto-medium orderby-container" id="orderBy">
        <div>
            <input oninput="getRestaurants()" type="radio" id="order1" name="order1" value="average_price" class="radioFilter"/>
            <label for="order1" class="radioLabel">Precio medio</label>
        </div>
        <div>
            <input oninput="getRestaurants()" type="radio" id="order2" name="order1" value="valoration" class="radioFilter"/>
            <label for="order2" class="radioLabel">Valoración</label>
        </div>
    </form>
    <button id="orderBtn" value="DESC">DESC</button>
    <div id="filterMargin"></div>
@endsection

@section('searchContainer')

    <div id="restaurants-list">
    </div>

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
            let scoreInput = document.getElementById('valoration');
            scoreInput.value = starId.split('-')[1] / 2;
            getRestaurants()
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

        
        function displayRestaurants(restaurants) {
            let restaurantList = document.getElementById('restaurants-list');
            restaurantList.innerHTML = '';
            
            restaurants.forEach(restaurant => {
                console.log(restaurant.valorations_avg_score / 2)
                let avg_score = (Math.round((restaurant.valorations_avg_score / 2) * 100) / 100).toFixed(2);
                
                restaurantList.innerHTML += `
                    <div onclick="window.location = '{{ route('restaurant') }}/?r=${restaurant.id}'" class="resContainer row">
                        <div class="col-res1"><img src="{{asset('images/thumbnails')}}/${restaurant.thumbnail}" alt="" srcset="" class="thumbnail"></div>
                        <div class="col-res2">
                            <div class="restaurant-foodtypes">
                                ${restaurant.foodtypes.map(foodtype => {
                                    return `<img src="{{asset('img/icons/food')}}/${foodtype.icon}" class="resIcon">`
                                }).join("")}
                            </div>
                            <h2 class="roboto-bold titleRes">${restaurant.name}</h2>
                            <p class="roboto-light-italic">${restaurant.location}</p>
                            <p class="roboto-light-italic">Precio medio: <span>${restaurant.average_price}€</span></p>
                            <p class="roboto-bold">Descripción</p>
                            <img src="{{asset('img/icons/quote.svg')}}" class="quote">
                            <p class="roboto-regular-italic">${restaurant.description}</p>
                        </div>
                        <div class="col-res3">
                            <h1 class="scoreText">${avg_score}</h1>
                            <br>
                            <img src="{{asset('img/icons/comm.svg')}}" class="commIcon">
                            <p class="commText">${restaurant.valorations_count}</p>
                        </div>
                        <hr class="hrRes">
                    </div><br>
                `;
            });
        }


        function displayFoodtypes(foodtypes) {
            let foodtypesContainer = document.getElementById('food-types');

            foodtypes.forEach(foodtype => {
                foodtypesContainer.innerHTML += 
                    `<div class="dropdown-option">
                        <input oninput="getRestaurants()" class="foodtype-item" id="foodtype-option-${foodtype.id}" type="checkbox" value="${foodtype.id}" />
                        <label for="foodtype-option-${foodtype.id}" >${foodtype.name}</label>
                    </div>`;
            });
        }


        function displayLoading() {
            let restaurantList = document.getElementById('restaurants-list');
            restaurantList.innerHTML = `<div class="loader-container"><span class="loader"></span></div>`;
        }


        function getRestaurants() {
            displayLoading();

            const name = document.getElementById('search-name').value;
            const minPrice = document.getElementById('min_price').value;
            const maxPrice = document.getElementById('max_price').value;
            const sortOrder = document.getElementById('orderBtn').value;

            let sortElement = document.querySelector('input[name="order1"]:checked');
            let sort = sortElement ? sortElement.value : '';

            let valorationElement = document.getElementById('valoration');
            let valoration = valorationElement.value ? valorationElement.value : "";

            let foodtypes = [];
            document.querySelectorAll('.foodtype-item:checked').forEach((foodtype) => {
                foodtypes.push(foodtype.value)
            })

            const queryString = new URLSearchParams({
                'name': name,
                'min_price': minPrice,
                'max_price': maxPrice,
                'valoration': valoration,
                'food_types': foodtypes,
                'sort': sort,
                'sort_order': sortOrder
            });

            fetch(`{{ route('api.restaurants.list') }}?${queryString.toString()}`)
            .then((res) => res.text())
            .then((responseText) => {
                let restaurants = JSON.parse(responseText);
                displayRestaurants(restaurants);
            })
        }


        function getFoodtypes() {
            fetch("{{ route('api.foodtypes.list') }}")
            .then((res) => res.text())
            .then((responseText) => {
                let foodtypes = JSON.parse(responseText);
                displayFoodtypes(foodtypes);
            })
        }

        getRestaurants();
        getFoodtypes();

</script>
    
@endsection
@section('content')
    
@endsection