<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Candidatos</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <link rel="icon" href="{{ asset('logo.ico') }}?v={{ time() }}" type="image/x-icon">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* Tipografía moderna */
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }

        .container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            /* Ancho de la barra lateral */
            background: #f0f0f0;
            padding: 20px;
            display: flex;
            flex-direction: column;
            /* Permitir que los botones se apilen verticalmente */
            justify-content: flex-start;
            /* El contenido comienza desde la parte superior */
        }

        .sidebar h2 {
            margin: 0 0 20px;
        }

        .logo {
            display: block;
            margin: 10px auto 20px;
            /* Centrar el logo y agregar espaciado */
            max-width: 150px;
            /* Máximo ancho recomendado */
            height: auto;
            /* Mantener la proporción del logo */
        }

        .user-info {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
            text-align: center;
            /* Centrado del nombre de usuario */
        }

        .button-container {
            display: flex;
            flex-direction: column;
            /* Colocar botones en columna */
            align-items: center;
            /* Centrar los botones horizontalmente */
            flex-grow: 1;
            /* Para que tome el espacio disponible */
            justify-content: flex-start;
            /* Subir los botones un poco */
            margin-top: 20px;
            /* Ajuste del margen superior */
        }

        .sidebar button {
            width: 80%;
            /* Ancho del botón */
            margin: 25px 0;
            /* Separación vertical entre botones */
            padding: 10px;
            background: #2c3e50;
            color: white;
            border: none;
            border-radius: 25px;
            /* Bordes redondeados */
            cursor: pointer;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            /* Transición para suavizar efectos */
        }

        .sidebar button:hover {
            background-color: #2980b9;
            /* Color del botón al pasar el mouse */
            transform: translateY(-2px);
            /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra al hacer hover */
        }

        .sidebar form button {
            width: 80%;
            margin-top: 20px;
            /* Separación entre los botones y el botón de cerrar sesión */
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            display: block;
            margin-left: auto;
            margin-right: auto;
            transition: background 0.3s, transform 0.3s, box-shadow 0.3s;
            /* Transición para suavizar efectos */
        }

        .sidebar form button:hover {
            background-color: #c82333;
            /* Color al pasar el ratón sobre el botón */
            transform: translateY(-2px);
            /* Efecto de elevación */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Sombra al hacer hover */
        }

        .main-content {
            flex: 1;
            padding: 20px;
            font-size: 18px;
            position: relative;
            /* Para posicionar el botón "Agregar" */
            overflow-y: auto;
            /* Activa el desplazamiento vertical */
            overflow-x: hidden;
            /* Oculta cualquier desplazamiento horizontal */
        }

        .container {
            display: flex;
            height: 100vh;
            overflow: hidden;
            /* Asegura que no haya desplazamiento en la vista completa */
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
            /* Habilitar desplazamiento horizontal si es necesario */
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
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

        /* Estilo para los botones de acción */
        .view-button,
        .edit-button,
        .delete-button {
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

        .acciones a {
            margin-right: 10px;
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .acciones a:hover {
            color: #0056b3;
        }

        /* Estilo para el botón Agregar */
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
            /* Transición para suavizar efectos */
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
                <!-- Navegación a la página de usuarios -->
                <button type="button" onclick="location.href='/candidatos'">Candidatos</button>
                <!-- Navegación a la página de candidatos -->
            </div>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logout-button">Cerrar sesión</button>
            </form>
        </aside>

        <!-- Contenido principal -->
        <main class="main-content">
            <h2 style="text-align: center; font-size: 27px; color: #2c3e50; margin-bottom: 20px;">
                Candidatos
            </h2>
            <!-- Botón para agregar candidato -->
            <button class="add-button" onclick="location.href='/Registro/Candidato'">Agregar</button>
            <!-- Redirige a la vista de registro -->
            @if (session('success'))
                <div class="alert alert-success"
                    style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <div class="user-card">
                <table>
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Apellido Paterno</th>
                            <th>Apellido Materno</th>
                            <th>Estatus</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($candidatos as $candidato)
                            <tr>
                                <td>{{ $candidato->nombre }}</td>
                                <td>{{ $candidato->apellido_paterno }}</td>
                                <td>{{ $candidato->apellido_materno }}</td>
                                <td>{{ $candidato->status ?? 'N/A' }}</td>
                                <!-- Ajusta según el campo de estatus correcto -->
                                <td class="acciones">
                                    <!-- Ver -->
                                    <a
                                        href="{{ route('candidatos.mostrar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
                                        <button class="view-button">Ver</button>
                                    </a>

                                    <!-- Editar -->
                                    <a
                                        href="{{ route('candidatos.editar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
                                        <button class="edit-button">Editar</button>
                                    </a>

                                    <!-- Eliminar -->
                                    <form
                                        action="{{ route('candidatos.eliminar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}"
                                        method="POST"
                                        onsubmit="return confirm('¿Estás seguro de eliminar a este candidato?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="delete-button">Eliminar</button>
                                    </form>
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
