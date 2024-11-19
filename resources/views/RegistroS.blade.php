<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Usuario</title>
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
            justify-content: flex-start; /* El contenido comienza desde la parte superior */
        }
        .sidebar h2 {
            margin: 0 0 20px;
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
            padding: 20px;
            font-size: 18px;
            position: relative; /* Asegura que el botón de "Agregar" se posicione en la esquina superior derecha */
            overflow-y: auto; /* Agregar desplazamiento vertical */
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .titulo-centrado {
            text-align: center;
            margin-bottom: 20px;
            font-size: 2rem; /* Ajuste del tamaño del título */
            font-weight: bold; /* Asegura que el título sea en negrita */
        }
        .user-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto; /* Habilitar desplazamiento horizontal si es necesario */
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .acciones {
            display: flex;
            justify-content: center;
            gap: 10px; /* Espaciado entre botones */
            text-align: center; /* Centrar el texto */
        }
        /* Estilo para los botones de acción */
        .view-button, .edit-button, .delete-button {
            width: 90%; /* Asegura que los botones de acción tengan el mismo tamaño */
            padding: 8px;
            font-size: 14px; /* Tamaño de fuente más pequeño */
            border-radius: 25px; /* Bordes redondeados */
            color: white; /* Letra en blanco */
            margin-bottom: 5px;
        }

        .view-button {
            background-color: #007bff; /* Azul para ver */
        }

        .edit-button {
            background-color: #28a745; /* Verde para editar */
        }

        .delete-button {
            background-color: #dc3545; /* Rojo para eliminar */
        }

        .view-button:hover {
            background-color: #0056b3; /* Azul oscuro al pasar el ratón */
        }

        .edit-button:hover {
            background-color: #218838; /* Verde oscuro al pasar el ratón */
        }

        .delete-button:hover {
            background-color: #c82333; /* Rojo oscuro al pasar el ratón */
        }
        .acciones a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }
        .acciones a:hover {
            color: #0056b3;
        }

        /* Estilo para el formulario */
        .form-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 1000px; /* Ampliar el ancho máximo */
            width: 100%; /* Hacerlo flexible */
            margin: 20px auto; /* Centrar el formulario */
        }

        .form-container .form-group {
            margin-bottom: 15px;
        }

        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .form-container input, .form-container select, .form-container textarea {
            width: 100%;
            padding: 12px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s; /* Transición para suavizar efectos */
        }

        .form-container button:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
        <aside class="sidebar">
            <h2>Menú</h2>
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

        <!-- Contenido principal -->
        <main class="main-content">
            <h3 class="titulo-centrado">Registrar Usuario</h3>

            <div class="form-container">
                <form method="POST" action="{{ route('usuarios.crear') }}">
                    @csrf
                    <!-- Campo de Usuario -->
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                    <!-- Campo de Correo -->
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                    <!-- Campo de Nombre Completo -->
                    <div class="form-group">
                        <label for="nombre_completo">Nombre Completo:</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" required>
                    </div>
                    <!-- Campo de Contraseña -->
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <!-- Confirmar Contraseña -->
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <!-- Campo de Superusuario -->
                    <div class="form-group">
                        <label for="superusuario">Superusuario:</label>
                        <select id="superusuario" name="superusuario" required>
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <!-- Botón de Enviar -->
                    <div class="form-group">
                        <button type="submit">Registrar</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
