<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Candidato</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Archivo CSS principal -->
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

        /* Barra lateral */
        .sidebar {
            width: 250px;
            background: #f0f0f0;
            padding: 20px;
            position: fixed;
            height: 100vh; /* Fija la barra lateral a toda la altura de la pantalla */
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

        /* Formulario de Cerrar sesión */
        .sidebar form {
            margin-top: 20px; /* Mueve el botón más arriba */
        }

        .sidebar button#logout-button {
            background-color: #d9534f;
        }

        /* Contenedor del contenido principal */
        .main-content {
            margin-left: 250px; /* Desplaza el contenido a la derecha de la barra lateral */
            padding: 20px;
            font-size: 18px;
            overflow-y: auto; /* Permite desplazamiento solo si es necesario */
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
            overflow-y: scroll; /* Permite desplazamiento solo en el formulario */
            max-height: 550px; /* Define la altura máxima para el formulario */
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

        /* Botón de guardar cambios */
        .form-group button {
            background-color: #28a745; /* Verde */
            color: white;
            padding: 8px 15px; /* Hizo el botón más pequeño */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 14px; /* Hizo el texto un poco más pequeño */
        }

        .form-group button:hover {
            background-color: #218838; /* Verde más oscuro */
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
            <h1>Editar Candidato</h1>
            <div class="edit-form">
                <form action="{{ route('candidatos.actualizar', $candidato->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input type="text" name="nombre" id="nombre" value="{{ old('nombre', $candidato->nombre) }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_paterno">Apellido Paterno</label>
                        <input type="text" name="apellido_paterno" id="apellido_paterno" value="{{ old('apellido_paterno', $candidato->apellido_paterno) }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido_materno">Apellido Materno</label>
                        <input type="text" name="apellido_materno" id="apellido_materno" value="{{ old('apellido_materno', $candidato->apellido_materno) }}">
                    </div>
                    <div class="form-group">
                        <label for="rfc">RFC</label>
                        <input type="text" name="rfc" id="rfc" value="{{ old('rfc', $candidato->rfc) }}">
                    </div>
                    <div class="form-group">
                        <label for="curp">CURP</label>
                        <input type="text" name="curp" id="curp" value="{{ old('curp', $candidato->curp) }}">
                    </div>
                    <div class="form-group">
                        <label for="nss">NSS</label>
                        <input type="text" name="nss" id="nss" value="{{ old('nss', $candidato->nss) }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion1">Dirección 1</label>
                        <input type="text" name="direccion1" id="direccion1" value="{{ old('direccion1', $candidato->direccion1) }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion2">Dirección 2</label>
                        <input type="text" name="direccion2" id="direccion2" value="{{ old('direccion2', $candidato->direccion2) }}">
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <input type="text" name="estado" id="estado" value="{{ old('estado', $candidato->estado) }}">
                    </div>
                    <div class="form-group">
                        <label for="ciudad">Ciudad</label>
                        <input type="text" name="ciudad" id="ciudad" value="{{ old('ciudad', $candidato->ciudad) }}">
                    </div>
                    <div class="form-group">
                        <label for="cp">CP</label>
                        <input type="text" name="cp" id="cp" value="{{ old('cp', $candidato->cp) }}">
                    </div>
                    <div class="form-group">
                        <label for="pais">País</label>
                        <input type="text" name="pais" id="pais" value="{{ old('pais', $candidato->pais) }}">
                    </div>
                    <div class="form-group">
                        <label for="puesto">Puesto</label>
                        <input type="text" name="puesto" id="puesto" value="{{ old('puesto', $candidato->puesto) }}">
                    </div>
                    <div class="form-group">
                        <label for="salario_diario">Salario Diario</label>
                        <input type="text" name="salario_diario" id="salario_diario" value="{{ old('salario_diario', $candidato->salario_diario) }}">
                    </div>
                    <div class="form-group">
                        <label for="fecha_ingreso">Fecha de Ingreso</label>
                        <input type="date" name="fecha_ingreso" id="fecha_ingreso" value="{{ old('fecha_ingreso', $candidato->fecha_ingreso) }}">
                    </div>
                    <div class="form-group">
                        <label for="correo_electronico">Correo Electrónico</label>
                        <input type="email" name="correo_electronico" id="correo_electronico" value="{{ old('correo_electronico', $candidato->correo_electronico) }}">
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
