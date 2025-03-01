<div class="header-global">
    <!-- Div transparente para cerrar el modal al hacer clic fuera -->
    <div v-if="showDropdown" class="overlay" @@click="toggleDropdown"></div>
    <div v-if="showDropdownSesion" class="overlay" @@click="mostrarDropdownSesion"></div>
    <div class="empresas" id="selectEmpresasHeader">
        <i class="icon-ol-empresa-filled"></i>
        <div class="seleccionada">
            <span style="font-size: 10px; line-height: 14px">Empresa seleccionada</span>
            <div class="select-empresa puntero-cursor" @@click="toggleDropdown"
                id="labelEmpresaSeleccionadaHeader">
                @{{ selectedEmpresa.razon_social }} <i class="icon-ol-angulo-abajo puntero-cursor" id="btnCambiarEmpresaHeader"></i>
            </div>
            <div v-if="showDropdown" class="dropdown">
                <div class="busqueda">
                    <input type="text" placeholder="Buscar Nombre / RFC" v-model="searchQuery"
                        @@keyup.enter="handleEnter">
                    <button @@click="clearSearch" class="boton-secundario"
                        id="btnLimpiarEmpresaHeader">Limpiar</button>
                </div>
                <h3>Empresas</h3>
                <div class="lista-empresas">
                    <div v-for="empresa in filteredEmpresas" :key="empresa.empresa_id" class="empresa-item"
                        @@click="selectEmpresa(empresa)" :id="'empresaHeaderSelect' + empresa.empresa_id">
                        <div>
                            <i class="icon-ol-empresa"></i>
                            <p>@{{ empresa.razon_social }}</p>
                        </div>
                        <span>@{{ empresa.rfc }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="perfil" @@click="mostrarDropdownSesion" id="btnDropdownSesionHeader">
        <i class="icon-ol-usuario-filled usuario" v-if="usuarioLogueado.urlImagen == ''"></i>
        <img :src="usuarioLogueado.urlImagen" alt="Foto" loading="lazy" class="foto" v-else>
        <div class="nombre">
            @{{ usuarioLogueado.nombre_corto }}
        </div>
        <i class="icon-ol-angulo-abajo"></i>
        <div class="dropdown-sesion" v-if="showDropdownSesion" id="dropdownSesion">
            <div class="header">
                <i class="icon-ol-usuario-filled" v-if="usuarioLogueado.urlImagen == ''"></i>
                <img :src="usuarioLogueado.urlImagen" alt="Foto" loading="lazy" class="foto" v-else>
                <span id="nomreUsuarioLogueadoHeader">@{{ usuarioLogueado.nombre_corto }}</span>
            </div>
            <div class="opcion" id="btnPerfilHeader">
                <i class="icon-ol-usuario"></i>
                <a href="{{ route('usuarios.perfilUsuario') }}"><span>Perfil</span></a>
            </div>
            <form id="logout-form" action="{{ route('logoutUsuarios') }}" method="POST" style="display: none;">
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
