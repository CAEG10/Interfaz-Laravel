@extends('adminlte::page')

@section('title', 'MQTT')

@section('content_header')
    <!-- <iframe class="card" src="http://127.0.0.1:1880/ui/#!/2?socketid=pOfc9IbKPg4EaVfvAAAT" height="280" width="90%"></iframe>         -->
  

@stop

@section('content')
{{-- Minimal without header / body only --}}
    <!--iframe class="card" src="http://127.0.0.1:1880/ui/#!/0?socketid=9doHMz46d8JHhHpQAAAB"  width="65%" height="110"></iframe-->  
    <iframe class="card" src="http://127.0.0.1:1880/ui/#!/2?socketid=pOfc9IbKPg4EaVfvAAAT" height="280" width="95%"></iframe>


<div class="wrapper">
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <form id="connection-information-form">
                        <div class="row">
                            <div class="col">
                                <label for="form-control">Borker MQTT</label>
                                <input id="host" type="text" class="form-control" value="broker.emqx.io" placeholder="broker.emqx.io">
                            </div>
                            <div class="col">
                                <label for="form-control">Puerto</label>
                                <input id="port" type="text" class="form-control" value="8083" placeholder="8083">
                            </div>
                        </div>
                        <br/>
                        <div class="row">
                            <div class="col">
                                <label for="form-control">Topic</label>
                                <input id="topic" type="text" class="form-control" value="M1" placeholder="M1">
                            </div>
                            <div class="col">
                                <label for="form-control">N° Cliente</label>
                                <input id="id" type="text" class="form-control" value="NODE_1" placeholder="NODE_1">
                            </div>
                        </div>
                            <br/>
                            <x-adminlte-button onclick="startConnect()"  theme="success" icon="fas fa-power-off" value="On" />
                            <x-adminlte-button onclick="startDisconnect()"  theme="danger" icon="fas fa-power-off" placeholder="Off" />
                            <x-adminlte-button onclick="Clear()"  theme="warning" icon="fas fa-trash"/>
                            <!-- <input type="button" onclick="startConnect()" value="Conectar" class="btn btn-success">
                            <input type="button" onclick="startDisconnect()" value="Desconectar" class="btn btn-danger">
                            <input type="button" onclick="Clear()" value="Limpiar" class="btn btn-warning"> -->
                            <br/>
                            <br/>
                            <x-adminlte-button onclick="Enviar('Adelante','M1')" theme="dark" icon="fas fa-arrow-alt-circle-up"/>
                            <x-adminlte-button onclick="Enviar('Izq','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
                            <x-adminlte-button onclick="Enviar('Der','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
                            <x-adminlte-button onclick="Enviar('Retroceder','M1')" theme="dark" icon="fas fa-arrow-alt-circle-down"/>
                            <x-adminlte-button onclick="Enviar('Stop','M1')" theme="dark" icon="fas fa-stop-circle"/><br/><br/>

                            <button type="button" class="btn btn-dark" onclick="Enviar('Ad_Der','M1')" >Adel Der</button>
                            <button type="button" class="btn btn-dark" onclick="Enviar('Ad_Izq','M1')" >Adel Izq</button>
                            <button type="button" class="btn btn-dark" onclick="Enviar('Re_Der','M1')" >Retr Der</button>
                            <button type="button" class="btn btn-dark" onclick="Enviar('Re_Izq','M1')" >Retr Izq</button>
                    </form> 
                    <br/>
                    <x-adminlte-textarea id="text_area" name="taBasic" rows="8" cols="4" placeholder="Esperando conexión..." />
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Camara 1</h5>
                    <div class="embed-responsive embed-responsive-21by9" border-style= "dashed">
                        <video id="video" class="embed-responsive-item"></video>
                    </div>
                    <x-adminlte-button onclick="Enviar('S1_izq','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
                    <x-adminlte-button onclick="Enviar('S1_der','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
                </div>
                <div class="card-body">
                    <h5 class="card-title">Camara 2</h5>
                    <div class="embed-responsive embed-responsive-21by9">
                        <video id="video" class="embed-responsive-item"></video>
                    </div>
                    <x-adminlte-button onclick="Enviar('S2_izq','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
                    <x-adminlte-button onclick="Enviar('S2_der','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
                    <h1>ESP32 with Servo</h1>
                    <p>Position: <span id="servoPos"></span></p>
                    <input type="range" min="0" max="180" class="slider" id="slider" 
                         onchange="Enviar(value, 'M1')"
                    />

                </div>
            </div>
        </div>
    </div>
