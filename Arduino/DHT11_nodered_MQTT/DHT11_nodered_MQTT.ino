/*****
 
 All the resources for this project:
 https://randomnerdtutorials.com/
 
*****/

#include <ESP8266WiFi.h>
#include <PubSubClient.h>
#include "DHT.h"
#include "MQ135.h"

// Uncomment one of the lines bellow for whatever DHT sensor type you're using!
#define DHTTYPE DHT11   // DHT 11
//#define DHTTYPE DHT21   // DHT 21 (AM2301)
//#define DHTTYPE DHT22   // DHT 22  (AM2302), AM2321
#define PIN_LED LED_BUILTIN


const char* ssid = "k"; //"VTR-1090892";
const char* password = "camilo123"; //"8pmphtjNxxdg";
const char* mqtt_server = "broker.hivemq.com";

// Initializes the espClient. You should change the espClient name if you have multiple ESPs running in your home automation system
WiFiClient espClient;
PubSubClient client(espClient);

String id = "NODE_2"; //cambiar id para cada node
char* inTopic = "int";
char* outTopic = "out";

// DHT Sensor - GPIO 5 = D1 on ESP-12E NodeMCU board
const int DHTPin = D4;
//const int DHTPin = D3;

// Lamp - LED - GPIO 4 = D2 on ESP-12E NodeMCU board
//const int lamp = LED_BUILTIN;

// Initialize DHT sensor.
DHT dht(DHTPin, DHTTYPE);

//Attach sensor to pin A0
MQ135 gasSensor = MQ135(A0); 

// Timers auxiliar variables
long now = millis();
long lastMeasure = 0;
float ppm;

// Don't change the function below. This functions connects your ESP8266 to your router
void setup_wifi() {
  delay(10);
  // We start by connecting to a WiFi network
  Serial.println();
  Serial.print("Connecting to ");
  Serial.println(ssid);
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("WiFi connected: ");
  Serial.println(WiFi.localIP());
}

// This functions is executed when some device publishes a message to a topic that your ESP8266 is subscribed to
// Change the function below to add logic to your program, so when a device publishes a message to a topic that 
// your ESP8266 is subscribed you can actually do something
void callback(String topic, byte* message, unsigned int length) {
  Serial.print("Message arrived on topic: ");
  Serial.print(topic);
  Serial.print(". Message: ");
  String messageTemp;
  
  for (int i = 0; i < length; i++) {
    Serial.print((char)message[i]);
    messageTemp += (char)message[i];
  }
  Serial.println();

  // Feel free to add more if statements to control more GPIOs with MQTT

  // If a message is received on the topic room/lamp, you check if the message is either on or off. Turns the lamp GPIO according to the message
//  if(topic=="LED"){
//      Serial.print("Changing LED to ");
//      if(messageTemp == "on"){
//        digitalWrite(PIN_LED, LOW);
//        Serial.print("On");
//      }
//      else if(messageTemp == "off"){
//        digitalWrite(PIN_LED, HIGH);
//        Serial.print("Off");
//      }
//  }
//  Serial.println();
}

// This functions reconnects your ESP8266 to your MQTT broker
// Change the function below if you want to subscribe to more topics with your ESP8266 
void reconnect() {
  // Loop until we're reconnected
  while (!client.connected()) {
    if (client.connect("ESP8266Client")) {
      //client.publish("outTopic", "reconectando..");
      client.subscribe(inTopic);

      String x = id + " Conectado ok";
      char y[20];
      x.toCharArray(y, 20);
      client.publish("outTopic", "Reconectando...");

    } 
       else {
//      Serial.print("failed, rc=");
//      Serial.print(client.state());
//      Serial.println(" try again in 5 seconds");
      // Wait 15 seconds before retrying
      delay(5000);
    }
  }
}

// The setup function sets your ESP GPIOs to Outputs, starts the serial communication at a baud rate of 115200
// Sets your mqtt broker and sets the callback function
// The callback function is what receives messages and actually controls the LEDs
void setup() {
  pinMode(PIN_LED, OUTPUT);
  
  dht.begin();
  
  Serial.begin(9600);
  setup_wifi();
  client.setServer(mqtt_server, 1883);
  client.setCallback(callback);

}

// For this project, you don't need to change anything in the loop function. 
//Basically it ensures that you ESP is connected to your broker
void loop() {

  if (!client.connected()) {
    reconnect();
  }
  if(!client.loop())
    client.connect("ESP8266Client");

  now = millis();
  // Publishes new temperature and humidity every 5 seconds
  if (now - lastMeasure > 600) {
    lastMeasure = now;
    // Sensor readings may also be up to 2 seconds 'old' (its a very slow sensor)
    float h = dht.readHumidity();
    // Read temperature as Celsius (the default)
    float t = dht.readTemperature();
    // Read temperature as Fahrenheit (isFahrenheit = true)
    //float f = dht.readTemperature(true);


    // Check if any reads failed and exit early (to try again).
    if (isnan(h) || isnan(t)){ //|| isnan(f)) {
      Serial.println("Failed to read from DHT sensor!");
      return;
    }
    //mq135
    //SensorGas = analogRead(0);
    float ppm = gasSensor.getPPM();
    static char GasTemp[7];
    dtostrf(ppm, 6, 0, GasTemp);
    
    // Computes temperature values in Celsius
    float hic = dht.computeHeatIndex(t, h, false);
    
    static char temperatureTemp[7];
    dtostrf(hic, 6, 1, temperatureTemp);
    
    static char humidityTemp[7];
    dtostrf(h, 6, 1, humidityTemp);

    // Publishes Temperature and Humidity values
    client.publish("SP1", temperatureTemp);
    client.publish("SP2", humidityTemp);
    client.publish("SP0", GasTemp);
    
    Serial.print("Calidad Aire: ");
    Serial.print(ppm);
    Serial.print(" ppm");    
    Serial.print('\n');
    Serial.print("Humedad: ");
    Serial.print(h);
    Serial.print(" %");
    Serial.print('\n');
    Serial.print("Temperatura: ");
    Serial.print(t);
    Serial.print(" °C ");
    Serial.print('\n');
    

  }
} 
