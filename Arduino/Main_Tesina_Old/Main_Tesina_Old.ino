#include "DHT.h"
#include "Scheduler.h"

#define DHTPIN 2     // what pin we're connected to
#define RELAY_LAMP 3
#define RELAY_PUMP 4
#define RELAY_FAN 5
#define DHTTYPE DHT22   // DHT 22  (AM2302)

DHT dht(DHTPIN, DHTTYPE, 30);

void setup() {
  Serial.begin(115200);
  pinMode(RELAY_LAMP, OUTPUT);
  pinMode(RELAY_PUMP, OUTPUT);
  pinMode(RELAY_FAN, OUTPUT);
  dht.begin();
  digitalWrite(RELAY_LAMP, HIGH);
  digitalWrite(RELAY_PUMP, LOW);
  digitalWrite(RELAY_FAN, LOW);
}

void loop()
{
  delay(2000);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  
  if (isnan(h) || isnan(t)) {
    //Serial.println("Failed to read from DHT sensor!");
    Serial.println("e");
    return;
  }

  if(h > 60){
    digitalWrite(RELAY_FAN, HIGH);
    digitalWrite(RELAY_LAMP, LOW);
  }
  else{
    digitalWrite(RELAY_FAN, LOW);
    digitalWrite(RELAY_LAMP, HIGH);
  }

}

void loop1() {
  delay(2000);
  float h = dht.readHumidity();
  float t = dht.readTemperature();
  
  if (isnan(h) || isnan(t)) {
    //Serial.println("Failed to read from DHT sensor!");
    Serial.println("e");
    return;
  }

  //Serial.print("Humidity: "); 
  Serial.print("h");
  Serial.print(h);
  //Serial.print(" %\t"); (% = Semplicemente il carattere %) (\t = TAB)
  //Serial.print("Temperature: "); 
  Serial.print("t");
  Serial.print(t);
  //Serial.print(" *C ");
}