<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} :: Administracion de Permisos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
</head>
<body>

    <div id="app">
        @include('permissions.includes.app-nav')
        @include('permissions.includes.side-menu')
        <main class="dashboard-panel py-4 px-5">
            @yield('content')
        </main>
    </div>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>