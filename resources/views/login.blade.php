<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Altura completa de la ventana */
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; /* Tipografía moderna */
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }
        .container {
            background-color: rgba(255, 255, 255, 0.95); /* Fondo blanco semitransparente */
            padding: 40px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15); /* Sombra suave */
            border-radius: 20px;
            width: 80%;
            max-width: 500px;
            opacity: 0; /* Comienza oculto */
            transform: translateY(20px); /* Comienza desplazado hacia abajo */
            transition: opacity 0.5s ease, transform 0.5s ease; /* Transición suave */
        }
        h1 {
            text-align: center;
            color: #333; /* Color de texto más oscuro */
            margin-bottom: 20px;
        }
        .alert {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            text-align: center;
        }
        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }
        .alert-danger {
            background-color: #f8d7da;
            color: #721c24;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #3498db; /* Color del botón */
            color: white;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 10px;
            transition: all 0.3s ease;
        }
        .btn:hover {
            background-color: #2980b9; /* Color del botón al pasar el mouse */
            transform: translateY(-2px); /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Sombra al hacer hover */
        }
        .btn-register {
            background-color: #2ecc71; /* Color del botón de registro */
        }
        .btn-register:hover {
            background-color: #27ae60; /* Color del botón de registro al pasar el mouse */
        }
    </style>
</head>
<body>
    <div class="container" id="login-container">
        <h1>Iniciar Sesión</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="usuario">Nombre de Usuario</label>
                <input type="text" name="usuario" id="usuario" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <button type="submit" class="btn">Iniciar Sesión</button>
        </form>
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
