@extends('layout.LayoutSistema')
@section('contenido')
@include('components.sidebarSistema', ['filtros' => $data])
<div class="app fondo-gris" id='app'>
    @include('components.headerGlobal', [])
    <div class="contenido centrar-items">
        <!-- Loader -->
        <div v-if="loader" class="loader-overlay">
            <div class="loader"></div>
        </div>
        <div class="alert" v-if="banner" id="alert">
            <div :class="bannerClass + ' banner'">
                <img class="imagen-link" :src="bannerImage">
                @{{ bannerMensaje }}
                <i @@click="ocultarBanner" class="icon-ol-cerrar" id="cerrarAlert">
                </i>
            </div>
        </div>
        <div class="home">
            <div class="encabezado">
                <img src="{{ config('app.url') }}/imagenes/logo/dataxtractor-identidadgrafica-isotipo-blanco.svg"
                    alt="DataXtractor">
                <div class="texto">
                    <div class="titulo"> ¡Bienvenido a DataXtractor! </div>
                    <div class="subtitulo"> Tu llave para el control y análisis inteligente de pedimentos </div>
                </div>
                <div class="fecha"> Último acceso: @{{ usuarioLogueado.fecha_ultimo_acceso }}</div>
            </div>
            <div class="accesos">
                <div class="botones">
                    <div class="botones-row">
                        <a href="/despacho/empresas" id="btnEmpresas">
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-empresas.svg"
                                    alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Empresas</span>
                                    <span class="nombre">Gestiona la información de las diferentes compañías.</span>
                                </div>
                            </div>
                        </a>
                        <a href="/despacho/glosas" id="btnGlosas">
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-glosas.svg" alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Glosas</span>
                                    <span class="nombre">Carga y consulta el historial de las acciones realizadas.</span>
                                </div>
                            </div>
                        </a>
                        <a href="/despacho/reportes" id="btnReportes">
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-reportes.svg"
                                    alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Reportes</span>
                                    <span class="nombre">Genera reportes sobre el estado de las glosas.</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="botones-row">
                        <a href="/despacho/cedulas" id="btnCedulas">
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-cedulas.svg"
                                    alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Cédulas</span>
                                    <span class="nombre">Accede fácilmente a los documentos de cada glosa.</span>
                                </div>
                            </div>
                        </a>
                        <a>
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-dashboard.svg"
                                    alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Dashboards</span>
                                    <span class="nombre">Visualiza el desempeño general de las empresas.</span>
                                </div>
                            </div>
                        </a>
                        <a href="{{ route('datosGenerales') }}" id="btnConfiguracionHome">
                            <div class="boton">
                                <img src="{{ config('app.url') }}/imagenes/home/dataxtractor-ilustraciones-home-configuracion.svg"
                                    alt="Cedulas">
                                <div class="descripcion">
                                    <span class="titulo">Configuración</span>
                                    <span class="nombre">Edita los datos generales, usuarios y perfiles.</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="card-vertical">
                    <span>Suscripción</span>
                    <table>
                        <tr>
                            <td>
                                <div class="circulo verde"></div>
                            </td>
                            <td>Cuenta</td>
                            <td class="derecha">
                                <h3>@{{ suscripcion.pin }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="circulo verde"></div>
                            </td>
                            <td>Empresas</td>
                            <td class="derecha">
                                <h3>@{{ suscripcion.empresas }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="circulo verde"></div>
                            </td>
                            <td>Usuarios</td>
                            <td class="derecha">
                                <h3>@{{ suscripcion.usuarios }}</h3>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="circulo verde"></div>
                            </td>
                            <td>Storage</td>
                            <td class="derecha icon">
                                <h3>@{{ formatBytes(suscripcion.storageUsado) }}</h3>
                                <i class="icon-ol-info-filled" @@mouseover="abrirInfoStorage"
                                    @@mouseleave="cerrarInfoStorage" ref="iconoInfo"></i>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <template>
        <div v-if="modalInfoStorage" class="modal" :style="{ left: posX + 'px', top: posY + 'px' }">
            <div class="modal-card storage" id="modalGenerar">
                <div class="modal-body">
                    <h2>Storage</h2>
                    <table>
                        <tr>
                            <td> <i class="icon-ol-carpeta-zip"></i></td>
                            <td>Glosas</td>
                            <td class="suma">@{{ formatBytes(suscripcion.totalStorageGlosas) }}</td>
                        </tr>
                        <tr>
                            <td> <i class="icon-ol-reportes"></i></td>
                            <td>Reportes</td>
                            <td class="suma">@{{ formatBytes(suscripcion.totalStorageReportes) }}</td>
                        </tr>
                        <tr>
                            <td> <i class="icon-ol-cedulas"></i></td>
                            <td>Cedulas</td>
                            <td class="suma">@{{ formatBytes(suscripcion.totalStorageCedulas) }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </template>


</div>

<script>
    window.appUrl = "{{ config('app.url') }}";
</script>


<script>
    var app = new Vue({
        el: '#app',
        data: {
            banner: false,
            bannerMensaje: false,
            bannerClass: false,
            appURL: "{{ config('app.url') }}",
            csrfToken: "{{ csrf_token() }}",
            usuarioLogueado: {
                {
                    Js::from($usuarioLogueado)
                }
            },
            suscripcion: {
                {
                    Js::from($suscripcion)
                }
            },
            empresas: {
                {
                    Js::from($empresas)
                }
            },
            data: {
                {
                    Js::from($data)
                }
            },
            empresaSeleccionada: {
                {
                    Js::from($empresaSeleccionada)
                }
            },
            tooltipCopiado: false,
            loader: false,
            isLoadingBtn: false,
            showDropdown: false,
            showDropdownSesion: false,
            searchQuery: '',
            selectedEmpresa: {
                empresa_id: null,
                razon_social: 'Seleccione una empresa',
                rfc: 'XAXX010101000'
            },
            modalInfoStorage: false,
            posX: 50,
            posY: 50,

        },
        mounted() {
            @if(Session::has('error'))
            this.mostrarBanner("banner-error", "{{ Session::get('error') }}");
            @endif
            @if(Session::has('exito'))
            this.mostrarBanner("banner-exito", "{{ Session::get('exito') }}");
            @endif
            @if(Session::has('permisoDenegado'))
            this.mostrarBanner("banner-advertencia", "{{ Session::get('permisoDenegado') }}");
            @endif
            this.cargaInicial();
        },
        computed: {
            bannerImage() {
                return `${window.appUrl}/imagenes/dataxtractor-iconos-notificacion-${this.bannerClass}.svg`;
            },
            filteredEmpresas() {
                return this.empresas.filter(empresa =>
                    empresa.razon_social.toLowerCase().includes(this.searchQuery.toLowerCase()) ||
                    empresa.rfc.toLowerCase().includes(this.searchQuery.toLowerCase())
                );
            },
        },
        methods: {
            mostrarBanner(tipoBanner, mensajeBanner) {
                this.bannerMensaje = mensajeBanner
                this.bannerClass = tipoBanner;
                this.banner = true;
                setTimeout(() => {
                    this.banner = false;
                }, 5000);
            },
            ocultarBanner() {
                this.banner = false;
            },
            cargaInicial() {
                console.log("Llego");
                if (this.empresaSeleccionada) {
                    this.selectedEmpresa = this.empresas.find(empresa => empresa.empresa_id == this.empresaSeleccionada);
                }
                this.filtrosJson = JSON.stringify(this.filtros);
            },
            toggleDropdown() {
                this.showDropdown = !this.showDropdown;
            },
            clearSearch() {
                this.searchQuery = '';
            },
            async selectEmpresa(empresa) {
                this.loader = true;
                let formData = new FormData();
                formData.append('empresaIdSeleccionar', empresa.empresa_id);

                return fetch(`${this.appURL}/despacho/empresas/seleccionar-empresa`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': this.csrfToken,
                        },
                        body: formData,
                    })
                    .then(response => {
                        console.log(response);
                        if (!response.ok)
                            throw new Error("La solicitud no fue exitosa");
                        return response.json();
                    })
                    .then(respuesta => {
                        if (respuesta.codigo != 200)
                            throw new Error(respuesta.mensaje);

                        window.location.reload(); // Recargar para que la nueva empresa se aplique en toda la app
                        this.loader = false;
                    })
                    .catch((error) => {
                        this.mostrarBanner("banner-error", error);
                        this.loader = false;
                    });
            },
            mostrarDropdownSesion() {
                this.showDropdownSesion = !this.showDropdownSesion;
            },
            handleEnter() {
                if (this.filteredEmpresas.length === 1) {
                    this.selectEmpresa(this.filteredEmpresas[0]);
                }
            },
            abrirInfoStorage() {
                const icono = this.$refs.iconoInfo;
                const rect = icono.getBoundingClientRect();

                console.log(rect.left);

                this.posY = rect.bottom + 10; // Justo debajo del icono
                this.posX = rect.left - 230;

                this.modalInfoStorage = true;
            },
            cerrarInfoStorage() {
                this.modalInfoStorage = false;
            },
        }
    })
    window.app = app;
</script>
@endsection
