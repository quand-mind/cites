<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Respuesta a tu pregunta</title>
</head>
<body>
    
    <h1>Respuesta a tu pregunta</h1>
    <p>¡Gracias por participar en nuestro portal <a href="{{env('APP_URL')}}">ovm website</a>!</p>
    <p>A continuación la respuesta a tu pregunta: {{$question->question}}</p>
    <br />

    <p>{{ $question->answer }}</p>
    <p>Tu aporte es valioso para nosotros.</p>

</body>
</html>