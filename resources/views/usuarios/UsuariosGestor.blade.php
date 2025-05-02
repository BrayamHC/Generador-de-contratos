@extends('layout.Layout')
@section('contenido')
@include('components.sidebarSistema')
<div class="app" id='app'>
    @include('components.headerGlobal')
    <div class="contenido header-sidebar">
        <div class="encabezado">
            <span class="titulo" id="tituloModulo">Usuarios</span>
            <div class="opciones">
                @if (auth()->user()->superusuario)
                <button class="boton-primario" @@click="abrirModalAgregarUsuario">Agregar Usuario</button>
                @endif
            </div>
        </div>
        <form method="GET" class="filtros" id="formFiltros">
            <div class="input-con-icono-contenedor">
                <input style="height:20px;" type="text" placeholder="Buscar" class="input-con-icono-derecha" name="busqueda"
                    value="{{ $filtros['busqueda'] ?? '' }}" id="inputBusquedaFiltros">
                <span class="icono-input-derecha">
                    <i class="icon-ol-buscar buscar" @@click="buscarUsuario" id="btnBuquedaUsuario"></i>
                </span>
            </div>
            <button style="margin-left: 45px;" class="boton-primario" id="btnBuscarUsuario">Buscar</button>
            <a href="{{ route('usuarios.listar') }}" class="boton boton-limpiar" id="btnLimpiarBusquedaUsuarios"><button
                    class="boton-secundario" type="button">Limpiar</button>
            </a>
        </form>
        <div class="main-content">
            <div class="tabla-gestor">
                <div id="dataGrid"></div>
            </div>
            <!-- MODALES -->
            <!-- COMIENZA MODAL AGREGAR USUARIO -->
            <template>
                <div v-if="modalAgregarUsuario" class="modal" id="modalAgregarUsuario">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Agregar Usuario</label>
                        </div>
                        <div class="modal-body">
                            <form id="formAgregarUsuario" ref="formAgregarUsuario" action="{{ route(('usuarios.crear')) }}"
                                method="POST" @@submit.prevent="onSubmit('formAgregarUsuario')">
                                @csrf
                                <div style="text-align: left;">
                                    <label class="requerido" for="usuario">Usuario</label>
                                    <input type="text" name="usuario" placeholder="Usuario" required maxlength="80"
                                        id="inputUsuarioAgregar" value="{{ old('nombreUsuario') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="correo">Correo</label>
                                    <input type="email" name="correo" placeholder="Correo" required
                                        id="inputCorreoAgregar" value="{{ old('correo') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="nombre_completo">Nombre completo</label>
                                    <input type="text" name="nombre_completo" placeholder="Nombre completo" required
                                        id="inputNombreAgregar" value="{{ old('nombre_completo') }}" />
                                </div>
                                <div class="input-password">
                                    <div>
                                        <label class="requerido">Contraseña </label>
                                        <label class="generar-password" @@click="generarPassword"
                                            id="btnGenerarPassword">Generar y copiar</label>
                                    </div>
                                    <div class="input-con-icono derecha">
                                        <input :type="verPassword ? 'text' : 'password'" name="password"
                                            placeholder="Contraseña" required maxlength="25"
                                            @@input="validarPassword" v-model="password"
                                            onkeypress="noSpaces(event)" id="inputPasswordAgregar" />
                                        <i class="icon-ol-visualizacion-cerrada copiar puntero-cursor"
                                            @@click="verPassword = !verPassword" v-if="!verPassword"
                                            id="btnVerPasswordAgregar"></i>
                                        <i class="icon-ol-visualizacion-abierta copiar puntero-cursor"
                                            @@click="verPassword = !verPassword" v-else
                                            id="btnOcultarPasswordAgregar"></i>
                                    </div>
                                    <div class="validar-password">
                                        <div class="progreso">
                                            <progress :value="seguridad" :class="colorSeguridad" max="100"
                                                id="progressAgregar"></progress>
                                            <label> Seguridad</label>
                                        </div>
                                        <div class="validaciones">
                                            <div v-for="(rule, index) in reglas" :key="index">
                                                <i :class="{ 'icon-ol-confirmar-filled verde': rule
                                                    .valid, 'icon-ol-cancelar-filled rojo': !rule.valid }"
                                                    :id="'validacion-' + index"></i>
                                                <label>@{{ rule.message }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="superusuario">SuperUsuario</label>
                                    <select id="superusuario" name="superusuario" required>
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalAgregarUsuario()" id="btnCancelarAgregar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formAgregarUsuario"
                                id="btnGuardarAgregar">Registrar
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL AGREGAR USUARIO -->
            <!-- COMIENZA MODAL EDITAR USUARIO -->
            <template>
                <div v-if="modalEditarUsuario" class="modal" id="modalEditarUsuario">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Editar Usuario</label>
                        </div>
                        <div class="modal-body">
                            <form :action="'{{ route('usuarios.actualizar', '') }}/' + Datasource.usuarioId" id="formEditarUsuario"
                                ref="formEditarUsuario" method="POST" @@submit.prevent="onSubmit('formEditarUsuario')">
                                @csrf
                                @method('PATCH')
                                <div style="text-align: left;">
                                    <label class="requerido" for="usuario">Usuario</label>
                                    <input type="text" name="usuario" placeholder="Usuario" required maxlength="80"
                                        v-model="Datasource.nombreUsuario" id="inputUsuarioAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="correo">Correo eléctronico</label>
                                    <input type="email" name="correo" placeholder="Correo" required
                                        v-model="Datasource.correoUsuario" id="inputCorreoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label style="text-align: left;" class="requerido" for="nombre_completo">Nombre completo</label>
                                    <input type="text" name="nombre_completo" placeholder="Nombre completo" required
                                        v-model="Datasource.nombreCompletoUsuario" id="inputNombreAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="password">Contraseña</label>
                                    <input type="password" name="password" placeholder="Contraseña"
                                        id="inputContraseñaAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="password_confirmation">Confirmar contraseña</label>
                                    <input type="password" name="password_confirmation" placeholder="Confirmar contraseña"
                                        id="inputConfContraseñaAgregar" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalEditarUsuario()" id="btnCancelarEditar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formEditarUsuario"
                                id="btnGuardarAgregar">Confirmar cambios
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL AGREGAR USUARIO -->
            <!-- COMIENZA MODAL ELIMINAR USUARIO -->
            <template>
                <div v-if="modalEliminarUsuario" class="modal" id="modalEditarUsuario">
                    <div class="modal-card modal-eliminar">
                        <div class="modal-header">
                            <div></div>
                            <i class="icon-ol-cerrar"
                                id="btnCerrarModalEliminar"></i>
                        </div>
                        <div class="modal-body">
                            <form :action="'{{ route('usuarios.eliminar', '') }}/' + Datasource.usuarioId" id="formEliminarUsuario" ref="formEliminarUsuario"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input name="usuarioIdEliminar" type="hidden" v-model="Datasource.usuarioId"
                                    id="inputUsuarioIdEliminar">
                                <i class="icon-ol-eliminar"></i>
                                <h3>Eliminar usuario</h3>
                                <p>¿Estás seguro de eliminar el siguiente usuario?<br>Esta acción no se puede deshacer.</span></p>
                                <div class="contenedor-input-datos">
                                    <input v-model="Datasource.nombreUsuario" disabled id="inputNombreUsuarioEliminar">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalEliminarUsuario" type="button"
                                id="btnCancelarEliminar">Cancelar</button>
                            <button type="submit" class="boton-cancelacion" form="formEliminarUsuario" @@click.prevent="onSubmit('formEliminarUsuario')"
                                id="btnConfirmarEliminar">Eliminar</button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- FINALIZA MODAL ELIMINAR USUARIO -->
        </div>
    </div>
</div>
<script id="opcionesTemplate" type="text/x-template">
    <div class="celda-acciones-gestor">
        @if (auth()->user()->superusuario)
            <a class="accionEditar" title="Editar">Editar</a>
            <a class="accionEliminar" title="Eliminar">Eliminar</a>
        @else
            <a>Permisos necesarios</a>
        @endif
    </div>
</script>


<!-- VUE -->

<script>
    var app = new Vue({
        el: '#app',
        data: {
            usuarioLogueado: {},
            urlImagen: '',
            usuarioObj: {},
            Datasource: {},
            //Modales
            modalAgregarUsuario: false,
            modalEditarUsuario: false,
            modalEliminarUsuario: false,
            showDropdownSesion: false,
            showDropdown: false,
            test: JSON.parse('{!! json_encode($usuarios) !!}'),
            accion: 'Agregar',
            columnas: [{
                    field: 'nombreUsuario',
                    type: 'string',
                    textAlign: 'Left',
                    width: 220,
                    headerText: 'Usuario',
                    requerido: true
                }, {
                    field: 'correoUsuario',
                    textAlign: 'Left',
                    type: 'string',
                    headerText: 'Correo',
                    requerido: true
                },
                {
                    field: 'nombreCompletoUsuario',
                    textAlign: 'Left',
                    type: 'string',
                    headerText: 'Nombre Completo',
                    requerido: true
                },
                {
                    field: 'fechaCreacionUsuario',
                    textAlign: 'Left',
                    type: 'string',
                    headerText: 'Fecha de creación',
                    requerido: true
                }, {
                    headerText: 'Acciones',
                    width: 96,
                    minWidth: 80,
                    textAlign: 'Center',
                    allowFiltering: false,
                    showInColumnChooser: false,
                    allowResizing: false,
                    template: '#opcionesTemplate'
                },

            ],
            password: '',
            passwordStrength: {
            score: 0
            },
            reglas: [{
                valid: false,
                message: '8 Caracteres como mínimo'
                },
                {
                valid: false,
                message: 'Al menos una letra mayúscula'
                },
                {
                valid: false,
                message: 'Al menos una letra minúscula'
                },
                {
                valid: false,
                message: 'Al menos un número'
                },
                {
                valid: false,
                message: 'Al menos un caracter especial'
                }
            ],
            verPassword: '',
            seguridad: 0,
            colorSeguridad: '',
        },
        mounted() {
            this.cargaInicial();
        },
        methods: {
            cargaInicial() {
                this.renderDataGrid();
            },
            async renderDataGrid() {

                // Se limpian datos de grid
                let div = document.getElementById("dataGrid");
                div.innerHTML = "";

                // Se injectan dependencias de syncfusion
                ej.grids.Grid.Inject(
                    ej.grids.Page,
                    ej.grids.Sort,
                    ej.grids.Resize,
                    ej.grids.Reorder,
                    ej.grids.Toolbar,
                    ej.grids.ColumnChooser
                );
                const dataSource = JSON.parse(JSON.stringify(this.test)); // Copia profunda
                // Se arma objeto dataGrid
                var grid = new ej.grids.Grid({
                    height: '100%',
                    gridLines: 'Row',
                    dataSource: dataSource,
                    columns: this.columnas,
                    allowPaging: true,
                    allowSorting: true,
                    allowResizing: true,
                    allowReordering: true,
                    allowColumnChooser: true,
                    showColumnChooser: true,
                    pageSettings: {
                        pageSize: 50
                    },
                    toolbar: ['ColumnChooser'],
                    dataBound: () => {
                        grid.hideScroll();
                    },
                    recordClick: (args) => {
                        if (args.target.classList.contains('accionEditar')) {
                            var rowObj3 = grid.getRowObjectFromUID(ej.base.closest(args.target, '.e-row').getAttribute(
                                'data-uid'));
                            this.abrirModalEditarUsuario(rowObj3.data);
                        }
                        if (args.target.classList.contains('accionEliminar')) {
                            var rowObj3 = grid.getRowObjectFromUID(ej.base.closest(args.target, '.e-row').getAttribute(
                                'data-uid'));
                            this.abrirModalEliminarUsuario(rowObj3.data);
                        }
                    }
                });

                // Se agrega datagrid
                grid.appendTo('#dataGrid');
            },
            abrirModalAgregarUsuario() {
                this.modalAgregarUsuario = true;
                this.password = '';
                this.validarPassword();
            },
            cerrarModalAgregarUsuario() {
                this.modalAgregarUsuario = false;
            },
            abrirModalEditarUsuario(usuario) {
                this.modalEditarUsuario = true;
                this.Datasource = {
                    ...usuario
                };
            },
            cerrarModalEditarUsuario() {
                this.modalEditarUsuario = false;
            },
            abrirModalEliminarUsuario(usuario) {
                this.Datasource = usuario;
                this.modalEliminarUsuario = true;
            },
            cerrarModalEliminarUsuario() {
                this.modalEliminarUsuario = false;
            },
            onSubmit(formulario) {
                // Capturar el formulario correcto basado en el parámetro
                const form = this.$refs[formulario];

                form.submit();
            },
            buscarUsuario() {
                this.$el.querySelector('form').submit();
            },
            mostrarDropdownSesion() {
                this.showDropdownSesion = !this.showDropdownSesion;
            },
            toggleDropdown() {
                this.showDropdown = !this.showDropdown;
            },
            validarPassword() {
              // Usar zxcvbn para evaluar la fortaleza de la contraseña
            this.passwordStrength = zxcvbn(this.password);

              // Actualizar las reglas de validación
            this.reglas[0].valid = this.password.length >= 8;
            this.reglas[1].valid = /[A-Z]/.test(this.password);
            this.reglas[2].valid = /[a-z]/.test(this.password);
            this.reglas[3].valid = /\d/.test(this.password);
            this.reglas[4].valid = /[!@#$%^&*(),.?":{}|<>/]/.test(this.password);

            if (this.passwordStrength.score == 0 || this.passwordStrength.score == 1) {
                this.seguridad = 33;
                this.colorSeguridad = 'rojo';
            } else if (this.passwordStrength.score == 2 || this.passwordStrength.score == 3) {
                this.seguridad = 66;
                this.colorSeguridad = 'amarillo';
            } else if (this.passwordStrength.score == 4) {
                this.seguridad = 100;
                this.colorSeguridad = 'verde';
            }
            if (this.password == '') {
                this.seguridad = 0;
            }

            console.log(!this.reglas.every(rule => rule.valid) || (this.seguridad < 50));
            },
            generarPassword() {
            this.password = generarPasswordSegura(12);
            this.validarPassword();
            //navigator.clipboard.writeText(this.password);
            },
        },

    });
    window.app = app;
</script>
@endsection