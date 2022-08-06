@extends('adminlte::page')

@section('title', 'GráficosH')

@section('content_header')
    <h1>Base de datos con Chartjs</h1>
@stop

@section('content')
    <iframe src="http://127.0.0.1:1880/ui/#!/0?socketid=9doHMz46d8JHhHpQAAAB" class="card" width="65%" height="110"></iframe>  

        <!-- Componente o widget card para grafico de ejemplo
        <div class="card">
        <canvas id="myChart" width="400" height="200"></canvas>
        </div> -->
        <!-- <div class="card">
        <canvas id="myChart3" width="400" height="200"></canvas>
        </div> -->
        <x-adminlte-card title="Humedad" theme="dark" icon="fas fa-lg fa-bell" collapsible removable maximizable>
            <canvas id="myChart3" width="500" height="200"></canvas>
        </x-adminlte-card>




@stop


@section('css')<!-- 
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}"> -->
   
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.8.0/dist/chart.min.js" integrity="sha256-cHVO4dqZfamRhWD7s4iXyaXWVK10odD+qp4xidFzqTI=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
     -->


<!-- Capturamos la variable de humedad '$dataT', en forta json -->
<script>
    $(document).ready(function() {
            const cData = JSON.parse(`<?php echo $dataH1; ?>`)
            console.log(cData)
            const ctx = document.getElementById('myChart3').getContext('2d');
            Chart.defaults.font.size = 14;
            const myChart3 = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: cData.label,
                    datasets: [{
                        label: 'Sensor-H',
                        data: cData.data,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            
                        ],
                        borderWidth: 1.2
                    }]
                },
                options: {
                    /* Titulo del grafico 
                    plugins: {
                        title: {
                            display: true,
                            text: 'Humedad Sensor',
                        }
                    }, */
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Fecha',
                        }
                        },
                        y: {
                            ticks: {
                                beginAtZero: true
                            },
                            title: {
                                display: true,
                                text: 'Humedad (%)',
                            }
                        }
                    }
                }
            });
        });
</script>


@stop


