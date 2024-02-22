@extends('layouts.layout_login')

@section('titulo','The Foot - Registrarse')
@section('regSection')
    <a href="" id="regBtn" class="roboto-medium">INICIAR SESIÓN</a>
    <br>
@endsection
@section('content')
    <div id="logContainer">
        <h1 id="loginTitle" class="roboto-bold text-align">Registrarse</h1>
        <p class="text-align subTitule roboto-light-italic">Inicia sesión para descubrir y reservar el mejor restaurante</p>
        <form action="" method="post" id="loginForm">
            <div class="row">
                <div class="column-3">
                    <label for="user" class="roboto-black">Usuario</label>
                    <br>
                    <input type="text" name="user" id="user" class="logininput register">
                    <br>
                    <label for="email" class="roboto-black">Correo electrónico</label>
                    <br>
                    <input type="email" name="email" id="email" class="logininput register">
                    <br>
                </div>
                <div class="column-3">
                    <label for="pwd" class="roboto-black">Contraseña</label>
                    <br>
                    <input type="password" name="pwd" id="pwd" class="logininput register">
                    <br>
                    <label for="pwd" class="roboto-black">Repite la contraseña</label>
                    <br>
                    <input type="password" name="pwd2" id="pwd2" class="logininput register">
                    <br>
                </div>
                <div class="column-3">
                    <input type="file" name="file" id="file">
                    <div id="imgContainer">
                        <img src="" id="profilePreview" alt="" srcset="" height="100px" width="100px">
                    </div>
                </div>
            </div>
            <button type="submit" id="loginbtn">Registrarse</button>
        </form>
    </div>
    <script src="{{asset("js/getImg.js")}}"></script>
@endsection
