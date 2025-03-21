        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="sidebar">
                <!-- <h2 style="color:aliceblue">Menú</h2> -->
                <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo">
                <!-- <div class="user-info">
                    <strong style="color:aliceblue">Usuario:</strong> {{ auth()->user()->usuario }}
                </div> -->
                <button type="button" onclick="location.href='/principal'">Home</button>
                <button type="button" onclick="location.href='/usuariosGestor'">Usuarios</button>
                <button type="button" onclick="location.href='/candidatosGestor'">Candidatos</button>
                <button type="button" onclick="location.href='/empleadosGestor'">RH</button>
                <button type="button" onclick="location.href='/proyectosGestor'">Proyectos</button>
                <button type="button" onclick="location.href='/contratosGestor'">Contratos</button>
                <button type="button" onclick="location.href='/vacacionesGestor'">Vacaciones</button>
            </div>
        </div>