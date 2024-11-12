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

        /* Estilo para el botón Agregar */
        .add-button {
            position: absolute;
            top: 20px;
            right: 20px;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
            transition: background 0.3s;
        }

        .add-button:hover {
            background-color: #0056b3;
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
            <h1>Lista de Candidatos</h1>

            <!-- Botón para agregar candidato -->
            <button class="add-button" onclick="location.href='/Registro/Candidato'">Agregar</button> <!-- Redirige a la vista de registro -->
            @if(session('success'))
                <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 10px; border-radius: 5px; margin-bottom: 20px;">
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
                        @foreach($candidatos as $candidato)
                            <tr>
                                <td>{{ $candidato->nombre }}</td>
                                <td>{{ $candidato->apellido_paterno }}</td>
                                <td>{{ $candidato->apellido_materno }}</td>
                                <td>{{ $candidato->status ?? 'N/A' }}</td> <!-- Ajusta según el campo de estatus correcto -->
                                <td class="acciones">
                                    <!-- Ver -->
                                    <a href="{{ route('candidatos.mostrar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
                                        <button class="view-button">Ver</button>
                                    </a>

                                    <!-- Editar -->
                                    <a href="{{ route('candidatos.editar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}">
                                        <button class="edit-button">Editar</button>
                                    </a>

                                    <!-- Eliminar -->
                                    <form action="{{ route('candidatos.eliminar', ['id' => $candidato->id, 'idsello' => substr(hash('sha256', $candidato->id . config('constants.URL_SALT')), -8)]) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar a este candidato?')">
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
