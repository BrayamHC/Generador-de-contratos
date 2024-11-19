<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Candidato</title>
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
            position: relative;
        }
        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start; /* El contenido comienza desde la parte superior */
            color: black;
        }
        .sidebar h2 {
            margin: 0 0 20px;
            font-size: 24px;
            font-weight: bold;
        }
        .logo {
            display: block;
            margin: 10px auto 20px; /* Centrar el logo y agregar espaciado */
            max-width: 150px; /* Máximo ancho recomendado */
            height: auto; /* Mantener la proporción del logo */
        }
        .user-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center; /* Centrado del nombre de usuario */
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-start; /* Subir los botones un poco */
            margin-top: 20px; /* Ajuste del margen superior */
        }
        .sidebar button {
            width: 80%; /* Ancho del botón */
            margin: 25px 0; /* Separación vertical entre botones */
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s; /* Transición para suavizar efectos */
        }
        .sidebar button:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
        .sidebar form button {
            width: 80%;
            margin-top: 20px; /* Separación entre los botones y el botón de cerrar sesión */
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s; /* Transición para suavizar efectos */
        }
        .sidebar form button:hover {
            background-color: #c82333; /* Color al pasar el ratón sobre el botón */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
        .main-content {
    flex: 1;
    padding: 20px;
    font-size: 18px;
    position: relative; /* Para posicionar el botón "Agregar" */
    overflow-y: auto; /* Activa el desplazamiento vertical */
    overflow-x: hidden; /* Oculta cualquier desplazamiento horizontal */
}

.container {
    display: flex;
    height: 100vh;
    overflow: hidden; /* Asegura que no haya desplazamiento en la vista completa */
}
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .candidato-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-height: none; /* Eliminamos el límite de altura */
            overflow-y: visible; /* Eliminamos el scroll */
        }
        .details-list {
            list-style-type: none;
            padding: 0;
        }
        .details-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center; /* Alinea verticalmente los elementos */
        }
        .details-list li span {
            font-weight: bold;
            margin-right: 10px; /* Espacio entre llave y la línea divisoria */
        }
        .details-list li .divider {
            height: 20px;
            width: 1px;
            background-color: #ddd;
            margin: 0 10px; /* Espacio alrededor de la línea divisoria */
        }

        /* Estilo para el botón de imprimir contrato */
        .print-button-container {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
        }
        .print-button {
            background: #2c3e50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            font-size: 16px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s; /* Transición para suavizar efectos */
        }
        .print-button:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
             <!-- Mostrar el logo -->
             <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo"> <!-- Ruta del logo -->
             <!-- Mostrar información del usuario -->
             <div class="user-info">
                 <strong>Usuario:</strong> {{ auth()->user()->usuario }} <!-- Muestra el nombre del usuario logueado -->
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

        <!-- Botón de Imprimir contrato -->
        @if($candidato->status === 'completo')
        <div class="print-button-container">
            <a href="{{ route('impresion.enviar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
                <button id="imprimir-contrato" class="print-button">Imprimir contrato</button>
            </a>
        </div>
        @endif

        <!-- Contenido principal -->
        <main class="main-content">
            <h2 style="text-align: center; font-size: 27px; color: #2c3e50; margin-bottom: 20px;">
                Información del Candidato
            </h2>
            <div class="candidato-details">
    <!-- Cabecera del formulario -->
    
    <!-- Tabla para mostrar los detalles -->
    <table style="width: 100%; border-collapse: collapse; margin: 0 auto; font-size: 16px; text-align: left;">
        <thead>
            <tr style="background-color: #f4f4f4; border-bottom: 2px solid #ccc;">
                <th style="padding: 10px; width: 40%;">Campo</th>
                <th style="padding: 10px;">Informacion</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Nombre</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->nombre }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Apellido Paterno</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->apellido_paterno }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Apellido Materno</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->apellido_materno }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">RFC</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->rfc ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">CURP</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->curp ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">NSS</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->nss ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Dirección 1</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->direccion1 ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Dirección 2</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->direccion2 ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Estado</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->estado ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Ciudad</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->ciudad ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">CP</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->cp ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">País</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->pais ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Puesto</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->puesto ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Salario Diario</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->salario_diario ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Fecha de Ingreso</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->fecha_ingreso ?? 'No disponible' }}</td>
            </tr>
            <tr>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">Correo Electrónico</td>
                <td style="padding: 10px; border-bottom: 1px solid #ddd;">{{ $candidato->correo_electronico ?? 'No disponible' }}</td>
            </tr>
        </tbody>
    </table>
</div>

        </main>
    </div>
    <script>
        // Añadir evento para que el texto "aquí" ejecute la descarga
        document.getElementById('download-link').addEventListener('click', function() {
            var candidatoId = '{{ $candidato->id }}';  // Obtener el ID del candidato
        
            // Crear la URL de la ruta de descarga del PDF
            var url = `/impresion/descargar/${candidatoId}`;  // Asegúrate de que esta ruta sea la correcta
        
            console.log('Solicitando archivo PDF desde: ', url);
        
            // Realizar la solicitud para descargar el archivo PDF
            var xhr = new XMLHttpRequest();
            xhr.open("GET", url, true);
            xhr.responseType = "blob";  // Tipo de respuesta que esperamos (archivo binario)
        
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Crear un enlace temporal para descargar el archivo
                    var link = document.createElement('a');
                    link.href = URL.createObjectURL(xhr.response);  // Crear URL para el blob
                    link.download = `contrato_${candidatoId}.pdf`;  // Nombre del archivo para la descarga
                    link.click();  // Hacer clic en el enlace para iniciar la descarga
                } else {
                    alert('Error al intentar descargar el archivo.');
                }
            };
        
            xhr.send();  // Enviar la solicitud
        });
    </script>
</body>
</html>
