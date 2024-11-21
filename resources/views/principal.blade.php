<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Contratos</title>
    <link rel="icon" href="{{ asset('Logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1);
        }

        .sidebar h2 {
            margin: 0 0 10px;
        }

        .logo {
            display: block;
            margin: 10px auto 20px;
            max-width: 150px;
            height: auto;
        }

        .user-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-start;
            margin-top: 20px;
        }

        .sidebar button {
            width: 80%;
            margin: 25px 0;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        }

        .sidebar button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .sidebar form button {
            width: 80%;
            margin-top: 20px;
            /* Separación entre los botones y el botón de cerrar sesión */
            padding: 10px;
            background: #ff0019;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            /* Transición para suavizar efectos */
        }

        .sidebar form button:hover {
            background-color: #a10515;
            /* Color al pasar el ratón sobre el botón */
            transform: translateY(-2px);
            /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra al hacer hover */
        }

        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 40px;
            font-size: 24px;
            text-align: center;
            flex-direction: column;
        }

        /* Animación para la tarjeta */
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Estilo de la tarjeta que contendrá la imagen */
        .card {
            background-color: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 500px;
            width: 100%;
            margin-top: 30px;
            animation: fadeInUp 1s ease-out;
            /* Aplicar la animación */
        }

        .card img {
            max-width: 100%;
            height: auto;
            border-radius: 10px;
            object-fit: cover;
        }

        .card h2 {
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
            <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo">
            <div class="user-info">
                <strong>Usuario:</strong> {{ auth()->user()->usuario }}
            </div>
            <div class="button-container">
                <button type="button" onclick="location.href='/usuarios'">Usuarios</button>
                <button type="button" onclick="location.href='/candidatos'">Candidatos</button>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logout-button">Cerrar sesión</button>
            </form>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <h2 style="text-align: center; font-size: 35px; color: #2c3e50; margin-bottom: 20px;">
                Bienvenido al gestor de contratos
            </h2>
            <!-- Tarjeta que contiene la imagen de contratos -->
            <div class="card">
                <img src="{{ asset('images/contratos.png') }}" alt="Contrato" />
            </div>
        </main>
    </div>
</body>

</html>
