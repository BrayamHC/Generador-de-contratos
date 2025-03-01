<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('titulo', 'Manage Admin')</title>
    <!-- SYNCFUSION -->
    <link rel="stylesheet" href="{{ config('app.url') }}/ej2-dataGrid/styles/material.min.css">
    <link rel="stylesheet" href="{{ config('app.url') }}/ej2-dataGrid/styles/customized/material.min.css">
    <script src="{{ config('app.url') }}/ej2-dataGrid/scripts/ej2.min.js" type="text/javascript"></script>

    {{-- VUE --}}
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>

    <script src="{{ config('app.url') }}/js/bootstrap.js"></script>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="{{ config('app.url') }}/css/estilos.css" />

    {{-- VERIFICADOR DE CONTRASEÑAS --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/zxcvbn/4.4.2/zxcvbn.js"></script>

</head>

<body>
    @include('components.sidebar', [])
    <main class="container">
        @yield('contenido')
    </main>
</body>

</html>
