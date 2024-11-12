<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cargando...</title>
    <style>
        /* Fondo con degradado y centrar el loader en pantalla */
        body, html {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }

        /* Contenedor del loader */
        #loader {
            text-align: center;
            position: relative;
            width: 100px;
            height: 100px;
        }

        /* Circulo animado con ondas */
        .wave {
            position: absolute;
            border: 4px solid #3498db;
            border-radius: 50%;
            opacity: 0;
            animation: wave-animation 1.5s ease-out infinite;
        }

        /* Configuración de cada onda */
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

    <!-- Loader centrado en pantalla con efecto de ondas -->
    <div id="loader">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <p>Cargando...</p>
    </div>

</body>
</html>
