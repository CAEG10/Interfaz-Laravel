@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1 class="m-0 text-dark">Bienvenido</h1>
@stop

@section('content')
<!--iframe class="card" src="http://127.0.0.1:1880/ui/#!/2?socketid=pOfc9IbKPg4EaVfvAAAT" height="280" width="95%"></iframe>
<iframe class="card" src="http://127.0.0.1:1880/ui/#!/1?socketid=pOfc9IbKPg4EaVfvAAAT" height="290" width="100%"></iframe-->
<!-- <div class="card"> -->
    <div class="gallery">
    <img src="vendor/adminlte/dist/img/pred1.png" alt="predicción hoja uva con podredumbre negra">
    <img src="vendor/adminlte/dist/img/Figure_35.png" alt="predicción hoja tomate sana">
    <img src="vendor/adminlte/dist/img/Figure_43.png" alt="predicción hoja de manzana con podredumbre negra">
    <img src="vendor/adminlte/dist/img/Figure_41.png" alt="predicción hoja manza con roya de cedro">
    <img src="vendor/adminlte/dist/img/Figure_42.png" alt="predicción hoja papa sana">
    <img src="vendor/adminlte/dist/img/Figure_22.png" alt="predicción hoja papa con tizón temprano">
    <img src="vendor/adminlte/dist/img/Figure_29.png" alt="predicción hoja tomate con tizón tardío">
    </div>
<!-- </div> -->
@stop

@section('css')
<link rel="stylesheet" href="vendor/adminlte/dist/css/gellery.css" />
    

@stop