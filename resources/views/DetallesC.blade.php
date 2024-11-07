<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalle del Candidato</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #A9CCE3, #FFFDD0);
        }
        .container {
            display: flex;
            height: 100vh;
        }
        .sidebar {
            width: 250px;
            background: #f0f0f0;            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            color: black;
        }
        .sidebar h2 {
            margin: 0 0 20px;
            font-size: 24px;
            font-weight: bold;
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
            font-size: 16px;
        }
        .sidebar button:hover {
            background: #0056b3;
        }
        .sidebar form button {
            width: 80%;
            margin-top: 20px;
            padding: 10px;
            background: #dc3545;
            color: white;
            border: none;
            border-radius: 25px;
            cursor: pointer;
            font-size: 16px;
        }
        .sidebar form button:hover {
            background: #c82333;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            font-size: 18px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
        .candidato-details {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-height: 500px;
            overflow-y: auto;
        }
        .details-list {
            list-style-type: none;
            padding: 0;
        }
        .details-list li {
            padding: 10px;
            border-bottom: 1px solid #ddd;
        }
        .details-list li span {
            font-weight: bold;
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
            <h1>Detalle del Candidato</h1>
            <div class="candidato-details">
                <ul class="details-list">
                    <li><span>Nombre:</span> {{ $candidato->nombre }}</li>
                    <li><span>Apellido Paterno:</span> {{ $candidato->apellido_paterno }}</li>
                    <li><span>Apellido Materno:</span> {{ $candidato->apellido_materno }}</li>
                    <li><span>RFC:</span> {{ $candidato->rfc ?? 'N/A' }}</li>
                    <li><span>CURP:</span> {{ $candidato->curp ?? 'N/A' }}</li>
                    <li><span>NSS:</span> {{ $candidato->nss ?? 'N/A' }}</li>
                    <li><span>Dirección 1:</span> {{ $candidato->direccion1 ?? 'N/A' }}</li>
                    <li><span>Dirección 2:</span> {{ $candidato->direccion2 ?? 'N/A' }}</li>
                    <li><span>Estado:</span> {{ $candidato->estado ?? 'N/A' }}</li>
                    <li><span>Ciudad:</span> {{ $candidato->ciudad ?? 'N/A' }}</li>
                    <li><span>CP:</span> {{ $candidato->cp ?? 'N/A' }}</li>
                    <li><span>País:</span> {{ $candidato->pais ?? 'N/A' }}</li>
                    <li><span>Puesto:</span> {{ $candidato->puesto ?? 'N/A' }}</li>
                    <li><span>Salario Diario:</span> {{ $candidato->salario_diario ?? 'N/A' }}</li>
                    <li><span>Fecha de Ingreso:</span> {{ $candidato->fecha_ingreso ?? 'N/A' }}</li>
                    <li><span>Correo Electrónico:</span> {{ $candidato->correo_electronico ?? 'N/A' }}</li>
                </ul>
            </div>
        </main>
    </div>
</body>
</html>
