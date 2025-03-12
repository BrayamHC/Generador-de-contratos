<div class="header-global">
    <div v-if="showDropdown" class="overlay" @@click="toggleDropdown"></div>
    <div v-if="showDropdownSesion" class="overlay" @@click="mostrarDropdownSesion"></div>
    <div class="empresas" id="selectEmpresasHeader">
        <div class="perfil" id=" btnDropdownSesionHeader">
            <i class="icon-ol-usuario-filled usuario" v-if="usuarioLogueado.urlImagen == ''"></i>
            <div class="nombre">
            </div>
        </div>
        <div class="perfil" @@click="mostrarDropdownSesion" id="btnDropdownSesionHeader">
            <img>
            <div class="nombre">
                {{ auth()->user()->usuario }}
            </div>
            <i class="icon-ol-angulo-abajo"></i>
            <div class="dropdown-sesion" v-if="showDropdownSesion" id="dropdownSesion">
                <div class="header">
                    <i class="icon-ol-usuario-filled" v-if="usuarioLogueado.urlImagen == ''"></i>
                    <img :src="usuarioLogueado.urlImagen" alt="Foto" loading="lazy" class="foto" v-else>
                    <span id="nomreUsuarioLogueadoHeader"> {{ auth()->user()->usuario }}
                    </span>
                </div>
                <div class="opcion" id="btnPerfilHeader">
                    <i class="icon-ol-usuario"></i>
                    <a><span>Perfil</span></a>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                    id="linkCerrarSesionHeader">
                    <div class="opcion">
                        <i class="icon-ol-salir"></i>
                        <span>Cerrar sesión</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>