<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrato Listo</title>
    <style>
        /* Fondo general */
        body,
        html {
            height: 100%;
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
            display: flex;
            overflow: hidden;
        }

        /* Estilos para la barra lateral */
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

        /* Estilo para el mensaje y el enlace de descarga */
        .content {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
            text-align: center;
        }

        .message {
            font-size: 24px;
            margin-bottom: 20px;
        }

        /* Estilo del texto como botón de descarga */
        .download-link {
            font-size: 18px;
            color: #007bff;
            cursor: pointer;
            text-decoration: underline;
        }

        .download-link:hover {
            color: #0056b3;
        }

        /* Loader */
        #loader {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
            width: 100px;
            height: 100px;
            z-index: 10;
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

    <!-- Contenido principal -->
    <div class="content">
        <div class="message">
            El contrato está listo.
        </div>
        <!-- Texto como enlace de descarga -->
        <span id="descargar-contrato" class="download-link">
            Descargar contrato
        </span>
    </div>

    <div id="loader">
        <div class="wave"></div>
        <div class="wave"></div>
        <div class="wave"></div>
        <p>Cargando...</p>
        <p>Su contrato está listo, puede descargarlo <span id="download-link"
                style="color: blue; text-decoration: underline; cursor: pointer;">aquí</span></p>
    </div>

    <script>
        // Añadir evento para que el texto "aquí" ejecute la descarga
        document.getElementById('download-link').addEventListener('click', function() {
            var candidatoId = '{{ $candidato->id }}'; // Obtener el ID del candidato

            // Crear la URL de la ruta de descarga del PDF
            var url = `/impresion/descargar/${candidatoId}`;
            console.log('Solicitando archivo PDF desde: ', url);

            // Realizar la solicitud para descargar el archivo PDF
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.responseType = "blob"; // Tipo de respuesta que esperamos (archivo binario)

            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Crear un enlace temporal para descargar el archivo
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(xhr.response); // Crear URL para el blob
                    link.download = `contrato_${candidatoId}.pdf`; // Nombre del archivo para la descarga
                    link.click(); // Hacer clic en el enlace para iniciar la descarga
                } else {
                    // Manejar el error si no se pudo descargar el archivo
                    alert('Error al intentar descargar el archivo PDF.');
                }
            };

            xhr.onerror = function() {
                alert('Ocurrió un error al intentar descargar el archivo PDF.');
            };

            xhr.send(); // Enviar la solicitud
        });
    </script>

</body>

</html>
