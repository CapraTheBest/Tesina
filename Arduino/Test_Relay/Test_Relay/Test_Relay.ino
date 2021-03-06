#define RELAY1  6                        
#define RELAY2  7                        
#define RELAY3  8                        
 
void setup()
{    
// Initialise the Arduino data pins for OUTPUT
  pinMode(RELAY1, OUTPUT);       
  pinMode(RELAY2, OUTPUT);
  pinMode(RELAY3, OUTPUT);
}
 
 void loop()
{
   digitalWrite(RELAY1,LOW);           // Turns ON Relays 1
   delay(2000);                                      // Wait 2 seconds
   digitalWrite(RELAY1,HIGH);          // Turns Relay Off
 
   digitalWrite(RELAY2,LOW);           // Turns ON Relays 2
   delay(2000);                                      // Wait 2 seconds
   digitalWrite(RELAY2,HIGH);          // Turns Relay Off
 
   digitalWrite(RELAY3,LOW);           // Turns ON Relays 3
   delay(2000);                                      // Wait 2 seconds
   digitalWrite(RELAY3,HIGH);          // Turns Relay Off   
 }
