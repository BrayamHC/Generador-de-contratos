@extends('layout.Layout')
@section('contenido')
@include('components.sidebarSistema')
<div class="app" id="app">
    @include('components.headerGlobal')
    <div class="contenido header-sidebar">
        <div class="encabezado">
            <span class="titulo" id="tituloModulo">Empleados</span>
            <div class="opciones">
                <button @@click="abrirModalAgregarEmpleado()" class="boton-primario">Agregar Empleado</button>
            </div>
        </div>
        <form method="GET" class="filtros" id="formFiltros">
            <div class="input-con-icono-contenedor">
                <input style="height:20px;" type="text" placeholder="Buscar" class="input-con-icono-derecha" name="busqueda"
                    value="{{ $filtros['busqueda'] ?? '' }}" id="inputBusquedaFiltros">
                <span class="icono-input-derecha">
                    <i class="icon-ol-buscar buscar" id="btnBuquedaEmpleado"></i>
                </span>
            </div>
            <button style="margin-left: 45px;" class="boton-primario" id="btnBuscarEmpleado">Buscar</button>
            <a href="{{route('empleados.listar')}}" class="boton boton-limpiar" id="btnLimpiarBusquedaEmpleado"><button
                    class="boton-secundario" type="button">Limpiar</button>
            </a>
        </form>
        <div class="main-content">
            <div class="tabla-gestor">
                <div id="dataGrid"></div>
            </div>
            <!-- MODALES -->
            <!-- COMIENZA MODAL AGREGAR EMPLEADO -->
            <template>
                <div v-if="modalAgregarEmpleado" class="modal" id="modalAgregarEmpleado">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Agregar Empleado</label>
                        </div>
                        <div style="overflow: auto;" class="modal-body">
                            <form id="formAgregarEmpleado" ref="formAgregarEmpleado" action="{{ route(('empleados.crear')) }}"
                                method="POST" @@submit.prevent="onSubmit('formAgregarEmpleado')">
                                @csrf
                                <div style="text-align: left;">
                                    <label class="requerido" for="empleado">Nombre</label>
                                    <input type="text" name="nombre" placeholder="Nombre" required
                                        id="inputEmpleadoAgregar" />
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
                            <button @@click="cerrarModalAgregarEmpleado()" id="btnCancelarAgregar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formAgregarEmpleado"
                                id="btnGuardarAgregar">Registrar
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL AGREGAR EMPLEADO -->
            <!-- COMIENZA MODAL EDITAR EMPLEADO -->
            <template>
                <div v-if="modalEditarEmpleado" class="modal" id="modalEditarEmpleado">
                    <div class="modal-card" id="modalGenerar">
                        <div class="modal-header">
                            <label>Editar Empleado</label>
                        </div>
                        <div style="overflow: auto;" class="modal-body">
                            <form :action="'{{ route('empleados.actualizar', '') }}/' + Datasource.empleadoId" id="formEditarEmpleado"
                                ref="formEditarEmpleado" method="POST" @@submit.prevent="onSubmit('formEditarEmpleado')">
                                @csrf
                                @method('PATCH')
                                <div style="text-align: left;">
                                    <label class="requerido" for="empleado">Nombre</label>
                                    <input type="text" name="nombre" placeholder="Nombre" required
                                        v-model="Datasource.nombreEmpleado" id="inputEmpleadoAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Paterno</label>
                                    <input type="text" name="apellido_paterno" placeholder="Apellido Paterno" required
                                        v-model="Datasource.apellidoPaterno" id="inputApAgregar" />
                                </div>
                                <div style="text-align: left;">
                                    <label class="requerido" for="apellidoPaterno">Apellido Materno</label>
                                    <input type="text" name="apellido_materno" placeholder="Apellido Materno" required
                                        v-model="Datasource.apellidoMaterno" id="inputAmAgregar" />
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
                                    <input type="text" name="salario_diario" placeholder="Salario diario"
                                        v-model="Datasource.salarioDiario"
                                        id="inputSalarioAgregar"
                                        @input="actualizarSalario"
                                        :value="formatearSalario(Datasource.salarioDiario)" />
                                </div>
                                <div style="text-align: left;">
                                    <label for="fechaIngreso">Fecha de ingreso</label>
                                    <input type="date" name="fecha_ingreso" placeholder="Fecha de ingreso"
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
                            <button @@click="cerrarModalEditarEmpleado()" id="btnCancelarAgregar">Cancelar</button>
                            <button type="submit" class="boton-primario" form="formEditarEmpleado"
                                id="btnGuardarAgregar">Registrar
                            </button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL EDITAR EMPLEADO -->
            <!-- INICIA MODAL VER EMPLEADO -->
            <template>
                <div v-if="modalDetalleEmpleado" class="modal modal-detalle" id="modalDetalleEmpleado">
                    <div class="modal-card modal-detalle">
                        <div class="header-modal">
                        </div>
                        <div class="encabezado">
                            <label id="labelNombreEmpleadoDetalle">@{{ nombreCompleto }}</label>
                            <div class="opciones">
                            </div>
                        </div>
                        <div class="datos-generales">
                            <label class="titulo"> Datos del empleado </label>
                            <table class="tabla-detalle">
                                <tbody>
                                    <tr>
                                        <td class="w30p">Nombre</td>
                                        <td id="labelNombreTablaDetalle">@{{ Datasource.nombreEmpleado }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Apellido Paterno</td>
                                        <td id="labelApDetalle">@{{ Datasource.apellidoPaterno }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Apellido Materno</td>
                                        <td id="labelApDetalle">@{{ Datasource.apellidoMaterno }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Status</td>
                                        <td id="labelEstatusDetalle">@{{ Datasource.estatus }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">RFC</td>
                                        <td id="labelRfcDetalle">@{{ Datasource.rfc }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">CURP</td>
                                        <td id="labelCurpDetalle">@{{ Datasource.curp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">NSS</td>
                                        <td id="labelNssDetalle">@{{ Datasource.curp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Dirección 1</td>
                                        <td id="labelDirDetalle">@{{ Datasource.direccion1 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Dirección 2</td>
                                        <td id="labelDireccionDetalle">@{{ Datasource.direccion2 }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Estado</td>
                                        <td id="labelEstadoDetalle">@{{ Datasource.estado }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Ciudad</td>
                                        <td id="labelCiudadDetalle">@{{ Datasource.ciudad }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Código postal</td>
                                        <td id="labelCpDetalle">@{{ Datasource.cp }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">País</td>
                                        <td id="labelPaisDetalle">@{{ Datasource.pais }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Salario diario</td>
                                        <td id="labelSalarioDetalle">@{{ Datasource.salarioDiario }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Fecha ingreso</td>
                                        <td id="labelFechaIngresoDetalle">@{{ Datasource.fechaIngreso }}</td>
                                    </tr>
                                    <tr>
                                        <td class="w30p">Correo eléctronico</td>
                                        <td id="labelCorreoDetalle">@{{ Datasource.correoElectronico }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-background" @@click="cerrarModalDetalleEmpleado"></div>
                </div>
            </template>
            <!-- TERMINA MODAL VER EMPLEADO -->
            <!-- COMIENZA MODAL ELIMINAR EMPLEADO -->
            <template>
                <div v-if="modalEliminarEmpleado" class="modal" id="modalEditarEmpleado">
                    <div class="modal-card modal-eliminar">
                        <div class="modal-body">
                            <form :action="'{{ route('empleados.eliminar', '') }}/' + Datasource.empleadoId" id="formEliminarEmpleado" ref="formEliminarEmpleado"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <input name="empleadoIdEliminar" type="hidden" v-model="Datasource.empleadoId"
                                    id="inputUsuarioIdEliminar">
                                <i class="icon-ol-eliminar"></i>
                                <h3>Eliminar candidato</h3>
                                <p>¿Estás seguro de eliminar el siguiente candidato?<br>Esta acción no se puede deshacer.</span></p>
                                <div class="contenedor-input-datos">
                                    <input :value="nombreCompleto" disabled id="inputNombreEmpleadoEliminar">
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @@click="cerrarModalEliminarEmpleado" type="button"
                                id="btnCancelarEliminar">Cancelar</button>
                            <button type="submit" class="boton-cancelacion" form="formEliminarEmpleado" @@click.prevent="onSubmit('formEliminarEmpleado')"
                                id="btnConfirmarEliminar">Eliminar</button>
                        </div>
                    </div>
                    <div class="modal-background"></div>
                </div>
            </template>
            <!-- TERMINA MODAL ELIMINAR EMPLEADO -->
        </div>
    </div>
</div>

<script id="opcionesTemplate" type="text/x-template">
    <div class="celda-acciones-gestor">
            <a class="accionEditar" title="Editar">Editar</a>
            <a class="accionEliminar" title="Eliminar">Eliminar</a>
    </div>
</script>
@verbatim
<script type="text/x-jsrender" id="link-detalle">
    <a href="javascript:void(0);" class="link-detalle">
    @{{ Datasource.nombreEmpleado }
    </a>
</script>
@endverbatim
<!-- VUE -->

<script>
    var app = new Vue({
        el: '#app',
        data: {
            usuarioLogueado: {},
            empladoObj: {},
            Datasource: {},
            //Modales
            modalAgregarEmpleado: false,
            modalEditarEmpleado: false,
            modalEliminarEmpleado: false,
            modalDetalleEmpleado: false,
            test: JSON.parse('{!! json_encode($empleados) !!}'),
            //Columnas
            columnas: [{
                field: 'nombreEmpleado',
                textAlign: 'Left',
                type: 'string',
                headerText: 'Empleado',
                requerido: true,
                template: function(args) {
                    return '<a href="javascript:void(0);" class="link-detalle">' + args.nombreEmpleado + '</a>';
                }
            }, {
                field: 'apellidoPaterno',
                textAlign: 'Left',
                type: 'string',
                headerText: 'Apellido Paterno',
                requerido: true
            }, {
                field: 'apellidoMaterno',
                textAlign: 'Left',
                type: 'string',
                headerText: 'Apellido Materno',
                requerido: true
            }, {
                field: 'estatus',
                textAlign: 'Left',
                type: 'string',
                headerText: 'Estatus',
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
            }, ]
        },
        computed: {
            nombreCompleto() {
                return `${this.Datasource.nombreEmpleado || ''} ${this.Datasource.apellidoPaterno || ''} ${this.Datasource.apellidoMaterno || ''}`.trim();
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
                        var rowObj3 = grid.getRowObjectFromUID(ej.base.closest(args.target, '.e-row').getAttribute('data-uid'));

                        if (args.target.classList.contains('accionEditar')) {
                            this.abrirModalEditarEmpleado(rowObj3.data);
                        } else if (args.target.classList.contains('accionEliminar')) {
                            this.abrirModalEliminarEmpleado(rowObj3.data);
                        } else if (args.target.classList.contains('link-detalle') || args.target.classList.contains('link-detalle')) {
                            this.abrirModalDetalleEmpleado(rowObj3.data);
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
                    format: 'yyyy-MM-dd',
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

            abrirModalAgregarEmpleado() {
                this.modalAgregarEmpleado = true;
                this.$nextTick(() => {
                    this.renderearDatePicker();
                });
            },
            cerrarModalAgregarEmpleado() {
                this.modalAgregarEmpleado = false;
            },
            abrirModalEditarEmpleado(empleado) {
                this.modalEditarEmpleado = true;
                this.$nextTick(() => {
                    this.renderearDatePicker();
                });

                // Asegurarse de que la fecha se muestre correctamente
                if (empleado.fechaIngreso) {
                    // Formateamos la fecha en formato 'Y-m-d'
                    empleado.fechaIngreso = this.formatearFecha(empleado.fechaIngreso);
                }

                this.Datasource = {
                    ...empleado
                }; // Aquí se usa el objeto recibido
            },
            cerrarModalEditarEmpleado() {
                this.modalEditarEmpleado = false;
            },
            abrirModalDetalleEmpleado(empleado) {
                this.modalDetalleEmpleado = true;
                this.Datasource = empleado;
                // Asegurarse de que la fecha se muestre correctamente
                if (empleado.fechaIngreso) {
                    // Formateamos la fecha en formato 'Y-m-d'
                    empleado.fechaIngreso = this.formatearFecha(empleado.fechaIngreso);
                }
            },
            cerrarModalDetalleEmpleado() {
                this.modalDetalleEmpleado = false;
            },
            abrirModalEliminarEmpleado(empleado) {
                this.modalEliminarEmpleado = true;
                this.Datasource = empleado;
            },
            cerrarModalEliminarEmpleado() {
                this.modalEliminarEmpleado = false;
            },
            onSubmit(formulario) {
                // Capturar el formulario correcto basado en el parámetro
                const form = this.$refs[formulario];

                form.submit();
            },
            formatearFecha(fecha) {
                const date = new Date(fecha);
                return date.toISOString().split('T')[0]; // Formato 'YYYY-MM-DD'
            },
            // Formatea el salario a formato monetario
            formatearSalario(salario) {
                if (!salario) return ''; // Si no hay valor, retorna vacío
                return salario.toLocaleString('es-MX', {
                    style: 'currency',
                    currency: 'MXN'
                });
            },

            // Elimina los caracteres no numéricos al guardar el valor
            quitarFormatoSalario(salario) {
                return salario.replace(/[^0-9.-]+/g, ''); // Elimina cualquier cosa que no sea número o punto
            },

            // Método de cuando el valor cambia en el input
            actualizarSalario() {
                this.Datasource.salarioDiario = this.quitarFormatoSalario(this.Datasource.salarioDiario);
            }

        }
    });
</script>



@endsection