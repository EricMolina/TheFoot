@extends('layouts.plantilla_login')

@section('titulo','The Foot - Login')

@section('content')
    <div id="logContainer">
        <h1 id="loginTitle" class="roboto-bold text-align">Login</h1>
        <p class="text-align subTitule roboto-light-italic">Inicia sesión para descubrir y reservar el mejor restaurante</p>
        <form action="" method="post" id="loginForm">
            <label for="email" class="roboto-black">Correo electrónico</label>
            <br>
            <input type="text" name="email" id="email">
            <br>
            <label for="pwd" class="roboto-black">Contraseña</label>
            <br>
            <input type="password" name="pwd" id="pwd">
            <br>
            <button type="submit" id="loginbtn">Iniciar sesión</button>
        </form>
    </div>
@endsection
