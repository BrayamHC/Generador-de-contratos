<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargando...</title>
    <style>
        /* Fondo general */
        body, html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
            display: flex;
            overflow: hidden;
        }

        /* Estilo de la barra lateral */
        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            bottom: 0;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .sidebar h2 {
            margin: 0 0 20px;
        }

        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
        }

        .sidebar button {
            width: 80%;
            margin: 10px 0;
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s;
        }

        .sidebar button:hover {
            background: #0056b3;
        }

        .sidebar form button {
            width: 80%;
            margin-top: 10px;
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
        }

        .sidebar form button:hover {
            background: #c82333;
        }

        /* Contenedor del loader, centrado independientemente */
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100px;
            height: 100px;
            z-index: 10; /* Asegura que esté al frente */
        }

        /* Efecto de ondas */
        .wave {
            position: absolute;
            border: 4px solid #3498db;
            border-radius: 50%;
            opacity: 0;
            animation: wave-animation 1.5s ease-out infinite;
        }

        .wave:nth-child(1) {
            width: 60px;
            height: 60px;
            animation-delay: 0s;
        }

        .wave:nth-child(2) {
            width: 80px;
            height: 80px;
            animation-delay: 0.3s;
        }

        .wave:nth-child(3) {
            width: 100px;
            height: 100px;
            animation-delay: 0.6s;
        }

        /* Texto de carga */
        #loader p {
            margin-top: 110px;
            font-size: 20px;
            color: #333;
        }

        /* Animación de ondas */
        @keyframes wave-animation {
            0% {
                opacity: 1;
                transform: scale(0.3);
            }
            100% {
                opacity: 0;
                transform: scale(1.5);
            }
        }
    </style>
</head>
<body>

    <!-- Barra lateral fija a la izquierda -->
    <aside class="sidebar">
        <h2>Menú</h2>
        <div class="button-container">
            <button type="button" onclick="location.href='/usuarios'">Usuarios</button>
            <button type="button" onclick="location.href='/candidatos'">Candidatos</button>
        </div>
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" id="logout-button">Cerrar sesión</button>
        </form>
    </aside>

    <!-- Loader centrado en pantalla -->
    <div id="loader">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <p>Cargando...</p>
    </div>

</body>
</html>
