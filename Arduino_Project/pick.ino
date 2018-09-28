// RFID 

#include <SPI.h>
#include <MFRC522.h>
 
#define RST_PIN   9                            // reset핀은 9번으로 설정
#define SS_PIN    10                           // SS핀은 10번으로 설정
                                               // SS핀은 데이터를 주고받는 역할의 핀( SS = Slave Selector )

int rec = 5;                                    // rec를 5번 핀으로 
int playe = 4;                                  // playe를 4번 핀으로
int command;                                    // 시리얼 모니터의 명령을 받아들이는 변수
 
MFRC522 mfrc(SS_PIN, RST_PIN);                 // MFR522를 이용하기 위해 mfrc객체를 생성해 줍니다.
 
void setup(){
  Serial.begin(9600);                         // 시리얼 통신, 속도는 9600
  SPI.begin();                                // SPI 초기화
                                              // (SPI : 하나의 마스터와 다수의 SLAVE(종속적인 역활)간의 통신 방식)
  mfrc.PCD_Init();                               
  
  pinMode(3, OUTPUT);

  Serial.begin(9600);                          // 시리얼 통신, 속도는 9600
  pinMode (rec, INPUT);                         // rec를 입력으로
  pinMode (playe,OUTPUT);                       // playe를 출력으로
  Serial.println("*********command*********");  // 1. 녹음 10초 2. 재생
  Serial.println("1. record 10sec");
  Serial.println("2. play ");
}
 
void loop(){
  // 태그가 접촉 될 경우
  if( mfrc.PICC_IsNewCardPresent() || mfrc.PICC_ReadCardSerial() ) {   
     
      // 태그가 접촉 된 경우 => 라이트
      digitalWrite(3, HIGH);  
      
      Serial.print("Card UID:");                  // 태그의 ID출력

      for (byte i = 0; i < 4; i++) {               // 태그의 ID출력하는 반복문.태그의 ID사이즈(4)까지
        Serial.print(mfrc.uid.uidByte[i]);        // mfrc.uid.uidByte[0] ~ mfrc.uid.uidByte[3]까지 출력
        Serial.print(" ");                        // id 사이의 간격 출력
      }
      Serial.println(); 
    
      while(Serial.available()) 
      {                  // 시리얼 통신이 연결되어 있을시    
        
        command = Serial.read();                   // 시리얼 통신으로 한 명령 읽기
        
        switch(command) 
        {                             
          case '1':                                 // 1 입력 시 녹음 시작
            Serial.println("Recording 10 sec.....");
            digitalWrite(rec,HIGH);                 // 녹음 중....
            delay(10000);                           // 10초 동안 녹음 중 
            digitalWrite(rec,LOW);                  // 녹음 종료 
            Serial.println("Recording finished");
            break;
                    
          case '2':                                 // 2 입력 시 녹음된 소리 재생
            Serial.println("play the record!!");
            digitalWrite(playe,HIGH);               // 재생 중.
            delay(10);
            digitalWrite(playe,LOW);                // 녹음된 소리 재생이 끝나면 low로 
            break;
        }
      }              
  } 
  else {
    // 태그 접촉이 되지 않았을때 또는 ID가 읽혀지지 않았을때
     digitalWrite(3, LOW);  
     delay(500);                                // 0.5초 딜레이 
     return;                                    // return
  }
}
