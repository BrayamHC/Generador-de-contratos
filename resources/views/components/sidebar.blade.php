<div class="sidebar administrativo">
    <div class="logo">
        <i class="icon-ol-usuarios" id="iconAdministradoresSidebar"></i>
    </div>
    <div class="menus">
        <div id="despachosMenu"
            title="Despachos">
            <a id="linkDespachoSidebar">
                <i class="icon-ol-despachos" id="iconDespachoSidebar"></i>
            </a>
        </div>
        <div id="usuariosMenu"
            title="Usuarios">
            <a id="linkAdministradoresSidebar">
                <i class="icon-ol-usuarios" id="iconAdministradoresSidebar"></i>
            </a>
        </div>
    </div>
    <div class="opcion-abajo">
        <div class="boton" id="cerrarSesion" title="Cerrar sesión">
            <form  style="display: none;">
                @csrf
            </form>
            <a id="linkSalir">
                <i class="icon-ol-salir" id="iconSalir"></i>
            </a>
        </div>
    </div>
</div>
