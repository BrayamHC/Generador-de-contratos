<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="icon" href="{{ asset('Logo.ico') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />
</head>

<body>
    <section class="login principal">
        <div class="login-card">
            <div class="container" id="login-container">
                <!-- Logo -->
                <div class="logo">
                    <h1>Iniciar Sesión</h1>
                </div>
                <!-- Formulario -->
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    @if (Session::has('error'))
                    <div class="banner-error-login" id="banner-error-login">
                        {!! Session::get('error') !!}
                    </div>
                    @endif
                    <div class="inputs">
                        <div>
                            <label for="usuario" class="requerido">Usuario</label>
                            <input name="usuario" placeholder="Usuario" type="text" value="{{ old('usuario') }}" id="inputUsuario">
                        </div>
                        @error('usuario')
                        <span class="campo-invalido">{{ $message }}</span>
                        @enderror
                        <div>
                            <label for="password" class="requerido">Contraseña</label>
                            <input name="password" placeholder="Contraseña" type="password" id="inputPassword">
                        </div>
                        @error('password')
                        <span class="campo-invalido">{{ $message }}</span>
                        @enderror
                        <div class="form-actions">
                            <button type="submit" class="btn">Iniciar sesión</button>
                        </div>
                    </div>
                </form>
                <div class="link-volver">
                    <a class="gris" id="linkOlvidastePassword">¿Olvidaste la contraseña?</a>
                </div>
            </div>
            <script>
                // Animación inicial
                window.onload = function() {
                    var container = document.getElementById('login-container');
                    container.style.opacity = '1';
                    container.style.transform = 'translateY(0)';
                };
            </script>
        </div>
        <div class="derecha">
            <span class="titulo">
            </span>
            <span class="subtitulo">
                Tu clave para la gestión empresarial eficiente y centralizada. </span>
        </div>
    </section>
</body>

</html>
