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
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #006657;
            color: #fff !important;
            font-size: 24px;
            border-radius: 5px;
            text-decoration: none;
        }
        .content-button {
            width: 100%;
            height: fit-content;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white !important;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>TheFoot</h1>
        </div>
        <div class="content">
            <h2>Bienvenido, {{ $user->name }}.</h2>
            <p>Gracias por registrarte en nuestra página. Aquí podrás encontrar una amplia selección de restaurantes y realizar tus pedidos de comida favorita.</p>
            <p>Si tienes alguna pregunta o necesitas ayuda, no dudes en contactarnos.</p>
            <div class="content-button">
                <a href="https://www.youtube.com/watch?v=dQw4w9WgXcQ&ab_channel=RickAstley" class="button">Acceder a la página</a>
            </div>
        </div>
    </div>
</body>
</html>