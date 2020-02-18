<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} - Página no encontrada</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <style>
        @import url("{{ asset('css/fonts.css') }}");
        *{
          box-sizing: content-box;
          padding: 0px;
          margin: 0px;
        }
        .w-90{
          width: 90%;
        }
        .azul{
         background-color: #2c3e50;
        }
        .verde{
          background-color: #00a96d;
        }
        .btn-verde{
          background-color: #00a96d;
        }
        .btn-verde:hover{
          background-color:#009462;
        }
        main{
          min-width: 70vw;
        }
    </style>


</head>
<body>
    <div id="app">
        <cabecera></cabecera>
        <navi></navi>
        <navmobile></navmobile>
        <div>
            <div>
            <b-navbar toggleable="lg" type="verde" variant="info">
              <b-navbar-brand href="#">NavBar</b-navbar-brand>

              <b-navbar-toggle target="nav-collapse"></b-navbar-toggle>

              <b-collapse id="nav-collapse" is-nav>
                <b-navbar-nav>
                  <b-nav-item href="#">Link #1</b-nav-item>
                </b-navbar-nav>
              </b-collapse>
            </b-navbar>
          </div>
        </div>
        <div class="mt-5 container-fluid container-lg d-flex justify-content-center flex-column flex-lg-row m-0 p-0 mx-lg-auto p-lg-auto">
              <main class="px-lg-5 px-xs-5 mb-5 w-100 min-vh-100">
                <error></error>
              </main>
              <sidebar></sidebar>
          </div>
        <pie></pie>
    </div>
</body>
</html>
