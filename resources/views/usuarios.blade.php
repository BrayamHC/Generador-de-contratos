<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuarios</title>
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
            justify-content: flex-start;
        }
        .sidebar h2 {
            margin: 0 0 20px;
        }
        .logo {
            display: block;
            margin: 10px auto 20px;
            max-width: 150px;
            height: auto;
        }
        .user-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
        }
        .button-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex-grow: 1;
            justify-content: flex-start;
            margin-top: 20px;
        }
        .sidebar button, .sidebar form button {
            width: 80%;
            margin: 25px 0;
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        }
        .sidebar button:hover, .sidebar form button:hover {
            background-color: #2980b9;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .sidebar form button {
            background: #dc3545;
            margin-top: 20px; /* Separación entre los botones y el botón de cerrar sesión */
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .sidebar form button:hover {
            background-color: #c82333;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            font-size: 18px;
            position: relative;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .user-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            overflow-x: auto;
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
            gap: 10px;
            text-align: center;
        }
        .view-button, .edit-button, .delete-button {
            width: 90%;
            padding: 8px;
            font-size: 14px;
            border-radius: 25px;
            color: white;
            margin-bottom: 5px;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        }
        .view-button {
            background-color: #007bff;
        }
        .edit-button {
            background-color: #28a745;
        }
        .delete-button {
            background-color: #dc3545;
        }
        .view-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .edit-button:hover {
            background-color: #218838;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .delete-button:hover {
            background-color: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .add-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
        }
        .add-button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>
<body>
    <div class="container">
        <aside class="sidebar">
            <h2>Menú</h2>
            <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo">
            <div class="user-info">
                <strong>Usuario:</strong> {{ auth()->user()->usuario }}
            </div>
            <div class="button-container">
                <button type="button" onclick="location.href='/usuarios'">Usuarios</button>
                <button type="button" onclick="location.href='/candidatos'">Candidatos</button>
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </aside>
        <main class="main-content">
            <h2 style="text-align: center; font-size: 27px; color: #2c3e50; margin-bottom: 20px;">
                Usuarios
            </h2>            @if(auth()->user() && auth()->user()->superusuario)
            <button class="add-button" onclick="location.href='/Registro/Usuario'">Agregar</button>
            @endif
            <div class="user-card">
                <table>
                    <thead>
                        <tr>
                            <th>Usuario</th>
                            <th>Nombre Completo</th>
                            <th>Correo</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->usuario }}</td>
                            <td>{{ $usuario->nombre_completo }}</td>
                            <td>{{ $usuario->correo }}</td>
                            <td>
                                <div class="acciones">
                                    @if(auth()->user()->superusuario)
                                    <a href="{{ route('usuarios.editar', $usuario->id) }}">
                                        <button class="edit-button">Editar</button>
                                    </a>
                                    <form action="{{ route('usuarios.eliminar', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">Eliminar</button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</body>
</html>
