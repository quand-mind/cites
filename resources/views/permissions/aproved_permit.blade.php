<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} :: Administracion de Permisos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
</head>
<body>

  <style>
    .pdf_table{
      margin-top:25px;
      width: 100vw;
      border-spacing: 0px;
    }
    th, td {
      border-bottom: 2px solid;
      padding: 15px;
      padding-left: 25px;
      border-spacing: 0px;
    }
    th {
      border-top: 2px solid;
    }
    .mt-4{
      margin-top: 100px;
    }
  </style>

    <div id="app">
        <div id="aproved-permit">
          <img src="{{ asset('images/bandera.png') }}" alt="" height="250px">
          <h1>Permiso</h1>
          <h3>N° de Permiso: {{ $permit->request_permit_no }}</h3>
          <span style="margin-top: 20px; margin-bottom:20px;">{{$permit->permit_type->name}}</span>

          <table class="pdf_table">
            <tr>
              <th>Cliente</th>
              <th>Nacionalidad</th>
              <th>Email</th>
              <th>Cédula</th>
            </tr>
            <tr>
              <td>{{$permit->client->user->name}}</td>
              <td>{{$permit->client->user->nationality}}</td>
              <td>{{$permit->client->email}}</td>
              <td>{{$permit->client->user->dni}}</td>
            </tr>
          </table>
          <h3>Datos del Permiso</h3>
          <table class="pdf_table">
            <tr>
              <th>Lugar de Envío</th>
              <th>Lugar de Llegada</th>
              <th>Email</th>
              <th>Cédula</th>
            </tr>
            <tr>
              <td>{{$permit->destiny_place}}</td>
              <td>{{$permit->departure_place}}</td>
              <td>{{$permit->shipment_port}}</td>
              <td>{{$permit->landing_port}}</td>
            </tr>
          </table>
          <table class="pdf_table">
            <tr>
              <th>Fecha de Creación</th>
              <th>Fecha de Emisión</th>
              <th>Válido Hasta</th>
            </tr>
            <tr>
              <td>{{date('d-m-Y', strtotime($permit->created_at))}}</td>
              <td>{{date('d-m-Y', strtotime($permit->updated_at))}}</td>
              <td>{{$permit->valid_until}}</td>
            </tr>
          </table>
          <div class="mt-4"></div>
          <hr>
          <h3 class="mt-4">Especies</h3>
          <table class="pdf_table">
            <tr>
              <th>Nombre Común</th>
              <th>Nombre Científico</th>
              <th>Tipo</th>
              <th>Cantidad</th>
            </tr>
            @foreach ($permit->species as $specie)
              <tr>
                  <td>{{$specie->name_common}}</td>
                  <td>{{$specie->name_scientific}}</td>
                  <td>{{$specie->type}}</td>
                  <td>{{$specie->pivot->qty}}</td>
              </tr>
            @endforeach
          </table>


        </div>
    </div>
</body>
</html>