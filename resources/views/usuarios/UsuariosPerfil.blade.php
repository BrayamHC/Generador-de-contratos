@extends('layout.Layout')
@section('contenido')
    @include('components.sidebarSistema')
    <div class="app" id='app'>
        <div class="contenido centrar-items">
            <div class="perfil-usuario">
                <h1 id="tituloModulo">Perfil</h1>
                <div class="header">
                    <div class="foto">
                        <i class="icon-ol-usuario-filled foto" id="imagenDefault"></i>
                        <img :src="imagenBase64" alt="Foto" loading="lazy" v-else id="imagenUsuario">
                        <i class="icon-ol-editar editar puntero-cursor" @@click="abrirModalSubirFoto"
                            id="iconoEditarFoto"></i>
                    </div>
                    <h2>@{{ usuarioLogeado.nombre_completo }}</h2>
                </div>
                <div class="inputs">
                    <div>
                        <label>Usuario</label>
                        <input disabled type="text" :value="usuarioLogeado.usuario">
                    </div>
                    <div>
                        <label>Nombre completo</label>
                        <input disabled type="text" :value="usuarioLogeado.nombre_completo">
                    </div>
                    <div>
                        <label>Fecha ultimo acceso</label>
                        <input disabled type="text" :value="usuarioLogeado.fecha_ultimo_acceso">
                    </div>
                </div>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <button type="button" class="boton-secundario">Cerrar sesion</button>
                </a>
            </div>
        </div>

        <!-- COMIENZA MODAL SUBIR FOTO -->
        <template>
            <div v-if="modalSubirFoto" class="modal">
                <div class="modal-card" id="modalGenerar">
                    <div class="modal-header">
                        <label>Subir imagen</label>
                        <i @@click="cerrarModalSubirFoto" class="icon-ol-cerrar">
                        </i>
                    </div>
                    <div class="modal-body">
                        <div class="area-carga" @@dragover="dragover" @@dragleave="dragleave"
                            @@drop="drop" v-if="fotografiaTemp == null">
                            <i class="icon-ol-subir"></i>
                            <span>Arrastra el archivo</span>
                            <span>o</span>
                            <button class="boton-borde" @@click="abrirSelectorArchivos">Da click
                                aquí</button>
                            <input style="display:none" type="file" id="fileInput" accept="image/jpeg" ref="fileInput"
                                @@change="handleFileSelect" />
                        </div>
                        <template v-else>
                            <div id="cropImgPub" class="mt-16">
                                <img src="" id="imgResourcePub" width="100%">
                            </div>
                            <div class="clearfix"></div>
                        </template>
                    </div>
                    <div class="modal-footer">
                        <button @@click="cerrarModalSubirFoto()">Cancelar</button>
                        <button type="submit" class="boton-primario" form="formSubirFoto" id="btnEditar"
                            @@click="guardarFoto">Subir imagen</button>
                    </div>
                </div>
                <div class="modal-background"></div>
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
                usuarioLogeado: {{ Js::from($usuarioLogeado) }},
                tooltipCopiado: false,
                loader: false,
                selectedEmpresa: {
                    empresa_id: null,
                    razon_social: 'Seleccione una empresa',
                    rfc: 'XAXX010101000'
                },
                modalSubirFoto: false,
                archivo: null,
                pub: null,
                imagenTmp: '',
                nombrePub: null,
                descripcionPub: null,
                fotografia: null,
                fotografiaTemp: null,
                nombreOriginal: null,
            },
            mounted() {
                @if (Session::has('error'))
                    this.mostrarBanner("banner-error", "{{ Session::get('error') }}");
                @endif
                @if (Session::has('exito'))
                    this.mostrarBanner("banner-exito", "{{ Session::get('exito') }}");
                @endif
                @if (Session::has('permisoDenegado'))
                    this.mostrarBanner("banner-advertencia", "{{ Session::get('permisoDenegado') }}");
                @endif
                this.cargaInicial();
            },
            computed: {
                bannerImage() {
                    return `${window.appUrl}/imagenes/dataxtractor-iconos-notificacion-${this.bannerClass}.svg`;
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
                },
                cerrarModalSubirFoto() {
                    this.modalSubirFoto = false;
                    this.fotografiaTemp = null;
                    this.fotografia = null;
                    this.nombrePub = null;
                    this.descripcionPub = null;
                    this.nombreOriginal = null
                    this.$nextTick(() => {
                        this.destroyCroppiePub();
                    });
                },
                abrirModalSubirFoto() {
                    this.modalSubirFoto = true;
                },
                drop(event) {
                    event.preventDefault();
                    event.target.classList.remove('drag-over');
                    const files = event.dataTransfer.files;
                    this.loadCroppiePub(files[0]);
                },
                dragover(event) {
                    event.preventDefault();
                    event.target.classList.add('drag-over');
                },
                dragleave() {
                    event.target.classList.remove('drag-over');
                },
                abrirSelectorArchivos() {
                    // Restablecer el valor del input
                    this.$refs.fileInput.value = "";
                    this.$refs.fileInput.click();
                },
                handleFileSelect(event) {
                    const files = event.target.files;
                    this.loadCroppiePub(files[0]);
                },
                loadCroppiePub(file) {
                    this.fotografiaTemp = file

                    this.$nextTick(() => {
                        const cropImgPub = document.getElementById('cropImgPub');
                        const fr = new FileReader();
                        fr.onload = (e) => {
                            const img = new Image();
                            img.src = e.target.result;

                            img.onload = () => {
                                const width = img.width;
                                const height = img.height;

                                if (width < 120 || height < 120) {
                                    this.fotografiaTemp = null;
                                    this.mostrarBanner("banner-error",
                                        `La imagen debe tener dimensiones de más de 120x120 píxeles. Actualmente tiene ${width}x${height}`
                                    );
                                    return;
                                }
                            };

                            if (this.pub !== null) {
                                this.pub.destroy();
                            }
                            console.log(cropImgPub);

                            this.pub = new Croppie(cropImgPub, {
                                viewport: {
                                    width: 240,
                                    height: 240,
                                    type: 'circle'
                                },
                                enforceBoundary: false,
                                showZoomer: true,
                                enableExif: true,
                                boundary: {
                                    width: 352,
                                    height: 240
                                },
                                url: fr.result,
                                zoom: 0
                            });

                        };

                        fr.readAsDataURL(file);

                        this.nombreOriginal = file.name;
                    });
                },
                destroyCroppiePub() {
                    if (this.pub !== null) {
                        this.pub.destroy();
                    }
                    this.$nextTick(() => {
                        this.pub = null;
                        document.getElementById('fileInput').value = "";
                    });
                },
                async guardarFoto() {
                    this.pub.result('base64').then((base64) => {
                        this.fotografia = base64;
                        this.$nextTick(() => {
                            this.fotografia = this.fotografia.replace(/^data:(.*?);base64,/,
                                '');
                            this.loader = true;
                            let formData = new FormData();
                            formData.append("fotografiaObj", JSON.stringify({
                                nombre: this.nombrePub,
                                descripcion: this.descripcionPub,
                                nombreOriginal: this.nombreOriginal,
                                base64: this.fotografia,
                            }));


                            return fetch(`${this.appURL}/despacho/usuarios/cargarFotoPerfil`, {
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

                                    this.loader = false;
                                    location.reload(true);
                                })
                                .catch((error) => {
                                    this.mostrarBanner("banner-error", error);
                                    this.loader = false;
                                });
                        });
                    }).catch((error) => {
                        console.error("Error al obtener base64:", error);
                    });

                },
            }
        })
        window.app = app;
    </script>
@endsection
