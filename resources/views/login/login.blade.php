<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="{{ asset('Logo.ico') }}" type="image/x-icon">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }

        .container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            width: 90%;
            max-width: 400px;
            opacity: 0;
            transform: translateY(20px);
            transition: opacity 0.5s ease, transform 0.5s ease;
        }

        .logo {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo img {
            max-width: 120px;
            height: auto;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 15px;
        }

        .alert {
            padding: 10px;
            margin-bottom: 15px;
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
            margin-bottom: 10px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
        }

        .form-control {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-actions {
            display: flex;
            justify-content: center;
            /* Centrar contenido */
            margin-top: 15px;
        }

        .btn {
            padding: 8px 20px;
            border: none;
            border-radius: 20px;
            background: #2c3e50;
            color: white;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    <div class="container" id="login-container">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/Logo.png') }}" alt="Login Logo">
        </div>

        <!-- Título -->
        <h1>Iniciar Sesión</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <!-- Formulario -->
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
            <div class="form-actions">
                <button type="submit" class="btn">Iniciar Sesión</button>
            </div>
        </form>
    </div>

    <script>
        // Animación inicial
        window.onload = function() {
            var container = document.getElementById('login-container');
            container.style.opacity = '1';
            container.style.transform = 'translateY(0)';
        };
    </script>
</body>

</html>
