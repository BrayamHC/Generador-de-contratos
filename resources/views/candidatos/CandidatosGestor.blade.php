@extends('layout.Layout')
@section('contenido')
@include('components.sidebarSistema')
<div class="app" id='app'>
    @include('components.headerGlobal')
    <div class="contenido header-sidebar">
        <div class="encabezado">
            <span class="titulo" id="tituloModulo">Candidatos</span>
            <div class="opciones">
                <button @@click="abrirModalAgregarCandidato()" class="boton-primario">Agregar Candidato</button>
            </div>
        </div>
        <form method="GET" class="filtros" id="formFiltros">
            <div class="input-con-icono-contenedor">
                <input style="height:20px;" type="text" placeholder="Buscar" class="input-con-icono-derecha" name="busqueda"
                    value="{{ $filtros['busqueda'] ?? '' }}" id="inputBusquedaFiltros">
                <span class="icono-input-derecha">
                    <i class="icon-ol-buscar buscar" @@click="buscarCandidato" id="btnBuquedaCandidato"></i>
                </span>
            </div>
            <button style="margin-left: 45px;" class="boton-primario" id="btnBuscarCandidato">Buscar</button>
            <a href="{{ route('candidatos.listar') }}" class="boton boton-limpiar" id="btnLimpiarBusquedaCandidatos"><button
                    class="boton-secundario" type="button">Limpiar</button>
            </a>
        </form>
        <div class="main-content">
            <div class="tabla-gestor">
                <div id="dataGrid"></div>
            </div>
            <!-- MODALES -->
            <!-- COMIENZA MODAL AGREGAR CANDIDATO -->
            <template>
                <div v-if="modalAgregarCandidato" class="modal" id="modalAgregarCandidato">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Agregar Candidato</label>
                        </div>
                        <div style="overflow: auto;" class="modal-body">
                            <form id="formAgregarCandidato" ref="formAgregarCandidato" action="{{ route(('candidatos.crear')) }}"
                                method="POST" @@submit.prevent="onSubmit('formAgregarCandidato')">
                                @csrf
                                <div style="text-align: left;">
                                    <label class="requerido" for="candidato">Nombre</label>
                                    <input type="text" name="nombre" placeholder="Nombre" required
                                        id="inputCandidatoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoMaterno">Apellido Paterno</label>
                                    <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required
                                        id="inputApAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Materno</label>
                                    <input type="text" name="apellido_materno" placeholder="Apellido Materno" required
                                        id="inputAmAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="rfc">RFC</label>
                                    <input type="text" name="rfc" placeholder="RFC"
                                        id="inputRfcAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="curp">CURP</label>
                                    <input type="text" name="curp" placeholder="CURP"
                                        id="inputCurpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="nss">NSS</label>
                                    <input type="text" name="nss" placeholder="NSS"
                                        id="inputNssAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="direccion1">Direccion 1</label>
                                    <input type="text" name="direccion1" placeholder="Direccion 1"
                                        id="inputDunoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="direccion2">Direccion 2</label>
                                    <input type="text" name="direccion2" placeholder="Direccion 2"
                                        id="inputDireccionAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="estado">Estado</label>
                                    <input type="text" name="estado" placeholder="Estado"
                                        id="inputEstadoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" name="ciudad" placeholder="Ciudad"
                                        id="inputCiudadAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="CP">Código postal</label>
                                    <input type="text" name="cp" placeholder="Código postal"
                                        id="inputCpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="pais">País</label>
                                    <input type="text" name="pais" placeholder="País"
                                        id="inputCpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="puesto">Puesto</label>
                                    <input type="text" name="puesto" placeholder="Puesto"
                                        id="inputPuestoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="salarioDiario">Salario diario</label>
                                    <input type="number" name="salario_diario" placeholder="Salario diario"
                                        id="inputSalarioAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="fechaIngreso">Fecha de ingreso</label>
                                    <input type="date" name="fecha_ingreso" placeholder="Fecha de ingreso"
                                        id="dateIngreso" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="correoElectronico">Correo eléctronico</label>
                                    <input type="email" name="correo_electronico" placeholder="Fecha de ingreso"
                                        id="inputCorreoAgregar" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalAgregarCandidato()" id="btnCancelarAgregar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formAgregarCandidato"
                                id="btnGuardarAgregar">Registrar
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL AGREGAR CANDIDATO -->
            <!-- COMIENZA MODAL EDITAR CANDIDATO -->
            <template>
                <div v-if="modalEditarCandidato" class="modal" id="modalAgregarCandidato">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Editar Candidato</label>
                        </div>
                        <div style="overflow: auto;" class="modal-body">
                            <form :action="'{{ route('candidatos.actualizar', '') }}/' + Datasource.candidatoId" id="formEditarCandidato"
                                ref="formEditarCandidato" method="POST" @@submit.prevent="onSubmit('formEditarCandidato')">
                                @csrf
                                @method('PATCH')
                                <div style="text-align: left;">
                                    <label class="requerido" for="candidato">Nombre</label>
                                    <input type="text" name="nombre" placeholder="Nombre" required
                                        v-model="Datasource.nombreCandidato" id="inputCandidatoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Paterno</label>
                                    <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required
                                        v-model="Datasource.apellidoMaterno" id="inputApAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Materno</label>
                                    <input type="text" name="apellido_materno" placeholder="Apellido Materno" required
                                        v-model="Datasource.apellidoPaterno" id="inputAmAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="estatus">Estatus</label>
                                    <input disabled type="text" name="estatus" placeholder="Estatus"
                                        v-model="Datasource.estatus" id="inputEstatusAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="rfc">RFC</label>
                                    <input type="text" name="rfc" placeholder="RFC"
                                        v-model="Datasource.rfc" id="inputRfcAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="curp">CURP</label>
                                    <input type="text" name="curp" placeholder="CURP"
                                        v-model="Datasource.curp" id="inputCurpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="nss">NSS</label>
                                    <input type="text" name="nss" placeholder="NSS"
                                        v-model="Datasource.nss" id="inputNssAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="direccion1">Direccion 1</label>
                                    <input type="text" name="direccion1" placeholder="Direccion 1"
                                        v-model="Datasource.direccion1" id="inputDunoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="direccion2">Direccion 2</label>
                                    <input type="text" name="direccion2" placeholder="Direccion 2"
                                        v-model="Datasource.direccion2" id="inputDireccionAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="estado">Estado</label>
                                    <input type="text" name="estado" placeholder="Estado"
                                        v-model="Datasource.estado" id="inputEstadoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="ciudad">Ciudad</label>
                                    <input type="text" name="ciudad" placeholder="Ciudad"
                                        v-model="Datasource.ciudad" id="inputCiudadAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="CP">Código postal</label>
                                    <input type="text" name="cp" placeholder="Código postal"
                                        v-model="Datasource.cp" id="inputCpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="pais">País</label>
                                    <input type="text" name="pais" placeholder="País"
                                        v-model="Datasource.pais" id="inputCpAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="puesto">Puesto</label>
                                    <input type="text" name="puesto" placeholder="Puesto"
                                        v-model="Datasource.puesto" id="inputPuestoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="salarioDiario">Salario diario</label>
                                    <input type="number" name="salario_diario" placeholder="Salario diario"
                                        v-model="Datasource.salarioDiario" id="inputSalarioAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="fechaIngreso">Fecha de ingreso</label>
                                    <input type="text" name="fecha_ingreso" placeholder="Fecha de ingreso"
                                        v-model="Datasource.fechaIngreso" id="dateIngreso" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="correoElectronico">Correo eléctronico</label>
                                    <input type="email" name="correo_electronico" placeholder="Fecha de ingreso"
                                        v-model="Datasource.correoElectronico" id="inputCorreoAgregar" />
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalEditarCandidato()" id="btnCancelarAgregar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formEditarCandidato"
                                id="btnGuardarAgregar">Registrar
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL EDITAR CANDIDATO -->
            <!-- COMIENZA MODAL ELIMINAR CANDIDATO -->
            <template>
                <div v-if="modalEliminarCandidato" class="modal" id="modalEditarCandidato">
                    <div class="modal-card modal-eliminar">
                        <div class="modal-header">
                            <div></div>
                            <i class="icon-ol-cerrar"
                                id="btnCerrarModalEliminar"></i>
                        </div>
                        <div class="modal-body">
                            <form :action="'{{ route('candidatos.eliminar', '') }}/' + Datasource.candidatoId" id="formEliminarCandidato" ref="formEliminarCandidato"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input name="candidatoIdEliminar" type="hidden" v-model="Datasource.candidatoId"
                                    id="inputUsuarioIdEliminar">
                                <i class="icon-ol-eliminar"></i>
                                <h3>Eliminar candidato</h3>
                                <p>¿Estás seguro de eliminar el siguiente candidato?<br>Esta acción no se puede deshacer.</span></p>
                                <div class="contenedor-input-datos">
                                    <input :value="nombreCompleto" disabled id="inputNombreCandidatoEliminar">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalEliminarCandidato" type="button"
                                id="btnCancelarEliminar">Cancelar</button>
                            <button type="submit" class="boton-cancelacion" form="formEliminarCandidato" @@click.prevent="onSubmit('formEliminarCandidato')"
                                id="btnConfirmarEliminar">Eliminar</button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- FINALIZA MODAL ELIMINAR CANDIDATO -->
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
            Datasource: {},
            candidatoObj: {},
            modalAgregarCandidato: false,
            modalEditarCandidato: false,
            modalEliminarCandidato: false,
            modalVerCandidato: false,
            test: JSON.parse('{!! json_encode($candidatos) !!}'),
            columnas: [{
                field: 'nombreCandidato',
                type: 'string',
                textAling: 'Left',
                headerText: 'Candidato',
                required: true
            }, {
                field: 'apellidoMaterno',
                type: 'string',
                textAling: 'left',
                headerText: 'Apellido Materno',
                required: true
            }, {
                field: 'apellidoPaterno',
                type: 'string',
                textAling: 'left',
                headerText: 'Apellido Paterno',
                required: true
            }, {
                field: 'estatus',
                type: 'string',
                textAling: 'left',
                headerText: 'Estatus',
                required: true
            }, {
                headerText: 'Acciones',
                width: 96,
                minWidth: 80,
                textAlign: 'Center',
                allowFiltering: false,
                showInColumnChooser: false,
                allowResizing: false,
                template: '#opcionesTemplate'
            }, ]
        },
        computed: {
            nombreCompleto() {
                return `${this.Datasource.nombreCandidato || ''} ${this.Datasource.apellidoPaterno || ''} ${this.Datasource.apellidoMaterno || ''}`.trim();
            },
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
                console.log(dataSource);
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
                            this.abrirModalEditarCandidato(rowObj3.data);
                        }
                        if (args.target.classList.contains('accionEliminar')) {
                            var rowObj3 = grid.getRowObjectFromUID(ej.base.closest(args.target, '.e-row').getAttribute(
                                'data-uid'));
                            this.abrirModalEliminarCandidato(rowObj3.data);
                        }
                    }
                });

                // Se agrega datagrid
                grid.appendTo('#dataGrid');
            },
            renderearDatePicker() {
                var _this = this; // Guardar el contexto de 'this' para usar dentro de las funciones

                // Inicializa el DatePicker para la fecha inicial
                var datepicker = new ej.calendars.DatePicker({
                    placeholder: "Elige una fecha",
                    start: 'Month',
                    depth: 'Month',
                    format: 'dd/MM/yyyy',
                    change: function(args) {
                        // Convierte la fecha seleccionada a formato 'Y-m-d'
                        const fechaInicio = new Date(args.value);
                        _this.fechaInicio = fechaInicio.toISOString().split('T')[0];

                        // Actualiza las fechas mínima y máxima permitidas para el DatePicker final
                        const minFechaFin = new Date(fechaInicio);
                        const maxFechaFin = new Date(fechaInicio);
                        maxFechaFin.setFullYear(maxFechaFin.getFullYear() + 7); // Agrega 7 años a la fecha inicial
                    }
                });

                // Renderiza el DatePicker para la fecha inicial
                datepicker.appendTo('#dateIngreso');
            },
            abrirModalAgregarCandidato() {
                this.modalAgregarCandidato = true;
                this.$nextTick(() => {
                    this.renderearDatePicker();
                });
            },
            cerrarModalAgregarCandidato() {
                this.modalAgregarCandidato = false;
            },
            abrirModalEditarCandidato(candidato) {
                this.modalEditarCandidato = true;
                this.$nextTick(() => {
                    this.renderearDatePicker();
                });

                // Asegurarse de que la fecha se muestre correctamente
                if (candidato.fechaIngreso) {
                    // Formateamos la fecha en formato 'Y-m-d'
                    candidato.fechaIngreso = this.formatearFecha(candidato.fechaIngreso);
                }

                this.Datasource = {
                    ...candidato
                }; // Aquí se usa el objeto recibido
            },

            formatearFecha(fecha) {
                const date = new Date(fecha);
                return date.toISOString().split('T')[0]; // Formato 'YYYY-MM-DD'
            },
            cerrarModalEditarCandidato() {
                this.modalEditarCandidato = false;
            },
            abrirModalEliminarCandidato(candidato) {
                this.modalEliminarCandidato = true;
                this.Datasource = candidato;
            },
            cerrarModalEliminarCandidato() {
                this.modalEliminarCandidato = false;
            },
            onSubmit(formulario) {
                // Capturar el formulario correcto basado en el parámetro
                const form = this.$refs[formulario];

                form.submit();
            },
            buscarCandidato() {
                this.$el.querySelector('form').submit();
            },

        }
    });
    window.app = app;
</script>
@endsection