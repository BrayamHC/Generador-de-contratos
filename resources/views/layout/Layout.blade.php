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

    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/croppie.js') }}"></script>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="{{ asset('css/estilos.css') }}" />

    <link rel="stylesheet" href="{{ asset('ico/outline/outline.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/normalizacion.css') }}" />



    {{-- VERIFICADOR DE CONTRASEÑAS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

</head>

<body class="layout-extendida">
    <main class="contenido-general">
        @yield('contenido')
    </main>
    <script>
        var tooltipHome = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipUsuarios = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipCandidatos = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipRH = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipProyectos = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipContratos = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        var tooltipVacaciones = new ej.popups.Tooltip({
            position: 'RightCenter',
            showTipPointer: false,
        });
        tooltipHome.appendTo('#homeMenu');
        tooltipUsuarios.appendTo('#homeUsuarios');
        tooltipCandidatos.appendTo('#homeCandidatos');
        tooltipRH.appendTo('#homeRH');
        tooltipProyectos.appendTo('#homeProyectos');
        tooltipContratos.appendTo('#homeContratos');
        tooltipVacaciones.appendTo('#homeVacaciones');
    </script>

</body>

</html>
