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
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
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
            box-shadow: 4px 0 8px rgba(0, 0, 0, 0.1); /* Sombra añadida a la barra lateral */
        }
        .sidebar h2 {
            margin: 0 0 10px;
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
            flex-direction: column; /* Colocar botones en columna */
            align-items: center; /* Centrar los botones horizontalmente */
            flex-grow: 1; /* Para que tome el espacio disponible */
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
            <!-- Mostrar el logo -->
            <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo"> <!-- Ruta del logo -->
            <!-- Mostrar información del usuario -->
            <div class="user-info">
                <strong>Usuario:</strong> {{ auth()->user()->usuario }} <!-- Muestra el nombre del usuario logueado -->
            </div>
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
</body>
</html>
