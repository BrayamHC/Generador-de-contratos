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
                                method="POST" @@submit.prevent="onSubmit('formAgregarUsuario')">
                                @csrf
                                <div style="text-align: left;">
                                    <label class="requerido" for="candidato">Nombre</label>
                                    <input type="text" name="candidato" placeholder="Nombre" required
                                        id="inputCandidatoAgregar" value="{{ old('nombreCandidato') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoMaterno">Apellido Paterno</label>
                                    <input type="text" name="apellidoMaterno" placeholder="Apellido Paterno" required
                                        id="inputApAgregar" value="{{ old('apellidoMaterno') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Materno</label>
                                    <input type="text" name="apellidoPaterno" placeholder="Apellido Materno" required
                                        id="inputAmAgregar" value="{{ old('apellidoPaterno') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="rfc">RFC</label>
                                    <input type="text" name="rfc" placeholder="RFC"
                                        id="inputRfcAgregar" value="{{ old('rfc') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="curp">CURP</label>
                                    <input type="text" name="curp" placeholder="CURP"
                                        id="inputCurpAgregar" value="{{ old('curp') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="nss">NSS</label>
                                    <input type="text" name="nss" placeholder="NSS"
                                        id="inputNssAgregar" value="{{ old('nss') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="direccion1">Direccion 1</label>
                                    <input type="text" name="direccion1" placeholder="Direccion 1"
                                        id="inputDunoAgregar" value="{{ old('direccion1') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="direccion2">Direccion 2</label>
                                    <input type="text" name="direccion1" placeholder="Direccion 2"
                                        id="inputDireccionAgregar" value="{{ old('direccion2') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="estado">Estado</label>
                                    <input type="text" name="estado" placeholder="Estado"
                                        id="inputEstadoAgregar" value="{{ old('estado') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="ciudad">Ciudad</label>
                                    <input type="text" name="cuidad" placeholder="Ciudad"
                                        id="inputCiudadAgregar" value="{{ old('cuidad') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="CP">Código postal</label>
                                    <input type="text" name="cp" placeholder="Código postal"
                                        id="inputCpAgregar" value="{{ old('cp') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="pais">País</label>
                                    <input type="text" name="cp" placeholder="País"
                                        id="inputCpAgregar" value="{{ old('pais') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="puesto">Puesto</label>
                                    <input type="text" name="puesto" placeholder="Puesto"
                                        id="inputPuestoAgregar" value="{{ old('puesto') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="salarioDiario">Salario diario</label>
                                    <input type="number" name="salarioDiario" placeholder="Salario diario"
                                        id="inputSalarioAgregar" value="{{ old('salarioDiario') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="fechaIngreso">Fecha de ingreso</label>
                                    <input type="date" name="fechaIngreso" placeholder="Fecha de ingreso"
                                        id="dateIngreso" value="{{ old('fechaIngreso') }}" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="correoElectronico">Correo eléctronico</label>
                                    <input type="email" name="correoElectronico" placeholder="Fecha de ingreso"
                                        id="inputCorreoAgregar" value="{{ old('correoElectronico') }}" />
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
            <!-- TERMINA MODAL AGREGAR USUARIO -->
        </div>
    </div>
</div>

<script id="opcionesTemplate" type="text/x-template">
    <div class="celda-acciones-gestor">
        @if (auth()->user()->superusuario)
            <a title="Editar">Editar</a>
            <a title="Eliminar">Eliminar</a>
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
            Datasource: [],
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