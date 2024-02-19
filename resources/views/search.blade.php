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
    <form action="" method="post" class="priceFilter">
        <input type="number" name="min_price" id="min_price" class="inputNumFilter border-right roboto-medium" placeholder="Precio min.">
        <input type="number" name="max_price" id="max_price" class="inputNumFilter roboto-medium" placeholder="Precio max.">
    </form>
    <select name="food_types" id="food_types" class="roboto-medium">
        <option value="0">Tipo de cocina</option>
        <option value="0">Tipo de cocina</option>
        <option value="0">Tipo de cocina</option>
    </select>
    <div id="filterMargin"></div>
@endsection
@section('content')
    
@endsection