</div>
<!--
<div class="row">
    <x-adminlte-card class="col-lg-6">
    {{-- With extra information on the bottom slot --}}
    <form id="connection-information-form">
            <x-adminlte-input name="iExtraAddress" label="Servidor MQTT" value="broker.emqx.io"  
                enable-old-support>
                <x-slot name="prependSlot">
                    <div class="input-group-text text-purple">
                        <i class="fas fa-server"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            <x-adminlte-input name="iPostalCode" label="Topic" value="M1"  
                enable-old-support>
                <x-slot name="prependSlot">
                    <div class="input-group-text text-purple">
                        <i class="fas fa-clipboard-check"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- With a link on the bottom slot and old support enabled --}}
            <x-adminlte-input name="iPostalCode" label="Puerto" value="8083" 
                enable-old-support>
                <x-slot name="prependSlot">
                    <div class="input-group-text text-purple">
                        <i class="fas fa-door-open"></i>
                    </div>
                </x-slot>
            </x-adminlte-input>

            {{-- With extra information on the bottom slot --}}
            <x-adminlte-input name="iExtraAddress" label="ID Cliente" value="NODE_1" 
                enable-old-support >
                <x-slot name="prependSlot">
                    <div class="input-group-text text-purple">
                        <i class="fas fa-address-card"></i>
                    </div>
                </x-slot>
                <x-slot name="bottomSlot">
                    <span class="text-sm text-gray">
                        CAMBIAR ID NODE_1 => Robot_1. 
                        AGREGAR buttons down-left - down-right - up-right - up-left
                    </span>
                </x-slot>
            </x-adminlte-input>

                {{-- Themes + icons --}}
    
        <input type="button" onclick="startConnect()" value="Conectar" class="btn btn-success">
        <input type="button" onclick="startDisconnect()" value="Desconectar" class="btn btn-danger">
        <input type="button" onclick="Clear()" value="Limpiar" class="btn btn-warning">
        <x-adminlte-button onclick="startConnect()"  theme="success" icon="fas fa-power-off"/>
        <x-adminlte-button onclick="startDisconnect()"  theme="danger" icon="fas fa-power-off"/>
        <x-adminlte-button onclick="Clear()"  theme="warning" icon="fas fa-trash"/>
        <br/>
        <br/>
        <x-adminlte-button onclick="Enviar('ADELANTE','M1')" theme="dark" icon="fas fa-arrow-alt-circle-up"/>
        <x-adminlte-button onclick="Enviar('IZQUIERDA','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
        <x-adminlte-button onclick="Enviar('DERECHA','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
        <x-adminlte-button onclick="Enviar('ATRAS','M1')" theme="dark" icon="fas fa-arrow-alt-circle-down"/>
        <x-adminlte-button onclick="Enviar('PARAR','M1')" theme="dark" icon="fas fa-stop-circle"/>
    </form>
    <br /><br />

            {{-- Minimal with placeholder --}}
    <x-adminlte-textarea id="text_area" name="taBasic" rows="8" cols="4" placeholder="Esperando conexión..." />
    </x-adminlte-card>

    <x-adminlte-card class="col-lg-6">
        Salida camara1
        <div class="card">
            <div class="card-body">
                <div class="embed-responsive embed-responsive-21by9">
                    <video id="video" class="embed-responsive-item"></video>
                </div>
            </div>
        </div>
        <x-adminlte-button onclick="Enviar('S1_izq','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
        <x-adminlte-button onclick="Enviar('S1_der','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
        <br /><br />
        Salida camara2
        <div class="card">
        <div class="card-body">
                <div class="embed-responsive embed-responsive-21by9">
                    <video id="video" class="embed-responsive-item"></video>
                </div>
            </div>
        </div>
        <x-adminlte-button onclick="Enviar('S2_izq','M1')" theme="dark" icon="fas fa-arrow-alt-circle-left"/>
        <x-adminlte-button onclick="Enviar('S2_der','M1')" theme="dark" icon="fas fa-arrow-alt-circle-right"/>
    </x-adminlte-card>
