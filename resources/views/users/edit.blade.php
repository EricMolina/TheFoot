<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Editar usuario</h1>
    <form method="POST" action="{{ route('users.update', $user) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name" value="{{ $user->name }}">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ $user->email }}">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">

        @if($user->profile_image)
            <label for="profile_image">Imagen de perfil actual:</label>
            <img src="{{ asset('images/profiles/' . $user->profile_image) }}" alt="Imagen de perfil">
        @endif
        <label for="profile_image">Actualizar imagen de perfil:</label>
        <input type="file" id="profile_image" name="profile_image">

        <label for="role">Rol:</label>
        <input type="text" id="role" name="role" value="{{ $user->role }}">

        <button type="submit">Actualizar</button>
    </form>
</body>
</html>