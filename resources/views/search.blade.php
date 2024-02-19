@extends('layouts.layout_search')
@section('titulo','The Foot - Restaurantes')

@section('regSection')
    <a href="" id="regBtn" class="roboto-medium">Cerrar sesión</a>
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
@section('content')
    
@endsection