</div> -->

@stop

@section('css')
    <!-- <link rel="stylesheet" href="{{asset('vendor/css/admin_custom.css')}}"> -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
    <script src="{{asset('js/mqttws31.min.js')}}"></script> 
    <script src="{{asset('js/paho.mqtt.min.js')}}"></script> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <!-- <script>
    //var slider = document.getElementById("servoSlider");
    var servoP = document.getElementById("servoPos");
    servoP.innerHTML = slider.value;
    slider.oninput = function() {
      slider.value = this.value;
      servoP.innerHTML = this.value;
    }
    $.ajaxSetup({timeout:1000});
    function servo(pos) {
      $.get("/?value=" + pos + "&");
      {Connection: close};
    }
  </script> -->

<script type="text/javascript">
                    ///////////////////mqtt
                    var dato_in="";
                    function startConnect() {
                        clientID = "ID-" + parseInt(Math.random() * 100);
                        var slider = document.getElementById("slider").value;
                        var servoP = document.getElementById("servoPos").value;
                        //slider.addEventListener('click', slider_changed);
                        //console.log(slider)
                        host = document.getElementById("host").value;
                        port = document.getElementById("port").value;
                        document.getElementById("text_area").value += 'Conectando a: ' + host + '\nEn el puerto: ' + port + '\n';
                        document.getElementById("text_area").value += 'ID Cliente: ' + clientID + '\n';
                        client = new Paho.MQTT.Client(host, Number(port), clientID);
                        client.onConnectionLost = onConnectionLost;
                        client.onMessageArrived = onMessageArrived;
                        client.connect({ 
                            onSuccess: onConnect,
                        });
                    }
                    function onConnect() {
                        topic = document.getElementById("topic").value;
                        document.getElementById("text_area").value += 'Suscribendo a topic: ' + topic +'\nConectado a Robok v1.1\n';
                        client.subscribe(topic);
                        
                        message = new Paho.MQTT.Message("Conexion Ok");
                        message.destinationName = "M1";
                        //client.send(message);
                    }
                    function onConnectionLost(responseObject) {
                        document.getElementById("text_area").value += 'Se perdio la conexion\n';
                        if (responseObject.errorCode !== 0) {
                            document.getElementById("text_area").value += 'ERROR: ' + responseObject.errorMessage;
                        }
                    }
                    function slider_changed () {
                        var ServoP = slider.value;
                        console.log(ServoP.value); 
                    }
                    function onMessageArrived(message) {
                        dato_in=message.payloadString;
                        //alert(dato_in);
                        document.getElementById("text_area").value += '' + message.destinationName + ' => ' + message.payloadString + '\n';
                        document.getElementById("text_area").scrollTop = document.getElementById("text_area").scrollHeight
                        console.log(dato_in)
                    }
                    function startDisconnect() {
                        client.disconnect();
                        document.getElementById("text_area").value += 'Desconectado' +'\n';
                    }
                    function Clear() {
                        document.getElementById("text_area").value = '';
                    }
                    function Enviar(msg,topic){
                        id = document.getElementById("id").value;
                        var txt=id+" "+msg;
                        //alert(txt);
                        message = new Paho.MQTT.Message(txt);
                        message.destinationName = topic;
                        client.send(message);
                    }
                    // function Servo(){
                    // var dato = document.getElementById("myRange").value;
                    // var slider = document.getElementById("servoSlider").value;
                    // var servoP = document.getElementById("servoPos").value;
                    // message = new Paho.MQTT.Message(dato);
                    // message.destinationName = '/' + usuario + '/salidaAnalogica'
                    // client.send(message);
                    // };

                    //////////////////fin mqtt    
                </script>


@stop

