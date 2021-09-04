<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} :: Administracion de Permisos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" integrity="sha384-REHJTs1r2ErKBuJB0fCK99gCYsVjwxHrSU0N7I1zl9vZbggVJXRMsv/sLlOAGb4M" crossorigin="anonymous">
</head>
<body>

  <style>
    body {
      margin: 0;
      padding: 0;
    }
    .absolute {
      margin: auto;
      display: inline;
      position: absolute;
      /* padding: 10px; */
    }
  </style>

    <div id="app">
      <div style="width:100%">

        <div style="position: absolute; top:0; left:0; width:45%; display:inline;">
          <img src="data:image/png;base64,{{ $logo }}" style="margin-right: 10px; display:inline; width: 10%;"/>
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">CONVENCION SOBRE EL COMERCIO INTERNACIONAL DE ESPECIES AMENAZADAS DE FAUNA Y FLORA SILVESTRES</h6>
        </div>
        <div style="border-left: 2px solid; border-bottom: 1px solid; position: absolute; padding:5px; top:0; left:269; width:50%; height: 71px; display:inline;">
          <h6 class="absolute" style="width: 100%; margin-top: 0px; top: 0; left:70;">Permiso/Certificado N°: {{$permit->request_permit_no}}</h6>
          @if ($permit->permit_type->type === 'export')
            <h6 class="absolute" style="padding-left: 5px; width: 80%; margin-top: 0px; top: 13;">Tipo: Exportación</h6>
          @endif
          <h6 class="absolute" style="padding-left: 5px; width:180px; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid; margin-top: 0px; top: 19; right: 0;">Válido hasta el:</h6>
          <span class="absolute" style="font-size: 16px;padding-left: 5px; width:180px; border-left: 1px solid; border-right: 1px solid; margin-top: 0px; top: 29; right: 0;">{{$permit->valid_until}}</span>
        </div>

        <div style="position: absolute; padding:5px; top:39; border:1px solid; height: 70px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Importador</h6>
        </div>
        <div style="position: absolute; padding:5px; top:39; border:1px solid; height: 70px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Exportador</h6>
        </div>

        <div style="position: absolute; padding:5px; top:78; border:1px solid; height: 30px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">País de Importación</h6>
        </div>
        <div style="position: absolute; padding:5px; top:78;  border:1px solid; height: 30px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">País de Exportación</h6>
        </div>

        <div style="position: absolute; padding:5px; top:98; border:1px solid; height: 140px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Condiciones Especiales</h6>
        </div>
        <div style="position: absolute; padding:5px; top:98; border:1px solid; height: 200px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Nombre, dirección, sello/timbre nacional y país de la Autoridad Administrativa</h6>
        </div>
        <div style="position: absolute; padding:5px; top:170; border:1px solid; height: 50px; left:0; width:24%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Fin de la Transacción</h6>
        </div>
        <div style="position: absolute; padding:5px; top:170; border:1px solid; height: 50px; left:132; width:25%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">N° de Estampilla de Seguridad</h6>
        </div>

        <div style="position: absolute; padding:5px; top:200; border:1px solid; height: 50px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 0;">Nombre Científico y Nombre Común de la especie</h6>
          <h6 class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140;">Descripción de los especímenes</h6>
        </div>
        <div style="position: absolute; padding:5px; top:200; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style=" border-right: 1px solid; width: 20%; padding-top:2px; margin-top: 0px; height:56px; top: -2;">Apéndice y Origen</h6>
        </div>

      </div>
    </div>
</body>
</html>