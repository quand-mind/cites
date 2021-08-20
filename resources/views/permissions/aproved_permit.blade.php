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
    .bordered{
      border: 1px solid;
    }
    .pdf_table{
      margin-top:25px;
      width: 90%;
      border-spacing: 0px;
    }
    th, td {
      border-bottom: 1px solid;
      padding: 15px;
      padding-left: 25px;
      border-spacing: 0px;
    }
    th {
      border-top: 1px solid;
    }
    .mt-4{
      margin-top: 100px;
    }
    .inline-block{
      display:inline-block;
    }
    .table{
      border: 1px solid;
      margin: 0px;  
      padding: 15px;
    }
    .w-100{
      width: 100%;
    }
    .w-50{
      width: 50%;
    }
    .w-45{
      width: 45%;
    }
    .w-48{
      width: 48%;
    }
    .w-40{
      width: 40%;
    }
    .w-35{
      width: 35%;
    }
    .w-25{
      width: 25%;
    }
    .w-20{
      width: 20%;
    }
    .pr-4{
      padding-right:40px;
    }
    .pl-4{
      padding-left:40px;
    }
    .pl-2{
      padding-left:20px;
    }
    .br-1{
      border-right: 1px solid;
    }
    .fs-18{
      font-size:18px;
    }
  </style>

    <div id="app">
      <div id="aproved-permit" class="table">
        <table class="w-100">

          <tr>
            <td class="bordered w-50">
              <img src="https://lh3.googleusercontent.com/proxy/U3Z-6_e65p7PrexKAtOJjRnQTH-MGUFerRy_rsyadt3TEsUWDEtAuVveEWJAuatxXPZHRWrWPsRtLzDFcg0H_ROY00yxjMmYFinA2OXF0XcOgItRXri35ok" alt="" height="50px">
              <h4 style="margin: 0px;">CONVENCIÓN SOBRE EL COMERCIO INTERNACIONAL DE ESPECIES AMENAZADAS DE FAUNA Y FLORA</h4>
            </td>
            <td class="bordered w-50">
              <div class="w-50 inline-block br-1">
                <h4 style="">Permiso N°: {{ $permit->request_permit_no }}</h3>
                @if ($permit->permit_type_id === 1)
                  <div class="fs-18" style="margin: 0px; padding-top: 10px">Tipo: Exportación</div>
                @endif
              </div>
              <div class="w-45 pl-2 inline-block fs-18" style="margin-top:25px;">
                <div style="padding-bottom:10%; border-bottom:1px solid;">Original</div>
                <div style="margin-top: 2%;">
                  2. Valido Hasta:
                    <span>{{$permit->valid_until}}</span>
                </div>
              </div>
            </td>
          </tr>

          <tr class="fs-18">
            @if ($permit->permit_type_id === 1)
              <td class="bordered w-50">
                <div>
                  <span>3.1. Exportador:</span>
                </div>
                <div>{{$permit->consigned_to}}</div>
              </td>
              <td class="bordered w-50">
                <div class="w-50 inline-block br-1">
                  <div>
                    <span>3.2. Dirección Exportador:</span>
                  </div>
                  <div>{{$permit->destiny_place}}</div>
                </div>
                <div class="w-40 pl-2 inline-block">
                  <div>
                    <span>3.3. País a Exportar:</span>
                  </div>
                  <div>{{$permit->country}}</div>
                </div>
              </td>
            @endif
          </tr>

          <tr class="fs-18">
            @if ($permit->special_conditions)
              <td class="bordered w-50">
                <div>
                  <span>4.1. Condiciones Especiales:</span>
                </div>
                <div>{{$permit->consigned_to}}</div>
              </td>
              <td class="bordered w-50">
                <div>
                  <span>4.2. Autoridad Administrativa:</span>
                </div>
                <div>{{$permit->consigned_to}}</div>
              </td>
            @endif
            <td class="bordered w-50">
            </td>
            <td class="bordered w-50">
              <div>
                <span>4.1. Autoridad Administrativa:</span>
              </div>
              {{-- <div>{{$permit->consigned_to}}</div> --}}
            </td>
          </tr>

          <tr class="fs-18">
            <td class="bordered w-50 ">
              <div>
                <span>5.1. Propósito de la transacción: </span>
              </div>
              <div>{{$permit->purpose}}</div>
            </td>
            <td class="bordered w-50">
              <div>
                <span>5.2. Estampilla de seguridad:</span>
              </div>
              
              @if($permit->requeriments[1]->pivot->is_valid)
                <div>Si</div>
              @else
                <div>No</div>
              @endif
            </td>
          </tr>

        </table>

        <h3>6. Especies</h3>
        <table class="w-100">

          @foreach ($permit->species as $specie)
            <tr>
                <td class="w-50 bordered" style="font-size:18px;">
                  <div class="w-50 inline-block br-1">
                    <div>Nombre Común:</div>
                    <div>{{$specie->name_common}}</div>
                  </div>
                  <div class="w-48 pl-2 inline-block">
                    <div>Nombre Científico: </div>
                    <div>{{$specie->name_scientific}}</div>
                  </div>
                </td>
                <td class="bordered" style="font-size:18px;">
                  <div class="w-40 inline-block br-1">
                    <div>Descripción:</div>
                    <div>Descripción</div>
                    {{-- <div>{{$specie->pivot->descirption}}</div> --}}
                  </div>
                  <div class="w-50 pl-2 inline-block">
                    <div>Número de Especímenes:</div>
                    <div>{{$specie->pivot->qty}}</div>
                  </div>
                </td>
            </tr>
          @endforeach

        </table>

        <table class="w-100">
          <tr class="w-100">
            <td class="bordered w-100">
              <div>
                <div>7.1 Permiso Expedido Por:</div>
                <div class="fs-18">{{$permit->official->user->name}} |  {{$permit->official->email}}</div>
              </div>
              <div style="margin-top:100px;">
                <div class="w-25 pr-4 inline-block" style="text-align:center">
                  <hr>
                  Lugar
                </div>
                <div class="w-25 pl-4 inline-block" style="text-align:center">
                  <hr>
                  Fecha
                </div>
                <div class="w-35 pl-4 inline-block" style="text-align:center">
                  <hr style="margin-bottom: 20px;">
                  <span style="font-size:18px;">Estampilla de Seguridad, firma y sello oficial</span>
                </div>
              </div>
            </td>
          </tr>
        </table>

        <table class="w-100">
          <tr class="w-100 fs-18">
            <td class="bordered w-50 ">
              <div>8.1 Aprobación de la exportación:</div>
              <div></div>
            </td>
            <td class="bordered w-50">
              <div>7.1 Conocimento de embarque/Carta de Porte aéreo N°:</div>
              <div></div>
            </td>
          </tr>
        </table>

        <table class="w-100">
          <tr class="w-100 fs-18" >
            <td class="bordered w-100">
              <div style="margin-top:150px;">
                <div class="w-20 pr-4 inline-block" style="text-align:center">
                  <hr>
                  Puerto de Exportación
                </div>
                <div class="w-20 pl-4 inline-block" style="text-align:center">
                  <hr>
                  Fecha
                </div>
                <div class="w-20 pl-4 inline-block" style="text-align:center">
                  <hr>
                  Firma
                </div>
                <div class="w-20 pl-4 inline-block" style="text-align:center">
                  <hr>
                  Sello Oficial y Título
                </div>
              </div>
            </td>
          </tr>
        </table>

      </div>
      <h2 style="float: right; padding-top: 10px;">Permiso CITES No. {{ $permit->request_permit_no }}</h2>
    </div>
</body>
</html>