<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @yield('title')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    {{-- <!-- Theme included stylesheets -->
    <link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">

    <!-- Core build with no theme, formatting, non-essential modules -->
    <link href="//cdn.quilljs.com/1.3.6/quill.core.css" rel="stylesheet">
    <script src="//cdn.quilljs.com/1.3.6/quill.core.js"></script> --}}
  
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
        .ql-editor img{
          max-width: 100%; 
        }
    </style>
</head>
<body>
    <div id="app">
        <cabecera></cabecera>
        <navi :menu-links="{{ $links->toJson() }}"></navi>
        <navmobile :menu-links="{{ $links->toJson() }}"></navmobile>
        <div class="mt-5 container-fluid container-lg d-flex justify-content-center flex-column flex-lg-row m-0 p-0 mx-lg-auto p-lg-auto">
              <main class="px-lg-5 px-xs-5 mb-5">
                @yield('content')
              </main>
              <sidebar></sidebar>
          </div>
        <pie></pie>
    </div>
</body>
</html>
