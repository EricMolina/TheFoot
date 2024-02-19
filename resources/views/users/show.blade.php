<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Detalles del usuario</h1>

    <p><strong>Nombre:</strong> {{ $user->name }}</p>
    <p><strong>Email:</strong> {{ $user->email }}</p>
    <p><strong>Rol:</strong> {{ $user->role }}</p>

    @if($user->profile_image)
        <img src="{{ asset('images/profiles/' . $user->profile_image) }}" alt="Imagen de perfil">
    @else
        <p>No se ha proporcionado ninguna imagen de perfil.</p>
    @endif

    <a href="{{ route('users.edit', $user) }}">Editar</a>
</body>
</html>