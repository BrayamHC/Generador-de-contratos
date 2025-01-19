<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio - Sistema Generador de Contratos</title>
    <link rel="icon" href="{{ asset('Logo.ico') }}?v={{ time() }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }

        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
            position: relative;
        }

        .content {
            max-width: 800px;
            padding: 40px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            margin-bottom: 20px;
            color: #333;
        }

        p {
            font-size: 20px;
            color: #555;
            margin-bottom: 30px;
        }

        .button-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .button-container a {
            text-decoration: none;
        }

        .login-button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .login-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Botón de Login -->
        <div class="button-container">
            <a href="{{ route('login') }}">
                <button class="login-button">Login</button>
            </a>
        </div>

        <!-- Contenido principal -->
        <div class="content">
            <h1>Sistema Generador de Contratos</h1>
            <p>Bienvenido a Loma, Expertos en TI. Nuestro sistema le permite generar contratos de manera rápida,
                sencilla y segura.</p>
        </div>
    </div>
</body>

</html>
