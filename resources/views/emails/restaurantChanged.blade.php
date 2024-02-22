<!DOCTYPE html>
<html>
<head>
    <title>Actualización de Restaurante</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .header {
            text-align: center;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .header h1 {
            font-size: 24px;
            color: #333;
        }
        .content p {
            font-size: 16px;
            color: #666;
        }
        .content ul {
            list-style-type: none;
            padding-left: 0;
        }
        .content ul li {
            font-size: 14px;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>{{ $updatedRestaurant->name }}</h1>
            <img src="{{ $updatedRestaurant->thumbnail }}" alt="{{ $updatedRestaurant->name }}">
            <p>Dirección: {{ $updatedRestaurant->location }}</p>
        </div>
        <div class="content">
            <p>Se han realizado los siguientes cambios:</p>
            <ul>
                @foreach($updatedRestaurant->getAttributes() as $key => $value)
                    @if($value != $oldRestaurant[$key])
                        <li>{{ $key }}: {{ $oldRestaurant[$key] }} => {{ $value }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
</body>
</html>