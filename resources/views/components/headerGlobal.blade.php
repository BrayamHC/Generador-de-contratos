<div class="header-global">
    <div class="empresas"></div>
    <div class="perfil" id=" btnDropdownSesionHeader">
        <i class="icon-ol-usuario-filled usuario" v-if="usuarioLogueado.urlImagen == ''"></i>
        <div class="nombre">
            {{ auth()->user()->usuario }}
        </div>
    </div>
</div>
