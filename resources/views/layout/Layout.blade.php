<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Signa')</title>
    <!-- SYNCFUSION -->
    <link rel="stylesheet" href="{{ asset('ej2-dataGrid/styles/material.min.css') }}/">
    <link rel="stylesheet" href="{{ asset('ej2-dataGrid/styles/customized/material.min.css') }}">
    <script src="{{ asset('ej2-dataGrid/scripts/ej2.min.js') }}" type="text/javascript"></script>

    {{-- VUE --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    {{-- DAYJS --}}
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/dayjs@1/locale/es-es.js"></script>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />

    {{-- VERIFICADOR DE CONTRASEÑAS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

</head>

<body class="layout-extendida">
    <main class="contenido-general">
        @yield('contenido')
    </main>
</body>

</html>
