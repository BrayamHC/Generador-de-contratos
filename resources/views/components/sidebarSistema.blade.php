        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="sidebar">
                <h2>Menú</h2>
                <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo">
                <div class="user-info">
                    <strong>Usuario:</strong> {{ auth()->user()->usuario }}
                </div>
                <button type="button" onclick="location.href='/principal'">Home</button>
                <button type="button" onclick="location.href='/usuariosGestor'">Usuarios</button>
                <button type="button" onclick="location.href='/candidatosGestor'">Candidatos</button>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" id="logout-button">Cerrar sesión</button>
                </form>
            </div>
        </div>
