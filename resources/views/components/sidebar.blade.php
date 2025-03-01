<div class="sidebar administrativo">
    <div class="logo">
        <img src="{{ config('app.url') }}/imagenes/logo/dataxtractor-identidadgrafica-isotipo-base.svg"
            alt="DataXtractor">
    </div>
    <div class="menus">
        <div class="{{ request()->routeIs('despachos.gestor') ? 'boton active' : 'boton' }}" id="despachosMenu"
            title="Despachos">
            <a href="{{ route('despachos.gestor') }}" id="linkDespachoSidebar">
                <i class="icon-ol-despachos" id="iconDespachoSidebar"></i>
            </a>
        </div>
        <div class="{{ request()->routeIs('administradores.gestor') ? 'boton active' : 'boton' }}" id="usuariosMenu"
            title="Usuarios">
            <a href="{{ route('administradores.gestor') }}" id="linkAdministradoresSidebar">
                <i class="icon-ol-usuarios" id="iconAdministradoresSidebar"></i>
            </a>
        </div>
    </div>
    <div class="opcion-abajo">
        <div class="boton" id="cerrarSesion" title="Cerrar sesión">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" id="linkSalir">
                <i class="icon-ol-salir" id="iconSalir"></i>
            </a>
        </div>
    </div>
</div>
