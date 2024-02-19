<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
    <form action="{{ route('api.admin.restaurants.update', $restaurant->id) }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('put')
        <input type="text" name="name" placeholder="name" value="{{ $restaurant->name }}"><br>
        <input type="text" name="description" placeholder="description" value="{{ $restaurant->description }}"><br>
        <input type="text" name="location" placeholder="location" value="{{ $restaurant->location }}"><br>
        <input type="number" name="average_price" placeholder="average_price" value="{{ $restaurant->average_price }}"><br>
        <input type="number" name="status" placeholder="status" value="{{ $restaurant->status }}"><br>
        <input type="number" name="manager_id" placeholder="manager_id" value="{{ $restaurant->manager_id }}"><br><br>

        <label for="">Italiana</label>
        <input type="checkbox" name="foodtypes[]" value="1"><br>
        <label for="">Japonesa</label>
        <input type="checkbox" name="foodtypes[]" value="2"><br><br>

        <input type="file" name="thumbnail" placeholder="thumbnail"><br><br>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>