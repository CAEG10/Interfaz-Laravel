@extends('adminlte::page')

@section('title', 'Tiempo Real')

@section('content_header')
    <h1>Datos sensores Graficado con Node-Red</h1>
@stop

@section('content')
    <p></p>
    <div class="container" position="absolute" justify-content="center" >
        <iframe class="card" src="http://127.0.0.1:1880/ui/#!/0?socketid=9doHMz46d8JHhHpQAAAB"  width="65%" height="110"></iframe>  
        <iframe class="card" src="http://127.0.0.1:1880/ui/#!/2?socketid=pOfc9IbKPg4EaVfvAAAT" height="280" width="95%"></iframe>
        <iframe class="card" src="http://127.0.0.1:1880/ui/#!/1?socketid=pOfc9IbKPg4EaVfvAAAT" height="570" width="80%"></iframe>
    </div>
    <br/><br/>
@stop

@section('css')
    <link rel="stylesheet" href="{{asset('/css/admin_custom.css')}}">
   
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

@stop