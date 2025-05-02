        <!-- Barra lateral -->
        <div class="sidebar">
            <div class="logo">
                <img src="{{ asset('images/User.png') }}" alt="Logo" class="logo">
            </div>
            <div class="menus">
                <div id="homeMenu" title="Home">
                    <a href="{{ route('principal') }}" style="display: block; text-decoration: none;">
                        <i class="icon-ol-inicio"></i>
                    </a>
                </div>
                <div id="homeUsuarios" title="Usuarios">
                    <a href="{{ route('usuarios.listar') }}">
                        <i class="icon-ol-usuario"></i>
                    </a>
                </div>
                <div id="homeCandidatos" title="Reclutamiento">
                    <a href="{{ route('candidatos.listar') }}">
                        <i class="icon-ol-usuarios"></i>
                    </a>
                </div>
                <div id="homeRH" title="RH">
                    <a href="{{ route('empleados.listar') }}">
                        <i class="icon-ol-empresa"></i>
                    </a>
                </div>
                <div id="homeProyectos" title="Proyectos">
                    <a href="{{ route('proyectos.listar') }}">
                        <i class="icon-ol-reportes"></i>
                    </a>
                </div>
                <div id="homeContratos" title="Contratos">
                    <a href="{{ route('contratos.listar') }}">
                        <i class="icon-ol-documento"></i>
                    </a>
                </div>
                <div id="homeVacaciones" title="Vacaciones">
                    <a href="{{ route('vacaciones.listar') }}">
                        <i class="icon-ol-calendario"></i>
                    </a>
                </div>
            </div>
        </div>
