#include <Arduino.h>

#include <ESP8266WiFi.h>

#include <ESP8266WiFiMulti.h>

#include <ESP8266HTTPClient.h>

#include <WiFiClient.h>

ESP8266WiFiMulti WiFiMulti;

/*
 8,6,7
*/

int mysensors[] = {
  5,
  4,
  14
};
int mysensorsize = sizeof(mysensors) / sizeof(int);
int myindicators[] = {
  12,
  13,
  15
};
int myindicatorssize = sizeof(myindicators) / sizeof(int);
int old_water_level = -1;


int location = 1;
const char*  wifiname = "adrian";
const char* wifipass = "Adrian123*";
String endpoint_api = "http://192.168.10.6/macasadia/api/uni_handler.php";
/*
PIN #10 HIGH
PIN #9 HIGH
PIN #5 HIGH
PIN #4 HIGH
PIN #14 HIGH
PIN #0 LOW
PIN #2 LOW
PIN #15 LOW
PIN #13 LOW
PIN #12 LOW
*/

/*
AFTER PIN HAS IN/OUT
16:33:58.634 -> PIN #12 LOW
16:33:58.712 -> PIN #13 LOW
16:33:58.823 -> PIN #15 LOW
16:33:58.949 -> PIN #5 LOW
16:33:59.043 -> PIN #4 LOW
16:33:59.121 -> PIN #14 LOW
*/
bool debugmode = true;
void pinModesSetup() {
  for (int wl = 0; wl < mysensorsize; wl++) {
    pinMode(mysensors[wl], INPUT);
    delay(100);
  }
  Serial.print("Size Of Sensors:");
  Serial.println(mysensorsize);
  if (debugmode == true) {
    for (int bl = 0; bl < myindicatorssize; bl++) {
      pinMode(myindicators[bl], OUTPUT);
      delay(100);
    }
    Serial.print("Size Of Leds:");
    Serial.println(myindicatorssize);
  }
}

void ConnectToWifi(const char * wifi_ssid,const char * wifi_password = "") {
  for (uint8_t t = 4; t > 0; t--) {
    Serial.printf("[SETUP] WAIT %d...\n", t);
    delay(1000);
  }

  WiFi.mode(WIFI_STA);
  WiFiMulti.addAP(wifi_ssid, wifi_password);
  Serial.print("Connecting");
  while (WiFiMulti.run() != WL_CONNECTED) {
    delay(300);
    Serial.print(".");
  }

  if (WiFi.status() == WL_CONNECTED)
    Serial.println("Connected");
}

void LogPinsState() {
  if (debugmode == true) {
    for (int wl = 0; wl < mysensorsize; wl++) {
      if (readFloatingSensor(mysensors[wl])) {
        Serial.print("PIN #");
        Serial.print(mysensors[wl]);
        Serial.println(" LOW");
      } else {
        Serial.print("PIN #");
        Serial.print(mysensors[wl]);
        Serial.println(" HIGH");
      }
      delay(100);
    }
    for (int bl = 0; bl < myindicatorssize; bl++) {
      if (readFloatingSensor(myindicators[bl])) {
        Serial.print("PIN #");
        Serial.print(myindicators[bl]);
        Serial.println(" LOW");
      } else {
        Serial.print("PIN #");
        Serial.print(myindicators[bl]);
        Serial.println(" HIGH");
      }
      delay(100);
    }
  }
}

void setup() 
{
  Serial.begin(115200);
  delay(1000);
  pinModesSetup();
  delay(2000);
  ConnectToWifi(wifiname,wifipass);
}

void loop() {
  /*
  if (WiFi.status() == WL_CONNECTED) {
  */
  Serial.println("=========================================");
  LogPinsState();
  int water_level = readLevels();
  float water_level_feet = water_level * 2.0;
  if(water_level == old_water_level){
    Serial.printf("[LEVELS]  %d [ FEET ] %f \n",water_level,water_level_feet);
    delay(1000); 
    return;
  }
  
  ledLevelIndicator(water_level);
  String datasend = "pid="+String(location)+"&level="+String(water_level)+"&feet="+String(water_level_feet);
  if(water_level >= 1){
    send_get_data("send_water_data",datasend);
  }else if(water_level >= 2){
    send_get_data("send_water_data",datasend); 
  }else if(water_level >= 3){
     send_get_data("send_water_data",datasend); 
  }else {
    send_get_data("send_water_data",datasend); 
  }

  old_water_level = water_level;
  Serial.printf("[LEVELS]  %d [ FEET ] %f \n",water_level,water_level_feet);
  Serial.println("=========================================");
  delay(800);
}

void send_get_data(String type, String data){
  if (WiFi.status() == WL_CONNECTED) {
    WiFiClient client;
    HTTPClient http;
    Serial.print("[HTTP] begin...\n");
    String url_get = endpoint_api+"?type="+type+"&"+data;
    if (http.begin(client, url_get)) {  // HTTP
      Serial.print("[HTTP] GET...\n");
      http.addHeader("Content-Type", "application/json");
      http.addHeader("Encryption", "XgTeIxQLUiv3lOSl8cXNkt4bxIGFjbzl");
      int httpCode = http.GET();//Stop here
      if (httpCode > 0) {
        Serial.printf("[HTTP] GET... code: %d\n", httpCode);

        // file found at server
        if (httpCode == HTTP_CODE_OK || httpCode == HTTP_CODE_MOVED_PERMANENTLY) {
         // String payload = http.getString();
          //Serial.println(payload);
          Serial.println("Success");
        }
      } else {
        Serial.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
      }
      http.end();
    } else {
      Serial.printf("[HTTP} Unable to connect\n");
    }
  }
}

int readLevels(){
    if(readFloatingSensor(mysensors[0])){
      return 0;
    }else{
      if(readFloatingSensor(mysensors[1])){
        return 1;
      }else{
        if(readFloatingSensor(mysensors[2])){
          return 2; 
        }else{
          return 3;
        }
      }
    }
    return 0;
}

void ledLevelIndicator(int WaterLvL){
  digitalWrite(myindicators[0],(WaterLvL >= 1));//false true true true true
  digitalWrite(myindicators[1],(WaterLvL >= 2));//false false true true true
  digitalWrite(myindicators[2],(WaterLvL >= 3));//false false false true true
}

bool readFloatingSensor(int sensorPin) {
  return digitalRead(sensorPin) == LOW; 
}