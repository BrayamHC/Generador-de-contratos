<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Contratos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: #FFFDD0; /* Color de fondo */
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px; /* Ancho de la barra lateral */
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column; /* Permitir que los botones se apilen verticalmente */
            justify-content: space-between; /* Separar botones y el de cerrar sesión */
        }
        .sidebar h2 {
            margin: 0 0 20px;
        }
        .button-container {
            display: flex;
            flex-direction: column; /* Colocar botones en columna */
            align-items: center; /* Centrar los botones horizontalmente */
            flex-grow: 1; /* Para que tome el espacio disponible */
        }
        .sidebar button {
            width: 80%; /* Ancho del botón */
            margin: 10px 0; /* Separación vertical entre botones */
            padding: 10px;
            background: #007bff;
            color: white;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            cursor: pointer;
            transition: background 0.3s; /* Efecto de transición al cambiar el color */
        }
        .sidebar button:hover {
            background: #0056b3; /* Color al pasar el ratón sobre el botón */
        }
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Cambiar la alineación vertical */
            padding-top: 40px; /* Espacio superior para el título */
            font-size: 24px;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
            <div class="button-container">
                <button type="button" onclick="location.href='/usuarios'">Usuarios</button> <!-- Navegación a la página de usuarios -->
                <button type="button" onclick="location.href='/candidatos'">Candidatos</button> <!-- Navegación a la página de candidatos -->
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logout-button">Cerrar sesión</button>
            </form>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <h1>Bienvenido al Gestor de Contratos</h1>
        </main>
    </div>
    <script>
        // Espera a que el DOM esté completamente cargado
        window.onload = function() {
            // Selecciona el contenedor
            var container = document.getElementById('login-container');
            // Cambia la opacidad y la posición del contenedor
            container.style.opacity = '1'; // Hacerlo visible
            container.style.transform = 'translateY(0)'; // Volver a la posición original
        };
    </script>
</body>
</html>
