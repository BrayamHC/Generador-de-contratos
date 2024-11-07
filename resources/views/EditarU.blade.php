<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuario</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
            display: flex;
            height: 100vh;
        }
        .container {
            display: flex;
            flex: 1;
        }
        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            position: fixed;
            height: 100vh;
            top: 0;
            left: 0;
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
        .sidebar form {
            margin-top: 20px;
        }
        .sidebar button#logout-button {
            background-color: #d9534f;
        }
        .main-content {
            margin-left: 250px;
            padding: 20px;
            font-size: 18px;
            overflow-y: auto;
            flex-grow: 1;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .edit-form {
            background-color: white;
            border-radius: 50px;
            box-shadow: 0 4px 50px rgba(0, 0, 0, 0.1);
            padding: 50px;
            max-height: 550px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background: #f9f9f9;
        }
        .form-group button {
            background-color: #28a745;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 14px;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .error {
            color: red;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
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

        <main class="main-content">
            <h1>Editar Usuario</h1>
            <div class="edit-form">
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
