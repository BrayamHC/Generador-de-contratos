<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
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
        .sidebar form button {
            width: 80%;
            margin-top: 10px 0;
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
            padding: 30px;
            overflow-x: auto; /* Habilitar desplazamiento horizontal si es necesario */
            margin: 0 auto;
            max-width: 1000px; /* Limita el ancho del formulario */
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            margin: 5px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
        .form-group button:hover {
            background-color: #0056b3;
        }
        .error ul {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border-radius: 5px;
            list-style-type: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Barra lateral -->
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
        <main class="main-content">
            <h1>Editar Usuario</h1>
            <div class="user-card">
                <form action="{{ route('usuarios.actualizar', $usuarios->id) }}" method="POST">
                    @csrf
                    @method('PATCH')

                    <!-- Error messages -->
                    @if ($errors->any())
                        <div class="error">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="usuario">Usuario</label>
                        <input type="text" name="usuario" id="usuario" value="{{ old('usuario', $usuarios->usuario) }}">
                    </div>

                    <div class="form-group">
                        <label for="correo">Correo Electrónico</label>
                        <input type="email" name="correo" id="correo" value="{{ old('correo', $usuarios->correo) }}">
                    </div>

                    <div class="form-group">
                        <label for="nombre_completo">Nombre Completo</label>
                        <input type="text" name="nombre_completo" id="nombre_completo" value="{{ old('nombre_completo', $usuarios->nombre_completo) }}">
                    </div>

                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" />
                    </div>

                    <div class="form-group">
                        <button type="submit">Guardar cambios</button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
