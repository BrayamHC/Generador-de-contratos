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
                    <i class="icon-ol-buscar buscar" @@click="buscarEmpleado" id="btnBuquedaEmpleado"></i>
                </span>
            </div>
            <button style="margin-left: 45px;" class="boton-primario" id="btnBuscarEmpleado">Buscar</button>
            <a class="boton boton-limpiar" id="btnLimpiarBusquedaEmpleado"><button
                    class="boton-secundario" type="button">Limpiar</button>
            </a>
        </form>
    </div>
</div>
@endsection