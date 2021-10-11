@extends('layouts.app')

@section('content')
    <h1>Consuming the Species + / CITE api</h1>
    
    <div class="container">

        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <canvas id="canvas" height="280" width="600"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>    

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

    <script>

        var status = <?php echo $status; ?>;
        var user = <?php echo $statusCount; ?>;
        var barChartData = {
            labels: year,
            datasets: [{
                label: 'User',
                backgroundColor: "pink",
                data: user
            }]
        };
        window.onload = function() {
            var ctx = document.getElementById("canvas").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'total de permisos por status'
    
                    }
                }
            });
        };
    </script>    
@endsection