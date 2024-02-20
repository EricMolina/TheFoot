@extends('layouts.layout_search')
@section('titulo','The Foot - Restaurantes')

@section('regSection')
    <a href="" id="regBtn" class="roboto-medium">CERRAR SESIÓN</a>
    <br>
@endsection

@section('filtro')
    {{-- <p style="float: left;">hola</p> --}}
    <div class="searchContainer">
        <img src="{{ asset('img/srcIcon.svg') }}" alt="" srcset="" id="srcIcon">
        <input class="srcInput roboto-medium-italic" type="text" name="src" id="src" placeholder="Tipo de cocina, nombre del restaurante">
    </div>
    <div class="paisContainer">
        <img src="{{ asset('img/location.png') }}" alt="" srcset="" id="locationIcon">
        <p class="roboto-bold">Barcelona</p>
    </div>
    <form class="priceFilter">
        <input type="number" name="min_price" id="min_price" class="inputNumFilter border-right roboto-medium" placeholder="Precio min.">
        <input type="number" name="max_price" id="max_price" class="inputNumFilter roboto-medium" placeholder="Precio max.">
    </form>
    <select name="food_types" id="food_types" class="roboto-medium">
        <option value="0">Tipo de cocina</option>
        <option value="0">Tipo de cocina</option>
        <option value="0">Tipo de cocina</option>
    </select>
    <input type="number" name="" class="priceFilter" id="valoration" placeholder="nota min.">
    <form class="priceFilter roboto-medium" id="orderBy">
        <p id="orderTxt">Ordenar por:</p>
        <input type="radio" id="order1" name="order1" value="precio" class="radioFilter"/>
        <label for="price" class="radioLabel">Precio medio</label>
        <input type="radio" id="order2" name="order1" value="precio" class="radioFilter"/>
        <label for="price" class="radioLabel">Valoración</label>
    </form>
    <button id="orderBtn">ASC</button>
    <div id="filterMargin"></div>
@endsection

@section('searchContainer')
{{-- Inicio del bloque del restaurante --}}
    <div class="resContainer row">
        <div class="col-res1"><img src="{{asset('img/restauranteImg/fr-FR.png')}}" alt="" srcset="" class="thumbnail"></div>
        <div class="col-res2">
            <img src="{{asset('img/icons/food/bowl.svg')}}" class="resIcon">
            <img src="{{asset('img/icons/food/bowl.svg')}}" class="resIcon">
            <h2 class="roboto-bold titleRes">Restaurante</h2>
            <p class="roboto-light-italic">Dirección inventada 123</p>
            <p class="roboto-light-italic">Precio medio: <span>10.50€</span></p>
            <p class="roboto-bold">Comentario destacado</p>
            <img src="{{asset('img/icons/quote.svg')}}" class="quote">
            <p class="roboto-regular-italic">Comentario de un usuario Comentario de un usuario Comentario de un usuario Comentario de un usuario Comentario de un usuario Comentario de un usuario</p>
        </div>
        <div class="col-res3">
            <h1 class="scoreText">9.3</h1>
            <br>
            <img src="{{asset('img/icons/comm.svg')}}" class="commIcon">
            <p class="commText">254</p>
        </div>
    </div>
    <hr class="hrRes">
{{-- Final del bloque --}}
    
@endsection
@section('content')
    
@endsection