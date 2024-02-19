<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Crear usuario</h1>
    <form method="POST" action="{{ route('users.store') }}" enctype="multipart/form-data">
        @csrf
        <label for="name">Nombre:</label>
        <input type="text" id="name" name="name">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email">

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password">

        <label for="profile_image">Imagen de perfil:</label>
        <input type="file" id="profile_image" name="profile_image">

        <label for="role">Rol:</label>
        <input type="text" id="role" name="role">

        <button type="submit">Crear</button>
    </form>
</body>
</html>