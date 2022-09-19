<!--  BOTONES MQTT NP2020-->

<html>

<head>
  <meta charset="utf-8">

  <!-- <script src="vendor/adminlte/dist/js/mqttws31.min.js" type="text/javascript"></script> -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/paho-mqtt/1.0.2/mqttws31.min.js"></script>
  <style>
    #messages {
    margin-top: 12px;
    margin-bottom: 12px;
    padding: 12px;
    width:400px;
    display: inline-block;
    border:1px solid black;
    max-height: 250px;
    min-height: 250px;
    overflow: scroll;
    }
    
    body{
    font-size:0.8em;
    font-family: Trebuchet MS, Lucida Sans Unicode, Arial, sans-serif;
    margin:0px;
    padding:0px;
    }
  </style>
  
</head>


<body>



<script type="text/javascript">

document.addEventListener('DOMContentLoaded', function() {
    mqtt_init();
}, false);

///////////////////mqtt
var dato_in="";

function startConnect() {
    clientID = "clientID-" + parseInt(Math.random() * 100);
    host = document.getElementById("host").value;
    port = document.getElementById("port").value;

    document.getElementById("messages").innerHTML += '<span>Conectando a: ' + host + ' puerto: ' + port + '</span><br/>';
    document.getElementById("messages").innerHTML += '<span>ID: ' + clientID + '</span><br/>';

    client = new Paho.MQTT.Client(host, Number(port), clientID);

    client.onConnectionLost = onConnectionLost;
    client.onMessageArrived = onMessageArrived;

    client.connect({ 
        onSuccess: onConnect,
    });
}

function onConnect() {
    topic = document.getElementById("topic").value;
    document.getElementById("messages").innerHTML += '<span>Suscribiendose a: ' + topic + '</span><br/>';
    client.subscribe(topic);
    
    message = new Paho.MQTT.Message("Conexion HTTP -> Broker MQTT OK");
    message.destinationName = "cmd";
    client.send(message);
}


function onConnectionLost(responseObject) {
    document.getElementById("messages").innerHTML += '<span>ERROR: Se perdio la conexion</span><br/>';
    if (responseObject.errorCode !== 0) {
        document.getElementById("messages").innerHTML += '<span>ERROR: ' + responseObject.errorMessage + '</span><br/>';
    }
}


function onMessageArrived(message) {
    dato_in=message.payloadString;
    //alert(dato_in);
    document.getElementById("messages").innerHTML += '<span>' + message.destinationName + '>' + message.payloadString + '</span><br/>';
}


function startDisconnect() {
    client.disconnect();
    document.getElementById("messages").innerHTML += '<span>Desconectado</span><br/>';
}

function Clear() {
    document.getElementById("messages").innerHTML = '';
}

function Enviar(msg,topic){
    id = document.getElementById("id").value;
    var txt=id+" "+msg;
    //alert(txt);
    message = new Paho.MQTT.Message(txt);
    message.destinationName = topic;
    client.send(message);
}
//////////////////fin mqtt
</script>

 <div class="wrapper">
    <h2>Control de NodeMCU por MQTT Websockets</h2>

    <form id="connection-information-form">
    <table>
      <tr>
      <td><b>Hostname:</b></td>
      <td><input id="host" type="text" name="host" value="broker.emqx.io"></td>  
      <td><b>Port:</b></td>
      <td><input id="port" type="text" name="port" value="8083" width="50"></td>  
      </tr>
      <tr>
      
      <td><b>Topic:</b></td>
      <td><input id="topic" type="text" name="topic" value="cmd"></td>
      <td><b>ID:</b></td>
      <td><input id="id" type="text" name="id" value="NODE_1"></td>
      </tr>
      
    </table>
    
   
    <input type="button" onclick="startConnect()" value="Connect">
    <input type="button" onclick="startDisconnect()" value="Disconnect">
    <input type="button" onclick="Clear()" value="Clear">
    <br><br>
    
    
    <button type="button" class="btn btn-dark" onclick="Enviar('Adelante','cmd')" >Adel</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Izq','cmd')"  >Izq</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Der','cmd')" >Der</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Atras','cmd')" >Atras</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Stop','cmd')"  >Stop</button><br><br>

    <button type="button" class="btn btn-dark" onclick="Enviar('Ad_Der','cmd')" >Adel Der</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Ad_Izq','cmd')" >Adel Izq</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Re_Der','cmd')" >Retr Der</button>
    <button type="button" class="btn btn-dark" onclick="Enviar('Re_Izq','cmd')" >Retr Izq</button>

    </form>
  <div id="messages"></div>
 </div>
 
<br>


</body>
</html>
