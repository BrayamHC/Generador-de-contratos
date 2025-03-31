@extends('layout.Layout')
@section('contenido')
@include('components.sidebarSistema')
<div class="app fondo-gris" id='app'>
    @include('components.headerGlobal')
    <div class="contenido centrar-items">
        <div class="home">
            <div class="encabezado">
                <img src="{{ asset('imagenes/logo/logo-signa.jpg') }}"
                    alt="SIGNA">
                <div class="texto">
                    <div class="titulo"> ¡Bienvenido a SIGNA! </div>
                    <div class="subtitulo"> Lleva el control y administracion de tu empresa.</div>
                </div>
                <div class="fecha"> Usuario loggeado: {{ auth()->user()->usuario }}</div>
            </div>
            <div class="accesos">
                <div class="botones">
                    <div class="botones-row">
                        <a href="/empleadosGestor" id="btnRH">
                            <div class="boton">
                                <i class="icon-profile"
                                    alt="RH"></i>
                                <div class="descripcion">
                                    <span class="titulo">Recursos humanos</span>
                                    <span class="nombre">Gestiona tu capital humano.</span>
                                </div>
                            </div>
                        </a>
                        <a href="/candidatosGestor" id="btnReclutamiento">
                            <div class="boton">
                                <i class="icon-user-plus" alt="Reclutamiento"></i>
                                <div class="descripcion">
                                    <span class="titulo">Reclutamiento</span>
                                    <span class="nombre">Administra candidatos y procesos de selección.</span>
                                </div>
                            </div>
                        </a>
                        <a href="/contratosGestor" id="btnDocumentos">
                            <div class="boton">
                                <i class="icon-profile"
                                    alt="Contratos"></i>
                                <div class="descripcion">
                                    <span class="titulo">Documentos y contratos</span>
                                    <span class="nombre">Crea, almacena y gestiona documentos legales.</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="botones-row">
                        <a href="/vacacionesGestor" id="btnFinanzas">
                            <div class="boton">
                                <i class="icon-coin-dollar" alt="Finanzas"></i>
                                <div class="descripcion">
                                    <span class="titulo">Vacaciones</span>
                                    <span class="nombre">Gestiona y asigna fácilmente las vacaciones de tu equipo.</span>
                                </div>
                            </div>
                        </a>
                        <a href="proyectosGestor" id="btnProyectos">
                            <div class="boton">
                                <i class="icon-list-numbered"
                                    alt="Tareas"></i>
                                <div class="descripcion">
                                    <span class="titulo">Gestión de proyectos y tareas</span>
                                    <span class="nombre">Planifica, asigna y monitorea tareas y proyectos.</span>
                                </div>
                            </div>
                        </a>
                        <a href="/usuariosGestor" id="btnUsuarios">
                            <div class="boton">
                                <i class="icon-cogs"
                                    alt="Configuracion"></i>
                                <div class="descripcion">
                                    <span class="titulo">Usuarios</span>
                                    <span class="nombre">Administra usuarios y perfiles.</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    var app = new Vue({
        el: '#app',
        data: {
            usuarioLogueado: {},
            showDropdownSesion: false,
            showDropdown: false,
        },
        methods: {
            mostrarDropdownSesion() {
                this.showDropdownSesion = !this.showDropdownSesion;
            },
            toggleDropdown() {
                this.showDropdown = !this.showDropdown;
            },
        }
    });
</script>
@endsection