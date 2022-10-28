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
    <div class="container justify-conten">
        <div class="row mx-lg-n5 d-flex justify-content-center py-3 bg-light">
            <div class="col-12 d-flex justify-content-center">
                <div clas="col-12">
                    <img src="http://www.minec.gob.ve/wp-content/uploads/2018/08/MINEC-LOGO.png" alt="MINEC" width="80px">
                </div>
            </div>
            <div class="col-6">
                <h1>Su Tramite fue validado</h1>
                <p>El tramite con el número  de registro <strong>{{ $formalitie->request_formalitie_no }}</strong> creado por usted fue validado exitosamente y se le asigno el número SISTRA <strong>{{ $formalitie->sistra }}</strong> </p>
                <p>Att: MINEC</p>
                <br/>
            </div>
            <div class="col-12 d-flex justify-content-center">
                <div clas="col-12">
                    <img src="/images/logos/logo-minexterior.png" alt="MINEC" width="80px">
                </div>
            </div>
        </div>
    </div>
</body>
</html>