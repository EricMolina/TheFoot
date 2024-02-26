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
            background-color: #006657;
            color: #fff;
            padding: 20px;
            margin-left: -20px;
            margin-right: -20px;
        }
        .header h1 {
            font-size: 48px;
            margin: 0;
        }
        .content p {
            font-size: 16px;
            color: #666;
        }
        .content h5 {
            font-size: 20px;
            color: #212121;
        }
        .content h2 {
            text-align: center;
            color: black;
            font-size: 32px;
        }
        .content ul {
            list-style-type: none;
            padding-left: 0;
        }
        .content ul li {
            font-size: 14px;
            color: #333;
            margin-bottom: 10px;
        }
        .content ul li span {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>TheFoot</h1>
        </div>
        @php
            $updatedAttributes = $updatedRestaurant->getAttributes();
            $oldAttributes = $oldRestaurant->getAttributes();
        @endphp
        <div class="content">
            <h2>{{ $updatedRestaurant->name }}</h2>
            <h5>Buenos días, {{ $manager }}.</h5>
            <p>Se han realizado los siguientes cambios de este restaurante a su cargo:</p>
            <ul>
                @foreach($updatedAttributes as $key => $value)
                    @if($key !== 'updated_at' && array_key_exists($key, $oldAttributes) && $value != $oldAttributes[$key])
                        <li><span>{{ $key }}:</span> {{ $oldAttributes[$key] }} => {{ $value }}</li>
                    @endif
                @endforeach
            </ul>
            <br>
            <p>Si ha recibido este correo por error o se han realizado cambios que no son de su agrado, por favor, accede a su gestor de restaurantes y realice una reclamación.</p>
        </div>
    </div>
</body>
</html>