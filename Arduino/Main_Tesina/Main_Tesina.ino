#include "DHT.h"
#include "Scheduler.h"

#define RELAY_PUMP 4
#define RELAY_LAMP 3
#define DHTPIN 2     // what pin we're connected to
#define DHTTYPE DHT22   // DHT 22  (AM2302)

DHT dht(DHTPIN, DHTTYPE, 30);

void setup() {
  Serial.begin(115200);
  pinMode(RELAY_LAMP, OUTPUT);
  pinMode(RELAY_PUMP, OUTPUT);
  dht.begin();
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