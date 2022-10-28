<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ env('APP_NAME') }} :: Administracion de Permisos</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">
    <style>
      @page { size: 31cm 21cm landscape; }
    </style>
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
        <div style="position: absolute; top:0; left:0; width:40%; display:inline;">
          <img src="data:image/png;base64,{{ $logo }}" style="margin-right: 10px; display:inline; width: 15%;"/>
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">CONVENCION SOBRE EL COMERCIO INTERNACIONAL DE ESPECIES AMENAZADAS DE FAUNA Y FLORA SILVESTRES</h6>
        </div>
        <div style="border-left: 2px solid; border-bottom: 1px solid; position: absolute; padding:5px; top:0; left:269; width:50%; height: 71px; display:inline;">
          <h6 class="absolute" style="width: 100%; margin-top: 0px; top: 0; left:70;">N° SISTRA: {{$permit->sistra}}</h6>
          @if ($permit->permit_type->type === 'export')
            <h6 class="absolute" style="padding-left: 5px; width: 80%; margin-top: 0px; top: 13;">Tipo: Exportación</h6>
          @endif
          <h6 class="absolute" style="padding-left: 5px; width:180px; border-top: 1px solid; border-left: 1px solid; border-right: 1px solid; margin-top: 0px; top: 19; right: 0;">Válido hasta el:</h6>
          <span class="absolute" style="font-size: 16px;padding-left: 5px; width:180px; border-left: 1px solid; border-right: 1px solid; margin-top: 0px; top: 29; right: 0;">{{$permit->valid_until}}</span>
        </div>

        <div style="position: absolute; padding:5px; top:39; border:1px solid; height: 70px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 20%; margin-top: 0px; top: 0;">Importador</h6>
          @if ($permit->permit_type->type =="import")
            <span class="absolute" style="width: 20%;margin-top: 0px; left:50; top: 3 ; font-size: 16px; ">{{$permit->formalitie->client->user->name}}</span>
          @endif
          @if ($permit->permit_type->type =="export" || $permit->permit_type->type =="reexport")
            <span class="absolute" style="width: 20%;margin-top: 0px; left:50; top: 3 ; font-size: 16px; ">{{$permit->consigned_to}}</span>
          @endif
        </div>
        <div style="position: absolute; padding:5px; top:39; border:1px solid; height: 70px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 20%; margin-top: 0px; top: 0;">Exportador</h6>
          @if ($permit->permit_type->type =="import") 
            <span class="absolute" style="width: 20%;margin-top: 0px; left:50; top: 3 ; font-size: 16px; ">{{$permit->consigned_to}}</span>
          @endif
          @if ($permit->permit_type->type =="export" || $permit->permit_type->type =="reexport")
            <span class="absolute" style="width: 20%;margin-top: 0px; left:50; top: 3 ; font-size: 16px; ">{{$permit->formalitie->client->user->name}}</span>
          @endif
        </div>

        <div style="position: absolute; padding:5px; top:78; border:1px solid; height: 30px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">País de Importación</h6>
          @if ($permit->permit_type->type =="import")
            <span class="absolute" style="width: 80%;margin-top: 0px; left:80; top: 3 ; font-size: 16px; ">Venezuela, VE</span>
          @endif
          @if ($permit->permit_type->type =="export" || $permit->permit_type->type =="reexport")
            <span class="absolute" style="width: 80%;margin-top: 0px; left:80; top: 3 ; font-size: 16px; ">{{$permit->country}}, {{$permit->country_code}}</span>
          @endif
        </div>
        <div style="position: absolute; padding:5px; top:78;  border:1px solid; height: 30px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">País de Exportación</h6>
          @if ($permit->permit_type->type =="import")
            <span class="absolute" style="width: 80%;margin-top: 0px; left:80; top: 3 ; font-size: 16px; ">{{$permit->country}}, {{$permit->country_code}}</span>
          @endif
          @if ($permit->permit_type->type =="export" || $permit->permit_type->type =="reexport")
            <span class="absolute" style="width: 80%;margin-top: 0px; left:80; top: 3 ; font-size: 16px; ">Venezuela, VE</span>
          @endif
        </div>

        <div style="position: absolute; padding:5px; top:98; border:1px solid; height: 140px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Condiciones Especiales</h6>
        </div>
        <div style="position: absolute; padding:5px; top:98; border:1px solid; height: 200px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style="width: 100%; margin-top: 0px; top: 0;">Nombre, dirección, sello/timbre nacional y país de la Autoridad Administrativa</h6>
          <h6 class="absolute" style="width: 100%; margin-top: 0px; left:30; top: 37;">República Bolivariana de Venezuela</h6>
          <span class="absolute" style="width: 30%; margin-top: 0px; left:30; top: 47 ; font-size: 16px; ">Ministerio del Ambiente y de los Recursos Naturales Renovables</span>
          <h6 class="absolute" style="width: 100%; margin-top: 0px; left:30; top: 80; font-size: 16px;">Centro Simón Bolívar, Torre Sur, Caracas, 1010</h6>
        </div>
        <div style="position: absolute; padding:5px; top:170; border:1px solid; height: 50px; left:0; width:24%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">Fin de la Transacción</h6>
          <span class="absolute" style="width: 80%;margin-top: 0px; left:3; top: 17 ; font-size: 16px; ">{{$permit->purpose}}</span>
        </div>
        <div style="position: absolute; padding:5px; top:170; border:1px solid; height: 50px; left:132; width:25%; display:inline;">
          <h6 class="absolute" style="width: 100%;margin-top: 0px; top: 0;">N° de Estampilla de Seguridad</h6>
          <span class="absolute" style="width: 100%;margin-top: 0px; left:3; top: 17 ; font-size: 16px; ">{{$permit->stamp_number}}</span>
        </div>

        <div style="position: absolute; padding:5px; top:200; border:1px solid; height: 50px; left:0; width:50%; display:inline;">
          <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 0;">Nombre Científico y Nombre Común de la especie</h6>
          <h6 class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140;">Descripción de los especímenes</h6>
        </div>
        <div style="position: absolute; padding:5px; top:200; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
          <h6 class="absolute" style=" border-right: 1px solid; width: 30%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:4;">Apéndice y Origen</h6>
          <h6 class="absolute" style=" border-right: 1px solid; width: 33%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:88;">Cantidad</h6>
          <h6 class="absolute" style="  width: 34%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:178;">Total Exportado</h6>
        </div>

        @php
          $count =0;
        @endphp

        {{-- @foreach($permit->permit->species[]s as $permit->species[]) --}}
          
          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 110px; left:0; width:2%; display:inline;">
            @if($count == 1)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">A</h6>
            @endif
            @if($count == 3)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">B</h6>
            @endif
            @if($count == 5)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">C</h6>
            @endif
            @if($count == 7)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">D</h6>
            @endif
          </div>

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:47%; display:inline;">
            <span class="absolute" style="width: 40%;margin-top: 0px; top: 12; font-size: 8;">{{$permit->species[0]->name_scientific}}</span>
            <span class="absolute" style="width: 40%;margin-top: 0px; top: 0; font-size: 8;">{{$permit->species[0]->name_common}}</span>
            <span class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140; font-size: 8;">{{$permit->species[0]->pivot->description}}</span>
          </div>
          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
            <span class="absolute" style=" border-right: 1px solid; width: 30%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:4;font-size: 8;">{{$permit->species[0]->appendix}}, {{$permit->species[0]->pivot->origin}}</span>
            <span class="absolute" style=" border-right: 1px solid; width: 33%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:88; font-size: 8;">{{$permit->species[0]->pivot->qty}}</span>
            <span class="absolute" style="  width: 34%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:178; font-size: 8;"></span>
          </div>

          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:98%; display:inline;">
            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: -5px; top: 0; font-size: 14px;">País de Origen:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:4">{{$permit->species[0]->pivot->origin_country}}</span>

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:57; font-size: 14px;">Permiso N°:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:57"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:112; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:112"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 20%; height:60px; margin-top: 0px; top: 0; left:168; font-size: 14px;"> País de la última reexportación:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:168"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:277; font-size: 14px;"> N° Certificado:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:277"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:344; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:344"></span>
                      
            <h6 class="absolute" style="border-right:1px solid; width: 21%; height:60px; margin-top: 0px; top: 0; left:413; font-size: 14px;"> N° de la operación o fecha de adquisición:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 38px; top: 0; font-size: 12px; left:413"></span>
          </div>
          
          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 110px; left:0; width:2%; display:inline;">
            @if($count == 1)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">A</h6>
            @endif
            @if($count == 3)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">B</h6>
            @endif
            @if($count == 5)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">C</h6>
            @endif
            @if($count == 7)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">D</h6>
            @endif
          </div>

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:47%; display:inline;">
            @if (count($permit->species) > 1)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 12; font-size: 8;">{{$permit->species[1]->name_scientific}}</span>
            @endif
            @if (count($permit->species) > 1)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 0; font-size: 8;">{{$permit->species[1]->name_common}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 1)
              <span class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140; font-size: 8;">{{$permit->species[1]->pivot->description}}</span>
            @endif
          </div>
          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
            @if (count($permit->species) > 1)
              <span class="absolute" style=" border-right: 1px solid; width: 30%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:4;font-size: 8;">{{$permit->species[1]->appendix}}, {{$permit->species[1]->pivot->origin}}</span>
            @endif
            @if (count($permit->species) > 1)
              <span class="absolute" style=" border-right: 1px solid; width: 33%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:88; font-size: 8;">{{$permit->species[1]->pivot->qty}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 1)
              <span class="absolute" style="  width: 34%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:178; font-size: 8;"></span>
            @endif
          </div>

          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:98%; display:inline;">
            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: -5px; top: 0; font-size: 14px;">País de Origen:</h6>
            @if (count($permit->species) > 1) 
              <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:4">{{$permit->species[1]->pivot->origin_country}}</span>
            @else
              <hr style="margin-top:38px;">
            @endif

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:57; font-size: 14px;">Permiso N°:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:57"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:112; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:112"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 20%; height:60px; margin-top: 0px; top: 0; left:168; font-size: 14px;"> País de la última reexportación:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:168"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:277; font-size: 14px;"> N° Certificado:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:277"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:344; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:344"></span>
                      
            <h6 class="absolute" style="border-right:1px solid; width: 21%; height:60px; margin-top: 0px; top: 0; left:413; font-size: 14px;"> N° de la operación o fecha de adquisición:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 38px; top: 0; font-size: 12px; left:413"></span>
          </div>
          
          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 110px; left:0; width:2%; display:inline;">
            @if($count == 1)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">A</h6>
            @endif
            @if($count == 3)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">B</h6>
            @endif
            @if($count == 5)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">C</h6>
            @endif
            @if($count == 7)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">D</h6>
            @endif
          </div>

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:47%; display:inline;">
            @if (count($permit->species) > 2)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 12; font-size: 8;">{{$permit->species[2]->name_scientific}}</span>
            @endif
            @if (count($permit->species) > 2)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 0; font-size: 8;">{{$permit->species[2]->name_common}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 2)
              <span class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140; font-size: 8;">{{$permit->species[2]->pivot->description}}</span>
            @endif
          </div>
          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
            @if (count($permit->species) > 2)
              <span class="absolute" style=" border-right: 1px solid; width: 30%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:4;font-size: 8;">{{$permit->species[2]->appendix}}, {{$permit->species[2]->pivot->origin}}</span>
            @endif
            @if (count($permit->species) > 2)
              <span class="absolute" style=" border-right: 1px solid; width: 33%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:88; font-size: 8;">{{$permit->species[2]->pivot->qty}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 2)  
              <span class="absolute" style="  width: 34%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:178; font-size: 8;"></span>
            @endif  
          </div>

          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:98%; display:inline;">
            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: -5px; top: 0; font-size: 14px;">País de Origen:</h6>
            @if (count($permit->species) > 2)
              <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:4">{{$permit->species[2]->pivot->origin_country}}</span>
            @else
              <hr style="margin-top:38px;">
            @endif

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:57; font-size: 14px;">Permiso N°:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:57"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:112; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:112"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 20%; height:60px; margin-top: 0px; top: 0; left:168; font-size: 14px;"> País de la última reexportación:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:168"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:277; font-size: 14px;"> N° Certificado:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:277"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:344; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:344"></span>
                      
            <h6 class="absolute" style="border-right:1px solid; width: 21%; height:60px; margin-top: 0px; top: 0; left:413; font-size: 14px;"> N° de la operación o fecha de adquisición:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 38px; top: 0; font-size: 12px; left:413"></span>
          </div>
          
          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 110px; left:0; width:2%; display:inline;">
            @if($count == 1)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">A</h6>
            @endif
            @if($count == 3)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">B</h6>
            @endif
            @if($count == 5)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">C</h6>
            @endif
            @if($count == 7)
              <h6 class="absolute" style="width: 40%;margin-top: 0px; top: 20;">D</h6>
            @endif
          </div>

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:47%; display:inline;">
            @if (count($permit->species) > 3)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 12; font-size: 8;">{{$permit->species[3]->name_scientific}}</span>
            @endif
            @if (count($permit->species) > 3)
              <span class="absolute" style="width: 40%;margin-top: 0px; top: 0; font-size: 8;">{{$permit->species[3]->name_common}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 3)
              <span class="absolute" style="width: 50%;margin-top: 2px; top: 0; left:140; font-size: 8;">{{$permit->species[3]->pivot->description}}</span>
            @endif
          </div>
          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:269; width:50%; display:inline;">
            @if (count($permit->species) > 3)
              <span class="absolute" style=" border-right: 1px solid; width: 30%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:4;font-size: 8;">{{$permit->species[3]->appendix}}, {{$permit->species[3]->pivot->origin}}</span>
            @endif
            @if (count($permit->species) > 3)
              <span class="absolute" style=" border-right: 1px solid; width: 33%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:88; font-size: 8;">{{$permit->species[3]->pivot->qty}}</span>
            @else
              <hr style="margin-top:25px;">
            @endif
            @if (count($permit->species) > 3)
              <span class="absolute" style="  width: 34%; padding-top:2px; margin-top: 0px; height:56px; top: 0; left:178; font-size: 8;"></span>
            @endif
          </div>

          @php
            $count++;
          @endphp

          <div style="position: absolute; padding:5px; top: {{200+(29*$count)}}; border:1px solid; height: 50px; left:16; width:98%; display:inline;">
            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: -5px; top: 0; font-size: 14px;">País de Origen:</h6>
            @if (count($permit->species) > 3)
              <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:4">{{$permit->species[3]->pivot->origin_country}}</span>
            @else
              <hr style="margin-top:38px;">
            @endif

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:57; font-size: 14px;">Permiso N°:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:57"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 10%; height:60px; margin-top: 0px; top: 0; left:112; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:112"></span>

            <h6 class="absolute" style="border-right:1px solid; width: 20%; height:60px; margin-top: 0px; top: 0; left:168; font-size: 14px;"> País de la última reexportación:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:168"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:277; font-size: 14px;"> N° Certificado:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:277"></span>
            
            <h6 class="absolute" style="border-right:1px solid; width: 12%; height:60px; margin-top: 0px; top: 0; left:344; font-size: 14px;"> Fecha:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 20px; top: 0; font-size: 12px; left:344"></span>
                      
            <h6 class="absolute" style="border-right:1px solid; width: 21%; height:60px; margin-top: 0px; top: 0; left:413; font-size: 14px;"> N° de la operación o fecha de adquisición:</h6>
            <span class="absolute" style="width: 20%; height:60px; margin-top: 38px; top: 0; font-size: 12px; left:413"></span>
          </div>

        {{-- @endforeach --}}
        
        @php
          $count++;
          $final = 200+(29*$count)
        @endphp

        <div style="position: absolute; padding:5px; top: {{$final}}; border:1px solid; height: 50px; left:0; width:101%; display:inline;">
          <h6 class="absolute" style=" solid; width: 100%; height:60px; margin-top: -5px; top: 0; font-size: 14px;">* País en el que los especímenes fueron recolectados en la naturaleza, criados en cautividad o reproducidos artificialmente (en caso de exportación).</h6>
          <h6 class="absolute" style=" solid; width: 100%; height:60px; margin-top: -5px; top: 9; font-size: 14px;">** Solamente para los especímenes de epeciess incluidas en el Apéndice I criados en cautividad o reproducidos artificialmente con fines comerciales.</h6>
          <h6 class="absolute" style=" solid; width: 100%; height:60px; margin-top: -5px; top: 18; font-size: 14px;">*** Para las espécies preconvención.</h6>
        </div>

        <div style="position: absolute; padding:5px; top: {{$final + 29}}; border:1px solid; height: 170px; left:0; width:101%; display:inline;">
          <h6 class="absolute" style=" solid; width: 100%; height:60px; margin-top: 0px; top: 0; font-size: 14px;"> Permiso expedido por: {{$permit->formalitie->official->user->name}} (V-{{$permit->formalitie->official->user->dni}})</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width: 15%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:30;">Lugar</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width: 15%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:150;">Fecha</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width: 45%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:270;">Estampilla de seguridad</h6>
        </div>

        <div style="position: absolute; padding:5px; top: {{$final + 116}}; border:1px solid; height: 170px; left:0; width:101%; display:inline;">

          <h6 class="absolute" style=" border: 1px solid; width: 8%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 31; left:0;">Sección</h6>
          <h6 class="absolute" style=" border: 1px solid; width: 8%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 42; left:0;">A</h6>
          <h6 class="absolute" style=" border: 1px solid; width: 8%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 53; left:0;">B</h6>
          <h6 class="absolute" style=" border: 1px solid; width: 8%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 64; left:0;">C</h6>
          <h6 class="absolute" style=" border: 1px solid; width: 8%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 75; left:0;">D</h6>
          
          <h6 class="absolute" style=" border: 1px solid; width: 10%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 31; left:43;">Cantidad</h6>
          <h6 class="absolute" style=" border: 1px solid; width: 10%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 42; left:43;">
            <span>{{$permit->species[0]->pivot->qty}}</span>
          </h6>
          <h6 class="absolute" style=" border: 1px solid; width: 10%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 53; left:43;">
            @if (count($permit->species) > 1) 
              <span>{{$permit->species[1]->pivot->qty}}</span>
            @endif
          </h6>
          <h6 class="absolute" style=" border: 1px solid; width: 10%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 64; left:43;">
            @if (count($permit->species) > 2) 
              <span>{{$permit->species[2]->pivot->qty}}</span>
            @endif
          </h6>
          <h6 class="absolute" style=" border: 1px solid; width: 10%; text-align:center; padding-top:2px; margin-top: 0px; height:20px; top: 75; left:43;">
            @if (count($permit->species) > 3) 
              <span>{{$permit->species[3]->pivot->qty}}</span>
            @endif
          </h6>

          <h6 class="absolute" style=" solid; width: 100%; height:60px; margin-top: 0px; top: 0; font-size: 14px;"> Aprobación de la Exportación: {{$permit->formalitie->official->user->name}} ({{$permit->formalitie->official->user->dni}})</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width: 20%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:105;">Puerto o Aeropuerto de Exportación</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width: 15%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:230;">Fecha</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width:15%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:330;">Firma</h6>
          <h6 class="absolute" style="text-align:center; border-top:1px solid; width:15%; height:60px; margin-top: -5px; top:72; font-size: 14px; left:430;">Sello y cargo oficiales</h6>
        </div>
        <img src="data:image/png;base64,{{ $codeQr }}"  style="margin-right: 10px; margin-top: 805px; display:inline; width: 10%;"/>  
        <h4 class="absolute" style="width:50%; height:60px; margin-top: 0px; top: {{$final + 220}}; left:340;">Permiso/Certificado N°: {{$permit->request_permit_no}}</h4>
        
      </div>
    </div>
</body>
</html>