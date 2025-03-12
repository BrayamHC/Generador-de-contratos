@extends('layout.Layout')
@section('contenido')
@include('components.sidebarSistema')
<div class="app" id="app">
    @include('components.headerGlobal')
    <div class="contenido header-sidebar">
        <div class="encabezado">
            <span class="titulo" id="tituloModulo">Empleados</span>
            <div class="opciones">
                <button class="boton-primario">Agregar Empleado</button>
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
        </div>
    </div>
</div>


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
                            this.abrirModalDetallEmpleado(rowObj3.data);
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

        }
    });
</script>



@endsection