<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title></title>
</head>
<body>
    <div>
        <div style="display:block; width:500px; border: 1px solid black; margin:auto;">
            <div style="display:flex; justify-content:center">
                <img src="/images/logos/logo-minec.png" alt="MINEC" width="80px">
            </div>
            <div style="position: relative; #top: -50%">
                <h1>Se superó la fecha para cargar los requisitos</h1>
                <p>Usted ha superado la fecha limite para cargar los requerimientos del permiso nro <strong>{{ $formalitie->request_permit_no }}</strong></p>
                <p>Att: MNEC</p>
                <br/>
            </div>
            <div style="display:flex; justify-content:center">
                <img src="/images/logos/logo-minexterior.png" alt="MINEC" width="80px">
            </div>
        </div>
    </div>
</body>
</html>