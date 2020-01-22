<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }}</title>
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
        <div class="container-fluid container-lg container-xl d-flex justify-content-center flex-column flex-xl-row flex-lg-row m-0 p-0 m-lg-auto p-lg-auto m-xl-auto p-xl-auto">
              <main class="px-lg-5 px-xs-5 mb-5 w-100 min-vh-100">
                <router-view></router-view>
              </main>
              <!-- <sidebar></sidebar> -->
          </div>
        <pie></pie>
    </div>
</body>
</html>
