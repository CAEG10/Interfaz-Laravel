/*
 * MT: Motor 1 - tracción
 * MD: Motor 2 - dirección
 * SH: servo 1 - Cámara Robot
 * SV: servo 2 - Camara Detección plaga 
 */

#include <ESP8266WiFi.h>
#include <PubSubClient.h>
//#include <SoftwareSerial.h>
#include <Servo.h>

////MOTOR 1: Tracción
#define MT_AVZ D1     //LPWM1 D1
#define MT_RET D2     //RPWM1 D2
//MOTOR 2: Dirección
#define MD_DER D3     //LPWM2 D3
#define MD_IZQ D4     //RPWM2 D4

const char* ssid = "k";//"VTR-1090892"; //aca va el nombre del router
const char* password = "camilo123";//"8pmphtjNxxdg";  //aca va la pass
const char* mqtt_server = "broker.emqx.io"; //aca va la ip del broker

Servo SH;
Servo SV;
WiFiClient espClient;
PubSubClient client(espClient);

String id = "NODE_1"; //cambiar id para cada node
char* inTopic = "M1";
char* outTopic = "out";

// INPUTS físicos switches límite de carrera .
int stop_der = D7;
int stop_izq = D8;

// VARIABLES DE CONTROL
float v_direccion = 0.25; // Velocidad dirección 0.15 a 1.0
float v_traccion = 0.75; // Velocidad tracción 0 a 1
float acc_traccion = 0.75;  // Aceleración tracción 0 a 1

// Variables de código
float acc_pwm = 255.0 * v_traccion;
bool mov_izq = false;
bool mov_der = false;
bool mov_avanzar = false;
bool mov_retroceder = false;

//////////////////////////////////////////////////////

void setup() {
  Serial.begin(9600);
  Serial.println();

  pinMode(LED_BUILTIN, OUTPUT);
  SH.attach(D5);      //GPIO14 -> D5
  SV.attach(D6);

  //PRUEBA SLIDER
  pinMode(MT_AVZ, OUTPUT);
  pinMode(MT_RET, OUTPUT);
  pinMode(MD_DER, OUTPUT);
  pinMode(MD_IZQ, OUTPUT);

  //señales de entrada con PULL_UP interna del arduino para los limite de carrera
  pinMode(stop_der, INPUT_PULLUP);
  pinMode(stop_izq, INPUT_PULLUP);

//  digitalWrite(MT_AVZ, LOW);
//  digitalWrite(MT_RET, LOW);
//  digitalWrite(MD_DER, LOW);
//  digitalWrite(MD_IZQ, LOW);
  //motor.write(90);

  setup_wifi();
  client.setServer(mqtt_server, 1883);
  client.setCallback(callback);

}

//////////////////////////////////////////////////////
void setup_wifi() {
  delay(10);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    Serial.print(".");
    delay(500);
  }
  Serial.println(id + " CONECTADO A WIFI OK");
}

