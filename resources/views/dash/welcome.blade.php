@extends('adminlte::page')
@section('title', 'Inicio')
@section('content_header')
    <h1 class="m-0 text-dark">Bienvenido al panel de administrador</h1>
@stop

@section('content')
<!--iframe class="card" src="http://127.0.0.1:1880/ui/#!/2?socketid=pOfc9IbKPg4EaVfvAAAT" height="280" width="95%"></iframe>
<iframe class="card" src="http://127.0.0.1:1880/ui/#!/1?socketid=pOfc9IbKPg4EaVfvAAAT" height="290" width="100%"></iframe-->
<!-- <div class="card"> -->

<div>
    <label class="card-header">Predicciones modelo mAP: 68%
        <br/>modelo id: 1651
    </label>
    <div class="gallery">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-12abk.png" alt="predicción hoja uva con podredumbre negra">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-6.png" alt="predicción hoja de manzana con podredumbre negra">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-4.png" alt="predicción hoja manza con roya de cedro">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-12.png" alt="predicción hoja papa sana">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-11.png" alt="predicción hoja papa con tizón temprano">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-16.png" alt="predicción hoja papa con tizón temprano">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-29.png" alt="predicción hoja papa con tizón temprano">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-28.png" alt="predicción hoja tomate sana">
    <img src="vendor/adminlte/dist/img/pred-1651/pred-24.png" alt="predicción hoja tomate con tizón tardío">
</div>

<div class="container">
    <label class="card-header">Prototipo Robot Móvil</label>
    <div class="gall">
        <img src="vendor/adminlte/dist/img/Img-Prototipo/prot-carcasa (3).jpeg" alt="rover con carcasa">
        <img src="vendor/adminlte/dist/img/Img-Prototipo/prot-carcasa (2).jpeg" alt="rover sin carcasa">
        <img src="vendor/adminlte/dist/img/Img-Prototipo/prot-carcasa (1).jpeg" alt="rover de frente">
        <img src="vendor/adminlte/dist/img/Img-Prototipo/prot-carcasa (9).jpeg" alt="predicción hoja manza con roya de cedro">
        <!-- <img src="vendor/adminlte/dist/img/Figure_42.png" alt="predicción hoja papa sana">
        <img src="vendor/adminlte/dist/img/Figure_22.png" alt="predicción hoja papa con tizón temprano">
        <img src="vendor/adminlte/dist/img/Figure_29.png" alt="predicción hoja tomate con tizón tardío"> -->
    </div>
    <br/><br/>
</div>

<!-- </div> -->
@stop

@section('css')
<link rel="stylesheet" href="vendor/adminlte/dist/css/gellery.css" />
<link rel="stylesheet" href="vendor/adminlte/dist/css/gall.css" />

@stop