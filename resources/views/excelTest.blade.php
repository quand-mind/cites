<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

    <!-- <h1>Consuming the Species + / CITE api</h1>   -->
    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    @foreach($datasets as $dataset)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{$title}}</th>
                                </tr>
                                <tr>
                                    <th>{{$dataset->label}}</th>
                                </tr>
                                <tr>
                                    <th scope="col">_</th>
                                    @foreach($labels as $label)
                                            <th scope="col">{{$label}}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>QTY</td>
                                    @foreach($dataset->data as $value)
                                        <td>{{$value}}</td>
                                    @endforeach   
                                </tr>
                            </tbody>
                        </table>
                    @endforeach
                </div>
            </div>
        </div>    

</body>
</html>