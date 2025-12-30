#include <SPI.h>
#include <MFRC522.h>

#include <ESP8266HTTPClient.h>
#include <ESP8266WiFi.h>

//Nerwork SSID
const char* ssid = "Infinix NOTE 30 Pro";
const char* password = "kosan_ujung";

//pengenalan host (server) = ip address komputer server
const char* host = "192.168.142.20";

#define LED_PIN 15 //D8
#define BTN_PIN 5 //D1

//sediakan variabel RFID
#define SDA_PIN 2 //D4
#define RST_PIN 0 //D3

MFRC522 mfrc522(SDA_PIN, RST_PIN);

void setup() {
  Serial.begin(9600);

  //setting koneksi wifi
  WiFi.hostname("NodeMCU");
  WiFi.begin(ssid, password);

  //cek koneksi wifi
  while(WiFi.status() != WL_CONNECTED)
  {
    //progress sedang mencari wifi
    delay(500);
    Serial.print(".");
  }
    Serial.println("WiFi Connected");
    Serial.println("IP Address : ");
    Serial.println(WiFi.localIP());

    pinMode(LED_PIN, OUTPUT);
    pinMode(BTN_PIN, OUTPUT);

    SPI.begin();
    mfrc522.PCD_Init();
    Serial.println("Mohon Dekatkan Kartu Anda ke Reader");
    Serial.println();
}

void loop() {
  //baca status pin button kemudian uji
  if(digitalRead(BTN_PIN)==1) //ditekan
  {
    //nyalakan lampu LED
    digitalWrite(LED_PIN, HIGH);
    while(digitalRead(BTN_PIN)==1) ;   //menahan proses sampai tombol dilepas

    //ubah mode absen di aplikasi web
    String getData, Link ;
    HTTPClient http ;
    //get data 
    Link = "http://192.168.142.20/absen/ubahmode.php";
    http.begin(Link);

    int httpCode = http.GET();
    String payload = http.getString();

    Serial.println(payload);
    http.end();
  }

    //matikan lampu LED
    digitalWrite(LED_PIN, LOW);

    if(!mfrc522.PICC_IsNewCardPresent())
      return ;

    if(! mfrc522.PICC_ReadCardSerial())
      return ;

    String IDTAG ="";
    for(byte i=0; i<mfrc522.uid.size; i++)
    {
      IDTAG +=mfrc522.uid.uidByte[i];
    }

    //nyalakan lampu LED
    digitalWrite(LED_PIN, HIGH);

    //kirim nomor kartu RFID untuk di simpan ke tabel tmprfid
    WiFiClient client;
    const int httpPort = 80;
    if(!client.connect(host, httpPort))
    {
      Serial.println("Connection Failed");
      return;
    }

    String Link;
    HTTPClient http;
    Link ="http://192.168.142.20/absen/kirimkartu.php?nokartu=" + IDTAG;
    http.begin(Link);

    int httpCode =http.GET();
    String payload = http.getString();
    Serial.println(payload);
    http.end();

    delay(500);

}
