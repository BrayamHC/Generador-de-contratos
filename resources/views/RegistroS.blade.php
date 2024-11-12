<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        /* Establecer la fuente principal y color de fondo */
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);        }

        /* Estilo para el contenedor principal */
        .container {
            display: flex;
            height: 100vh;
        }

        /* Barra lateral */
        .sidebar {
            width: 250px; /* Ancho de la barra lateral */
            background: #f0f0f0; /* Fondo gris claro */
            padding: 20px;
            display: flex;
            flex-direction: column; /* Colocar botones en columna */
            justify-content: space-between; /* Separar botones y el de cerrar sesión */
        }
        
        /* Título de la barra lateral */
        .sidebar h2 {
            margin: 0 0 20px;
            font-size: 24px;
            color: #333; /* Color del texto */
        }

        /* Contenedor de botones */
        .button-container {
            display: flex;
            flex-direction: column; /* Colocar botones en columna */
            align-items: center; /* Centrar los botones horizontalmente */
            flex-grow: 1; /* Para que tome el espacio disponible */
        }

        /* Estilos de los botones de la barra lateral */
        .sidebar button {
            width: 80%; /* Ancho del botón */
            margin: 10px 0; /* Separación vertical entre botones */
            padding: 10px;
            background: #007bff; /* Color de fondo azul */
            color: white;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            cursor: pointer;
            transition: background 0.3s; /* Efecto de transición */
        }

        /* Estilo del botón al pasar el ratón */
        .sidebar button:hover {
            background: #0056b3; /* Color al pasar el ratón sobre el botón */
        }
        .sidebar form #logout-button {
        width: 80%;
        margin-top: 10px;
        padding: 10px;
        background: #dc3545; /* Rojo para el botón de cerrar sesión */
        color: white;
        border: none;
        border-radius: 25px;
        cursor: pointer;
        transition: background 0.3s;
    }
    .sidebar form #logout-button:hover {
        background: #c82333; /* Rojo oscuro al pasar el ratón */
    }

        /* Contenido principal */
        .main-content {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alineación del contenido */
            padding-top: 40px; /* Espacio superior para el título */
            font-size: 24px;
            color: #333; /* Color del texto */
        }

        /* Estilo del formulario */
        .form-container {
            width: 50%; /* Ancho del formulario */
            background: #ffffff; /* Fondo blanco para el formulario */
            border-radius: 10px; /* Bordes redondeados */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Sombra sutil */
            padding: 20px;
        }

        /* Estilo de los grupos de campos */
        .form-group {
            display: flex;
            justify-content: space-between; /* Espaciado entre etiqueta y campo */
            margin-bottom: 15px; /* Espaciado entre grupos de campos */
        }

        .form-group label {
            flex-basis: 45%; /* Ancho de la etiqueta */
            margin-right: 10px; /* Espaciado a la derecha */
            color: #555; /* Color gris para las etiquetas */
        }

        .form-group input, .form-group select {
            flex-basis: 50%; /* Ancho del campo de entrada */
            padding: 8px; /* Espaciado interno */
            border: 1px solid #ccc; /* Borde gris */
            border-radius: 5px; /* Bordes redondeados */
        }

        /* Estilo del botón de guardar */
        .save-button {
            background: #007bff; /* Color azul */
            color: white;
            border: none;
            border-radius: 25px; /* Bordes redondeados */
            padding: 10px 20px; /* Espaciado interno */
            cursor: pointer;
            transition: background 0.3s; /* Efecto de transición */
            float: right; /* Alinear a la derecha */
        }

        /* Estilo del botón al pasar el ratón */
        .save-button:hover {
            background: #0056b3; /* Color al pasar el ratón sobre el botón */
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
            <button type="button" onclick="location.href='/logout'">Cerrar sesión</button>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <div class="form-container">
                <h1>Crear Usuario</h1>
                <form method="POST" action="{{ route('usuarios.crear') }}">
                    @csrf <!-- Protección CSRF -->
                    <div class="form-group">
                        <label for="usuario">Usuario:</label>
                        <input type="text" id="usuario" name="usuario" required>
                    </div>
                    <div class="form-group">
                        <label for="correo">Correo:</label>
                        <input type="email" id="correo" name="correo" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_completo">Nombre Completo:</label>
                        <input type="text" id="nombre_completo" name="nombre_completo" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña:</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label for="superusuario">Superusuario:</label>
                        <select id="superusuario" name="superusuario" required>
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div>
                    <button type="submit" class="save-button">Guardar</button>
                </form>
            </div>
        </main>
    </div>
    <script>
        // Espera a que el DOM esté completamente cargado
        window.onload = function() {
            // Aquí puedes agregar cualquier lógica de JavaScript adicional si es necesario
        };
    </script>
</body>
</html>
