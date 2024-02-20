@extends('layouts.layout_login')

@section('titulo','The Foot - Login')
@section('regSection')
    <a href="" id="regBtn" class="roboto-medium">REGISTRARSE</a>
    <br>
@endsection
@section('content')
    <div id="logContainer">
        <h1 id="loginTitle" class="roboto-bold text-align">Inicio de sesión</h1>
        <p class="text-align subTitule roboto-light-italic">Inicia sesión para descubrir y reservar el mejor restaurante</p>
        <form action="" method="post" id="loginForm">
            <label for="email" class="roboto-black">Correo electrónico</label>
            <br>
            <input type="email" name="email" id="email" class="logininput">
            <br>
            <label for="pwd" class="roboto-black">Contraseña</label>
            <br>
            <input type="password" name="pwd" id="pwd" class="logininput">
            <br>
            <button type="submit" id="loginbtn">Iniciar sesión</button>
        </form>
    </div>
@endsection
