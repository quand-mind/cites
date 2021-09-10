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
        <div style="display:block; width:500px; margin:auto;">
            <div style="display:flex; justify-content:center">
                <img src="/images/logos/logo-minec.png" alt="MINEC" width="80px">
            </div>
            <div style="position: relative; #top: -50%">
                <h1>Observaciones </h1>
                <p> El tramite <strong>{{ $formalitie->request_formalitie_no }}</strong> posee las siguientes observaciones:</p>
                <p><li><ul>{{ $formalitie->observations}}</ul></li></p>
                <p>Usted tiene hasta el día {{ $formalitie->collected_time }} para parfa cumplir con las observaciones dadas.</p>
                <p>Att: MNEC</p>
                <br/>
            </div>
            <div style="display:flex; justify-content:center">
                <div width="80px" style="background:url(../images/logos/logo-minexterior.png);"></div>
            </div>
        </div>
    </div>
</body>
</html>