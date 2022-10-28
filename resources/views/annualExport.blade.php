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

    <div class="container">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <table class="table">
                        <thead>
                            <tr>
                                <th></th>
                                <th>{{$title}}</th>
                            </tr>
                            <tr></tr>
                            <tr>
                                <th></th>
                                @foreach($labels as $label)
                                <th scope="col">{{$label}}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($datasets as $dataset)
                                <tr>
                                    <td></td>
                                    <td>{{$dataset->appendix}}</td>
                                    <td>{{$dataset->name_scientific}}</td>
                                    <td>{{$dataset->description}}</td>
                                    <td>{{$dataset->qty}}</td>
                                    <td>{{$dataset->origin_country}}</td>
                                    <td>{{$dataset->country}}</td>
                                    <td>{{$dataset->type}}</td>
                                    <td>{{$dataset->request_permit_no}}</td>
                                    <td>{{$dataset->stamp_number}}</td>
                                    <td>{{$dataset->purpose}}</td>
                                    <td>{{$dataset->origin}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>    

</body>
</html>