//////////////////////////////////////////////////////
void callback(char* topic, byte* payload, unsigned int length) {
  Serial.print("DATO_IN [");
  Serial.print(topic);
  Serial.print("] ");
  String p = "";
  for (int i = 0; i < length; i++) {
    Serial.print((char)payload[i]);
    p += (char)payload[i];
  }

  int largo = p.length();
  char arr[largo];
  p.toCharArray(arr, largo);

  /////////////////////////
  client.publish(outTopic, arr);
  ////////////////////////

  Serial.println();

  /**/
  //ATRAS = N ->joystick.js
  if (p == id + " Adelante") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    delay(500);
    mov_avanzar = true;
    mov_retroceder = false;
    mov_izq = false;
    mov_der = false;
    
  }
  //ATRAS = S ->joystick.js
  if (p == id + " Atras") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    delay(500);
    mov_avanzar = false;
    mov_retroceder = true;
    mov_izq = false;
    mov_der = false;
  }
  
  //PARAR = C ->joystick.js
  if (p == id + " Stop") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = false;
    mov_retroceder = false;
    mov_izq = false;
    mov_der = false;
  }
  
  //ATRAS = S ->joystick.js
  if (p == id + " Izq") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = false;
    mov_retroceder = false;
    mov_izq = true;
    mov_der = false;    
    }
    
    //DERECHA = D ->
  if (p == id + " Der") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = false;
    mov_retroceder = false;
    mov_izq = false;
    mov_der = true;
    }
    //Adelante_Derecha
  if (p == id + " Ad_Der") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = true;
    mov_retroceder = false;
    mov_izq = false;
    mov_der = true;
    }    
    //Adelante_Izquierda
  if (p == id + " Ad_Izq") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = true;
    mov_retroceder = false;
    mov_izq = true;
    mov_der = false;
    }    
    //Retroceder_Derecha
  if (p == id + " Re_Der") {
    digitalWrite(LED_BUILTIN,LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = false;
    mov_retroceder = true;
    mov_izq = false;
    mov_der = true;
    }
    //Retroceder_Izquierda
  if (p == id + " Re_Izq") {
    digitalWrite(LED_BUILTIN, LOW);
    delay(500);
    digitalWrite(LED_BUILTIN, HIGH);
    mov_avanzar = false;
    mov_retroceder = true;
    mov_izq = true;
    mov_der = false;
    }
   




  //SE PUEDE CAMBIAR EL NOMBRE DEL DISPOSITIVO
  //ENVIANDO A inTopic "NOMBRE1 2 NOMBRE2"
  if (p.indexOf(id + " 2 ") != -1) {
    id = p.substring(p.indexOf(" 2 ") + 3, p.length());
  }


}

//////////////////////////////////////////////////////
void reconnect() {
  while (!client.connected()) {
    if (client.connect("ESP8266Client")) {
      //client.publish("outTopic", "reconectando..");
      client.subscribe(inTopic);

      String x = id + " Conectado ok";
      char y[20];
      x.toCharArray(y, 20);
      client.publish(outTopic, y);

    } else {
      //Serial.print(client.state());
      delay(5000);
    }
  }
}

//////////////////////////////////////////////////////
void loop() {
    // Activación de límites de carrera en la dirección
    if (digitalRead(stop_der) == LOW){
      mov_der = false;
    }
    if (digitalRead(stop_izq) == LOW){
      mov_izq = false;
    }
  

  // Movimiento dirección
  // Si llegó una señal activa de movimiento hacia la izq o der, se activan los motores de dirección respectivamente
      if (mov_izq == true) {
        analogWrite(MD_DER, 0);
        analogWrite(MD_IZQ, v_direccion*255);
      } else if (mov_der == true) {
        analogWrite(MD_DER, v_direccion*255);
        analogWrite(MD_IZQ, 0);
      } else {
        analogWrite(MD_DER, 0);
        analogWrite(MD_IZQ, 0);
      }

  // Movimiento tracción
  // Si llegó una señal activa de movimiento para avanzar o retroceder, se sumará o restará a la aceleración de la tracción
  if (mov_avanzar) {
    if (acc_pwm < 250.0) {
      acc_pwm += acc_traccion;
    }
  } else if (mov_retroceder) {
    if (acc_pwm > -250.0) {
      acc_pwm -= acc_traccion;
    }
  } else {
    if (acc_pwm < 0.0) {
      acc_pwm += acc_traccion;
    } else {
      acc_pwm -= acc_traccion;
    }
  }

  // Dependiendo si la aceleración es negativa o positiva, el carro avanzará o retrocederá
  if (acc_pwm > 0) {
    analogWrite(MT_AVZ, round(acc_pwm * v_traccion));
    analogWrite(MT_RET, 0);
  } else {
    analogWrite(MT_AVZ, 0);
    analogWrite(MT_RET, round(-1.0 * acc_pwm * v_traccion));
  }


    

  if (!client.connected()) {
    reconnect();
  } 
  client.loop();

  //int valor = analogRead(A0); 
  //char buf[10];
  //client.publish("sensor", itoa(valor,buf,10));


  }
